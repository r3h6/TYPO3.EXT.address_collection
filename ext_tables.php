<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'Address collection'
);

$pluginSignature = str_replace('_','',$_EXTKEY) . '_pi1';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_pi1.xml');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Address collection');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tt_address', 'EXT:address_collection/Resources/Private/Language/locallang_csh_tt_address.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tt_address');
$GLOBALS['TCA']['tt_address'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'default_sortby' => 'ORDER BY name ASC',

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',

		),
		'searchFields' => 'name,first_name,middle_name,last_name,gender,birthday,title,email,phone,phone_direct,mobile,fax,www,address,building,room,zip,city,region,country,post_office_box,image,images,description,company,position,department,qualifications,nick_name,longitude,latitude,skype,twitter,facebook,linked_in,address_groups,related_addresses,related_addresses_from,user,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Address.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tt_address.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tt_address_group', 'EXT:address_collection/Resources/Private/Language/locallang_csh_tt_address_group.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tt_address_group');
$GLOBALS['TCA']['tt_address_group'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_group',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',

		),
		'searchFields' => 'title,description,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/AddressGroup.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tt_address_group.gif'
	),
);

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

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

//$GLOBALS['TCA']['tt_address']['ctrl']['dividers2tabs'] = 1;
$GLOBALS['TCA']['tt_address']['ctrl']['requestUpdate'] = 'country';

/**
 * Add address types
 */
\Monogon\AddressCollection\Utility\TcaUtility::addType('Tx_AddressCollection_Address');
\Monogon\AddressCollection\Utility\TcaUtility::addType('Tx_AddressCollection_BusinessAddress');
\Monogon\AddressCollection\Utility\TcaUtility::addType('Tx_AddressCollection_CompanyAddress');
\Monogon\AddressCollection\Utility\TcaUtility::addType('Tx_AddressCollection_PersonalAddress');


if (TYPO3_MODE == 'BE') {
	// Add wizard icon
	\Monogon\AddressCollection\Utility\ExtensionUtility::addWizicon('Pi1');
	// Add page tree icon
	\TYPO3\CMS\Backend\Sprite\SpriteManager::addTcaTypeIcon('pages', 'contains-address', '../typo3conf/ext/' . $_EXTKEY . '/Resources/Public/Icons/folder.gif');
	$TCA['pages']['columns']['module']['config']['items'][] = array(
	'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_be.xlf:pages.module.address',
	'address',
	'EXT:' . $_EXTKEY . '/Resources/Public/Icons/folder.gif'
	);
}