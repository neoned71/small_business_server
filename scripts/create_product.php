<?php
include("header.php");

//name variant photo unit_size

include("self_check.php");


if(!empty($_POST['product_pic_base64']))
{
	$product_pic_name="product_".$time_hash.".png";
	image_base64_save($_POST["product_pic_base64"],$product_pic_name,PRODUCT_IMAGE_PATH,"png");
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

if( !empty($_POST['price']))
{
	$price=handle_escaping($dbc,$_POST["price"]);
}
else
{
	$result->message="prize not found";
	return_error($dbc,$result);
}


$product_id=create_product($dbc,$name,$variant,$product_pic_name,$unit_size,$employee_id,$price);
if(empty($product_id))
{

	$result->message="creating product failed";
	return_error($dbc,$result);
	
}
return_successful($dbc,$result,"Done creating product");
?>

