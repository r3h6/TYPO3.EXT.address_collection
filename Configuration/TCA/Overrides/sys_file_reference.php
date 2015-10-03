<?php
defined('TYPO3_MODE') or die();

if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('news') === FALSE){
	/**
	 * Add extra field showinpreview and some special news controls to sys_file_reference record
	 */
	$additionalColumns = array(
		'showinpreview' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:news/Resources/Private/Language/locallang_db.xlf:sys_file_reference.showinpreview',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
	);

	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_file_reference', $additionalColumns);
}

// add special address palette
$GLOBALS['TCA']['sys_file_reference']['palettes']['addressPalette'] = array(
	'showitem' => 'showinpreview',
	'canNotCollapse' => TRUE
);