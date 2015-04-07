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

use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Theme utility class
 */
class ThemeUtility implements \TYPO3\CMS\Core\SingletonInterface {

	public static function setTheme (\TYPO3\CMS\Extbase\Mvc\View\ViewInterface $view, $theme){

		$paths = $view->getTemplateRootPaths();
		if (isset($paths[$theme])){
			$path = $paths[$theme];
			unset($paths[$theme]);
			array_unshift($paths, $path);
			$view->setTemplateRootPaths($paths);
		} else {
			array_unshift($paths, array_pop($paths));
			$view->setTemplateRootPaths($paths);
		}

		// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($view);
	}

	public static function getAvailableThemes ($pageUid){

		static::createFakeFrontEnd($pageUid);

		$themes = array();
		$setup = $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_addresscollection.'];
		if (isset($setup['view.']['templateRootPaths.'])){
			foreach ($setup['view.']['templateRootPaths.'] as $key => $value){
				$themes[] = array($value, $key);
			}
		}
		return $themes;
	}

	private static function createFakeFrontEnd($pageUid = 0) {
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


}