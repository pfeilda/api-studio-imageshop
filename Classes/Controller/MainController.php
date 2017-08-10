<?php

namespace Apistudio\Imageshop\Controller;

use Apistudio\Imageshop\Domain\Repository\CollectionRepository;
use TYPO3\CMS\Core\Utility\DebugUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Fluid\View\TemplateView;
use TYPO3\CMS\Frontend\Imaging\GifBuilder;

/**
 * Class Main
 * @package Apistudio\Imageshop\Controller
 */
class MainController extends ActionController
{
    /**
     * list action
     */
    public function listAction()
    {
        $objectmanager = new ObjectManager();
        $collectionRepository = $objectmanager->get(CollectionRepository::class);

        $collections = $collectionRepository->findAll();
        $this->view->assign("collections", $collections);

        $this->checkForLoggedInUser($this->view);
    }

    /**
     * detail action
     * @param int $collectionId
     */
    public function detailAction($collectionId)
    {
        $objectmanager = new ObjectManager();
        $collectionRepository = $objectmanager->get(CollectionRepository::class);

        $collection = $collectionRepository->findByUid($collectionId);

        $gifbuilder = $objectmanager->get(GifBuilder::class);
//        $gifbuilder->

        $this->view->assign("collection", $collection);

        $this->checkForLoggedInUser($this->view);
    }

    /**
     * check for user
     * @param \TYPO3\CMS\Fluid\View\TemplateView $view
     */
    private function checkForLoggedInUser(TemplateView $view){
        $user = $GLOBALS["TSFE"]->fe_user->user;
        if(is_array($user)){
            $view->assign("isLoggedIn",true);
            $view->assign("user",$user);
        } else {
            $view->assign("isLoggedIn",false);
        }
    }

}