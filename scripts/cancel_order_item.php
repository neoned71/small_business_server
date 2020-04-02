<?php
include("header.php");
$permission=1;
include("self_check.php");

$cancelled_by=$employee_id;


if( !empty($_POST['order_item_id']))
{
	$order_item_id=handle_escaping($dbc,$_POST["order_item_id"]);
}
else
{
	$result->message="order item id not found";
	return_error($dbc,$result);
}

if(!cancel_order_item($dbc,$order_item_id,$cancelled_by))
{

	$result->message="cancelling order failed";
	return_error($dbc,$result);
	
}
return_successful($dbc,$result,"Done cancelling order");
?>

