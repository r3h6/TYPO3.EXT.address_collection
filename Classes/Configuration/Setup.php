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
 * Setup
 */
class Setup implements \ArrayAccess {

	protected $delimiter = '.';

	protected $array = array();

	public function __construct ($settings = array()){
		$this->mergeSettings($settings);
	}

	public function mergeSettings ($settings) {
		if (isset($settings['setup']) && is_array($settings['setup'])){
			$this->array = \TYPO3\CMS\Extbase\Utility\ArrayUtility::arrayMergeRecursiveOverrule($this->array, $settings['flexform'], FALSE, FALSE);
		}
		if (isset($settings['flexform']) && is_array($settings['flexform'])){
			$this->array = \TYPO3\CMS\Extbase\Utility\ArrayUtility::arrayMergeRecursiveOverrule($this->array, $settings['flexform'], FALSE, FALSE);
		}
	}

	public function get ($path, $default = NULL){
		try {
			$value = \TYPO3\CMS\Core\Utility\ArrayUtility::getValueByPath($this->array, $path, $this->delimiter);
		} catch (\RuntimeException $exception){
			$value = $default;
		}
		return $value;
	}

	// {{{ ArrayAccess

	final public function offsetSet($offset, $value) {
		if (is_null($offset)) {
			$this->array[] = $value;
		} else {
			$this->array[$offset] = $value;
		}
	}

	final public function offsetExists($offset) {
		return isset($this->array[$offset]);
	}

	final public function offsetUnset($offset) {
		unset($this->array[$offset]);
	}

	final public function offsetGet($offset) {
		return isset($this->array[$offset]) ? $this->array[$offset] : null;
	}

	// }}}


}

?>