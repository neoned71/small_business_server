<?php
if(!defined("LIVE")) DEFINE("LIVE",false);
DEFINE("CONTACT_EMAIL","neoned71@gmail.com");
define ('BASE_URI','includes/');
define ('BASE_URL', 'localhost');
define ('MYSQL', BASE_URI . 'mysql.php');
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
date_default_timezone_set('Asia/Kolkata');
?>
