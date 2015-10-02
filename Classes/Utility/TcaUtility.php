<?php
namespace Monogon\AddressCollection\Utility;

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

use \TYPO3\CMS\Backend\Utility\BackendUtility;

/**
 * TemplateLayout utility class
 */
class TcaUtility {

	protected static $cache = array();

	public static function addType ($type){
		$GLOBALS['TCA']['tt_address']['columns'][$GLOBALS['TCA']['tt_address']['ctrl']['type']]['config']['items'][] = array('LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.tx_extbase_type.' . $type, $type);
	}

	public static function showItem ($type, $removeItem = NULL){

		$showItem = $GLOBALS['TCA']['tt_address']['types']['1']['showitem'];
		// $showItem .= ',--div--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection_domain_model_address,';

		// $showItem .= 'position, department, qualifications, fal_image, nick_name, post_office_box, longitude, latitude, user, address_groups, other_addresses, related_addresses';

		// $showItem = 'tx_extbase_type, name, first_name, middle_name, last_name, gender, birthday, title, email, phone, mobile, fax, www, company, address, building, room, zip, city, region, country, image, images, description, position, department, qualifications, nick_name, post_office_box, longitude, latitude, user, address_groups';


		$GLOBALS['TCA']['tt_address']['types'][$type]['showitem'] = $showItem;
	}

	public static function getTypeFields ($object){
		//, $type, $table = 'tt_address'
		if (!isset(self::$cache[$type])){
			self::$cache[$type] = self::getTypeFieldsUncached($type, $table);
		}
		return self::$cache[$type];
	}

	protected static function getTypeFieldsUncached ($type, $table){
		$fields = array();

		if (isset($GLOBALS['TCA'][$table]['types']['0'])){
			$showItem = $GLOBALS['TCA'][$table]['types']['0']['showitem'];
		}
		if (isset($GLOBALS['TCA'][$table]['types']['1'])){
			$showItem = $GLOBALS['TCA'][$table]['types']['1']['showitem'];
		}
		if (isset($GLOBALS['TCA'][$table]['types'][$type])){
			$showItem = $GLOBALS['TCA'][$table]['types'][$type]['showitem'];
		}
		$typeFields = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $showItem, TRUE);

		foreach ($typeFields as $typeField){
			list($fieldName, $altTitle, $palette, $spec) = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(';', $typeField);
			if (strpos($fieldName, '--') !== 0){
				$fields[] = $fieldName;
			}
			if ($palette){
				$fields = array_merge($fields, self::getPalleteFields($palette, $table));
			}

		}
		return $fields;
	}

	protected static function getPalleteFields ($palette, $table){
		$fields = array();
		if (isset($GLOBALS['TCA'][$table]['palettes'][$palette])){
			$showItem = $GLOBALS['TCA'][$table]['palettes'][$palette]['showitem'];
			$paletteFields = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $showItem, TRUE);
			foreach ($paletteFields as $paletteField){
				list($fieldName, $altTitle, $palette, $spec) = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(';', $paletteField);
				if (strpos($fieldName, '--') !== 0){
					$fields[] = $fieldName;
				}
			}
		}
		return $fields;
	}
}