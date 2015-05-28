<?php

$extPath = dirname(__FILE__) . '/';
$vendorsPath = $extPath . 'Resources/Private/Vendors/';

return array(
	'JeroenDesloovere\\VCard\\VCard' => $vendorsPath . 'VCard/VCard.php',
	'JeroenDesloovere\\VCard\\Exception' => $vendorsPath . 'VCard/Exception.php',
	'JeroenDesloovere\\VCard\\VCardMediaException' => $vendorsPath . 'VCard/VCardMediaException.php',
	'Behat\\Transliterator\\Transliterator' => $vendorsPath . 'Transliterator/Transliterator.php',
);