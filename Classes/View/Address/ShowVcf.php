<?php
namespace Monogon\AddressCollection\View\Address;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 R3 H6 <r3h6@outlook.com>
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

use JeroenDesloovere\VCard\VCard;
use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * ShowVcf
 */
class ShowVcf extends \TYPO3\CMS\Extbase\Mvc\View\AbstractView {

	/**
	 * @var \TYPO3\CMS\Extbase\Service\ImageService
	 * @inject
	 */
	protected $imageService;

	public function render (){

		/** @var \Monogon\AddressCollection\Domain\Model\Address $address */
		$address = $this->variables['address'];

		switch ($address->getRecordType()) {
			case 'Tx_AddressCollection_BusinessAddress':
				# code...$
				break;

			default:
				# code...
				break;
		}
		// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($address);

		/** @var \JeroenDesloovere\VCard\VCard */
		$vcard = new VCard();

		// define variables
		$lastname = $address->getLastName();
		$firstname = $address->getFirstName();
		$additional = '';
		$prefix = $address->getGender();
		$suffix = $address->getTitle();

		// add personal data
		$vcard->addName($lastname, $firstname, $additional, $prefix, $suffix);

		// add work data
		$vcard->addCompany($address->getCompany());
		$vcard->addJobtitle($address->getPosition());
		$vcard->addEmail($address->getEmail());
		$vcard->addPhoneNumber($address->getPhone(), 'PREF;WORK');
		$vcard->addPhoneNumber($address->getMobile(), 'WORK');
		$vcard->addAddress(null, null, $address->getAddress(), $address->getCity(), null, $address->getZip(), $address->getCountry());
		$vcard->addURL($address->getWww());

		$images = $address->getImages();
		if (count($images)){
			foreach ($images as $image){
				// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($image);
				//$imagePath = GeneralUtility::getFileAbsFileName($image->getOriginalResource()->getPublicUrl());
				$imageUrl = $this->resizeImage($image->getOriginalResource());
				$vcard->addPhoto($imageUrl);
				break;
			}
		}
		//$vcard->addPhoto();

// return vcard as a string

		// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this);
		$response = $this->controllerContext->getResponse();

		$headers = $vcard->getHeaders(TRUE);
		// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($headers); exit;
		foreach ($headers as $key => $value){
			// $response->setHeader($key, $value);
		}
		return $vcard->getOutput();
	}

	protected function resizeImage ($image){
		$processingInstructions = array(
			'width' => NULL,
			'height' => NULL,
			'minWidth' => 0,
			'minHeight' => 0,
			'maxWidth' => 100,
			'maxHeight' => 100,
		);
		$processedImage = $this->imageService->applyProcessingInstructions($image, $processingInstructions);
		return $this->imageService->getImageUri($processedImage);
	}
}