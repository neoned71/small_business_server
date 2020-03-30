<?php
include("header.php");
$permission=1;
include("self_check.php");

if( !empty($_POST['distributor_id']))
{
	$distributor_id=handle_escaping($dbc,$_POST["distributor_id"]);
}
else
{
	$result->message="distributor id not found";
	return_error($dbc,$result);
}

if(!empty($_POST['name']))
{
	$name=handle_escaping($dbc,$_POST["name"]);
}
else
{
	$result->message="name not found";
	return_error($dbc,$result);
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



if(!update_distributor($dbc,$distributor_id,$name,$firm_name))
{

	$result->message="updating distributor failed";
	
	return_error($dbc,$result);
	
}
return_successful($dbc,$result,"Done updating distributor");
?>

