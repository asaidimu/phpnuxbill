<?php

define('APP_URL', 'http://localhost:5500/');
$_app_stage = 'Live';
// Database PHPNuxBill
$db_host      = 'localhost';
$db_user        = 'nuxbill';
$db_password  = 'pmapass';
$db_name      = 'pma';

// Database Radius
$radius_host      = 'localhost';
$radius_user        = 'pma';
$radius_pass      = 'pmapass';
$radius_name      = 'nuxbill';

if ($_app_stage != 'Live') {
  error_reporting(E_ERROR);
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
} else {
  error_reporting(E_ERROR);
  ini_set('display_errors', 0);
  ini_set('display_startup_errors', 0);
}

