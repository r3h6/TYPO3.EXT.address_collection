<?php
namespace Monogon\AddressCollection\Domain\Model;

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
 * Address
 */
class Address extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	const GENDER_MALE = 'm';

	const GENDER_FEMALE = 'f';

	/**
	 * [$recordType description]
	 *
	 * @var string
	 */
	protected $recordType = '';

	/**
	 * Name
	 *
	 * @var string
	 */
	protected $name = '';

	/**
	 * First name
	 *
	 * @var string
	 */
	protected $firstName = '';

	/**
	 * Middle name
	 *
	 * @var string
	 */
	protected $middleName = '';

	/**
	 * Last name
	 *
	 * @var string
	 */
	protected $lastName = '';

	/**
	 * Gender
	 *
	 * @var string
	 */
	protected $gender = '';

	/**
	 * Birthday
	 *
	 * @var \DateTime
	 */
	protected $birthday = NULL;

	/**
	 * Title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * E-mail
	 *
	 * @var string
	 */
	protected $email = '';

	/**
	 * Phone
	 *
	 * @var string
	 */
	protected $phone = '';

	/**
	 * Mobile
	 *
	 * @var string
	 */
	protected $mobile = '';

	/**
	 * Fax
	 *
	 * @var string
	 */
	protected $fax = '';

	/**
	 * Website
	 *
	 * @var string
	 */
	protected $www = '';

	/**
	 * Company
	 *
	 * @var string
	 */
	protected $company = '';

	/**
	 * Address
	 *
	 * @var string
	 */
	protected $address = '';

	/**
	 * Building
	 *
	 * @var string
	 */
	protected $building = '';

	/**
	 * Room
	 *
	 * @var string
	 */
	protected $room = '';

	/**
	 * ZIP
	 *
	 * @var string
	 */
	protected $zip = '';

	/**
	 * City
	 *
	 * @var string
	 */
	protected $city = '';

	/**
	 * Region
	 *
	 * @var string
	 */
	protected $region = '';

	/**
	 * Country
	 *
	 * @var string
	 */
	protected $country = '';

	/**
	 * Image
	 *
	 * @var string
	 */
	protected $image = NULL;

	/**
	 * Images
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 * @cascade remove
	 */
	protected $images = NULL;

	/**
	 * Description
	 *
	 * @var string
	 */
	protected $description = '';

	/**
	 * Position
	 *
	 * @var string
	 */
	protected $position = '';

	/**
	 * Department
	 *
	 * @var string
	 */
	protected $department = '';

	/**
	 * Qualifications
	 *
	 * @var string
	 */
	protected $qualifications = '';

	/**
	 * Nickname
	 *
	 * @var string
	 */
	protected $nickName = '';

	/**
	 * Post-office box
	 *
	 * @var string
	 */
	protected $postOfficeBox = '';

	/**
	 * Longitude
	 *
	 * @var string
	 */
	protected $longitude = '';

	/**
	 * Latitude
	 *
	 * @var string
	 */
	protected $latitude = '';

	/**
	 * Skype
	 *
	 * @var string
	 */
	protected $skype = '';

	/**
	 * Twitter
	 *
	 * @var string
	 */
	protected $twitter = '';

	/**
	 * Facebook
	 *
	 * @var string
	 */
	protected $facebook = '';

	/**
	 * LinkedIn
	 *
	 * @var string
	 */
	protected $linkedIn = '';

	/**
	 * User
	 *
	 * @var \Monogon\AddressCollection\Domain\Model\User
	 * @lazy
	 */
	protected $user = NULL;

	/**
	 * Address groups
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Monogon\AddressCollection\Domain\Model\AddressGroup>
	 * @lazy
	 */
	protected $addressGroups = NULL;

	/**
	 * Related addresses
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Monogon\AddressCollection\Domain\Model\Address>
	 * @lazy
	 */
	protected $relatedAddresses = NULL;

	/**
	 * Returns the  recordType
	 *
	 * @return string $recordType
	 */
	public function getRecordType() {
		return $this->recordType;
	}

	/**
	 * Sets the recordType
	 *
	 * @param string $recordType
	 * @return object $this
	 */
	public function setRecordType($recordType) {
		$this->recordType = $recordType;
		return $this;
	}

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->images = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->addressGroups = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->relatedAddresses = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the name
	 *
	 * @return string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Returns the firstName
	 *
	 * @return string $firstName
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * Sets the firstName
	 *
	 * @param string $firstName
	 * @return void
	 */
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}

	/**
	 * Returns the middleName
	 *
	 * @return string $middleName
	 */
	public function getMiddleName() {
		return $this->middleName;
	}

	/**
	 * Sets the middleName
	 *
	 * @param string $middleName
	 * @return void
	 */
	public function setMiddleName($middleName) {
		$this->middleName = $middleName;
	}

	/**
	 * Returns the lastName
	 *
	 * @return string $lastName
	 */
	public function getLastName() {
		return $this->lastName;
	}

	/**
	 * Sets the lastName
	 *
	 * @param string $lastName
	 * @return void
	 */
	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}

	/**
	 * Returns the gender
	 *
	 * @return string $gender
	 */
	public function getGender() {
		return $this->gender;
	}

	/**
	 * Sets the gender
	 *
	 * @param string $gender
	 * @return void
	 */
	public function setGender($gender) {
		$this->gender = $gender;
	}

	/**
	 * Returns the birthday
	 *
	 * @return \DateTime $birthday
	 */
	public function getBirthday() {
		return $this->birthday;
	}

	/**
	 * Sets the birthday
	 *
	 * @param \DateTime $birthday
	 * @return void
	 */
	public function setBirthday(\DateTime $birthday) {
		$this->birthday = $birthday;
	}

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the email
	 *
	 * @return string $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the email
	 *
	 * @param string $email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * Returns the phone
	 *
	 * @return string $phone
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * Sets the phone
	 *
	 * @param string $phone
	 * @return void
	 */
	public function setPhone($phone) {
		$this->phone = $phone;
	}

	/**
	 * Returns the mobile
	 *
	 * @return string $mobile
	 */
	public function getMobile() {
		return $this->mobile;
	}

	/**
	 * Sets the mobile
	 *
	 * @param string $mobile
	 * @return void
	 */
	public function setMobile($mobile) {
		$this->mobile = $mobile;
	}

	/**
	 * Returns the fax
	 *
	 * @return string $fax
	 */
	public function getFax() {
		return $this->fax;
	}

	/**
	 * Sets the fax
	 *
	 * @param string $fax
	 * @return void
	 */
	public function setFax($fax) {
		$this->fax = $fax;
	}

	/**
	 * Returns the www
	 *
	 * @return string $www
	 */
	public function getWww() {
		return $this->www;
	}

	/**
	 * Sets the www
	 *
	 * @param string $www
	 * @return void
	 */
	public function setWww($www) {
		$this->www = $www;
	}

	/**
	 * Returns the company
	 *
	 * @return string $company
	 */
	public function getCompany() {
		return $this->company;
	}

	/**
	 * Sets the company
	 *
	 * @param string $company
	 * @return void
	 */
	public function setCompany($company) {
		$this->company = $company;
	}

	/**
	 * Returns the address
	 *
	 * @return string $address
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * Sets the address
	 *
	 * @param string $address
	 * @return void
	 */
	public function setAddress($address) {
		$this->address = $address;
	}

	/**
	 * Returns the building
	 *
	 * @return string $building
	 */
	public function getBuilding() {
		return $this->building;
	}

	/**
	 * Sets the building
	 *
	 * @param string $building
	 * @return void
	 */
	public function setBuilding($building) {
		$this->building = $building;
	}

	/**
	 * Returns the room
	 *
	 * @return string $room
	 */
	public function getRoom() {
		return $this->room;
	}

	/**
	 * Sets the room
	 *
	 * @param string $room
	 * @return void
	 */
	public function setRoom($room) {
		$this->room = $room;
	}

	/**
	 * Returns the zip
	 *
	 * @return string $zip
	 */
	public function getZip() {
		return $this->zip;
	}

	/**
	 * Sets the zip
	 *
	 * @param string $zip
	 * @return void
	 */
	public function setZip($zip) {
		$this->zip = $zip;
	}

	/**
	 * Returns the city
	 *
	 * @return string $city
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Sets the city
	 *
	 * @param string $city
	 * @return void
	 */
	public function setCity($city) {
		$this->city = $city;
	}

	/**
	 * Returns the region
	 *
	 * @return string $region
	 */
	public function getRegion() {
		return $this->region;
	}

	/**
	 * Sets the region
	 *
	 * @param string $region
	 * @return void
	 */
	public function setRegion($region) {
		$this->region = $region;
	}

	/**
	 * Returns the country
	 *
	 * @return string $country
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * Sets the country
	 *
	 * @param string $country
	 * @return void
	 */
	public function setCountry($country) {
		$this->country = $country;
	}

	/**
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the position
	 *
	 * @return string $position
	 */
	public function getPosition() {
		return $this->position;
	}

	/**
	 * Sets the position
	 *
	 * @param string $position
	 * @return void
	 */
	public function setPosition($position) {
		$this->position = $position;
	}

	/**
	 * Returns the department
	 *
	 * @return string $department
	 */
	public function getDepartment() {
		return $this->department;
	}

	/**
	 * Sets the department
	 *
	 * @param string $department
	 * @return void
	 */
	public function setDepartment($department) {
		$this->department = $department;
	}

	/**
	 * Returns the qualifications
	 *
	 * @return string $qualifications
	 */
	public function getQualifications() {
		return $this->qualifications;
	}

	/**
	 * Sets the qualifications
	 *
	 * @param string $qualifications
	 * @return void
	 */
	public function setQualifications($qualifications) {
		$this->qualifications = $qualifications;
	}

	/**
	 * Returns the nickName
	 *
	 * @return string $nickName
	 */
	public function getNickName() {
		return $this->nickName;
	}

	/**
	 * Sets the nickName
	 *
	 * @param string $nickName
	 * @return void
	 */
	public function setNickName($nickName) {
		$this->nickName = $nickName;
	}

	/**
	 * Returns the postOfficeBox
	 *
	 * @return string $postOfficeBox
	 */
	public function getPostOfficeBox() {
		return $this->postOfficeBox;
	}

	/**
	 * Sets the postOfficeBox
	 *
	 * @param string $postOfficeBox
	 * @return void
	 */
	public function setPostOfficeBox($postOfficeBox) {
		$this->postOfficeBox = $postOfficeBox;
	}

	/**
	 * Returns the longitude
	 *
	 * @return string $longitude
	 */
	public function getLongitude() {
		return $this->longitude;
	}

	/**
	 * Sets the longitude
	 *
	 * @param string $longitude
	 * @return void
	 */
	public function setLongitude($longitude) {
		$this->longitude = $longitude;
	}

	/**
	 * Returns the latitude
	 *
	 * @return string $latitude
	 */
	public function getLatitude() {
		return $this->latitude;
	}

	/**
	 * Sets the latitude
	 *
	 * @param string $latitude
	 * @return void
	 */
	public function setLatitude($latitude) {
		$this->latitude = $latitude;
	}

	/**
	 * Returns the image
	 *
	 * @return string image
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * Sets the image
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
	 * @return string image
	 */
	public function setImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image) {
		$this->image = $image;
	}

	/**
	 * Adds a FileReference
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
	 * @return void
	 */
	public function addImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image) {
		$this->images->attach($image);
	}

	/**
	 * Removes a FileReference
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $imageToRemove The FileReference to be removed
	 * @return void
	 */
	public function removeImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $imageToRemove) {
		$this->images->detach($imageToRemove);
	}

	/**
	 * Returns the images
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
	 */
	public function getImages() {
		return $this->images;
	}

	/**
	 * Sets the images
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
	 * @return void
	 */
	public function setImages(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $images) {
		$this->images = $images;
	}

	/**
	 * sets the Skype attribute
	 *
	 * @param 	string	 $skype
	 * @return 	void
	 */
	public function setSkype($skype) {
		$this->skype = $skype;
	}

	/**
	 * returns the Skype attribute
	 *
	 * @return 	string
	 */
	public function getSkype() {
		return $this->skype;
	}

	/**
	 * sets the twitter attribute
	 *
	 * @param 	string	 $twitter
	 * @return 	void
	 */
	public function setTwitter($twitter) {
		if (substr($twitter, 0, 1) !== '@') {
			throw new \InvalidArgumentException('twitter name must start with @', 1357530444);
		}
		$this->twitter = $twitter;
	}

	/**
	 * returns the twitter attribute
	 *
	 * @return 	string
	 */
	public function getTwitter() {
		return $this->twitter;
	}

	/**
	 * sets the Facebook attribute
	 *
	 * @param 	string	 $facebook
	 * @return 	void
	 */
	public function setFacebook($facebook) {
		if (substr($facebook, 0, 1) !== '/') {
			throw new \InvalidArgumentException('Facebook name must start with /', 1357530471);
		}
		$this->facebook = $facebook;
	}

	/**
	 * returns the Facebook attribute
	 *
	 * @return 	string
	 */
	public function getFacebook() {
		return $this->facebook;
	}

	/**
	 * sets the LinkedIn attribute
	 *
	 * @param 	string	 $linkedIn
	 * @return 	void
	 */
	public function setLinkedIn($linkedIn) {
		$this->linkedIn = $linkedIn;
	}

	/**
	 * returns the LinkedIn attribute
	 *
	 * @return 	string
	 */
	public function getLinkedIn() {
		return $this->linkedIn;
	}

	/**
	 * Returns the user
	 *
	 * @return \Monogon\AddressCollection\Domain\Model\User user
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * Sets the user
	 *
	 * @param \Monogon\AddressCollection\Domain\Model\User $user
	 * @return \Monogon\AddressCollection\Domain\Model\User user
	 */
	public function setUser(\Monogon\AddressCollection\Domain\Model\User $user) {
		$this->user = $user;
	}

	/**
	 * Adds a AddressGroup
	 *
	 * @param \Monogon\AddressCollection\Domain\Model\AddressGroup $addressGroup
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Monogon\AddressCollection\Domain\Model\AddressGroup> addressGroups
	 */
	public function addAddressGroup(\Monogon\AddressCollection\Domain\Model\AddressGroup $addressGroup) {
		$this->addressGroups->attach($addressGroup);
	}

	/**
	 * Removes a AddressGroup
	 *
	 * @param \Monogon\AddressCollection\Domain\Model\AddressGroup $addressGroupToRemove The AddressGroup to be removed
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Monogon\AddressCollection\Domain\Model\AddressGroup> addressGroups
	 */
	public function removeAddressGroup(\Monogon\AddressCollection\Domain\Model\AddressGroup $addressGroupToRemove) {
		$this->addressGroups->detach($addressGroupToRemove);
	}

	/**
	 * Returns the addressGroups
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Monogon\AddressCollection\Domain\Model\AddressGroup> addressGroups
	 */
	public function getAddressGroups() {
		return $this->addressGroups;
	}

	/**
	 * Sets the addressGroups
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Monogon\AddressCollection\Domain\Model\AddressGroup> $addressGroups
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Monogon\AddressCollection\Domain\Model\AddressGroup> addressGroups
	 */
	public function setAddressGroups(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $addressGroups) {
		$this->addressGroups = $addressGroups;
	}

	/**
	 * Adds a Address
	 *
	 * @param \Monogon\AddressCollection\Domain\Model\Address $relatedAddress
	 * @return void
	 */
	public function addRelatedAddress(\Monogon\AddressCollection\Domain\Model\Address $relatedAddress) {
		$this->relatedAddresses->attach($relatedAddress);
	}

	/**
	 * Removes a Address
	 *
	 * @param \Monogon\AddressCollection\Domain\Model\Address $relatedAddressToRemove The Address to be removed
	 * @return void
	 */
	public function removeRelatedAddress(\Monogon\AddressCollection\Domain\Model\Address $relatedAddressToRemove) {
		$this->relatedAddresses->detach($relatedAddressToRemove);
	}

	/**
	 * Returns the relatedAddresses
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Monogon\AddressCollection\Domain\Model\Address> $relatedAddresses
	 */
	public function getRelatedAddresses() {
		return $this->relatedAddresses;
	}

	/**
	 * Sets the relatedAddresses
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Monogon\AddressCollection\Domain\Model\Address> $relatedAddresses
	 * @return void
	 */
	public function setRelatedAddresses(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $relatedAddresses) {
		$this->relatedAddresses = $relatedAddresses;
	}

}