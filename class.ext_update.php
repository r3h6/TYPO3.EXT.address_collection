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

class AlreadyMigratedFALException extends Exception {

}

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
	 * @var \TYPO3\CMS\Core\Resource\ResourceFactory
	 */
	protected $resourceFactory;

	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManager;
	 */
	protected $objectManager;


	/**
	 * Constructor
	 */
	public function __construct() {
		$this->databaseConnection = $GLOBALS['TYPO3_DB'];
		$this->objectManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
		$this->resourceFactory = $this->objectManager->get('TYPO3\\CMS\\Core\\Resource\\ResourceFactory');
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
			// Check if tt_address table is present.
			$this->checkDatabase();

			// Update any record with no type set.
			$result = $this->databaseConnection->exec_UPDATEquery('tt_address', "tx_extbase_type=''", array('tx_extbase_type' => 'Tx_AddressCollection_Address'));
			if ($result === FALSE){
				throw new Exception($this->databaseConnection->sql_error(), $this->databaseConnection->sql_errno());
			}

			// Message.
			$rowsCount = $this->databaseConnection->sql_affected_rows();
			$this->messageArray[] = array(FlashMessage::OK, $title, sprintf('%d address records have been updated!', $rowsCount));
		} catch (Exception $exception){
			$this->messageArray[] = array(FlashMessage::ERROR, $title, $exception->getMessage());
		}
	}

	protected function migrateImagesToFAL ($folderId = '1:/user_upload/'){
		$title = 'Migrate images to FAL';
		try {
			// Check if tt_address table is present.
			$this->checkDatabase();

			// Get records who are not migrated yet.
			$result = $this->databaseConnection->exec_SELECTquery('uid, pid, image', 'tt_address', 'image!="" AND images=0');
			if ($result === FALSE){
				throw new Exception($this->databaseConnection->sql_error(), $this->databaseConnection->sql_errno());
			}

			// Count rows for message.
			$rowsCount = $this->databaseConnection->sql_affected_rows();

			// Get FAL folder object.
			$folder = $this->resourceFactory->retrieveFileOrFolderObject($folderId);

			// Data map.
			$data = array();

			// Loop through addresses
			while ($address = $this->databaseConnection->sql_fetch_assoc($result)){
				$images = GeneralUtility::trimExplode(',', $address['image']);
				$references = array();
				foreach ($images as $i => $image) {
					try {
						// Create or get FAL object in storage 0.
						$filePath = GeneralUtility::getFileAbsFileName('uploads/pics/' . $image);
						$file = $this->resourceFactory->retrieveFileOrFolderObject($filePath);

						// Check if same file exists in storage 1.
						// Otherwise copy it.
						$migratedFile = $this->databaseConnection->exec_SELECTgetSingleRow('uid', 'sys_file', sprintf("sha1='%s' AND storage=1", $file->getSha1()));

						if (is_array($migratedFile)){
							$uidLocal = $migratedFile['uid'];
						} else {
							$migratedFile = $file->copyTo($folder);
							$uidLocal = $migratedFile->getProperty('uid');
						}

						if (!$uidLocal){
							throw new Exception('Invalid local uid!', 1428149072);
						}

						// Add reference to data map
						if (!isset($data['sys_file_reference'])){
							$data['sys_file_reference'] = array();
						}

						$id = uniqid('NEW');
						$references[] = $id;
						$data['sys_file_reference'][$id] = array(
							'uid_local' => $uidLocal,
							'uid_foreign' => $address['uid'],
							'pid' => $address['pid'],
							'tablenames' => 'tt_address',
							'fieldname' => 'images',
							'tstamp' => time(),
							'crdate' => time(),
							'sorting_foreign' => ($i + 1),
						);

					} catch (Exception $exception){
						$this->messageArray[] = array(FlashMessage::ERROR, sprintf("$title (tt_address #%d)", $address['uid']), $exception->getMessage());
					}
				}
				// If address has references, add them to the address record.
				if (!empty($references)){
					$data['tt_address'][$address['uid']]['images'] = join(',', $references);
				}
			}

			// Process data map.
			$tce = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\DataHandling\\DataHandler');
			$tce->stripslashes_values = 0;
			$tce->start($data, array());
			$tce->process_datamap();

			// Message.
			$this->messageArray[] = array(FlashMessage::OK, $title, sprintf('Migrated %d record(s)!', $rowsCount));

		} catch (AlreadyMigratedFALException $exception){
			$this->messageArray[] = array(FlashMessage::OK, $title, $exception->getMessage());
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