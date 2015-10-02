<?php
namespace Monogon\AddressCollection\ViewHelpers\Format;

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
 * DmsViewHelper
 */
class DmsViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * http://stackoverflow.com/a/27516822
	 *
	 * @param  float  $value     [description]
	 * @param  string  $a         [description]
	 * @param  string  $b         [description]
	 * @param  string  $format    [description]
	 * @param  integer $precision [description]
	 * @return string             [description]
	 */
	public function render ($value, $a = '-', $b = '', $format = '%s%s° %s %s', $precision = 3){
		if ($value === NULL){
			$value = (float) $this->renderChildren();
		}

		$dms = new stdObject();
		$dms->notation = ($value < 0) ? $a: $b;
		$dms->degrees = floor(abs($value));
		$dms->decimal = abs($value) - $dms->degrees;
		$dms->minutes = round($dms->decimal * 60, $precision);

		return sprintf($format, $dms->notation, $dms->degrees, $dms->decimal, $dms->minutes);
	}
}