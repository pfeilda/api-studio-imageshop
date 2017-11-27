<?php
/**
 * Copyright notice
 *
 * (c)  2017-2017. Daniel Pfeil <dp@api-studio.de>, API Studio UG (haftungsbeschraenkt)
 *
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 */
namespace Apistudio\Imageshop\Controller;

use Apistudio\Imageshop\Domain\Model\Cart;
use Apistudio\Imageshop\Domain\Model\Product;
use Apistudio\Imageshop\Domain\Repository\CartRepository;
use Apistudio\Imageshop\Domain\Repository\ProductRepository;
use Apistudio\Imageshop\Utility\PayPalUtility;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\PayerInfo;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

/**
 * Class Main
 * @package Apistudio\Imageshop\Controller
 */
class CartController extends ActionController
{
    /**
     * @param array $products
     * @param array $collection
     * @param array $error
     */
    public function refreshAction(array $products, array $collection, $error = []){

        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $cartRepository = $objectManager->get(CartRepository::class);
        $productRepository = $objectManager->get(ProductRepository::class);
        $feUserRepository = $objectManager->get(FrontendUserRepository::class);

        $unpaidCart = $this->getUnpaidCart();

        foreach ($products as $key => $value){
            if($value == 1){
                $productsModel = $productRepository->findByUid($key);
                if($productsModel instanceof Product){
                    $unpaidCart->addProduct($productsModel);
                }
            }
        }

        $feUser = $feUserRepository->findByUid($GLOBALS["TSFE"]->fe_user->user["uid"]);

        $this->saveRepository($unpaidCart, $cartRepository);
        $unpaidCart->setFeUser($feUser);
        $this->saveRepository($unpaidCart, $cartRepository);

        if(count($error)>0){
            $this->view->assign("error", $error);
        }

        $this->view->assign("cart",$unpaidCart);
    }

    /**
     * @todo refactor and extract
     * @todo PayerID, token, paymentId add these fields to dont check cHash in Installtool
     */
    public function payAction(){

        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $feUserRepository = $objectManager->get(FrontendUserRepository::class);
        $agbs = $this->request->getArgument("agb");

        if ($agbs === "accepted"){
            //@todo refactor with design Pattern
            $apiContext = PayPalUtility::getApiContext($this->settings["paypal"]["clientId"],$this->settings["paypal"]["clientSecret"]);

            $feUser = $feUserRepository->findByUid($GLOBALS["TSFE"]->fe_user->user["uid"]);

            $payerInfo = new PayerInfo();
            $payerInfo->setPayerId($feUser->getUid());

            $payer = new Payer();
            $payer->setPaymentMethod("paypal");
            $payer->setPayerInfo($payerInfo);

            $unpaidCart = $this->getUnpaidCart();

            $itemList = new ItemList();
            $subtotal = 0.0;
            foreach ($unpaidCart->getProducts() as $key => $value){
                var_dump($value);
                $price = $value->getPrice();
                $subtotal = $subtotal + $price;

                $item = new Item();
                $item->setName($value->getName())
                    ->setCurrency("EUR")
                    ->setQuantity(1)
                    ->setSku($value->getUid())
                    ->setPrice($price);
                $itemList->addItem($item);
            }

            $details = new Details();
            $tax = ($subtotal * 0.19);
            $total = $subtotal + $tax;
            $details->setTax($tax)
                ->setSubtotal($subtotal);

            $amount = new Amount();
            $amount->setCurrency("EUR")
                ->setTotal($total)
                ->setDetails($details);

            //@todo description in typoscript
            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription("Bilder")
                ->setInvoiceNumber(uniqid());

            $uriBuilder = $objectManager->get(UriBuilder::class);
            //@todo improve protocol by both
            $returnUrl = "http://" . $_SERVER["HTTP_HOST"] . "/" . $uriBuilder->reset()
                ->setTargetPageUid($GLOBALS['TSFE']->id)
                ->uriFor(
                    "verifypayment",
                    array("status"=> "success"),
                    "Cart",
                    "imageshop",
                    "inventory");
            $cancelUrl = "http://" . $_SERVER["HTTP_HOST"] . "/" .  $uriBuilder->reset()->buildFrontendUri() . $uriBuilder->reset()
                ->setTargetPageUid($GLOBALS['TSFE']->id)
                ->uriFor(
                    "verifypayment",
                    array("status"=> "fail"),
                    "Cart",
                    "imageshop",
                    "inventory");

            $redirectUrls = new RedirectUrls();
            $redirectUrls->setReturnUrl($returnUrl)
                ->setCancelUrl($cancelUrl);

            $payment = new Payment();
            $payment->setIntent("sale")
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions(array($transaction));

            $request = clone $payment;

            try{
                $payment->create($apiContext);
                $approvalUrl = $payment->getApprovalLink();
                $cartRepository = $objectManager->get(CartRepository::class);
                $unpaidCart->setAcceptagb(true);
                if($payment->getUpdateTime() !== null){
                    $unpaidCart->setPaymentdate(new \DateTime($payment->getUpdateTime()));
                } else {
                    $unpaidCart->setPaymentdate(new \DateTime($payment->getCreateTime()));
                }
                $unpaidCart->setPaymentid($payment->getId());
                $unpaidCart->setPaymentstate(PayPalUtility::getStatusKey($payment));
                $unpaidCart->setPaymentmethod(1);

                $this->saveRepository($unpaidCart,$cartRepository);

                header("Location: {$approvalUrl}",true,302);
                exit();
            }catch (\Exception $exception){
                var_dump($exception);
                //@todo refresh view with exception
            }

        } else {
            $this->forward("refresh", null, null, ["products" => [], "collection" => [], "error"=>["agbs"]]);
        }
    }

