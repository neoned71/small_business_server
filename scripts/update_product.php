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

if( !empty($_POST['product_id']))
{
	$product_id=handle_escaping($dbc,$_POST["product_id"]);
}
else
{
	$result->message="product id not found";
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




if(!update_product($dbc,$product_id,$name,$variant,$unit_size,$price))
{

	$result->message="updating product failed";
	
	return_error($dbc,$result);
	
}
return_successful($dbc,$result,"Done updating product");
?>

