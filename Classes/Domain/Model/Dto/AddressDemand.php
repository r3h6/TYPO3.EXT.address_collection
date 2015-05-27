<?php
namespace MONOGON\AddressCollection\Domain\Model\Dto;

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
class AddressDemand extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * [$includeAddresses description]
	 * @var array
	 */
	protected $includeAddresses = array();

	/**
	 * [$categoryConjunction description]
	 * @var string
	 */
	protected $categoryConjunction;

	/**
	 * [$includeSubCategories description]
	 * @var boolean
	 */
	protected $includeSubCategories;

	/**
	 * [$orderBy description]
	 * @var string
	 */
	protected $orderBy;

	/**
	 * [$orderDirection description]
	 * @var string
	 */
	protected $orderDirection;

	/**
	 * Name
	 *
	 * @var string
	 */
	protected $name = '';

	/**
	 * E-mail
	 *
	 * @var string
	 */
	protected $email = '';

	/**
	 * Address group
	 *
	 * @var array
	 */
	protected $addressGroups = array();

	/**
	 * [$recordTypes description]
	 *
	 * @var array
	 */
	protected $recordTypes = array();

	/**
	 * [$character description]
	 *
	 * @var string
	 * @validate StringLength(maximum=1)
	 */
	protected $character = '';

	/**
	 * [$originalDemand description]
	 *
	 * @var \MONOGON\AddressCollection\Domain\Model\Dto\AddressDemand
	 */
	protected $originalDemand = NULL;

	/**
	 * addressGroupRepository
	 *
	 * @var \MONOGON\AddressCollection\Domain\Repository\AddressGroupRepository
	 * @inject
	 */
	protected $addressGroupRepository = NULL;

	/**
	 * Create a demand object from two array.
	 * @param  array $properties         Usually from settings
	 * @param  array $overrideProperties Usually from request
	 * @return MONOGON\AddressCollection\Domain\Model\Dto\AddressDemand
	 */
	public static function factory (array $properties, $overrideProperties = NULL){

		$arrayConverter =  GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager')->get('MONOGON\\AddressCollection\\TypeConverter\\ArrayConverter');

		$propertyMappingConfiguration = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager')->get('TYPO3\\CMS\\Extbase\\Property\\PropertyMappingConfigurationBuilder')->build();

		$propertyMappingConfiguration->forProperty('addressGroups')->setTypeConverter($arrayConverter);
		$propertyMappingConfiguration->forProperty('recordTypes')->setTypeConverter($arrayConverter);
		$propertyMappingConfiguration->forProperty('includeAddresses')->setTypeConverter($arrayConverter);



		$propertyMapper = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager')->get('TYPO3\\CMS\\Extbase\\Property\\PropertyMapper');
		$demand = $propertyMapper->convert($properties, 'MONOGON\\AddressCollection\\Domain\\Model\\Dto\\AddressDemand', $propertyMappingConfiguration);


		// $argument = $properties;
		if (is_array($overrideProperties)){
			foreach ($overrideProperties as $propertyName => $propertyValue){
				switch ($propertyName){
					case 'addressGroups':
					case 'recordTypes':
					case 'includeAddresses':
						$propertyValue = join(',', array_intersect(
							GeneralUtility::trimExplode(',', $properties[$propertyName], TRUE),
							GeneralUtility::trimExplode(',', $propertyValue, TRUE)
						));
						break;

				}
				$properties[$propertyName] = $propertyValue;
			}
			$overrideDemand = $propertyMapper->convert($properties, 'MONOGON\\AddressCollection\\Domain\\Model\\Dto\\AddressDemand', $propertyMappingConfiguration);
			$overrideDemand->setOriginalDemand($demand);

			// Validate
			$validator = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager')->get('TYPO3\\CMS\\Extbase\\Validation\\ValidatorResolver')->getBaseValidatorConjunction(get_class($overrideDemand));
			$result = $validator->validate($overrideDemand);
			if ($result->hasErrors()){
				return NULL;
			}


			return $overrideDemand;
		}

		return $demand;
	}

	/**
	 * Returns the  addressGroups
	 *
	 * @return array $addressGroups
	 */
	public function getAddressGroups(){
		return $this->addressGroups;
	}

	/**
	 * Sets the addressGroups
	 *
	 * @param array $addressGroups
	 * @return object $this
	 */
	public function setAddressGroups($addressGroups){
		$this->addressGroups = $addressGroups;
		return $this;
	}

	/**
	 * Returns the  includeAddresses
	 *
	 * @return array $includeAddresses
	 */
	public function getIncludeAddresses(){
		return $this->includeAddresses;
	}

	/**
	 * Sets the includeAddresses
	 *
	 * @param array $includeAddresses
	 * @return object $this
	 */
	public function setIncludeAddresses($includeAddresses){
		$this->includeAddresses = $includeAddresses;
		return $this;
	}

	/**
	 * Returns the  categoryConjunction
	 *
	 * @return string $categoryConjunction
	 */
	public function getCategoryConjunction(){
		return $this->categoryConjunction;
	}

	/**
	 * Sets the categoryConjunction
	 *
	 * @param string $categoryConjunction
	 * @return object $this
	 */
	public function setCategoryConjunction($categoryConjunction){
		$this->categoryConjunction = $categoryConjunction;
		return $this;
	}

	/**
	 * Returns the  includeSubCategories
	 *
	 * @return boolean $includeSubCategories
	 */
	public function getIncludeSubCategories (){
		return $this->includeSubCategories ;
	}

	/**
	 * Sets the includeSubCategories
	 *
	 * @param boolean $includeSubCategories
	 * @return object $this
	 */
	public function setIncludeSubCategories ($includeSubCategories ){
		$this->includeSubCategories  = $includeSubCategories ;
		return $this;
	}

	/**
	 * Returns the  orderBy
	 *
	 * @return string $orderBy
	 */
	public function getOrderBy(){
		return $this->orderBy;
	}

	/**
	 * Sets the orderBy
	 *
	 * @param string $orderBy
	 * @return object $this
	 */
	public function setOrderBy($orderBy){
		$this->orderBy = $orderBy;
		return $this;
	}

	/**
	 * Returns the  orderDirection
	 *
	 * @return string $orderDirection
	 */
	public function getOrderDirection(){
		return $this->orderDirection;
	}

	/**
	 * Sets the orderDirection
	 *
	 * @param string $orderDirection
	 * @return object $this
	 */
	public function setOrderDirection($orderDirection){
		$this->orderDirection = $orderDirection;
		return $this;
	}

	/**
	 * Returns the name
	 *
	 * @return string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}

	/**
	 * Returns the email
	 *
	 * @return string $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the email
	 *
	 * @param string $email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}

	/**
	 * Returns the  recordTypes
	 *
	 * @return array $recordTypes
	 */
	public function getRecordTypes(){
		return $this->recordTypes;
	}

	/**
	 * Sets the recordTypes
	 *
	 * @param array $recordTypes
	 * @return object $this
	 */
	public function setRecordTypes($recordTypes){
		$this->recordTypes = $recordTypes;
		return $this;
	}

	/**
	 * Returns the  character
	 *
	 * @return [type] $character
	 */
	public function getCharacter(){
		return $this->character;
	}

	/**
	 * Sets the character
	 *
	 * @param [type] $character
	 * @return object $this
	 */
	public function setCharacter($character){
		$this->character = $character;
		return $this;
	}

	/**
	 * Returns the originalDemand
	 *
	 * @return \MONOGON\AddressCollection\Domain\Model\Dto\AddressDemand $originalDemand
	 */
	public function getOriginalDemand(){
		return $this->originalDemand;
	}

	/**
	 * Sets the originalDemand
	 *
	 * @param \MONOGON\AddressCollection\Domain\Model\Dto\AddressDemand $originalDemand
	 * @return object $this
	 */
	public function setOriginalDemand($originalDemand){
		$this->originalDemand = $originalDemand;
		return $this;
	}

	public function getAddressGroupsOption (){
		if ($this->originalDemand){
			$uids = $this->originalDemand->getAddressGroups();
		} else {
			$uids = $this->getAddressGroups();
		}
		if (empty($uids)){
			return $this->addressGroupRepository->findAll();
		}
		return $this->addressGroupRepository->findByUids($uids);
	}
}