<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'Address Collection '
);

$pluginSignature = str_replace('_','',$_EXTKEY) . '_pi1';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_pi1.xml');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Address Collection (Extbase)');



if (!\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('tt_address')){
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/ttaddress_tables.php';
}

if (!isset($GLOBALS['TCA']['tt_address']['ctrl']['type'])) {
	if (file_exists($GLOBALS['TCA']['tt_address']['ctrl']['dynamicConfigFile'])) {
		require_once($GLOBALS['TCA']['tt_address']['ctrl']['dynamicConfigFile']);
	}
	// no type field defined, so we define it here. This will only happen the first time the extension is installed!!
	$GLOBALS['TCA']['tt_address']['ctrl']['type'] = 'tx_extbase_type';
	$tempColumns = array();
	$tempColumns[$GLOBALS['TCA']['tt_address']['ctrl']['type']] = array(
		'exclude' => 1,
		'label'   => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection.tx_extbase_type',
		'config' => array(
			'type' => 'select',
			'items' => array(),
			'size' => 1,
			'maxitems' => 1,
		)
	);
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_address', $tempColumns, 1);
}

$tmp_address_collection_columns = array(
	'position' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection_domain_model_address.position',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'department' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection_domain_model_address.department',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'qualifications' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection_domain_model_address.qualifications',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'fal_image' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection_domain_model_address.fal_image',
		'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
			'falImage',
			array('maxitems' => 1),
			$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
		),
	),
	'nick_name' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection_domain_model_address.nick_name',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'post_office_box' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection_domain_model_address.post_office_box',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'longitude' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection_domain_model_address.longitude',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'latitude' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection_domain_model_address.latitude',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'user' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection_domain_model_address.user',
		'config' => array(
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => 'fe_users',
			'size' => '1',
			'maxitems' => '1',
			'minitems' => '0',
			'show_thumbs' => '1',
			'wizards' => array(
				'suggest' => array(
					 'type' => 'suggest',
				),
			),
		),

	),
	'other_addresses' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection_domain_model_address.related_addresses',
		'config' => array(
			'type' => 'inline',
			'foreign_table' => 'tt_address',
			'foreign_field' => 'parent_address',
			'maxitems'      => 9999,
			'appearance' => array(
				'collapseAll' => 0,
				'levelLinksPosition' => 'top',
				'showSynchronizationLink' => 1,
				'showPossibleLocalizationRecords' => 1,
				'showAllLocalizationLink' => 1
			),
		),

	),
	'related_addresses' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection_domain_model_address.related_addresses',
		'config' => array(
			'type' => 'select',
			'foreign_table' => 'tt_address',
			'MM' => 'tx_addresscollection_address_relatedaddresses_address_mm',
			'size' => 10,
			'autoSizeMax' => 30,
			'maxitems' => 9999,
			'multiple' => 0,
			'wizards' => array(
				'_PADDING' => 1,
				'_VERTICAL' => 1,
				'edit' => array(
					'type' => 'popup',
					'title' => 'Edit',
					'script' => 'wizard_edit.php',
					'icon' => 'edit2.gif',
					'popup_onlyOpenIfSelected' => 1,
					'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
					),
				'add' => Array(
					'type' => 'script',
					'title' => 'Create new',
					'icon' => 'add.gif',
					'params' => array(
						'table' => 'tt_address',
						'pid' => '###CURRENT_PID###',
						'setValue' => 'prepend'
						),
					'script' => 'wizard_add.php',
				),
			),
		),
	),
);

$tmp_address_collection_columns['parent_address'] = array(
	'config' => array(
		'type' => 'passthrough',
	)
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_address',$tmp_address_collection_columns);


$GLOBALS['TCA']['tt_address']['ctrl']['dividers2tabs'] = 1;


//$TCA['tt_address']['types']['1']['showitem'] =  'hidden;;;;1-1-1, tx_extbase_type, gender;;;;3-3-3, name, first_name, middle_name, last_name;;2;;, birthday, address;;6, zip, city;;3, email;;5, phone;;4, image;;;;4-4-4, description, addressgroup;;;;1-1-1, --div--;LLL:EXT:lang/locallang_tca.xlf:sys_category.tabs.category, categories';

\MONOGON\AddressCollection\Utility\TcaUtility::addType('Tx_AddressCollection_Address');
\MONOGON\AddressCollection\Utility\TcaUtility::addType('Tx_AddressCollection_BusinessAddress');
\MONOGON\AddressCollection\Utility\TcaUtility::addType('Tx_AddressCollection_CompanyAddress');
\MONOGON\AddressCollection\Utility\TcaUtility::addType('Tx_AddressCollection_PersonalAddress');
\MONOGON\AddressCollection\Utility\TcaUtility::addType('Tx_AddressCollection_DeliveryAddress');
\MONOGON\AddressCollection\Utility\TcaUtility::addType('Tx_AddressCollection_BillingAddress');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_address', $GLOBALS['TCA']['tt_address']['ctrl']['type'],'','after:' . $TCA['tt_address']['ctrl']['label']);





\MONOGON\AddressCollection\Utility\TcaUtility::showItem('Tx_AddressCollection_Address');
\MONOGON\AddressCollection\Utility\TcaUtility::showItem('Tx_AddressCollection_BusinessAddress');
\MONOGON\AddressCollection\Utility\TcaUtility::showItem('Tx_AddressCollection_CompanyAddress');
\MONOGON\AddressCollection\Utility\TcaUtility::showItem('Tx_AddressCollection_PersonalAddress');
\MONOGON\AddressCollection\Utility\TcaUtility::showItem('Tx_AddressCollection_DeliveryAddress');
\MONOGON\AddressCollection\Utility\TcaUtility::showItem('Tx_AddressCollection_BillingAddress');





if (TYPO3_MODE == 'BE') {
	\MONOGON\AddressCollection\Utility\ExtensionUtility::addWizicon('Pi1');
}

// Add page tree icon
if (TYPO3_MODE == 'BE') {
	\TYPO3\CMS\Backend\Sprite\SpriteManager::addTcaTypeIcon('pages', 'contains-address', '../typo3conf/ext/' . $_EXTKEY . '/Resources/Public/Icons/folder.gif');
	$TCA['pages']['columns']['module']['config']['items'][] = array(
	'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_be.xlf:pages.module.address',
	'address',
	'EXT:' . $_EXTKEY . '/Resources/Public/Icons/folder.gif'
	);
}