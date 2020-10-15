<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['translate_uri_dashes']  = FALSE;

$route['default_controller'] = "app";

if (APP_MODULE == 'admin')
{
  $route['404_override'] = 'app/error';
  $route['script/app.js'] = "app/appscript";
}

if (APP_MODULE == 'front')
{

  $route['404_override']          = 'files/error_404';

  $route['pager'] = 'app/pager';

  $route['^d?fs?/([A-Za-z0-9_-]*)/(.*)/([A-Za-z0-9-_]*\.(pdf|svg|png|gif|jpe?g))$'] = 'files/file/$1/$2/$3';
  $route['^d?fx/([A-Za-z0-9_-]*)/(.*)/([A-Za-z0-9-_]*\.(pdf|svg|png|gif|jpe?g))$'] = 'files/coords/$1/$2/$3';

  $route['^d?fd/(.*)/([A-Za-z0-9-_]*/.(.*){3,4})$'] = 'files/download_file/$1/$2/$3';
  $route['^d?fv/(.*)/([A-Za-z0-9-_]*/.(.*){3,4})$'] = 'files/view_file/$1/$2/$3';

  $route['^f(s|x|d|v)?/.*'] = 'files/error_406';

}
