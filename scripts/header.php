<?php
define("ROOT","..");
// include($root."/initialization.php");
include(ROOT."/initialization.php");


define("DP_PATH",ROOT."/images/pictures_display");
define("ID_IMAGE_PATH",ROOT."/images/pictures_id");
define("SHOP_IMAGE_PATH",ROOT."/images/shops");
define("TEMP_IMAGE_PATH",ROOT."/images/temp");
define("PRODUCT_IMAGE_PATH",ROOT."/images/products");

define("BLANK_SHOP_IMAGE_NAME","blank.png");
define("BLANK_PRODUCT_IMAGE_NAME","blank.png");
define("BLANK_EMPLOYEE_IMAGE_NAME","profile.png");

// $dp_path=$root."/images/pictures_display";
// $id_path=$root."/images/pictures_id";
// $shop_image_path=$root."/images/shops";
// $temp_image_path=$root."/images/temp";
// $product_image_path=$root."/images/products";

if(STAGING)
{
	error_reporting(E_ERROR | E_WARNING);
}


start_db_transaction($dbc);
$rand=rand();
$time_hash=hash('sha256',$rand."_".time());
$result=new stdClass;


//check if the person is capable to perform this task


?>