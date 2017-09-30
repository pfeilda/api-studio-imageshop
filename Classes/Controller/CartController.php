<?php
/**
 * All Files are owned by API-Studio. It is forbidden to use,
 * distrubute or anything else without permission of the
 * owner. CEO Daniel Pfeil <dp@api-studio.de>
 * Copyright (c) 2015-2017.
 */
namespace Apistudio\Imageshop\Controller;

use Apistudio\Imageshop\Domain\Model\Cart;
use Apistudio\Imageshop\Domain\Model\Collection;
use Apistudio\Imageshop\Domain\Model\Product;
use Apistudio\Imageshop\Domain\Repository\CartRepository;
use Apistudio\Imageshop\Domain\Repository\CollectionRepository;
use Apistudio\Imageshop\Domain\Repository\ProductRepository;
use TYPO3\CMS\Core\Utility\DebugUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/**
 * Class Main
 * @package Apistudio\Imageshop\Controller
 */
class CartController extends ActionController
{
    /**
     * @param array $products
     * @param array $collection
     */
    public function refreshAction(array $products, array $collection){

        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $collectionRepository = $objectManager->get(CollectionRepository::class);
        $productRepository = $objectManager->get(ProductRepository::class);
        $cartRepository = $objectManager->get(CartRepository::class);
        $feUserRepository = $objectManager->get(FrontendUserRepository::class);
        $collection = $collectionRepository->findByIdentifier($collection);

        $unpaidCarts = $cartRepository->findByIspaid(false);
        if($unpaidCarts->count()!== 0){
            $unpaidCart = $unpaidCarts[0];
        } else {
            $unpaidCart = $objectManager->get(Cart::class);
        }

        foreach ($products as $key => $value){
            if($value == 1){
                $productsModel = $productRepository->findByUid($key);
                if($productsModel instanceof Product){
                    $unpaidCart->addProduct($productsModel);
                }
            }
        }

        $feUser = $feUserRepository->findByUid($GLOBALS["TSFE"]->fe_user->user["uid"]);
        $unpaidCart->setFeUser($feUser);

        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($unpaidCart->getPaymentmethod());

        if($unpaidCart->getUid() === null){
            $cartRepository->add($unpaidCart);
            DebugUtility::debug("tet");
        } else {
            $cartRepository->update($unpaidCart);
        }
        DebugUtility::debug($cartRepository);

        $this->view->assign("cart",$unpaidCart);
    }

    /**
     * @param array $product
     */
    public function removeproductAction(array $product = []){
        DebugUtility::debug($product);

        $this->forward("refresh",null,null, array("products"=>array(),"collection"=>array()));
    }

    protected function getUnpaidCart(){

    }
}