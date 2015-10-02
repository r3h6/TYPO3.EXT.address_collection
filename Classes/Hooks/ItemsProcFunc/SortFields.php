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

use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * SortFields
 */
class SortFields implements \TYPO3\CMS\Core\SingletonInterface {

	public function getSortFields (array &$config){

		// $coreSortFields = 'gender, first_name, middle_name, last_name, title, company, '
		// 	.'address, building, room, birthday, zip, city, region, country, email, www, phone, mobile, '
		// 	.'fax';

		$coreSortFields = 'name, first_name, middle_name, last_name, gender, birthday, title, email, phone, mobile, fax, www, company, address, building, room, zip, city, region, country, position, department, qualifications, nick_name, post_office_box, longitude, latitude';

		$sortFields = GeneralUtility::trimExplode(',', $coreSortFields);

		$selectOptions = array();
		foreach($sortFields as $field) {
			$label = $GLOBALS['LANG']->sL($GLOBALS['TCA']['tt_address']['columns'][$field]['label']);
			$label = substr($label, 0, -1);

			$selectOptions[] = array(
				'field' => $field,
				'label' => $label
			);
		}

		// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($selectOptions); exit;

		// add sorting by order of single selection
		// $selectOptions[] = array (
		// 	'field' => 'singleSelection',
		// 	'label' => $GLOBALS['LANG']->sL('LLL:EXT:tt_address/pi1/locallang_ff.xml:pi1_flexform.sortBy.singleSelection')
		// );

		// sort by labels
		$labels = array();
		foreach($selectOptions as $key => $v) {
			$labels[$key] = $v['label'];
		}
		$labels = array_map('strtolower', $labels);
		array_multisort($labels, SORT_ASC, $selectOptions);

		// add fields to <select>
		foreach($selectOptions as $option) {
			$config['items'][] = array(
				$option['label'],
				$option['field']
			);
		}
	}
}