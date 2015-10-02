<?php
namespace Monogon\AddressCollection\Wizard;

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

use \Monogon\AddressCollection\Utility\ExtensionUtility;
use \TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use \Monogon\AddressCollection\Configuration\ExtConf;

/**
 * AbstractWizicon
 */
abstract class AbstractWizicon {

	/**
	 * [$pluginName description]
	 * @var string
	 */
	protected $pluginName = '';

	/**
	 * Processing the wizard items array
	 *
	 * @param array $wizardItems The wizard items
	 * @return array array with wizard items
	 */
	final public function proc($wizardItems) {

		$pluginSignature = ExtensionUtility::pluginSignature($this->pluginName);

		$wizardItems['plugins_tx_' . $pluginSignature] = array(
			'icon' => ExtensionManagementUtility::extRelPath(ExtConf::EXT_KEY) . 'Resources/Public/Icons/' . $pluginSignature . '_wizicon.png',
			'title' => $GLOBALS['LANG']->sL('LLL:EXT:' . ExtConf::EXT_KEY . '/Resources/Private/Language/locallang_be.xlf:' . $pluginSignature . '.title'),
			'description' => $GLOBALS['LANG']->sL('LLL:EXT:' . ExtConf::EXT_KEY . '/Resources/Private/Language/locallang_be.xlf:' . $pluginSignature . '.description'),
			'params' => '&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=' . $pluginSignature,
		);

		return $wizardItems;
	}
}

?>