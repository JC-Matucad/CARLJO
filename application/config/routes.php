<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Control_login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['Control_functions/Delete_User/(:num)'] = 'Control_functions/Delete_User/$1';

