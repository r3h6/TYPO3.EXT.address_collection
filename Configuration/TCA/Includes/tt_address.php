<?php

return array(
	'images' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection_domain_model_address.images',
		'config' =>
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
			'images',
			array('maxitems' => 6),
			$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
		),

	),
	'position' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection_domain_model_address.position',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'department' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection_domain_model_address.department',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'qualifications' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection_domain_model_address.qualifications',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'nick_name' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection_domain_model_address.nick_name',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'post_office_box' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection_domain_model_address.post_office_box',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'longitude' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection_domain_model_address.longitude',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'latitude' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection_domain_model_address.latitude',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim'
		),
	),
	'user' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection_domain_model_address.user',
		'config' => array(
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => 'fe_users',
			'size' => '1',
			'maxitems' => '1',
			'minitems' => '0',
			'show_thumbs' => '1',
			'wizards' => array(
				'suggest' => array(
					 'type' => 'suggest',
				),
			),
		),
	),
	'skype' => array (
		'exclude' => 1,
		'label'   => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection_domain_model_address.skype',
		'config'  => array (
			'type' => 'input',
			'size' => '20',
			'eval' => 'trim',
			'max'  => '50',
			'placeholder' => 'example'
		)
	),
	'twitter' => array (
		'exclude' => 1,
		'label'   => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection_domain_model_address.twitter',
		'config'  => array (
			'type' => 'input',
			'size' => '20',
			'eval' => 'trim',
			'max'  => '50',
			'placeholder' => '@example'
		)
	),
	'facebook' => array (
		'exclude' => 1,
		'label'   => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection_domain_model_address.facebook',
		'config'  => array (
			'type' => 'input',
			'size' => '20',
			'eval' => 'trim',
			'max'  => '50',
			'placeholder' => '/example'
		)
	),
	'linked_in' => array (
		'exclude' => 1,
		'label'   => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection_domain_model_address.linked_in',
		'config'  => array (
			'type' => 'input',
			'size' => '20',
			'eval' => 'trim',
			'max'  => '50',
			'placeholder' => 'example'
		)
	),
);