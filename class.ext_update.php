<?php

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

use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use MONOGON\AddressCollection\Configuration\ExtConf;

/**
 * ext_update
 */
class ext_update {

	/**
	 * Array of flash messages (params) array[][status,title,message]
	 *
	 * @var array
	 */
	protected $messageArray = array();

	/**
	 * @var \TYPO3\CMS\Core\Database\DatabaseConnection
	 */
	protected $databaseConnection;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->databaseConnection = $GLOBALS['TYPO3_DB'];
	}

	/**
	 * Main function, returning the HTML content of the module
	 *
	 * @return	string		HTML
	 */
	public function main() {

		$this->updateTtAddressExtbaseType();
		$this->migrateImagesToFAL();


		return $this->generateOutput();
	}

	protected function updateTtAddressExtbaseType (){
		$title = 'Set extbase type';
		try {
			$this->checkDatabase();

			$result = $this->databaseConnection->exec_UPDATEquery('tt_address', "tx_extbase_type=''", array('tx_extbase_type' => 'Tx_AddressCollection_Address'));
			if ($result === FALSE){
				throw new Exception($this->databaseConnection->sql_error(), $this->databaseConnection->sql_errno());
			}

			$rowsCount = $this->databaseConnection->sql_affected_rows();
			$this->messageArray[] = array(FlashMessage::OK, $title, sprintf('%d address records have been updated!', $rowsCount));
		} catch (Exception $exception){
			$this->messageArray[] = array(FlashMessage::ERROR, $title, $exception->getMessage());
		}
	}

	protected function migrateImagesToFAL (){
		$title = 'Migrate images to FAL';
		try {
			$this->checkDatabase();

			$result = $this->databaseConnection->exec_SELECTquery('uid, image', 'tt_address', 'image!=""');
			if ($result === FALSE){
				throw new Exception($this->databaseConnection->sql_error(), $this->databaseConnection->sql_errno());
			}

			$rowsCount = $this->databaseConnection->sql_affected_rows();
			$this->messageArray[] = array(FlashMessage::NOTICE, $title, sprintf('Found %d image(s).', $rowsCount));

			while ($row = $this->databaseConnection->sql_fetch_assoc($result)){
				\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($row);
			}

		} catch (Exception $exception){
			$this->messageArray[] = array(FlashMessage::ERROR, $title, $exception->getMessage());
		}
	}

	protected function checkDatabase (){
		$tables = $this->databaseConnection->admin_get_tables();
		if (!isset($tables['tt_content'])){
			throw new Exception('Table tt_address not present.', 1428086748);
		}
	}

	/**
	 * Checks how many rows are found and returns true if there are any
	 * (this function is called from the extension manager)
	 *
	 * @param	string		$what: what should be updated
	 * @return	boolean
	 */
	public function access($what = 'all')
	{
		return TRUE;
	}

	/**
	 * Generates output by using flash messages
	 *
	 * @return string
	 */
	protected function generateOutput() {
		$output = '';
		foreach ($this->messageArray as $messageItem) {
			/** @var \TYPO3\CMS\Core\Messaging\FlashMessage $flashMessage */
			$flashMessage = GeneralUtility::makeInstance(
				'TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
				$messageItem[2],
				$messageItem[1],
				$messageItem[0]);
			$output .= $flashMessage->render();
		}
		return $output;
	}
}