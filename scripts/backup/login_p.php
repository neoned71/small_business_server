<?php
include("../initialization.php");

$data=new stdClass;

$email=handle_escaping($dbc,$_POST["email"]);
$pass=handle_escaping($dbc,$_POST["password"]);
$pass_hash=md5($pass);

$login=get_login($dbc,$email,$pass);

if(!empty($login))
{
	$data->login=json_decode($login);
	$data->status="success";
}
else
{
	$data->status="failed";
	$data->message="please enter a correct username or password";
}

echo json_encode($data);
?>