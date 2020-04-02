<?php
function get_order($dbc,$order_id)
{
	$sql="select * from order_table where id=".$order_id;
	$id=false;
	$ret=array();
	if($res=mysqli_query($dbc,$sql))
	{
		if($row=mysqli_fetch_assoc($res))
		{
			$data=new stdClass();
			$id=$row['id'];
			$data->shop=json_decode(get_shop($dbc,$row['shop_id']));		
			$data->billed=$row['taxed'];
			$data->amount=$row['amount'];
			$data->status=$row['status'];
			$data->time=$row['time'];
			$data->tax_amount=$row['tax_amount'];
			$data->total_amount=$data->amount + $data->tax_amount;
			$data->orders=json_decode(get_order_items($dbc,$order_id,$data->shop));
		}
		return json_encode($data);	
	}
	return false;
}

function get_order_items($dbc,$order_id,$shop)
{
	$sql="select * from order_item_table where order_id=".$order_id;
	$id=false;
	
	$ret=array();

	if($res=mysqli_query($dbc,$sql))
	{
		while($row=mysqli_fetch_assoc($res))
		{
			$data=new stdClass();
			$id=$row['id'];
			array_push($ret, json_decode(get_order_item($dbc,$id,$shop)));	
		
		}
		return json_encode($ret);
		
		
	}
	else{
		if (STAGING) {
			echo mysqli_error($dbc);
		}
	}
	return false;
}

function get_order_item($dbc,$order_item_id,$shop)
{
	$sql="select * from order_item_table where id=".$order_id;
	$id=false;
	$data=false;
	

	if($res=mysqli_query($dbc,$sql))
	{
		
		
		if($row=mysqli_fetch_assoc($res))
		{
			$data=new stdClass();
			
			$id=$row['id'];
			$data->product=json_decode(get_product($dbc,$row['product_id']));	
			
			$data->quantity=$row['quantity'];
			$data->billed=$row['taxed'];
			$data->amount=$row['amount'];
			$data->status=$row['status'];
			$data->time=$row['time'];
			$data->tax_amount=$row['tax_amount'];
			$data->total_amount=$data->amount + $data->tax_amount;
			$temp=$row['serviced_by'];
			if($temp!=0)
			{
				$data->serviced_by=json_decode(get_distributor($dbc,$temp));
			}
			else{
				$data->serviced_by=json_decode(get_distributor_zorr($dbc,$shop));
			}
			
			$data->is_cancelled=$row['is_cancelled'];
			$data->cancelled_by=$row['cancelled_by'];
			$data->cancellation_time=$row['cancelled_time'];
			
			
			
		
		}
		return json_encode($data);
		
		
	}
	return false;
}


function create_order($dbc,$shop_id,$taxed,$employee_id)
{

	$sql="INSERT INTO `order_table`(`shop_id`, `taxed`, `employee_id`) VALUES (".$shop_id.",".$taxed.",".$employee_id.")";
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	else
	{
		if (STAGING) {
			echo mysqli_error($dbc);
		}
	}
	return $id;
}


function create_order_item($dbc,$order_id,$product_id,$quantity,$discount,$serviced_by,$taxed)
{
	$product=json_decode(get_product($dbc,$product_id));
	if(empty($product) or $product->active==0)
	{
		if (STAGING) {
			echo "empty product";
		}
		return false;
	}
	$amount=$product->price;
	$tax=0;
	if($taxed==1)
	{
		$tax=$amount*TAX_PERCENTAGE*0.01;
		// echo $tax;
	}
// order_id product_id quantity discount(percentage:0) serviced_by(us(id:0) or a distributor(id:n)) tax(default:0) 
	$sql="INSERT INTO `order_item_table`(`amount`,`order_id`, `product_id`, `quantity`,`discount`, `serviced_by`, `tax`) VALUES (".$amount.",".$order_id.",".$product_id.",".$quantity.",".$discount.",".$serviced_by.",".$tax.")";
	// echo $sql;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	else
	{
		if (STAGING) {
			echo mysqli_error($dbc);
		}
	}
	return $id;
}

//finish this one later
function update_order_item_quantity($dbc,$order_item_id,$quantity)
{

	$sql="update `order_item_table` set `quantity`=".$quantity." where id=".$order_item_id;
	// echo $sql;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{

		return true;
	}
	else
	{
		if (STAGING) {
			echo mysqli_error($dbc);
		}
	}
	// return $id;

}



function cancel_order_item($dbc,$order_item_id,$employee_id)
{
	$sql="update `order_item_table` set `is_cancelled`=1, cancelled_by=".$employee_id.", cancelled_time=now() where id=".$order_item_id;
	// echo $sql;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{

		return true;
	}
	else
	{
		if (STAGING) {
			echo mysqli_error($dbc);
		}
	}
}



function cancel_order($dbc,$order_id,$employee_id)
{
	$sql="update `order_item_table` set `is_cancelled`=1, cancelled_by=".$employee_id.", cancelled_time=now() where order_id=".$order_id." and is_cancelled=0";
	// echo $sql;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{

		return true;
	}
	else
	{
		if (STAGING) {
			echo mysqli_error($dbc);
		}
	}
}



//send_sms_to_distributor
//get_orders_untaxed
function get_orders_unbilled($dbc)
{
	$sql="select * from order_table where taxed=0 order by time desc";
	// $sql="select * from distributor_table where pincode in (select pincode from pincode_allocation_table where id=(select pincode_id from pincode_candidate_table where candidate_type=3))";
	$id=false;
	$ret=array();
	
	if($res=mysqli_query($dbc,$sql))
	{
		while($row=mysqli_fetch_assoc($res))
		{
			array_push($ret,get_order($dbc,$row['id']));
		}
		return json_encode($ret);
	}
	else
	{
		if (STAGING) {
			echo mysqli_error($dbc);
		}
		return false;
	}
}



//get_orders_taxed
function get_orders_billed($dbc)
{
	$sql="select * from order_table where taxed=1 order by time desc ";
	// $sql="select * from distributor_table where pincode in (select pincode from pincode_allocation_table where id=(select pincode_id from pincode_candidate_table where candidate_type=3))";
	$id=false;
	$ret=array();
	
	if($res=mysqli_query($dbc,$sql))
	{
		while($row=mysqli_fetch_assoc($res))
		{
			array_push($ret,get_order($dbc,$row['id']));
		}
		return json_encode($ret);
	}
	else
	{
		if (STAGING) {
			echo mysqli_error($dbc);
		}
		return false;
	}
}


function get_orders_shop($dbc,$shop_id)
{
	$sql="select * from order_table where shop_id=".$shop_id." order by time desc";
	// $sql="select * from distributor_table where pincode in (select pincode from pincode_allocation_table where id=(select pincode_id from pincode_candidate_table where candidate_type=3))";
	$id=false;
	$ret=array();
	
	if($res=mysqli_query($dbc,$sql))
	{
		while($row=mysqli_fetch_assoc($res))
		{
			array_push($ret,get_order($dbc,$row['id']));
		}
		return json_encode($ret);
	}
	else
	{
		if (STAGING) {
			echo mysqli_error($dbc);
		}
		return false;
	}
}

?>