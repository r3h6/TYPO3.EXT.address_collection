<?php
namespace MONOGON\AddressCollection\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use MONOGON\AddressCollection\Domain\Model\Dto\AddressDemand;
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
 * AddressController
 */
class AddressController extends ActionController {

	/**
	 * addressRepository
	 *
	 * @var \MONOGON\AddressCollection\Domain\Repository\AddressRepository
	 * @inject
	 */
	protected $addressRepository = NULL;

	/**
	 * addressGroupRepository
	 *
	 * @var \MONOGON\AddressCollection\Domain\Repository\AddressGroupRepository
	 * @inject
	 */
	protected $addressGroupRepository = NULL;

	/**
	 * UserRepository
	 *
	 * @var \MONOGON\AddressCollection\Domain\Repository\UserRepository
	 * @inject
	 */
	protected $UserRepository = NULL;

	//protected $User = NULL;
	/**
	 * [$setup description]
	 *
	 * @var \MONOGON\AddressCollection\Configuration\Setup
	 * @inject
	 */
	protected $setup = NULL;

	/**
	 * [initializeAction description]
	 *
	 * @return void [description]
	 */
	public function initializeAction() {
		$this->setup->mergeRecursiveOverrule(
			$this->settings['setup']
		)->mergeRecursiveOverrule(
			$this->settings['flexform']
		);
		$pageType = GeneralUtility::_GP('type');
		$this->setup->set('isAjax', $this->setup->get('ajaxPageType') && $pageType == $this->setup->get('ajaxPageType'));
	}

	/**
	 * @param $view
	 */
	public function initializeView($view) {
		$view->assign('data', $this->configurationManager->getContentObject()->data);
		$view->assign('setup', $this->setup);
	}

	protected function initializeListAction (){
		$demandPropertyMappingConfiguration = $this->arguments->getArgument('demand')->getPropertyMappingConfiguration();
		$demandPropertyMappingConfiguration->allowProperties('character');
		$demandPropertyMappingConfiguration->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\PersistentObjectConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\PersistentObjectConverter::CONFIGURATION_CREATION_ALLOWED, TRUE);

