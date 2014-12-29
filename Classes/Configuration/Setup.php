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

	/**
	 * [$seperator description]
	 * @var string
	 */
	private $seperator;

	protected $array;

	public function __construct($array = array(), $seperator = '.') {
		$this->array = $array;
		$this->seperator = $seperator;
	}

	/**
	 * [set description]
	 * @param string $key  example.layoutPath
	 * @param mixed $value [description]
	 * @return \MONOGON\CodeLibrary\Configuration\Setup $this
	 */
	public function set ($key, $value){
		$keyParts = $this->getKeyParts($key);
		$array = array();
		$reference = &$array;
		foreach ($keyParts as $keyPart){
			if (isset($reference[$keyPart])){
				$reference = &$reference[$keyPart];
			} else {
				$reference[$keyPart] = array();
				$reference = &$reference[$keyPart];
			}
		}
		$reference = $value;
		return $this->mergeRecursiveOverrule($array);
	}

	/**
	 * [get description]
	 * @param  string $key example.layoutPath
	 * @return mixed      [description]
	 */
	public function get ($key, $default = NULL) {
		$keyParts = $this->getKeyParts($key);
		$config = NULL;
		$reference = &$this->array;
		foreach ($keyParts as $keyPart){
			if (isset($reference[$keyPart])){
				$reference = &$reference[$keyPart];
				$config = $reference;
			} else {
				return $default;
			}
		}
		return $config;
	}



	/**
	 * [merge description]
	 * @param  array   $firstArray          [description]
	 * @param  boolean $dontAddNewK$eys      [description]
	 * @param  boolean $emptyValuesOverride [description]
	 * @return \MONOGON\CodeLibrary\Configuration\Setup $this
	 */
	public function mergeRecursiveOverrule (array $array, $dontAddNewKeys = FALSE, $emptyValuesOverride = TRUE){
		$this->array = \TYPO3\CMS\Extbase\Utility\ArrayUtility::arrayMergeRecursiveOverrule($this->array, $array, $dontAddNewKeys, $emptyValuesOverride);
		return $this;
	}

	/**
	 * [getKeyParts description]
	 * @param  string $key [description]
	 * @return array      [description]
	 */
	private function getKeyParts($key){
		return explode($this->seperator, $key);
	}

	public function setSeperator ($seperator){
		$this->seperator = $seperator;
	}


	public function offsetSet($offset, $value) {
		if (is_null($offset)) {
			$this->array[] = $value;
		} else {
			$this->array[$offset] = $value;
		}
	}

	public function offsetExists($offset) {
		return isset($this->array[$offset]);
	}

	public function offsetUnset($offset) {
		unset($this->array[$offset]);
	}

	public function offsetGet($offset) {
		return isset($this->array[$offset]) ? $this->array[$offset] : null;
	}
}

?>