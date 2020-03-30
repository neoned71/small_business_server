<?php
include("header.php");
//check if the person is capable to perform this task

include("self_check.php");


if(!empty($_POST['order_json']))
{

	$order_obj=json_decode($_POST["order_json"]);
	if(!empty($order_obj))
	{
		$orders = $order_obj->orders_array;
		$shop_id= $order_obj->shop_id;
		$shop=json_decode(get_shop($dbc,$shop_id));
		if(empty($shop))
		{
			$result->message="Unkown Shop";
			return_error($dbc,$result);
		}
		$taxed=$order_obj->taxed;
		$discount=0;
	}
	else
	{
		$result->message="bad json object";
		return_error($dbc,$result);
	}
	

}
else
{
	$result->message="order json not found";
	return_error($dbc,$result);
}

$employee_pincodes=json_decode(get_pincodes_array($dbc,$employee_id,$employee_type));
// var_dump($employee_pincodes);
// var_dump($shop->pincode);
if(!in_array($shop->pincode,$employee_pincodes))
{
	$result->message="Shop is not under your Applicable region.";
	return_error($dbc,$result);
}

$order_id=create_order($dbc,$shop_id,$taxed,$employee_id);
if(empty($order_id))
{
	$result->message="creating order failed";
	return_error($dbc,$result);	
}

// $failed=false;
$notifications=array();
foreach($orders as $a)
{
	// echo "loop";
	if($a->serviced_by!=0)
	{
		if(!check_distributor_for_shop_product($dbc,$a->serviced_by,$shop->pincode,$a->product_id))
		{
			$result->message="Distributor not authorized for this.";
			return_error($dbc,$result);
		}
	}

	$temp_order_id=create_order_item($dbc,$order_id,$a->product_id,$a->quantity,$discount,$a->serviced_by,$taxed);

	if(empty($temp_order_id))
	{
		$result->message="Creating order item failed.";
		return_error($dbc,$result);
	}
	$temp_notification=new stdClass;
	$temp_notification->distributor_id=$a->serviced_by;
	$temp_notification->shop_id=$a->shop_id;
	$temp_notification->product_id=$a->product_id;
	$temp_notification->quantity=$a->quantity;
	array_push($notifications, $temp_notification);
}

make_notifications($dbc,$notifications);
$result->order_id=$order_id;
return_successful($dbc,$result,"Created order successfully.");
?>

