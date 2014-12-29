<?php
namespace MONOGON\AddressCollection\View\Address;

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
 * Address
 */
class NewJson extends \TYPO3\CMS\Extbase\Mvc\View\JsonView {

	protected $partialRootPaths;

	public function setPartialRootPaths ($partialRootPaths){
		$this->partialRootPaths = $partialRootPaths;
	}

	public function ___render (){
		$output = array();
		// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this);

		//$a = $this->controllerContext->getConfigurationManager()->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS);
		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($a);


		$flashMessagesView = GeneralUtility::makeInstance('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
		$flashMessagesView->setTemplateSource('<f:flashMessages renderMode="div" />');
		$output['flashMessages'] = $flashMessagesView->render();

		$validationResultsView = GeneralUtility::makeInstance('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
		$validationResultsView->setPartialRootPath(GeneralUtility::getFileAbsFileName(array_shift($this->partialRootPaths)));
		$validationResultsView->setControllerContext($this->controllerContext);
		$validationResultsView->setFormat('html');
		$validationResultsView->setTemplateSource('<f:render partial="FormErrors" />');
		$output['validationResults'] = $validationResultsView->render();

		//$output['flashMessages'] = $this->controllerContext->getFlashMessageQueue()->getAllMessagesAndFlush();
		//$output['validationResults'] = $this->controllerContext->getRequest()->getOriginalRequestMappingResults();
		// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($output);
		return json_encode($output);
	}

}