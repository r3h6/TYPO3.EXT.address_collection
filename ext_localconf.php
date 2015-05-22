<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'MONOGON.' . $_EXTKEY,
	'Pi1',
	array(
		'Address' => 'list, show',

	),
	// non-cacheable actions
	array(
		'Address' => 'list',

	)
);
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

$pluginSignature = \MONOGON\AddressCollection\Utility\ExtensionUtility::pluginSignature('Pi1', $_EXTKEY);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/TSConfig/page.ts">');

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['extbase']['typeConverters'][] = 'MONOGON\\AddressCollection\\TypeConverter\\ArrayConverter';

/**
 * backwardscompatibility function which hooks into TCEmain and watches for
 * tt_address records with changes to the first, middle, and last name fields to
 * come by. That function shall then write changes back to the old combined name
 * field in a configurable format - first name first or last name first and
 * which glue string (comma, space, whatever)
 */
$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = 'MONOGON\\AddressCollection\\Hooks\\MergeName';

/**
 *
 */
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info'][$pluginSignature][$_EXTKEY] = 'MONOGON\\AddressCollection\\Hooks\\Pi1Info->render';

function user_pageHadAddressPlugin (){
	$cacheFile = PATH_site . 'typo3temp/tx_addresscollection.cache';
	if (file_exists($cacheFile)){

	} else {

	}
}

if (\MONOGON\AddressCollection\Configuration\ExtConf::get('includeRealUrlConfig')){
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY). 'Configuration/RealUrl/Default.php';
}