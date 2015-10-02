<?php
namespace Monogon\AddressCollection\Hooks\ItemsProcFunc;

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

use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Monogon\AddressCollection\Configuration\ExtConf;
//use SJBR\StaticInfoTables\Hook\Backend\Form\ElementRenderingHelper;

/**
 * RegionHelper
 */
class RegionHelper implements \TYPO3\CMS\Core\SingletonInterface {

	/**
	 * [$countryRepository description]
	 * @var \SJBR\StaticInfoTables\Domain\Repository\CountryRepository
	 */
	protected $countryRepository;

	/**
	 * [$countryZoneRepository description]
	 * @var \SJBR\StaticInfoTables\Domain\Repository\CountryZoneRepository
	 */
	protected $countryZoneRepository;

	public function __construct (){
		$this->countryRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager')->get('SJBR\\StaticInfoTables\\Domain\\Repository\\CountryRepository');
		$this->countryZoneRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager')->get('SJBR\\StaticInfoTables\\Domain\\Repository\\CountryZoneRepository');
	}

	public function countryZones (&$PA, $fObj){
		$rowCountry = $PA['row']['country'];
		if (is_numeric($rowCountry)){
			$country = $this->countryRepository->findByUid($rowCountry);
			$countryZones = $this->countryZoneRepository->findByCountryOrderedByLocalizedName($country);
			foreach ($countryZones as $countryZone){
				$PA['items'][] = array($countryZone->getLocalName(), $countryZone->getUid());
			}
		}
		if (count($PA['items']) === 1){
			$PA['items'][] = array('Crete a new language pack or disable the country zone selecter box!', -1);
		}
	}
}