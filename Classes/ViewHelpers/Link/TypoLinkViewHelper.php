<?php
namespace MONOGON\AddressCollection\ViewHelpers\Link;

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
 * TypoLinkViewHelper
 */
class TypoLinkViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * ContentObjectRenderer
	 *
	 * @var TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer (tslib_cObj)
	 * @inject
	 */
	protected $cObj;

	/**
	 * [render description]
	 * @param  string  $parameter  [description]
	 * @param  string  $class      [description]
	 * @param  string  $aTagParams [description]
	 * @param  boolean $absolute   [description]
	 * @return string              [description]
	 */
	public function render ($parameter, $class = '', $aTagParams = '', $absolute = FALSE){

		$uid = array_shift(t3lib_div::trimExplode(' ', $parameter, TRUE));
		if ($uid == $GLOBALS['TSFE']->id){
			$class .= ' current';
		}
		if (strlen($class)){
			$aTagParams .= sprintf(' class="%s"', $class);
		}

		$output = $this->renderChildren();
		if (strlen(trim($parameter))){
			$conf = array(
				'parameter' => $parameter,
				'ATagParams' => $aTagParams,
				'forceAbsoluteUrl' => $absolute,
			);
			$output = $this->cObj->typoLink($output, $conf);
		}
		return $output;
	}
}

?>