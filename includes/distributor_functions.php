<?php
function get_all_distributors($dbc)
{
	
	$sql="select id from distributor_table";
	$ret=array();
	if($res=mysqli_query($dbc,$sql))
	{
		while($row=mysqli_fetch_assoc($res))
		{
			$data=json_decode(get_distributor($dbc,$row['id']));
			if(empty($data))
			{
				return false;
			}
			array_push($ret, $data);
		}
	}
	else
	{
		return false;
	}
	return json_encode($ret);
}


function get_distributor_zorr($dbc,$shop){
	$obj=new stdClass;
	$obj->id=0;
	$obj->name="Zorr";
	$obj->region_name=json_decode(get_region_name($dbc,$shop->pincode));
	return json_encode($obj);	
}
//get_distributor_for_pincode_product
// distributor_stock_product_table
function get_distributors_for_product_pincode($dbc,$product_id,$region_name)
{
	$sql="select distributor_id as id from distributor_product_table where distributor_id in (select candidate_id from pincode_candidate_table where pincode_id in (select id from pincode_allocation_table where pincode=".$pincode.") and candidate_type=3) and product_id=".$product_id;
	// $sql="select * from distributor_table where pincode in (select pincode from pincode_allocation_table where id=(select pincode_id from pincode_candidate_table where candidate_type=3))";
	$id=false;
	$ret=array();
	
	if($res=mysqli_query($dbc,$sql))
	{
		while($row=mysqli_fetch_assoc($res))
		{
			array_push($ret,get_distributor($dbc,$row['id']));
		}
		return json_encode($ret);
	}
	else
	{
		// echo mysqli_error($dbc);
		return false;
	}
}




function create_distributor($dbc,$name, $email, $firm_name, $gst_number)
{
	$sql="INSERT INTO `distributor_table`( `name`, `email`, `firm_name`, `gst_number`) VALUES ('".$name."', '".$email."', '".$firm_name."', '".$gst_number."')";
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	else
	{
		echo mysqli_error($dbc);
	}
	return $id;


}

function disable_distributor($dbc,$dis_id)
{
	$sql="UPDATE `distributor_table` SET `active` = 0 WHERE `distributor_table`.`id` =".$dis_id;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		return true;
	}
	return $id;
}

function enable_distributor($dbc,$dis_id)
{
	$sql="UPDATE `employee_table` SET `active` = 1 WHERE `distributor_table`.`id` =".$dis_id;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		return true;
	}
	return $id;
}

function get_distributor($dbc,$distributor_id)
{
	$sql="select * from distributor_table where id=".$distributor_id;
	$id=false;
	
	$ret=array();

	if($res=mysqli_query($dbc,$sql))
	{
		if($row=mysqli_fetch_assoc($res)){
			$data=new stdClass();
			$id=$row['id'];
			$data->email=$row['email'];	
			$data->name=$row['name'];
			$data->is_active=$row['is_active'];
			$data->firm_name=$row['firm_name'];
			$data->gst_number=$row['gst_number'];
			if($row['pincode_id']!=0)
			{
				if(empty($data->pincodes=get_pincodes_array($dbc,$row['pincode_id'])))
				{
					$data->pincodes=array();
				}
			}
			
			
			
		}
		return json_encode($data);
		
		
	}
	return false;
}

?>