<?php
namespace MONOGON\AddressCollection\Hooks\ItemsProcFunc;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 R3 H6 <r3h6@outlook.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
use \MONOGON\AddressCollection\Utility\TemplateLayoutUtility;
use \MONOGON\AddressCollection\Configuration\ExtConf;

/**
 * TemplateLayout
 */
class TemplateLayout {

	public function getListActionTemplates (array &$config){
		$this->getTemplates($config, 'list');
	}

	public function getSearchActionTemplates (array &$config){
		$this->getTemplates($config, 'search');
	}

	public function getShowActionTemplates (array &$config){
		$this->getTemplates($config, 'show');
	}

	protected function getTemplates (array &$config, $key){

		//$config['row']['pid'];
		$this->createFakeFrontEnd($config['row']['pid']);
		// $configurationManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager')->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');
		// $configurationManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager')->get('TYPO3\\CMS\\Extbase\\Configuration\\FrontendConfigurationManager');
		// $extbaseFrameworkConfiguration = $configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);

		$setup = $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_addresscollection.'];


		if (isset($setup['view.']['templateRootPaths.'])){
			// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($setup['view.']['templateRootPaths.']); exit;
			foreach ($setup['view.']['templateRootPaths.'] as $key => $value){
				$additionalLayout = array($value, $value);
				array_push($config['items'], $additionalLayout);
			}
		}




// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($setup);
// 		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($extbaseFrameworkConfiguration); exit;
		// $templateLayouts = TemplateLayoutUtility::getAvailableTemplateLayouts($config['row']['pid'], $key);
		// foreach ($templateLayouts as $layout) {
		// 	$additionalLayout = array($GLOBALS['LANG']->sL($layout[0], TRUE), $layout[1]);
		// 	array_push($config['items'], $additionalLayout);
		// }
	}


	/**
	 * Tx_Phpunit_Framework::createFakeFrontEnd()
	 *
	 * @param  integer $pageUid [description]
	 * @return [type]           [description]
	 */
	protected function createFakeFrontEnd($pageUid = 0) {
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