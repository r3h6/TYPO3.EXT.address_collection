<?php
namespace MONOGON\AddressCollection\ViewHelpers\Form;

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
class IsRequiredViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractConditionViewHelper {

	/**
	 * [$reflectionService description]
	 * @var \TYPO3\CMS\Extbase\Reflection\ReflectionService
	 * @inject
	 */
	protected $reflectionService;

	/**
	 * [render description]
	 * @param  object $object [description]
	 * @param  string $property [description]
	 * @return [type]        [description]
	 */
	public function render ($object, $property){
		if ($this->isRequired($object, $property)) {
			return $this->renderThenChild();
		} else {
			return $this->renderElseChild();
		}
	}

	protected function isRequired ($object, $property){
		$className = get_class($object);
		$propertyTagsValues = $this->reflectionService->getPropertyTagsValues($className, $property);
		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($propertyTagsValues);
		if (isset($propertyTagsValues['validate'])){
			foreach ($propertyTagsValues['validate'] as $validatorConfig){
				if (strpos($validatorConfig, 'NotEmpty') !== FALSE){
					return TRUE;
				}
			}
		}
		return FALSE;
	}
}