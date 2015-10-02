<?php
namespace Monogon\AddressCollection\Domain\Validator;

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
 * The repository for AddressGroups
 */
class PhoneNumberValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {

	public function isValid ($value){
		if (!is_string($value) || !$this->validPhoneNumber($value)) {
			$this->addError(
				$this->translateErrorMessage(
					'validator.phonenumber.notvalid',
					'addressCollection'
				), 1415391144);
		}
	}

	protected function validPhoneNumber ($value){
		$result = preg_match('/[\+\-\s\(\)x0-9]{5,30}/i', $value);
		return ($result !== 0);
	}
}