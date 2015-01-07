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


	/**
	 * [render description]
	 * @param  string $class           [description]
	 * @param  string $tagName         [description]
	 * @param  string $tagNameChildren [description]
	 * @return [type]                  [description]
	 */
	public function render ($class = NULL, $tagName = 'ul', $tagNameChildren = 'li'){


		$menuItems = array();
		$characterList = $this->addressRepository->getCharacterList();
		$completeList = $characterList;

		foreach (str_split(self::$alphabet, 1) as $character){
			if (!in_array($character, $characterList)){
				$completeList[] = $character;
			}
		}

		sort($completeList, SORT_LOCALE_STRING);

		$uriBuilder = $this->controllerContext->getUriBuilder();

		// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($uriBuilder);

		$tag = $this->objectManager->get('TYPO3\\CMS\\Fluid\\Core\\ViewHelper\\TagBuilder', $tagName);

		if ($class){
			$tag->addAttribute('class', $class);
		}

		$templateVariableContainer = $this->renderingContext->getTemplateVariableContainer();
		foreach ($completeList as $character){
			$childTag = $this->objectManager->get('TYPO3\\CMS\\Fluid\\Core\\ViewHelper\\TagBuilder', $tagNameChildren);

			if (in_array($character, $characterList)){
				$link = $uriBuilder->reset()->uriFor(NULL, array(
					'demand' => array(
						'character' => $character,
					),
				));
				$linkTag = $this->objectManager->get('TYPO3\\CMS\\Fluid\\Core\\ViewHelper\\TagBuilder', 'a');
				$linkTag->addAttribute('href', $link);
				$linkTag->setContent($character);
				$childTag->setContent($linkTag->render());
			} else {
				$childTag->setContent($character);
			}

			$tag->setContent(
				$tag->getContent() . $childTag->render()
			);

			//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($link);
			// $templateVariableContainer->add('menuItem', $menuItem);
			// $output .= $this->renderChildren();
			// $templateVariableContainer->remove('menuItem');
		}
		return $tag->render();
	}
}