<?php
//error_reporting(E_ERROR | ~E_WARNING);
$root="..";
// include($root."/initialization.php");
include($root."/initialization.php");
$permission=1;
// for being logged in
include("self_check.php");


$dp_path=$root."/images/pictures_display";
$id_path=$root."/images/pictures_id";

if(STAGING)
{
	error_reporting(E_ERROR | E_WARNING);
}

$rand=rand();
$time_hash=hash('sha256',$rand."_".time());

start_db_transaction($dbc);


//code of this file starts

// if(empty(create_login_item($dbc,$employee_id))){
// 	$result->message="creating employee login failed";
// 	return_error($dbc,$result);
// }


//code of this file ends

	return_successful($dbc,$result,"template executed successfully");


?>