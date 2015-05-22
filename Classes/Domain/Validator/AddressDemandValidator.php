<?php
namespace MONOGON\AddressCollection\Domain\Validator;

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
 *
 */
class AddressDemandValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {
	/**
	 * [$setup description]
	 *
	 * @var \MONOGON\AddressCollection\Configuration\Setup
	 * @inject
	 */
	protected $setup = NULL;

	public function isValid ($value){
		if (!($value instanceof \MONOGON\AddressCollection\Domain\Model\Dto\AddressDemand)){
			return;
		}

		$originalDemand = \MONOGON\AddressCollection\Domain\Model\Dto\AddressDemand::createFromArray($this->setup->get('list.demand'));

		$value->setOriginalDemand($originalDemand);

		// if ($originalDemand->getAddressGroups()){

		// }

		// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($originalDemand);

	}
}