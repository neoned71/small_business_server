<?php
include("header.php");
$permission=1;
include("self_check.php");

if( !empty($_POST['shop_id']))
{
	$shop_id=handle_escaping($dbc,$_POST["shop_id"]);
}
else
{
	$result->message="shop id not found";
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

if( !empty($_POST['phone']))
{
	$phone=handle_escaping($dbc,$_POST["phone"]);
}
else
{
	$result->message="phone not found";
	return_error($dbc,$result);
}

if(!empty($_POST['email']))
{
	$email=handle_escaping($dbc,$_POST["email"]);
}
else
{
	$result->message="email not found";
	return_error($dbc,$result);
}

if( !empty($_POST['address']))
{
	$address=handle_escaping($dbc,$_POST["address"]);
}
else
{
	$result->message="address not found";
	return_error($dbc,$result);
}

if( !empty($_POST['name_of_contact']))
{
	$name_of_contact=handle_escaping($dbc,$_POST["name_of_contact"]);
}
else
{
	$result->message="name of the contact not found";
	return_error($dbc,$result);
}



if( !empty($_POST['gst_number']))
{
	$gst_number=handle_escaping($dbc,$_POST["gst_number"]);
}
else
{
	$result->message="gst number not found";
	return_error($dbc,$result);
}

if(!update_shop($dbc,$shop_id,$name,$address,$phone,$email,$name_of_contact,$gst_number))
{

	$result->message="updating shop failed";
	return_error($dbc,$result);
	
}
return_successful($dbc,$result,"Done updating shop");
?>

