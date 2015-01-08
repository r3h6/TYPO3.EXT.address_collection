<?php
namespace MONOGON\AddressCollection\ViewHelpers\Form\Options;

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
 * FindAllViewHelper
 */
class AddressGroupsViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * addressGroupRepository
	 *
	 * @var \MONOGON\AddressCollection\Domain\Repository\AddressGroupRepository
	 * @inject
	 */
	protected $addressGroupRepository = NULL;

	/**
	 * [$configurationManager description]
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManager
	 * @inject
	 */
	protected $configurationManager;

	/**
	 * [render description]
	 * @param array $uids
	 */
	public function render ($uids = array()){
		if (empty($uids)){
			return $this->addressGroupRepository->findAll();
		}
		return $this->addressGroupRepository->findByUids($uids);
	}
}