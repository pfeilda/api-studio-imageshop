<?php
if (!defined('TYPO3_MODE')) die ('Access denied.');
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    "Apistudio." . $_EXTKEY,
    "inventory",
    array("Main" => "list, detail"),
    array("Main" => ""),
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_PLUGIN
);
