<?php
namespace Monogon\AddressCollection\Domain\Repository;

use TYPO3\CMS\Extbase\Utility\ArrayUtility;
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
 * The repository for Addresses
 */
class AddressRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * @param $demand
	 */
	public function getCharacterList($demand = NULL) {
		$characterList = array();
		$query = $this->createQuery();
		$join = '';
		if ($demand !== NULL) {
			$addressGroups = $demand->getAddressGroups();
			if (!empty($addressGroups)) {
				$databaseConntection = $GLOBALS['TYPO3_DB'];
				$join = '
					INNER JOIN  `tt_address_group_mm`  `mm`
					ON  `tt_address`.`uid` =  `mm`.`uid_local`
					WHERE  `mm`.`uid_foreign` IN (' . join(', ', $databaseConntection->cleanIntArray($addressGroups)) . ')';
			}
		}
		$query->statement('
			SELECT LCASE(LEFT(`last_name` , 1)) AS `character`
			FROM `tt_address`
			' . $join . '
			GROUP BY `character`
			ORDER BY `character`' . $where);
		$results = $query->execute(TRUE);
		foreach ($results as $row) {
			if (!empty($row['character'])) {
				$characterList[] = $row['character'];
			}
		}
		return $characterList;
	}

	/**
	 * @param \MONOGON\AddressCollection\Domain\Model\Dto\AddressDemand $demand
	 */
	public function findDemanded(\MONOGON\AddressCollection\Domain\Model\Dto\AddressDemand $demand) {
		$query = $this->createQuery();
		$constraints = array();

		$names = ArrayUtility::trimExplode(',', $demand->getName(), TRUE);
		if (!empty($names)) {
			$constraints[] = $this->buildLikeConstraint('name', $names, $query);
		}

		$emails = ArrayUtility::trimExplode(',', $demand->getEmail(), TRUE);
		if (!empty($emails)) {
			$constraints[] = $this->buildLikeConstraint('email', $emails, $query);
		}

		$character = $demand->getCharacter();
		if ($character) {
			$constraints[] = $query->like('lastName', $character . '%');
		}

		$addressGroups = $demand->getAddressGroups();
		if (!empty($addressGroups)) {
			$constraints[] = $this->buildContainsConstraint('addressGroups', $addressGroups, $query);
		}

		$recordTypes = $demand->getRecordTypes();
		if (!empty($recordTypes)) {
			$constraints[] = $this->buildInContraint('recordType', $recordTypes, $query);
		}

		$includeAddresses = $demand->getIncludeAddresses();
		if (!empty($includeAddresses)) {
			$constraints[] = $this->buildInContraint('uid', $includeAddresses, $query);
		}

		array_filter($constraints);
		if (!empty($constraints)) {
			$query->matching($query->logicalAnd($constraints));
		}
		return $query->execute();
	}

	/**
	 * @param $propertyName
	 * @param $operands
	 * @param $query
	 */
	protected function buildLikeConstraint($propertyName, $operands, $query) {
		$constraints = array();
		foreach ((array) $operands as $operand) {
			$operand = '%' . str_replace('%', '', $operand) . '%';
			$constraints[] = $query->like($propertyName, $operand);
		}
		return $query->logicalOr($constraints);
	}

	/**
	 * @param $propertyName
	 * @param $operands
	 * @param $query
	 */
	protected function buildContainsConstraint($propertyName, $operands, $query) {
		$constraints = array();
		foreach ((array) $operands as $operand) {
			$constraints[] = $query->contains($propertyName, $operand);
		}
		return $query->logicalOr($constraints);
	}

	/**
	 * @param $propertyName
	 * @param $operands
	 * @param $query
	 */
	protected function buildInContraint($propertyName, $operands, $query) {
		return $query->in($propertyName, $operands);
	}

}