		//$GLOBALS['TSFE']->reqCHash();
	}

	/**
	 * action list
	 *
	 * @param \MONOGON\AddressCollection\Domain\Model\Dto\AddressDemand $demand
	 * @return void
	 */
	public function listAction(\MONOGON\AddressCollection\Domain\Model\Dto\AddressDemand $demand = NULL) {
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($demand);
		// Create demand
		if ($demand === NULL){
			$propertyMapper = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Property\\PropertyMapper');
			$demand = $propertyMapper->convert(AddressDemand::accessibleProperties($this->setup->get('list.demand')), 'MONOGON\\AddressCollection\\Domain\\Model\\Dto\\AddressDemand');
		}

		$this->view->assign('demand', $demand);
		// Find addresses
		$addresses = $this->addressRepository->findDemanded($demand);
		$this->view->assign('addresses', $addresses);
		// Template layout
		$this->view->assign('templateLayout', $this->setup->get('list.template'));
	}

	// /**
	//  * action search
	//  *
	//  * @param \MONOGON\AddressCollection\Domain\Model\Dto\AddressDemand $demand
	//  * @return void
	//  */
	// public function searchAction(\MONOGON\AddressCollection\Domain\Model\Dto\AddressDemand $demand = NULL) {
	// 	// Create demand
	// 	if ($demand === NULL) {
	// 		$demand = $this->objectManager->get('MONOGON\\AddressCollection\\Domain\\Model\\Dto\\AddressDemand');
	// 	}
	// 	$this->view->assign('demand', $demand);
	// 	// Find addresses
	// 	$addresses = $this->addressRepository->findDemanded($demand);
	// 	$this->view->assign('addresses', $addresses);
	// 	// Find address groups
	// 	$addressGroups = $this->addressGroupRepository->findAll();
	// 	$this->view->assign('addressGroups', $addressGroups);
	// 	// Template layout
	// 	$this->view->assign('templateLayout', $this->setup->get('search.template'));
	// }

	public function initializeShowAction() {
		if (!$this->request->hasArgument('address')) {
			$this->request->setArgument('address', $this->setup->get('show.demand.includeAddresses'));
		}
	}

	/**
	 * action show
	 *
	 * @param \MONOGON\AddressCollection\Domain\Model\Address $address
	 * @return void
	 */
	public function showAction(\MONOGON\AddressCollection\Domain\Model\Address $address) {
		$this->view->assign('address', $address);
	}

	/**
	 * [initializeNewAction description]
	 *
	 * @return void [description]
	 */
	public function initializeNewAction() {
		$this->changeArgumentDataType();
	}

	/**
	 * action new
	 *
	 * @param \MONOGON\AddressCollection\Domain\Model\Address $newAddress
	 * @ignorevalidation $newAddress
	 * @return void
	 */
	public function newAction(\MONOGON\AddressCollection\Domain\Model\Address $newAddress = NULL) {
		if ($newAddress === NULL) {
			$newAddress = $this->objectManager->get('MONOGON\\AddressCollection\\Domain\\Model\\Address');
		}
		$this->view->assign('newAddress', $newAddress);
	}

	/**
	 * [initializeCreateAction description]
	 *
	 * @return void [description]
	 */
	public function initializeCreateAction() {
		$this->changeArgumentDataType();
	}

	/**
	 * action create
	 *
	 * @param \MONOGON\AddressCollection\Domain\Model\Address $newAddress
	 * @return void
	 */
	public function createAction(\MONOGON\AddressCollection\Domain\Model\Address $newAddress) {
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->addressRepository->add($newAddress);
		$this->redirect('manage');
	}

	/**
	 * action edit
	 *
	 * @param \MONOGON\AddressCollection\Domain\Model\Address $address
	 * @ignorevalidation $address
	 * @return void
	 */
	public function editAction(\MONOGON\AddressCollection\Domain\Model\Address $address) {
		$this->view->assign('address', $address);
	}

	/**
	 * action update
	 *
	 * @param \MONOGON\AddressCollection\Domain\Model\Address $address
	 * @return void
	 */
	public function updateAction(\MONOGON\AddressCollection\Domain\Model\Address $address) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->addressRepository->update($address);
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \MONOGON\AddressCollection\Domain\Model\Address $address
	 * @return void
	 */
	public function deleteAction(\MONOGON\AddressCollection\Domain\Model\Address $address) {
		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->addressRepository->remove($address);
		$this->redirect('list');
	}

	/**
	 * action manage
	 *
	 * @return void
	 */
	public function manageAction() {
		// Find addresses
		$recordTypes = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $this->setup->get('manage.demand.recordTypes'));
		$demand = $this->objectManager->get('MONOGON\\AddressCollection\\Domain\\Model\\Dto\\AddressDemand');
		$groupedAddresses = array();
		foreach ($recordTypes as $recordType) {
			$demand->setRecordTypes(array($recordType));
			$groupedAddresses[$recordType] = $this->addressRepository->findDemanded($demand);
		}
		$this->view->assign('groupedAddresses', $groupedAddresses);
		// Template layout
		$this->view->assign('templateLayout', $this->setup->get('manage.template'));
	}

	/**
	 * [changeArgumentDataType description]
	 *
	 * @return void [description]
	 */
	protected function changeArgumentDataType() {
		if ($this->request->hasArgument('newAddress') && is_array($newAddress = $this->request->getArgument('newAddress')) && isset($newAddress['recordType'])) {
			$recordType = $newAddress['recordType'];
			$extbaseFrameworkConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
				'MONOGON\\AddressCollection\\Configuration\\Setup',
				$this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK)
			);
			$className = $extbaseFrameworkConfiguration->get('persistence.classes.MONOGON\\AddressCollection\\Domain\\Model\\Address.subclasses.' . $recordType);
			//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($className);
			if ($className) {
				$newAddressArgument = $this->arguments->getArgument('newAddress');
				$newAddressArgument->setDataType($className);
				$propertyMappingConfiguration = $newAddressArgument->getPropertyMappingConfiguration();
				// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($propertyMappingConfiguration);
				$propertyMappingConfiguration->allowProperties('recordType');
				$propertyMappingConfiguration->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\PersistentObjectConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\PersistentObjectConverter::CONFIGURATION_CREATION_ALLOWED, TRUE);
				$this->initializeActionMethodValidators();
			}
		}
	}

}