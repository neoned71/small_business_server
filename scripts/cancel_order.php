<?php
include("header.php");
$permission=1;
include("self_check.php");

$cancelled_by=$employee_id;


if( !empty($_POST['order_id']))
{
	$order_id=handle_escaping($dbc,$_POST["order_id"]);
}
else
{
	$result->message="order id not found";
	return_error($dbc,$result);
}

if(!cancel_order($dbc,$order_id,$cancelled_by))
{

	$result->message="cancelling order failed";
	return_error($dbc,$result);
	
}
return_successful($dbc,$result,"Done cancelling order");
?>

