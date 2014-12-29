<?php
namespace MONOGON\AddressCollection\ViewHelpers\RecordType;

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

use \MONOGON\AddressCollection\Utility\TcaUtility;
use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Address
 */
class IsPropertyVisibleViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractConditionViewHelper {

	/**
	 * [render description]
	 * @param  \TYPO3\CMS\Extbase\DomainObject\AbstractEntity $object [description]
	 * @param  string $property [description]
	 * @return [type]        [description]
	 */
	public function render ($object, $property){
		$fields = TcaUtility::getTypeFields($object);
		$fieldName = GeneralUtility::camelCaseToLowerCaseUnderscored($property);
		if (in_array($fieldName, $fields)) {
			return $this->renderThenChild();
		} else {
			return $this->renderElseChild();
		}
	}
}