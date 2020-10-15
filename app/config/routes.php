<?php defined('BASEPATH') OR exit('No direct script access allowed');

require NZAPATH.'config/routes.php';

$route['contact'] = "app/contact";
$route['custom_newsletter'] = "app/custom_newsletter";
$route['ajax_subscribe'] = "app/ajax_subscribe";
// $route['(.*)'] = 'app/index/$1';
$route['instagramApi/(.*)'] = 'app/instagramApi/$1';
$route['liveadmin/(.*)'] = 'app/liveadmin/$1';
// $route['es(.*)'] = 'app/lang/$1';
// $route['en(.*)'] = 'app/lang/$1';
$route['nocookie(.*)'] = 'app/nocookie';
$route['logout(.*)'] = 'app/logout';
$route['info/(.*)'] = 'app/info/$1';

$route['changelang/(.*)'] = 'app/changelang/$1';

$route['(.*)'] = 'app/index/$1';