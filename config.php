<?php
if ($_SERVER['SERVER_NAME'] == 'kool.test' || $_SERVER['SERVER_NAME'] == 'localhost')
{
	$base_sys = 'http://kool.test/';
	define('APP_MODE', 'dev');

	$_SERVER['CI2_PATH'] = 'C:/xampp/htdocs/thekoolhub/_ci/';
	$_SERVER['CI3_PATH'] = 'C:/xampp/htdocs/thekoolhub/_ci3/';
	$_SERVER['NZA_PATH'] = 'C:/xampp/htdocs/thekoolhub/.nz/';
}
else if ($_SERVER['SERVER_NAME'] == 'thekoolhub.com' )
{
	$base_sys = 'https://thekoolhub.com/';

	$_SERVER['CI2_PATH'] = '/home/thekoolhub/public_html/_ci/';
	$_SERVER['CI3_PATH'] = '/home/thekoolhub/public_html/_ci3/';
	$_SERVER['NZA_PATH'] = '/home/thekoolhub/public_html/.nz/';

	define('APP_MODE', 'online');
}
else
{
	$base_sys = 'https://thekoolhub.com/';

	$_SERVER['CI2_PATH'] = '/home/thekoolhub/public_html/_ci/';
	$_SERVER['CI3_PATH'] = '/home/thekoolhub/public_html/_ci3/';
	$_SERVER['NZA_PATH'] = '/home/thekoolhub/public_html/.nz/';

	define('APP_MODE', 'online');
}

$assign_to_config['language'] = 'spanish';

include_once '.config.php';

if (APP_MODE == 'dev')
{
	define('ENVIRONMENT', 'development');
	$config['log_threshold'] = 3;
}
if (APP_MODE == 'online')
{
	define('ENVIRONMENT', 'development');
	$assign_to_config['log_threshold']	= 2;
	#define('ENVIRONMENT', 'production');
}
