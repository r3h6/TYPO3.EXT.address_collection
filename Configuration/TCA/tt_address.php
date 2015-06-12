<?php

// ******************************************************************
// This is the standard TypoScript address table, tt_address
// ******************************************************************

$GLOBALS['TCA']['tt_address'] = array (
	'ctrl' => $GLOBALS['TCA']['tt_address']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'name,address,building,room,city,zip,region,country,phone,fax,email,www,title,company,image'
	),
	'feInterface' => $GLOBALS['TCA']['tt_address']['feInterface'],
	'columns' => array (
		'hidden' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type' => 'check'
			)
		),
		'gender' => array (
			'label'  => 'LLL:EXT:address_collection/Resources/Private/Language/locallang.xlf:tx_addresscollection_domain_model_address.gender',
			'config' => array (
				'type'    => 'radio',
				'default' => 'm',
				'items'   => array(
					array('LLL:EXT:address_collection/Resources/Private/Language/locallang.xlf:tx_addresscollection_domain_model_address.gender.m', 'm'),
					array('LLL:EXT:address_collection/Resources/Private/Language/locallang.xlf:tx_addresscollection_domain_model_address.gender.f', 'f')
				)
			)
		),
		'name' => array (
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.name',
			'config' => array (
				'type' => 'input',
				'size' => '40',
				'eval' => 'trim',
				'max'  => '255'
			)
		),
		'first_name' => array (
			'exclude' => 0,
			'label'   => 'LLL:EXT:address_collection/Resources/Private/Language/locallang.xlf:tx_addresscollection_domain_model_address.first_name',
			'config'  => array (
				'type' => 'input',
				'size' => '40',
				'eval' => 'trim',
				'max'  => '255'
			)
		),
		'middle_name' => array (
			'exclude' => 0,
			'label'   => 'LLL:EXT:address_collection/Resources/Private/Language/locallang.xlf:tx_addresscollection_domain_model_address.middle_name',
			'config'  => array (
				'type' => 'input',
				'size' => '40',
				'eval' => 'trim',
				'max'  => '255'
			)
		),
		'last_name' => array (
			'exclude' => 0,
			'label'   => 'LLL:EXT:address_collection/Resources/Private/Language/locallang.xlf:tx_addresscollection_domain_model_address.last_name',
			'config'  => array (
				'type' => 'input',
				'size' => '40',
				'eval' => 'trim',
				'max'  => '255'
			)
		),
		'birthday' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:address_collection/Resources/Private/Language/locallang.xlf:tx_addresscollection_domain_model_address.birthday',
			'config'  => array (
				'type' => 'input',
				'eval' => 'date',
				'size' => '8',
				'max'  => '20'
			)
		),
		'title' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.title_person',
			'config'  => array (
				'type' => 'input',
				'size' => '20',
				'eval' => 'trim',
				'max'  => '255'
			)
		),
		'address' => array (
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.address',
			'config' => array (
				'type' => 'text',
				'cols' => '20',
				'rows' => '3'
			)
		),
		'building' => array (
			'label'  => 'LLL:EXT:address_collection/Resources/Private/Language/locallang.xlf:tx_addresscollection_domain_model_address.building',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
				'size' => '20',
				'max'  => '20'
			)
		),
		'room' => array (
			'label'  => 'LLL:EXT:address_collection/Resources/Private/Language/locallang.xlf:tx_addresscollection_domain_model_address.room',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
				'size' => '20',
				'max'  => '15'
			)
		),
		'phone' => array (
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.phone',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
				'size' => '20',
				'max'  => '30'
			)
		),
		'fax' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.fax',
			'config'  => array (
				'type' => 'input',
				'size' => '20',
				'eval' => 'trim',
				'max'  => '30'
			)
		),
		'mobile' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:address_collection/Resources/Private/Language/locallang.xlf:tx_addresscollection_domain_model_address.mobile',
			'config'  => array (
				'type' => 'input',
				'eval' => 'trim',
				'size' => '20',
				'max'  => '30'
			)
		),
		'www' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.www',
			'config'  => array (
				'type' => 'input',
				'eval' => 'trim',
				'size' => '20',
				'max'  => '255',
				'wizards' => array(
					'_PADDING' => 2,
					'link' => array(
						'type' => 'popup',
						'title' => 'LLL:EXT:cms/locallang_ttc.xml:header_link_formlabel',
						'icon' => 'link_popup.gif',
						'script' => 'browse_links.php?mode=wizard&act=page|url',
						'params' => array(
							'blindLinkOptions' => 'mail,file,spec,folder',
						),
						'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1',
					),
				)
			)
		),
		'email' => array (
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.email',
			'config' => array (
				'type' => 'input',
				'size' => '40',
				'eval' => 'trim',
				'max'  => '255'
			)
		),
		'company' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:address_collection/Resources/Private/Language/locallang.xlf:tx_addresscollection_domain_model_address.company',
			'config'  => array (
				'type' => 'input',
				'eval' => 'trim',
				'size' => '20',
				'max'  => '255'
			)
		),
		'city' => array (
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.city',
			'config' => array (
				'type' => 'input',
				'size' => '20',
				'eval' => 'trim',
				'max'  => '255'
			)
		),
		'zip' => array (
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.zip',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
				'size' => '10',
				'max'  => '20'
			)
		),
		'region' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:address_collection/Resources/Private/Language/locallang.xlf:tx_addresscollection_domain_model_address.region',
			'config'  => array (
				'type' => 'input',
				'size' => '20',
				'eval' => 'trim',
				'max'  => '255'
			)
		),
		'country' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.country',
			'config'  => array (
				'type' => 'input',
				'size' => '20',
				'eval' => 'trim',
				'max'  => '128'
			)
		),
		'image' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.image',
			'config'  => array (
				'type'          => 'group',
				'internal_type' => 'file',
				'allowed'       => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'max_size'      => '1000',
				'uploadfolder'  => 'uploads/pics',
				'show_thumbs'   => '1',
				'size'          => '3',
				'maxitems'      => TT_ADDRESS_MAX_IMAGES,
				'minitems'      => '0'
			)
		),
		'description' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.description',
			'config'  => array (
				'type' => 'text',
				'rows' => 5,
				'cols' => 48
			)
		),
		'addressgroup' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:address_collection/Resources/Private/Language/locallang.xlf:tx_addresscollection_domain_model_address.address_groups',
			'config'  => array(
				'type' => 'select',
				'foreign_table' => 'tt_address_group',
				'foreign_table_where' => ' AND tt_address_group.sys_language_uid IN (-1, 0) ORDER BY tt_address_group.title ASC',
				'MM' => 'tt_address_group_mm',
				// 'MM_opposite_field' => 'items',
				// 'MM_match_fields' => array(
				// 	'tablenames' => 'categories',
				// 	'fieldname' => 'pages',
				// ),
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
				// 'type'          => 'select',
				// 'form_type'     => 'user',
				// 'userFunc'      => 'tx_ttaddress_treeview->displayGroupTree',
				// 'treeView'      => 1,
				// 'foreign_table' => 'tt_address_group',
				// 'size'          => 5,
				// 'autoSizeMax'   => 25,
				// 'minitems'      => 0,
				// 'maxitems'      => 50,
				// 'MM'            => 'tt_address_group_mm',
			)
		),

		// {{{ Extended fields

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
				'size' => 10,
				'eval' => 'trim'
			),
		),
		'latitude' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tx_addresscollection_domain_model_address.latitude',
			'config' => array(
				'type' => 'input',
				'size' => 10,
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

		// }}}
	),
	// 'types' => array (
	// 	'1' => array('showitem' => 'hidden;;;;1-1-1, gender;;;;3-3-3, name;;2, birthday, address;;6, zip, city;;3, email;;5, phone;;4, image;;;;4-4-4, description, addressgroup;;;;1-1-1')
	// ),
	// 'palettes' => array (
	// 	'2' => array('showitem' => 'title, company'),
	// 	'3' => array('showitem' => 'country, region'),
	// 	'4' => array('showitem' => 'mobile, fax'),
	// 	'5' => array('showitem' => 'www'),
	// 	'6' => array('showitem' => 'building, room')
	// )
	'types' => array (
		'1' => array('showitem' => 'tx_extbase_type,
			--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.name;name, description,
			--div--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_tab.contact,
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
			--div--;LLL:EXT:lang/locallang_tca.xlf:sys_category.tabs.category,
				addressgroup, user
		'),
		'Tx_AddressCollection_CompanyAddress' => array('showitem' => 'tx_extbase_type,
			name, description,
			--div--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_tab.contact,
				--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.address;address,
				--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.building;building,
				--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.geo;geo,
				--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.contact;contact,
				--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.social;social,
			--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.images,
				images,
			--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
				hidden,
			--div--;LLL:EXT:lang/locallang_tca.xlf:sys_category.tabs.category,
				addressgroup, user
		'),
		'Tx_AddressCollection_PersonalAddress' => array('showitem' => 'tx_extbase_type,
			--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.name;name, nick_name, description,
			--div--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_tab.contact,
				--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.address;address,
				--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.building;building,
				--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.contact;contact,
				--palette--;LLL:EXT:address_collection/Resources/Private/Language/locallang_db.xlf:tt_address_palette.social;social,
			--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.images,
				images,
			--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
				hidden,
			--div--;LLL:EXT:lang/locallang_tca.xlf:sys_category.tabs.category,
				addressgroup, user
		'),
	),
	'palettes' => array (
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
			'showitem' => 'email, --linebreak--,
							phone, fax, --linebreak--,
							mobile, --linebreak--,
							www',
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
	),
);


$GLOBALS['TCA']['tt_address']['types']['Tx_AddressCollection_Address'] = $GLOBALS['TCA']['tt_address']['types']['1'];
$GLOBALS['TCA']['tt_address']['types']['Tx_AddressCollection_DeliveryAddress'] = $GLOBALS['TCA']['tt_address']['types']['Tx_AddressCollection_PersonalAddress'];
$GLOBALS['TCA']['tt_address']['types']['Tx_AddressCollection_BillingAddress'] = $GLOBALS['TCA']['tt_address']['types']['Tx_AddressCollection_PersonalAddress'];


if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('static_info_tables')){
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
		// 'foreign_table' => 'static_country_zones',
		// 'foreign_table_where' => 'ORDER BY static_country_zones.zn_name_local',
		// 'itemsProcFunc' => 'SJBR\\StaticInfoTables\\Hook\\Backend\\Form\\ElementRenderingHelper->translateCountryZonesSelector',
		'itemsProcFunc' => 'MONOGON\\AddressCollection\\Hooks\\ItemsProcFunc\\RegionHelper->countryZones',
		'size' => 1,
		'minitems' => 0,
		'maxitems' => 1,
		// 'wizards' => array(
		// 	'add' => array(
		// 		'type' => 'script',
		// 		'title' => 'LLL:EXT:static_info_tables/Resources/Private/Language/locallang_db:static_country_zones.title',
		// 		'icon' => 'add.gif',
		// 		'params' => array(
		// 			'table' => 'static_country_zones',
		// 			'pid' => '0',
		// 			'setValue' => 'prepend'
		// 		),
		// 		'module' => array(
		// 			'name' => 'wizard_add'
		// 		)
		// 	)
		// )
	);
}


	// start splitting name into first and last name
$extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['tt_address']);

	// original values
$showitemOrig            = $GLOBALS['TCA']['tt_address']['types'][1]['showitem'];
$showRecordFieldListOrig = $GLOBALS['TCA']['tt_address']['interface']['showRecordFieldList'];

	// shows both, the old and the new fields while converting to the new fields
$showItemReplace = ' name, first_name, middle_name, last_name;;2;;,';
$showRecordFieldListReplace = 'name,first_name,middle_name,last_name,';


if ($extConf['disableCombinedNameField']) {
		// shows only the new fields
	$showItemReplace            = ' first_name, middle_name;;;;, last_name;;2;;,';
	$showRecordFieldListReplace = 'first_name,middle_name,last_name,';

	$GLOBALS['TCA']['tt_address']['ctrl']['label']           = 'last_name';
	$GLOBALS['TCA']['tt_address']['ctrl']['label_alt']       = 'first_name';
	$GLOBALS['TCA']['tt_address']['ctrl']['label_alt_force'] = 1;
	$GLOBALS['TCA']['tt_address']['ctrl']['default_sortby']  = 'ORDER BY last_name, first_name, middle_name';
}

$showitemNew = str_replace(
	' name;;2,',
	$showItemReplace,
	$showitemOrig
);
$showRecordFieldListNew = str_replace(
	'name,',
	$showRecordFieldListReplace,
	$showRecordFieldListOrig
);

$GLOBALS['TCA']['tt_address']['types'][1]['showitem'] = $showitemNew;
$GLOBALS['TCA']['tt_address']['interface']['showRecordFieldList'] = $showRecordFieldListNew;

	// end splitting name

?>