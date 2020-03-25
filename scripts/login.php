<?php
//error_reporting(E_ERROR | ~E_WARNING);
$root="..";
// include($root."/initialization.php");
include($root."/initialization.php");

start_db_transaction($dbc);

$failed=true;
$data=new stdClass;


//code of this file starts
$username=handle_escaping($dbc,$_POST["username"]);
$pass=handle_escaping($dbc,$_POST["password"]);

$login=login($dbc,$username,$pass);
//echo json_encode($pass);
if(!empty($login) )
{
	if(empty($login->employee))
	{
		$data->message="no employee linked to this id found";
		return_error($dbc,$data);
	}
	else if($login->employee->active==1)
	{
		$data->login=json_decode($login);
		return_successful($dbc,$data,"successfully logged in");
		
	}
	else if($login->employee->active==0)
	{
		
		$data->message="You are marked as NOT ACTIVE by admin";
		return_error($dbc,$data);
	}
	
}
else
{
	$data->status="failed";
	$data->message="please enter a correct username and password";
	return_error($dbc,$data);
}
//code of this file ends


?>