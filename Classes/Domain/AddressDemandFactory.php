<?php
namespace Monogon\AddressCollection\Domain;

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
 * AddressDemandFactory
 */
class AddressDemandFactory implements \TYPO3\CMS\Core\SingletonInterface {

	/**
	 * [$objectManager description]
	 * @var TYPO3\CMS\Extbase\Object\ObjectManager
	 * @inject
	 */
	protected $objectManager = NULL;

	/**
	 * Create a demand object from two array.
	 * @param  array $properties         Usually from settings
	 * @param  array $overrideProperties Usually from request
	 * @return Monogon\AddressCollection\Domain\Model\Dto\AddressDemand
	 */
	public function makeInstance (array $properties, array $overrideProperties = NULL){
		$arrayConverter =  $this->objectManager->get('Monogon\\AddressCollection\\TypeConverter\\CommaListToArrayConverter');

		$propertyMappingConfiguration = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Property\\PropertyMappingConfigurationBuilder')->build();
		$propertyMappingConfiguration->forProperty('addressGroups')->setTypeConverter($arrayConverter);
		$propertyMappingConfiguration->forProperty('recordTypes')->setTypeConverter($arrayConverter);
		$propertyMappingConfiguration->forProperty('includeAddresses')->setTypeConverter($arrayConverter);

		// Make regular demand.
		$propertyMapper = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Property\\PropertyMapper');
		$demand = $propertyMapper->convert($properties, 'Monogon\\AddressCollection\\Domain\\Model\\Dto\\AddressDemand', $propertyMappingConfiguration);

		// Make override demand.
		if (is_array($overrideProperties)){
			foreach ($overrideProperties as $propertyName => $propertyValue){
				switch ($propertyName){
					case 'addressGroups':
					case 'recordTypes':
					case 'includeAddresses':
						$propertyValue = join(',', array_intersect(
							GeneralUtility::trimExplode(',', $properties[$propertyName], TRUE),
							$propertyValue
						));
						break;

				}
				$properties[$propertyName] = $propertyValue;
			}
			$overrideDemand = $propertyMapper->convert($properties, 'Monogon\\AddressCollection\\Domain\\Model\\Dto\\AddressDemand', $propertyMappingConfiguration);
			$overrideDemand->setOriginalDemand($demand);

			// Validate
			$validator = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Validation\\ValidatorResolver')->getBaseValidatorConjunction(get_class($overrideDemand));
			$result = $validator->validate($overrideDemand);
			if ($result->hasErrors()){
				return NULL;
			}

			return $overrideDemand;
		}

		return $demand;
	}
}