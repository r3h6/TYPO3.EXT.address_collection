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

	/**
	 * Get available template layouts for a certain page
	 *
	 * @param int $pageUid
	 * @param string $key
	 * @return array
	 */
	public static function getAvailableTemplateLayouts($pageUid, $key) {
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