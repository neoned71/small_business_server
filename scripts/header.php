<?php
$root="..";
// include($root."/initialization.php");
include($root."/initialization.php");

$dp_path=$root."/images/pictures_display";
$id_path=$root."/images/pictures_id";
$shop_image_path=$root."/images/shops";
$product_image_path=$root."/images/products";

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