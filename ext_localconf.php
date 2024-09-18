<?php
defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Produzentenstolz',
        'list',
        [
            \Produzentenstolz\Produzentenstolz\Controller\ProduzentenstolzController::class => 'list'
        ],
        // non-cacheable actions
        [

        ]
    );
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Produzentenstolz',
        'map',
        [
            \Produzentenstolz\Produzentenstolz\Controller\ProduzentenstolzController::class => 'map'
        ],
        // non-cacheable actions
        [

        ]
    );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    list {
                        iconIdentifier = produzentenstolz-plugin-list
                        title = LLL:EXT:produzentenstolz/Resources/Private/Language/locallang_db.xlf:tx_produzentenstolz_list.name
                        description = LLL:EXT:produzentenstolz/Resources/Private/Language/locallang_db.xlf:tx_produzentenstolz_list.description
                        tt_content_defValues {
                            CType = list
                            list_type = produzentenstolz_list
                        }
                    }
                    map {
                        iconIdentifier = produzentenstolz-plugin-map
                        title = LLL:EXT:produzentenstolz/Resources/Private/Language/locallang_db.xlf:tx_produzentenstolz_map.name
                        description = LLL:EXT:produzentenstolz/Resources/Private/Language/locallang_db.xlf:tx_produzentenstolz_map.description
                        tt_content_defValues {
                            CType = list
                            list_type = produzentenstolz_map
                        }
                    }
                }
                show = *
            }
       }'
    );
})();

$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['proxy'] = \Produzentenstolz\Produzentenstolz\Controller\ProxyController::class . '::proxyAction';
