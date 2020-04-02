<?php
include("header.php");
$permission=1;
include("self_check.php");

if( !empty($_POST['quantity']))
{
	$quantity=handle_escaping($dbc,$_POST["quantity"]);
}
else
{
	$result->message="new quantity not found";
	return_error($dbc,$result);
}


if( !empty($_POST['order_item_id']))
{
	$order_item_id=handle_escaping($dbc,$_POST["order_item_id"]);
}
else
{
	$result->message="order item id not found";
	return_error($dbc,$result);
}

if(!update_order_item_quantity($dbc,$order_item_id,$quantity))
{

	$result->message="updating order item quantity failed";
	return_error($dbc,$result);
	
}
return_successful($dbc,$result,"Done updating order quantity");
?>

