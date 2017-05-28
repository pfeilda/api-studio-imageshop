<?php
if (!defined('TYPO3_MODE')) die ('Access denied.');
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    "ApiStudio." . $_EXTKEY, "inventory", array("Main" => "list, test"), array("Main" => "list, test"));