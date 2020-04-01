<?php
//error_reporting(E_ERROR | ~E_WARNING);
// include($root."/initialization.php");

include("header.php");
include($root."/initialization.php");
$permission=1;
// for being logged in



//code of this file starts

// if(empty(create_login_item($dbc,$employee_id))){
// 	$result->message="creating employee login failed";
// 	return_error($dbc,$result);
// }


//code of this file ends

	return_successful($dbc,$result,"template executed successfully");


?>