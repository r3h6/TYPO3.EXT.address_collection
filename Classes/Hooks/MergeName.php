<?php
namespace Monogon\AddressCollection\Hooks;

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

use Monogon\AddressCollection\Configuration\ExtConf;

/**
 * MergeName
 */
class MergeName {

	const STATUS_UPDATE = 'update';
	const STATUS_NEW = 'new';
	const TABLE = 'tt_address';

	/**
	 * looks for tt_address records with changes to the first, middle, and
	 * last name fields to come by. This function will then write changes back
	 * to the old combined name field in a configurable format
	 *
	 * @param	string		action status: new/update is relevant for us
	 * @param	string		db table
	 * @param	integer		record uid
	 * @param	array		record
	 * @param	object		parent object
	 * @return	void
	 */
	function processDatamap_postProcessFieldArray($status, $table, $id, &$fieldArray, $pObj) {

		$logger = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Core\Log\LogManager')->getLogger(__CLASS__);
		$logger->info($status);

		if($table == self::TABLE && ($status == self::STATUS_NEW || $status == self::STATUS_UPDATE)) {
			if($status == self::STATUS_UPDATE) {
				$address = $this->getFullRecord($id);
			} else {
				$address = $fieldArray;
			}

			$format = ExtConf::get('backwardsCompatFormat');

			$newRecord = array_merge($address, $fieldArray);

			$combinedName = trim(sprintf(
				$format,
				$newRecord['first_name'],
				$newRecord['middle_name'],
				$newRecord['last_name']
			));

			if(!empty($combinedName)) {
				$fieldArray['name'] = $combinedName;
			}
		}
	}

	/**
	 * gets a full tt_address record
	 *
	 * @param	integer	$uid: unique id of the tt_address record to get
	 * @return	array	full tt_address record with associative keys
	 */
	function getFullRecord($uid) {
		$row = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'*',
			'tt_address',
			'uid = '.$uid
		);
		return $row[0];
	}
}