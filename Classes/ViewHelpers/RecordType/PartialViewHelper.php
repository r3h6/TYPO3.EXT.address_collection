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

use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Address
 */
class PartialViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper {

	/**
	 * [render description]
	 * @param \MONOGON\AddressCollection\Domain\Model\Address $address [description]
	 * @param array $arguments Arguments to pass to the partial.
	 * @param boolean $optional Set to TRUE, to ignore unknown sections, so the definition of a section inside a template can be optional for a layout
	 * @return string
	 * @return boolean        [description]
	 */
	public function render ($address, $arguments = array(), $optional = FALSE){

		$classNameParts = GeneralUtility::trimExplode('\\', get_class($address), TRUE);

		try {
			return parent::render(NULL, end($classNameParts) . '/FormFields', $arguments, $optional);
		} catch (\Exception $exception){
			return parent::render(NULL, 'Address/FormFields', $arguments, $optional);
		}
	}
}