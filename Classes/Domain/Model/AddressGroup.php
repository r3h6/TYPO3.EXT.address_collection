<?php
namespace MONOGON\AddressCollection\Domain\Model;

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
 * AddressGroup
 */
class AddressGroup extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * Description
	 *
	 * @var string
	 */
	protected $description = '';

	/**
	 * Parent group
	 *
	 * @var \MONOGON\AddressCollection\Domain\Model\AddressGroup
	 * @lazy
	 */
	protected $parentGroup = NULL;

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
	 * Returns the parentGroup
	 *
	 * @return \MONOGON\AddressCollection\Domain\Model\AddressGroup $parentGroup
	 */
	public function getParentGroup() {
		return $this->parentGroup;
	}

	/**
	 * Sets the parentGroup
	 *
	 * @param \MONOGON\AddressCollection\Domain\Model\AddressGroup $parentGroup
	 * @return void
	 */
	public function setParentGroup(\MONOGON\AddressCollection\Domain\Model\AddressGroup $parentGroup) {
		$this->parentGroup = $parentGroup;
	}

}