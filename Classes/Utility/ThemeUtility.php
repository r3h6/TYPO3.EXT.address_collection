<?php
namespace MONOGON\AddressCollection\Utility;

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

/**
 * Theme utility class
 */
class ThemeUtility {

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
		$setup = new \MONOGON\PathArrayAccess(\MONOGON\AddressCollection\Utility\TypoScriptUtility::getPageSetup($pageUid), '/');
		$templateRootPaths = $setup->get('plugin./tx_addresscollection./view./templateRootPaths.');
		if (is_array($templateRootPaths)){
			return $templateRootPaths;
		}
		return array();
	}

}