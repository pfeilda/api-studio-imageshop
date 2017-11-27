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

$EM_CONF[$_EXTKEY] = array(
    'title' => 'Image Shop',
    'description' => 'These extension adds a rudimental shop system for images.',
    'category' => 'fe',
    'constraints' => array(
        'depends' => array(
            'typo3' => '8.0.0-8.9.9'
        )
    ),
    'state' => 'beta',
    'uploadFolder' => 0,
    'clearCacheOnLoad' => 0,
    'author' => 'Daniel Pfeil',
    'author_email' => 'dp@api-studio.de',
    'author_company' => 'API Studio UG (haftungsbeschränkt)',
    'version' => '0.9.0'
);