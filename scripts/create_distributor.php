<?php
include("header.php");
$permission=1;
include("self_check.php");


if(!empty($_POST['name']))
{
	$name=handle_escaping($dbc,$_POST["name"]);
}
else
{
	$result->message="name not found";
	return_error($dbc,$result);
}

if(!empty($_POST['email']))
{
	$email=handle_escaping($dbc,$_POST["email"]);
}
else
{
	$email="N.A.";
}

if( !empty($_POST['firm_name']))
{
	$firm_name=handle_escaping($dbc,$_POST["firm_name"]);
}
else
{
	$result->message="firm name not found";
	return_error($dbc,$result);
}

if( !empty($_POST['gst_number']))
{
	$gst_number=handle_escaping($dbc,$_POST["gst_number"]);
}
else
{
	$result->message="gst(mandatory) not found";
	return_error($dbc,$result);
}

$distributor_id=create_distributor($dbc,$name,$email,$firm_name,$gst_number);
if(empty($distributor_id))
{

	$result->message="Creating distributor failed";
	
	return_error($dbc,$result);
	
}
$result->distributor_id=$distributor_id;
return_successful($dbc,$result,"Done creating distributor");
?>

