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
namespace Apistudio\Imageshop\ViewHelpers;

use TYPO3\CMS\Core\Imaging\ImageManipulation\CropVariantCollection;
use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\Utility\CommandUtility;
use TYPO3\CMS\Core\Utility\DebugUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Service\ImageService;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class CopyrightViewHelper
 * @package Apistudio\Imageshop\ViewHelpers
 * @todo extend Mediaviewhelper and width and height configurable
 */
class CopyrightViewHelper extends AbstractViewHelper
{
    /**
     * @param FileReference $filereference
     * @return string
     */
    public function render(FileReference $filereference){
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $imageService = $objectManager->get(ImageService::class);


        $cropVariant = $this->arguments['cropVariant'] ?: 'default';
        $cropString = $filereference instanceof FileReference ? $filereference->getProperty('crop') : '';
        $cropVariantCollection = CropVariantCollection::create((string)$cropString);
        $cropArea = $cropVariantCollection->getCropArea($cropVariant);
        $processingInstructions = [
            'width' => 200,
            'crop' => $cropArea->isEmpty() ? null : $cropArea->makeAbsoluteBasedOnFile($filereference),
        ];

        $images = $imageService->applyProcessingInstructions($filereference, $processingInstructions);

        $dest =  time() . $images->getUid() . "ouput.jpg";
        $status = CommandUtility::exec(CommandUtility::imageMagickCommand("composite", "-gravity " . PATH_site . "copyright.png Center " . PATH_site . $images->getPublicUrl() . " " .  PATH_site . $dest),$out,$return);

        return $dest;
    }
}