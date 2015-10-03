<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tt_address'] = array(
	'ctrl' => $GLOBALS['TCA']['tt_address']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, first_name, middle_name, last_name, gender, birthday, title, email, phone, phone_direct, mobile, fax, www, address, building, room, zip, city, region, country, post_office_box, image, images, description, company, position, department, qualifications, nick_name, longitude, latitude, skype, twitter, facebook, linked_in, addressgroup, related_addresses, related_addresses_from, user',
	),
	'types' => array(
		'Tx_AddressCollection_Address' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, name, first_name, middle_name, last_name, gender, birthday, title, email, phone, phone_direct, mobile, fax, www, address, building, room, zip, city, region, country, post_office_box, image, images, description, company, position, department, qualifications, nick_name, longitude, latitude, skype, twitter, facebook, linked_in, addressgroup, related_addresses, related_addresses_from, user, '),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(

		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tt_address',
				'foreign_table_where' => 'AND tt_address.pid=###CURRENT_PID### AND tt_address.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),

		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),

		'name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'first_name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.first_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'middle_name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.middle_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'last_name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.last_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'gender' => array (
			'label'  => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.gender',
			'config' => array (
				'type'    => 'radio',
				'default' => 'm',
				'items'   => array(
					array('LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.gender.m', 'm'),
					array('LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.gender.f', 'f')
				)
			)
		),
		'birthday' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.birthday',
			'config' => array(
				'type' => 'input',
				'size' => 7,
				'eval' => 'date',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'email' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.email',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'phone' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.phone',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'phone_direct' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.phone_direct',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'mobile' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.mobile',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'fax' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.fax',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'www' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.www',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'address' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.address',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'building' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.building',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'room' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.room',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'zip' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.zip',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'city' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.city',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'region' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.region',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'country' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.country',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'post_office_box' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.post_office_box',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'image' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.image',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'images' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.images',
			'config' =>
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'images',
				array(
					'maxitems' => 6,
					// 'foreign_match_fields' => array(
					// 	'fieldname' => 'images',
					// 	'tablenames' => 'tt_address',
					// 	'table_local' => 'sys_file',
					// ),
					'foreign_types' => array(
						'0' => array(
							'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.basicoverlayPalette;basicoverlayPalette,
						--palette--;;addressPalette,
						--palette--;;filePalette'
						),
						\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => array(
							'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.basicoverlayPalette;basicoverlayPalette,
						--palette--;;addressPalette,
						--palette--;;filePalette'
						),
						\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
							'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.basicoverlayPalette;basicoverlayPalette,
						--palette--;;addressPalette,
						--palette--;;filePalette'
						),
						\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => array(
							'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.basicoverlayPalette;basicoverlayPalette,
						--palette--;;addressPalette,
						--palette--;;filePalette'
						),
						\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => array(
							'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.basicoverlayPalette;basicoverlayPalette,
						--palette--;;addressPalette,
						--palette--;;filePalette'
						),
						\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => array(
							'showitem' => '
						--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.basicoverlayPalette;basicoverlayPalette,
						--palette--;;addressPalette,
						--palette--;;filePalette'
						),
					),
				),
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			),

		),
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'company' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.company',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'position' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.position',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'department' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.department',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'qualifications' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.qualifications',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'nick_name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.nick_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'longitude' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.longitude',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'latitude' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.latitude',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'skype' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.skype',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim',
				'placeholder' => 'example'
			),
		),
		'twitter' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.twitter',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim',
				'placeholder' => '@example'
			),
		),
		'facebook' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.facebook',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim',
				'placeholder' => '/example'
			),
		),
		'linked_in' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.linked_in',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim',
				'placeholder' => 'example'
			),
		),
		'addressgroup' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.address_groups',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tt_address_group',
				'foreign_table_where' => ' AND tt_address_group.sys_language_uid IN (-1, 0) ORDER BY tt_address_group.title ASC',
				'MM' => 'tt_address_group_mm',
				'size' => 10,
				'autoSizeMax' => 50,
				'maxitems' => 9999,
				'renderMode' => 'tree',
				'treeConfig' => array(
					'parentField' => 'parent_group',
					'appearance' => array(
						'expandAll' => TRUE,
						'showHeader' => TRUE,
					),
				),
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tt_address_group',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
		'related_addresses' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.related_addresses',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'tt_address',
				'foreign_table' => 'tt_address',
				'MM_opposite_field' => 'related_addresses_from',
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 100,
				'MM' => 'tx_addresscollection_address_address_mm',
				'wizards' => array(
					'suggest' => array(
						'type' => 'suggest',
					),
				),
			),
		),
		'related_addresses_from' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.related_addresses_from',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'foreign_table' => 'tt_address',
				'allowed' => 'tt_address',
				'size' => 5,
				'maxitems' => 100,
				'MM' => 'tx_addresscollection_address_address_mm',
				'readOnly' => 1,
			),
		),
		'user' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address.user',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'fe_users',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),

	),
);
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

