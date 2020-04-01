<?php
//error_reporting(E_ERROR | ~E_WARNING);
// include($root."/initialization.php");

include("header.php");
$permission=1;
// for being logged in
include("self_check.php");


$ret=array();

//code of this file starts
if(!empty($_POST['distributor_id']))
{
	$distributor_id=handle_escaping($dbc,$_POST['distributor_id']);
	$s=json_decode(get_distributor($dbc,$distributor_id,$candidate_id,$candidate_type));

	if(empty($s))
	{
		$result->message="distributor not found";
		return_error($dbc,$result);
	}
	else
	{
		
		array_push($ret, $s);
	}
}
else
{
	$ret=json_decode(get_distributors($dbc,$candidate_id,$candidate_type));
	if(empty($ret))
	{
		$result->message="All distributors query failed!";
		return_error($dbc,$result);
	}
	
}
// if(empty(create_login_item($dbc,$employee_id))){
// 	$result->message="creating employee login failed";
// 	return_error($dbc,$result);
// }


//code of this file ends

$result->distributors=$ret;
return_successful($dbc,$result,"executed successfully");


?>