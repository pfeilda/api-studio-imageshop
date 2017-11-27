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

use Apistudio\Imageshop\Domain\Repository\CollectionRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Fluid\View\TemplateView;

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