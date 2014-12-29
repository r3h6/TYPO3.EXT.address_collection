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
use \MONOGON\AddressCollection\Configuration\ExtConfManager;
use \TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

/**
 * ExtensionUtility
 */
class ExtensionUtility implements \TYPO3\CMS\Core\SingletonInterface {

	/**
	 * [pluginSignature description]
	 * @param  string $pluginName [description]
	 * @param  string $extKey     [description]
	 * @return string             [description]
	 */
	public static function pluginSignature ($pluginName, $extKey = NULL){
		if ($extKey === NULL){
			$extKey = ExtConfManager::EXT_KEY;
		}
		$extensionName = GeneralUtility::underscoredToUpperCamelCase($extKey);
		return strtolower($extensionName . '_' . $pluginName);
	}

	/**
	 * [addWizicon description]
	 * @param string $pluginName [description]
	 * @param  string $extKey     [description]
	 */
	public static function addWizicon ($pluginName, $extKey = NULL){
		if ($extKey === NULL){
			$extKey = ExtConfManager::EXT_KEY;
		}
		$namespace = substr(__NAMESPACE__, 0, strrpos(__NAMESPACE__, '\\')) . '\\Wizard\\';

		$className = $namespace . $pluginName . 'Wizicon';
		$GLOBALS['TBE_MODULES_EXT']['xMOD_db_new_content_el']['addElClasses'][$className] =
		ExtensionManagementUtility::extPath($extKey) . 'Classes/Wizard/' . $pluginName . 'Wizicon.php';
	}
}