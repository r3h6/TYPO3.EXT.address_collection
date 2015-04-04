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
	if (!defined('TT_ADDRESS_MAX_IMAGES')){
		define('TT_ADDRESS_MAX_IMAGES', 6);
	}
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
	'images' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection_domain_model_address.images',
		'config' =>
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
			'images',
			array('maxitems' => 6),
			$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
		),

	),
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


// $GLOBALS['TCA']['tt_address']['types']['Tx_AddressCollection_Address']['showitem'] .= 'name, first_name, middle_name, last_name, gender, birthday, title, email, phone, mobile, fax, www, company, address, building, room, zip, city, region, country, image, images, description, position, department, qualifications, nick_name, post_office_box, longitude, latitude, user, address_groups';


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