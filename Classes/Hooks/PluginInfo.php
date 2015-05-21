<?php
namespace MONOGON\AddressCollection\Hooks;

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
use \TYPO3\CMS\Core\Utility\ArrayUtility;

/**
 * PluginInfo
 */
abstract class PluginInfo {

	protected $flexFormService;
	protected $flexFormArray;
	protected $pluginName = NULL;

	protected $locallangPath = 'LLL:EXT:address_collection/Resources/Private/Language/locallang_be.xlf';

	public function __construct(){
		$this->flexFormService = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Service\\FlexFormService');

		if ($this->pluginName === NULL){
			$this->pluginName = substr(array_pop(explode('\\', get_class($this))), 0, -4);
		}
	}

	public function render ($params = array(), $pObj){
		$this->flexFormArray = ArrayUtility::flatten($this->flexFormService->convertFlexFormContentToArray($params['row']['pi_flexform']));

		return $this->createOutput($this->init());
	}

	abstract protected function init ();

	protected function getFlexFormValue ($key){
		if (isset($this->flexFormArray[$key])){
			return $this->flexFormArray[$key];
		}
		return NULL;
	}

	protected function translate ($key){
		$value = $GLOBALS['LANG']->sL($this->locallangPath . ':' . $key);
		return $value ? $value: $key;
	}

	protected function createOutput (array $array){
		$content = '';
		$content .= '<span>' . $this->translate(strtolower($this->pluginName)) . '</span>';
		foreach ($array as $label => $valueOrTag){
			$value = $this->getFlexFormValue($valueOrTag);
			if ($value === NULL){
				$value = $valueOrTag;
			}

			$content .= '<tr>';
			$content .= '<td>' . $this->translate($label) . '</td>';
			$content .= '<td>' . $value . '</td>';
			$content .= '</tr>';
		}
		return '<table class="typo3-dblist">' . $content . '</table>';
	}
}