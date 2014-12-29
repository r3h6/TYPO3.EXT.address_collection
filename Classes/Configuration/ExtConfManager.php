<?php
namespace MONOGON\AddressCollection\Configuration;

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

/**
 *
 * @package MONOGON
 * @subpackage code_library
 */
class ExtConfManager implements \TYPO3\CMS\Core\SingletonInterface {

	/**
	 * @var string
	 */
	const EXT_KEY = 'address_collection';

	/**
	 * @var array
	 */
	protected $configuration = array();

	/**
	 * @param string|NULL $extensionKey
	 */
	public function __construct() {
		if (isset($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][self::EXT_KEY])) {
			$this->configuration = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][self::EXT_KEY]);
		}
	}

	/**
	 * @param string $key
	 * @return mixed
	 */
	public function getValue ($key) {
		if (is_array($this->configuration) && array_key_exists($key, $this->configuration)) {
			return $this->configuration[$key];
		} else {
			return NULL;
		}
	}
}

?>