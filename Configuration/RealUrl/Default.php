<?php

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['_DEFAULT']['postVarSets']['_DEFAULT']['address-list'] = array(
	array(
		'GETvar' => 'tx_addresscollection_pi1[action]',
		// 'valueMap' => array(
		// 	'list' => '',
		// ),
		// 'noMatch' => 'bypass',
		// 'valueDefault' => 'list',
	),
	array(
		'GETvar' => 'tx_addresscollection_pi1[demand][character]',
	),
);

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['_DEFAULT']['postVarSets']['_DEFAULT']['page'] = array(
	array(
		'GETvar' => 'tx_addresscollection_pi1[@widget_0][currentPage]',
	),
);

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['_DEFAULT']['postVarSets']['_DEFAULT']['address'] = array(
	array(
		'GETvar' => 'tx_addresscollection_pi1[controller]',
		'valueMap' => array(
			'address' => '',
		),
		'noMatch' => 'bypass',
	),
	array(
		'GETvar' => 'tx_addresscollection_pi1[address]',
		'lookUpTable' => array(
			'table' => 'tt_address',
			'id_field' => 'uid',
			'alias_field' => 'name',
			'addWhereClause' => ' AND NOT deleted',
			'useUniqueCache' => 1,
			'useUniqueCache_conf' => array(
				'strtolower' => 1,
				'spaceCharacter' => '-'
			),
			// 'languageGetVar' => 'L',
			// 'languageExceptionUids' => '',
			// 'languageField' => 'sys_language_uid',
			// 'transOrigPointerField' => 'l10n_parent',
			'autoUpdate' => 1,
			'expireDays' => 180,
		),
	),
);