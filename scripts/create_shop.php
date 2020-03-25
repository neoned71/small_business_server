<?php
include("header.php");
if(!check_credentials($_POST['self']))
{
	$result->message="name not found";
	return_error($dbc,$result);
}
else
{
	$employee_id=handle_escaping($dbc, $_POST['self']);
	$employee=json_decode(get_employee($dbc,$employee_id));
}


if(!empty($_POST['shop_pic_base64']))
{
	$shop_pic_name="shop_".$time_hash.".png";
	image_base64_save($_POST["shop_pic_base64"],$shop_pic_name,$shop_image_path,"png");
}
else
{
	$shop_pic_name="blank.png";
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

if(!empty($_POST['name_of_contact']))
{
	$name_of_contact=handle_escaping($dbc,$_POST["name_of_contact"]);
}
else
{
	$result->message="name of contact of the shop not found";
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

if( !empty($_POST['pincode']))
{
	$pincode=handle_escaping($dbc,$_POST["pincode"]);
}
else
{
	$result->message="pincode not found";
	return_error($dbc,$result);
}

if(!empty($_POST['gst_number']))
{
	$id_tygst_numberpe=handle_escaping($dbc,$_POST["gst_number"]);
}
else
{
	$gst_number="N.A.";
}




$shop_id=create_shop($dbc,$name,$shop_pic_name,$address,$phone,$email,$name_of_contact,$pincode,$employee_id,$gst_number);
if(empty($shop_id))
{

	$result->message="creating shop failed";
	return_error($dbc,$result);
	
}

return_successful($dbc,$result,"Done creating Shop");

?>

