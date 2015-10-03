<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Monogon.' . $_EXTKEY,
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

$pluginSignature = \Monogon\AddressCollection\Utility\ExtensionUtility::pluginSignature('Pi1', $_EXTKEY);

/**
 * Page ts config
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/TSConfig/Page.ts">');

/**
 * backwardscompatibility function which hooks into TCEmain and watches for
 * tt_address records with changes to the first, middle, and last name fields to
 * come by. That function shall then write changes back to the old combined name
 * field in a configurable format - first name first or last name first and
 * which glue string (comma, space, whatever)
 */
$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = 'Monogon\\AddressCollection\\Hooks\\MergeName';

/**
 * Plugininfo
 */
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info'][$pluginSignature][$_EXTKEY] = 'Monogon\\AddressCollection\\Hooks\\Pi1Info->render';

/**
 * Realurl
 */
if (\Monogon\AddressCollection\Configuration\ExtConf::get('includeRealUrlConfig')){
	require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY). 'Configuration/RealUrl/Default.php';
}