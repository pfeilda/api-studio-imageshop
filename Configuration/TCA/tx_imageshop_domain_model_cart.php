<?php
/**
 * All Files are owned by API-Studio. It is forbidden to use,
 * distrubute or anything else without permission of the
 * owner. CEO Daniel Pfeil <dp@api-studio.de>
 * Copyright (c) 2015-2017.
 */

return array(
    'ctrl' => array(
        'title' => 'LLL:EXT:imageshop/Resources/Private/Language/locallang.xlf:cart',
        'label' => 'name',
        'label_alt' => '',
        'iconfile' => '/typo3/sysext/core/Resources/Public/Icons/T3Icons/apps/apps-filetree-folder-media.svg',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'default_sortby' => 'name ASC',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
            'fe_group' => 'fe_group'
        )
    ),
    'columns' => array(
        'paymentdate' => array(
            'exclude' => true,
            'label' => 'LLL:EXT:imageshop/Resources/Private/Language/locallang.xlf:paymentdate',
            'config' => array(
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
                'default' => 0
            )
        ),
        'ispaid' => array(
            'exclude' => true,
            'label' => 'LLL:EXT:imageshop/Resources/Private/Language/locallang.xlf:ispaid',
            'config' => array(
                'type' => 'check',
                'default' => 0
            )
        ),
        'paymentmethod' => array(
            'exclude' => true,
            'label' => 'LLL:EXT:imageshop/Resources/Private/Language/locallang.xlf:paymentmethod',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => array(
                    array('LLL:EXT:imageshop/Resources/Private/Language/locallang.xlf:paymentmethod.pleaseselect', '--div--'),
                    array('LLL:EXT:imageshop/Resources/Private/Language/locallang.xlf:paymentmethod.notselected', '0'),
                    array('LLL:EXT:imageshop/Resources/Private/Language/locallang.xlf:paymentmethod.paypal', '1'),
                    array('LLL:EXT:imageshop/Resources/Private/Language/locallang.xlf:paymentmethod.manual', '2'),
                ),
                'default' =>'--div--',
                'size' => 1,
                'maxitems' => 1
            )
        ),
        'starttime' => array(
            'exclude' => true,
            'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => array(
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
                'default' => 0
            ),
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly'
        ),
        'endtime' => array(
            'exclude' => true,
            'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => array(
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
                'default' => 0,
                'range' => array(
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                )
            ),
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly'
        ),
        'fe_group' => array(
            'exclude' => true,
            'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.fe_group',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'size' => 5,
                'maxitems' => 20,
                'items' => array(
                    array(
                        'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.hide_at_login',
                        -1
                    ),
                    array(
                        'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.any_login',
                        -2
                    ),
                    array(
                        'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.usergroups',
                        '--div--'
                    )
                ),
                'exclusiveKeys' => '-1,-2',
                'foreign_table' => 'fe_groups',
                'foreign_table_where' => 'ORDER BY fe_groups.title',
                'enableMultiSelectFilterTextfield' => true
            )
        ),
        'hidden' => array(
            'exclude' => true,
            'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => array(
                'type' => 'check',
                'items' => array(
                    '1' => array(
                        '0' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:hidden.I.0'
                    )
                )
            )
        ),
        'l18n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough',
                'default' => ''
            )
        ),
    ),
    'palettes' => array(
        'access' => array(
            'showitem' => '
                starttime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel,
                endtime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel,
                --linebreak--,
                fe_group;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:fe_group_formlabel,
                --linebreak--,editlock
            ',
        ),
        'hidden' => array(
            'showitem' => '
                hidden;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:field.default.hidden
            ',
        ),
    ),
    'types' => array(
        '0' => array(
            'showitem' => '
                --div--;LLL:EXT:imageshop/Resources/Private/Language/locallang.xlf:general, 
                    paymentdate,ispaid,paymentmethod,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, 
                    --palette--;;hidden,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                    '
        )
    )
);