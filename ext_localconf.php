<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'MONOGON.' . $_EXTKEY,
	'Pi1',
	array(
		'Address' => 'list, show, new, create, edit, update, delete, search, manage',

	),
	// non-cacheable actions
	array(
		'Address' => 'create, update, delete',

	)
);
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/TSConfig/config.ts">');

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['extbase']['typeConverters'][] = 'MONOGON\\AddressCollection\\TypeConverter\\ArrayConverter';

/**
 * backwardscompatibility function which hooks into TCEmain and watches for
 * tt_address records with changes to the first, middle, and last name fields to
 * come by. That function shall then write changes back to the old combined name
 * field in a configurable format - first name first or last name first and
 * which glue string (comma, space, whatever)
 */
$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = 'MONOGON\\AddressCollection\\Hooks\\MergeName';