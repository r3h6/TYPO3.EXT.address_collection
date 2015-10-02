<?php
namespace Monogon\AddressCollection\ViewHelpers\Render;

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
 * PartialViewHelper
 */
class PartialViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper {

	/**
	 * [render description]
	 * @param  \Monogon\AddressCollection\Domain\Model\Address $address   [description]
	 * @param  string                                          $partial   [description]
	 * @param  array                                           $arguments [description]
	 * @param  boolean                                         $optional  [description]
	 * @return string
	 */
	public function render (\Monogon\AddressCollection\Domain\Model\Address $address, $partial, $arguments = array(), $optional = FALSE){

		$classNameParts = GeneralUtility::trimExplode('\\', get_class($address), TRUE);
		$partialPath = end($classNameParts) . '/' . $partial;

		try {
			return parent::render(NULL, $partialPath, $arguments, $optional);
		} catch (\Exception $exception){
			if (strpos($exception->getMessage(), $partialPath) === FALSE){
				throw $exception;
			}

			return parent::render(NULL, 'Address/' . $partial, $arguments, $optional);
		}
	}
}