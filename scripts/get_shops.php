<?php
//error_reporting(E_ERROR | ~E_WARNING);
// include($root."/initialization.php");

include("header.php");
$permission=1;
// for being logged in
include("self_check.php");


$ret=array();

//code of this file starts
if(!empty($_POST['shop_id']))
{
	$shop_id=handle_escaping($dbc,$_POST['shop_id']);
	$s=json_decode(get_shop($dbc,$shop_id));

	if(empty($s))
	{
		$result->message="shop not found";
		return_error($dbc,$result);
	}
	else
	{
		
		array_push($ret, $s);
	}
}
else
{
	$ret=json_decode(get_shops($dbc));
	if(empty($ret))
	{
		$result->message="All shops query failed!";
		return_error($dbc,$result);
	}
	
}
// if(empty(create_login_item($dbc,$employee_id))){
// 	$result->message="creating employee login failed";
// 	return_error($dbc,$result);
// }


//code of this file ends

$result->shops=$ret;
return_successful($dbc,$result,"executed successfully");


?>