$GLOBALS['TCA']['tt_address']['types'] = array (
	'1' => array('showitem' => 'tx_extbase_type,
		--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.name;name, description,
		--div--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_tab.details,
			--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.address;address,
			--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.building;building,
			--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.geo;geo,
			--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.organization;organization,
			--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.contact;contact,
			--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.social;social,
		--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.images,
			images,
		--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
			hidden,
		--div--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_tab.relations,
			addressgroup, user, related_addresses, related_addresses_from
	'),
	'Tx_AddressCollection_CompanyAddress' => array('showitem' => 'tx_extbase_type,
		name, description,
		--div--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_tab.details,
			--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.address;address,
			--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.building;building,
			--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.geo;geo,
			--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.contact;contact,
			--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.social;social,
		--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.images,
			images,
		--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
			hidden,
		--div--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_tab.relations,
			addressgroup, user, related_addresses, related_addresses_from
	'),
	'Tx_AddressCollection_PersonalAddress' => array('showitem' => 'tx_extbase_type,
		--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.name;name, nick_name, description,
		--div--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_tab.details,
			--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.address;address,
			--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.building;building,
			--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.contact;contact,
			--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.social;social,
		--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.images,
			images,
		--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
			hidden,
		--div--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_tab.relations,
			addressgroup, user, related_addresses, related_addresses_from
	'),
);
$GLOBALS['TCA']['tt_address']['palettes'] = array(
	'name' => array(
		'showitem' => '
						gender, title, --linebreak--,
						first_name, middle_name, --linebreak--,
						last_name',
		'canNotCollapse' => 1
	),

	'organization' => array(
		'showitem' => 'company, department, position, --linebreak--,
						qualifications',
		'canNotCollapse' => 1
	),

	'address' => array(
		'showitem' => 'address, --linebreak--,
						post_office_box, --linebreak--,
						city, zip, region, --linebreak--,
						country',
		'canNotCollapse' => 1
	),

	'building' => array(
		'showitem' => 'building, room',
		'canNotCollapse' => 1
	),

	'contact' => array(
		'showitem' => 'phone, phone_direct, --linebreak--,
						mobile, --linebreak--,
						fax, --linebreak--,
						email, www',
		'canNotCollapse' => 1
	),

	'geo' => array(
		'showitem' => 'longitude, latitude',
		'canNotCollapse' => 1
	),

	'social' => array(
		'showitem' => 'skype, --linebreak--,
						twitter, --linebreak--,
						facebook, --linebreak--,
						linked_in',
		'canNotCollapse' => 1
	),
);

if (\Monogon\AddressCollection\Configuration\ExtConf::get('useStaticInfoTables')
	&& \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('static_info_tables')){
	$GLOBALS['TCA']['tt_address']['columns']['country']['config'] = array(
		'type' => 'select',
		'items' => array(
			array('', 0),
		),
		'onChange' => 'reload',
		'foreign_table' => 'static_countries',
		'foreign_table_where' => 'ORDER BY static_countries.cn_short_en',
		'itemsProcFunc' => 'SJBR\\StaticInfoTables\\Hook\\Backend\\Form\\ElementRenderingHelper->translateCountriesSelector',
		'size' => 1,
		'minitems' => 0,
		'maxitems' => 1,
		'wizards' => array(
			'suggest' => array(
				'type' => 'suggest',
				'default' => array(
					'receiverClass' => 'SJBR\\StaticInfoTables\\Hook\\Backend\\Form\\SuggestReceiver'
				)
			)
		)
	);
	$GLOBALS['TCA']['tt_address']['columns']['region']['config'] = array(
		'type' => 'select',
		'items' => array(
			array('', 0),
		),
		'itemsProcFunc' => 'Monogon\\AddressCollection\\Hooks\\ItemsProcFunc\\RegionHelper->countryZones',
		'size' => 1,
		'minitems' => 0,
		'maxitems' => 1,
	);
}