<?php
/**
 * All Files are owned by API-Studio. It is forbidden to use,
 * distrubute or anything else without permission of the
 * owner. CEO Daniel Pfeil <dp@api-studio.de>
 * Copyright (c) 2015-2017.
 */
namespace Apistudio\Imageshop\Controller;

use Apistudio\Imageshop\Domain\Repository\CollectionRepository;
use Apistudio\Imageshop\Domain\Repository\ProductRepository;
use TYPO3\CMS\Core\Utility\DebugUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/**
 * Class Main
 * @package Apistudio\Imageshop\Controller
 */
class CartController extends ActionController
{
    public function refreshAction(){
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $collectionRepository = $objectManager->get(CollectionRepository::class);
        $productRepository = $objectManager->get(ProductRepository::class);

        $formPostValue = $GLOBALS["_POST"]["tx_imageshop_inventory"];

        $collection = $collectionRepository->findByUid($formPostValue["collection"]);
        $products = array();
        foreach ($formPostValue["products"] as $key => $value){
            if($value == 1){
                $products[] = $productRepository->findByUid($value);
            }
        }

    }
}