<?php
namespace MONOGON\AddressCollection\ViewHelpers\Menu;

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
 * CharacterMenuViewHelper
 */
class CharacterMenuViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	protected static $alphabet = 'abcdefghijklmnopqrstuvwxyz';

	/**
	 * addressRepository
	 *
	 * @var \MONOGON\AddressCollection\Domain\Repository\AddressRepository
	 * @inject
	 */
	protected $addressRepository = NULL;


	public function render (){
		$output = '';

		$menuItems = array();
		$characterList = $this->addressRepository->getCharacterList();
		$completeList = $characterList;

		foreach (str_split(self::$alphabet, 1) as $character){
			if (!in_array($character, $characterList)){
				$completeList[] = $character;
			}
		}

		sort($completeList, SORT_LOCALE_STRING);

		$templateVariableContainer = $this->renderingContext->getTemplateVariableContainer();
		foreach ($completeList as $character){
			$link = NULL;
			if (in_array($character, $characterList)){
				$link = TRUE;
			}
			$menuItem = array(
				'character' => $character,
				'link' => $link,
			);
			$templateVariableContainer->add('menuItem', $menuItem);
			$output .= $this->renderChildren();
			$templateVariableContainer->remove('menuItem');
		}
		return $output;
	}
}