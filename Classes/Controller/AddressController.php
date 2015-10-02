<?php
namespace Monogon\AddressCollection\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Monogon\AddressCollection\Domain\Model\Dto\AddressDemand;
use Monogon\AddressCollection\Utility\ThemeUtility;
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
	 * @var \Monogon\AddressCollection\Domain\Repository\AddressRepository
	 * @inject
	 */
	protected $addressRepository = NULL;

	/**
	 * [$setup description]
	 *
	 * @var \Monogon\AddressCollection\Configuration\Setup
	 * @inject
	 */
	protected $setup = NULL;

	/**
	 * [initializeAction description]
	 *
	 * @return void [description]
	 */
	public function initializeAction() {
		// $this->setup->mergeSettings($this->settings);
		$pageType = GeneralUtility::_GP('type');
		$isAjax = $this->setup->get('ajaxPageType') && $pageType == $this->setup->get('ajaxPageType');
		$this->setup->set('isAjax', $isAjax);
		if ($isAjax) {
			$this->setup->set('list.template', 'Ajax');
		}
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Mvc\View\ViewInterface $view
	 */
	public function initializeView(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface $view) {
		$view->assign('data', $this->configurationManager->getContentObject()->data);
		$view->assign('setup', $this->setup);
	}

	/**
	 * [initializeListAction description]
	 *
	 * @return void [description]
	 */
	protected function initializeListAction() {
		$demandArray = $this->request->hasArgument('demand') ? $this->request->getArgument('demand') : NULL;
		$this->request->setArgument('demand', \Monogon\AddressCollection\Domain\Model\Dto\AddressDemand::factory($this->setup->get('list.demand'), $demandArray));
	}

	/**
	 * action list
	 *
	 * @param \Monogon\AddressCollection\Domain\Model\Dto\AddressDemand $demand
	 * @validate $demand NotEmpty
	 * @return void
	 */
	public function listAction(\Monogon\AddressCollection\Domain\Model\Dto\AddressDemand $demand) {
		$this->view->assign('demand', $demand);
		// Find addresses
		$addresses = $this->addressRepository->findDemanded($demand);
		$this->view->assign('addresses', $addresses);
		// Template layout
		$this->view->assign('templateLayout', $this->setup->get('list.template'));
	}

	/**
	 * [initializeShowAction description]
	 *
	 * @return void [description]
	 */
	public function initializeShowAction() {
		if (!$this->request->hasArgument('address')) {
			$this->request->setArgument('address', $this->setup->get('show.demand.includeAddresses'));
		}
	}

	/**
	 * action show
	 *
	 * @param \Monogon\AddressCollection\Domain\Model\Address $address
	 * @return void
	 */
	public function showAction(\Monogon\AddressCollection\Domain\Model\Address $address) {
		$this->view->assign('address', $address);
	}

}