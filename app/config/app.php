<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

$config['project-id'] 				= 0;
$config['db-global'] 					= 'thekoolh_gd.';
$config['hide-nz-layout'] 		= true;

$config['client'] 						= "Kool";
$config['client-mail'] 				= 'hola@kool.com';


// inglés (usa), portugués, polaco y Croata
$config['custom_lang'] = [
	'es' => 'Español',
	'en' => 'Inglés',
	// 'en-us' => 'Inglés USA',
	// 'en-ca' => 'Inglés CA',
	// 'pt' => 'Portugués',
	// 'pl' => 'Polaco',
	// 'cr' => 'Croata',
	// 'fr' => 'Francés',
	// 'sk' => 'Eslovaco',
	// 'el' => 'Griego',
	// 'de' => 'Alemán',
	// 'nl' => 'Holandés',
	// 'it' => 'Italiano',
	// 'ar-ly' => 'Árabe Líbano',
	// 'cs' => 'Checo',
	// 'fa' => 'Irán',
	// 'zh' => 'China',
];

$config['lang'] 							= 'es';

$config['uploads'] 						= 'files/';
$config['uploads-global'] 		= 'files-nz/';

$config['layout-version'] 		= '?v1.0';
$config['fb-app-id'] 					= '';

$config['analytics-id'] 		  = '';
$config['mailjet-api-key'] 		= 'ec4f81b2894ce3aeb5f987effcf10fd5';
$config['mailjet-api-secret'] = '80fc6f04059c6c5231924f124c351041';

if (defined('APP_MODE') && APP_MODE == 'online')
{
	$config['mailjet-api-key'] 		= 'ec4f81b2894ce3aeb5f987effcf10fd5';
	$config['mailjet-api-secret'] = '80fc6f04059c6c5231924f124c351041';
	$config['project-id']				= 0;
	$config['db-global'] 				= 'thekoolh_gd.';
	$config['layout-version'] 	= '?v1.0';
	$config['upload-version'] 	= '?v1';
}

$config['uploads'] 					  = FCPATH.$config['uploads'];
$config['uploads-global'] 	  = FCPATH.$config['uploads-global'];
