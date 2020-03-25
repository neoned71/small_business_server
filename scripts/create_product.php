<?php
include("header.php");

//name variant photo unit_size

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


if(!empty($_POST['product_pic_base64']))
{
	$product_pic_name="product_".$time_hash.".png";
	image_base64_save($_POST["product_pic_base64"],$product_pic_name,$product_image_path,"png");
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

if(!empty($_POST['variant']))
{
	$variant=handle_escaping($dbc,$_POST["variant"]);
}
else
{
	$result->message="product variant not found";
	return_error($dbc,$result);
}

if( !empty($_POST['unit_size']))
{
	$unit_size=handle_escaping($dbc,$_POST["unit_size"]);
}
else
{
	$result->message="unit size not found";
	return_error($dbc,$result);
}


$product_id=create_product($dbc,$name,$variant,$product_pic_name,$unit_size,$employee_id);
if(empty($product_id))
{

	$result->message="creating product failed";
	return_error($dbc,$result);
	
}
return_successful($dbc,$result,"Done creating product");
?>

