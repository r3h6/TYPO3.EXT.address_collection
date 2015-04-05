<?php
namespace MONOGON\AddressCollection\Utility;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Frans Saris <franssaris@gmail.com>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use MONOGON\AddressCollection\Configuration\ExtConf;

/**
 * TemplateLayout utility class
 */
class TemplateLayoutUtility implements \TYPO3\CMS\Core\SingletonInterface {

	public static function getAvailableTemplateLayouts ($pageUid){

		$setup = $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_addresscollection.'];
		if (isset($setup['view.']['templateRootPaths.'])){
			foreach ($setup['view.']['templateRootPaths.'] as $key => $value){
				$additionalLayout = array($value, $value);
				array_push($config['items'], $additionalLayout);
			}
		}
	}

	protected static function createFakeFrontEnd($pageUid = 0) {
		if ($pageUid < 0) {
			throw new \InvalidArgumentException('$pageUid must be >= 0.', 1334439467);
		}

		// $this->suppressFrontEndCookies();
		// $this->discardFakeFrontEnd();

		$GLOBALS['TT'] = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\TimeTracker\\NullTimeTracker');

		/** @var $frontEnd TypoScriptFrontendController */
		$frontEnd = GeneralUtility::makeInstance(
			'TYPO3\\CMS\\Frontend\\Controller\\TypoScriptFrontendController', $GLOBALS['TYPO3_CONF_VARS'], $pageUid, 0
		);
		$GLOBALS['TSFE'] = $frontEnd;

		// simulates a normal FE without any logged-in FE or BE user
		$frontEnd->beUserLogin = FALSE;
		$frontEnd->renderCharset = 'utf-8';
		$frontEnd->workspacePreview = '';
		$frontEnd->initFEuser();
		$frontEnd->determineId();
		$frontEnd->initTemplate();
		$frontEnd->config = array();

		$frontEnd->tmpl->getFileName_backPath = PATH_site;

		//if (($pageUid > 0) && in_array('sys_template', $this->dirtySystemTables, TRUE)) {
			$frontEnd->tmpl->runThroughTemplates($frontEnd->sys_page->getRootLine($pageUid), 0);
			$frontEnd->tmpl->generateConfig();
			$frontEnd->tmpl->loaded = 1;
			$frontEnd->settingLanguage();
			$frontEnd->settingLocale();
		//}

		$frontEnd->newCObj();


		// $this->hasFakeFrontEnd = TRUE;
		// $this->logoutFrontEndUser();

		return $frontEnd->id;
	}


	/**
	 * Get available template layouts for a certain page
	 *
	 * @param int $pageUid
	 * @param string $key
	 * @return array
	 */
	public static function _getAvailableTemplateLayouts($pageUid, $key) {
		$templateLayouts = array();

		// Check if the layouts are extended by ext_tables
		if (isset($GLOBALS['TYPO3_CONF_VARS']['EXT'][ExtConf::EXT_KEY]['templateLayouts'])
			&& is_array($GLOBALS['TYPO3_CONF_VARS']['EXT'][ExtConf::EXT_KEY]['templateLayouts'])) {
			$templateLayouts = $GLOBALS['TYPO3_CONF_VARS']['EXT'][ExtConf::EXT_KEY]['templateLayouts'];
		}

		// Add TsConfig values
		foreach(self::getTemplateLayoutsFromTsConfig($pageUid, $key) as $templateKey => $title) {
			$templateLayouts[] = array($title, $templateKey);
		}

		return $templateLayouts;
	}

	/**
	 * Get template layouts defined in TsConfig
	 *
	 * @param $pageUid
	 * @return array
	 */
	protected static function getTemplateLayoutsFromTsConfig($pageUid, $key) {
		$templateLayouts = array();
		$pagesTsConfig = \TYPO3\CMS\Backend\Utility\BackendUtility::getPagesTSconfig($pageUid);
		$setup = new \MONOGON\PathArrayAccess($pagesTsConfig, '/');
		$templateLayouts = $setup->get("tx_addresscollection./templateLayouts./$key.", array());

		return $templateLayouts;
	}
}