    /**
     *
     */
    public function verifypaymentAction(){
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $cartRepository = $objectManager->get(CartRepository::class);
        $apicontext = PayPalUtility::getApiContext($this->settings["paypal"]["clientId"],$this->settings["paypal"]["clientSecret"]);
        $payment = Payment::get($_GET['paymentId'], $apicontext);
        $cart = $cartRepository->findByPaymentid($payment->getId())[0];

        $execution = new PaymentExecution();
        $execution->setPayerId($_GET['PayerID']);

        $statusKey = PayPalUtility::getStatusKey($payment);

        if($statusKey == 1){
            try{
                $result = $payment->execute($execution,$apicontext);
                $statusKey = PayPalUtility::getStatusKey($payment);
                $cart->setPaymentstate($statusKey);
                $this->saveRepository($cart, $cartRepository);
            } catch (Exception $exception){
                //@todo implement Exception
            }
        } else if($statusKey == 2){
            $cart->setPaymentstate($statusKey);
            $this->saveRepository($cart, $cartRepository);
        }

        $this->forward("list", null, null, array());
    }

    /**
     *
     */
    public function listAction(){
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $cartRepository = $objectManager->get(CartRepository::class);
        $feuserRepository = $objectManager->get(FrontendUserRepository::class);

        $feUser = $feuserRepository->findByUid($GLOBALS["TSFE"]->fe_user->user["uid"]);

        $carts = $cartRepository->findByFeUser($feUser);

        foreach ($carts as $key => $value){
            if(!$value->isCleared()){
                unset($carts[$key]);
            }
        }

        $this->view->assign("cobj", $this->configurationManager->getContentObject()->data);
        $this->view->assign("carts", $carts);
    }

    public function downloadAction(){
        $objectmanager = GeneralUtility::makeInstance(ObjectManager::class);
        $cartRepository = $objectmanager->get(CartRepository::class);
        //@todo check if user can download cart
        $feuserRepository = $objectmanager->get(FrontendUserRepository::class);
        $feUser = $feuserRepository->findByUid($GLOBALS["TSFE"]->fe_user->user["uid"]);

        $cart = $cartRepository->findByUid($this->request->getArgument("cart"));

        $zip = new \ZipArchive();
        $downloadFolder = uniqid();
        mkdir("typo3temp" . DIRECTORY_SEPARATOR . "imageshop" . DIRECTORY_SEPARATOR . $downloadFolder, 0755, true);
        $zipPath = "typo3temp" . DIRECTORY_SEPARATOR . "imageshop" . DIRECTORY_SEPARATOR . $downloadFolder
            . DIRECTORY_SEPARATOR .  $cart->getUid() . "_" . date("d-m-Y") . ".zip";

        if(file_exists($zipPath)) {
            $zip->open($zipPath, \ZipArchive::OVERWRITE);
        } else{
            $zip->open($zipPath, \ZipArchive::CREATE);
        }

        foreach ($cart->getProducts() as $key => $value){
            $resource = $value->getMedia()->getOriginalResource();
            $zip->addFile($resource->getPublicUrl(true),$resource->getProperties()["name"]);
        }
        $zip->close();

        header("location: http://" .  $_SERVER["HTTP_HOST"]  . DIRECTORY_SEPARATOR . $zipPath,true,302);
    }

    public function removeproductAction(){
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $productRepository = $objectManager->get(ProductRepository::class);
        $cartRepository = $objectManager->get(CartRepository::class);

        $cart = $this->getUnpaidCart();
        $product = $productRepository->findByUid($this->request->getArgument("product"));
        $cart->removeProduct($product);

        $this->saveRepository($cart, $cartRepository);

        $this->forward("refresh",null,null, array("products"=>array(),"collection"=>array()));
    }

    /**
     * @return Cart
     */
    protected function getUnpaidCart():Cart{
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $cartRepository = $objectManager->get(CartRepository::class);
        $feUserRepository = $objectManager->get(FrontendUserRepository::class);

        $feUser = $feUserRepository->findByUid($GLOBALS["TSFE"]->fe_user->user["uid"]);

        $carts = $cartRepository->findByFeUser($feUser);
        $unpaidCarts = array();
        foreach ($carts as $cart){
            if(!$cart->isCleared()){
                array_push($unpaidCarts, $cart);
            }
        }

        if(count($unpaidCarts)!== 0){
            return $unpaidCarts[0];
        } else {
            return $objectManager->get(Cart::class);
        }
    }

    protected function saveRepository($model, $repository){
        if($model->getUid() === null){
            $repository->add($model);
        } else {
            $repository->update($model);
        }
        $objectmanager = GeneralUtility::makeInstance(ObjectManager::class);
        $persistenceManager = $objectmanager->get(PersistenceManager::class);
        $persistenceManager->persistAll();
    }
}