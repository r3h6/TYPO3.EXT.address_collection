<?php
namespace MONOGON\AddressCollection\ViewHelpers\Widget\Controller;

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
 * CharacterMenuController
 */
class CharacterMenuController extends \TYPO3\CMS\Fluid\Core\Widget\AbstractWidgetController {


	/**
	 * [$characters description]
	 * @var string
	 */
	protected $characters;

	/**
	 * [$demand description]
	 * @var \MONOGON\AddressCollection\Domain\Model\Dto\AddressDemand
	 */
	protected $demand;

	/**
	 * addressRepository
	 *
	 * @var \MONOGON\AddressCollection\Domain\Repository\AddressRepository
	 * @inject
	 */
	protected $addressRepository = NULL;


	public function initializeAction (){
		$this->demand = $this->widgetConfiguration['demand'];
		$this->characters = $this->widgetConfiguration['characters'];
	}

	public function indexAction (){

		$characterList = $this->addressRepository->getCharacterList($this->demand);
		$completeList = $characterList;

		foreach (str_split($this->characters, 1) as $character){
			if (!in_array($character, $characterList)){
				$completeList[] = $character;
			}
		}

		sort($completeList, SORT_LOCALE_STRING);

		// $uriBuilder = $this->controllerContext->getUriBuilder();

		// Build menu
		$menu = array();
		foreach ($completeList as $character){

			$menuItem = array(
				'character' => $character,
				'link' => '',
			);

			// if (in_array($character, $characterList)){
			// 	$menuItem['link'] = $uriBuilder->reset()->uriFor(NULL, array(
			// 		'demand' => array(
			// 			'character' => $character,
			// 		),
			// 	));
			// }

			$menu[] = $menuItem;
		}

		$this->view->assign('menu', $menu);
	}
}