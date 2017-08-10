<?php
defined('TYPO3_MODE') or die();
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_imageshop_domain_model_collection');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_imageshop_domain_model_product');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY,"Configuration/TypoScript", "TypoScript for Imageshop");

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin("Apistudio." . $_EXTKEY, "inventory", "Inventory");