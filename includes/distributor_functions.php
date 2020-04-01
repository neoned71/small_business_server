<?php
function get_distributors($dbc)
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
function get_distributors_for_shop_product($dbc,$product_id,$shop_id)
{
	$sql="SELECT distributor_id as id FROM `distributor_product_table` ds
			inner join region_candidate_table rct on ds.distributor_id=rct.candidate_id and ds.product_id=".$product_id." and rct.candidate_type=".DISTRIBUTOR_USER_TYPE."
			inner join shop_table st on st.id=".$shop_id." and rct.region_name in (select taluk from pincodes where pincode=st.pincode)
			inner join distributor_table dt on ds.distributor_id=dt.id and dt.active=1;";
	// $sql="select distributor_id as id from distributor_product_table where distributor_id in (select candidate_id from pincode_candidate_table where pincode_id in (select id from pincode_allocation_table where pincode=".$pincode.") and candidate_type=3) and product_id=".$product_id;
	// $sql="select * from distributor_table where pincode in (select pincode from pincode_allocation_table where id=(select pincode_id from pincode_candidate_table where candidate_type=3))";
	$id=false;
	$ret=array();
	// echo $sql;
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

function check_distributor_for_shop_product($dbc,$distributor_id,$product_id,$shop_id)
{
	
	$sql="SELECT count(*) as count FROM `distributor_product_table` ds
			inner join region_candidate_table rct on ds.distributor_id=rct.candidate_id and ds.distributor_id=".$distributor_id." and ds.product_id=".$product_id." and rct.candidate_type=".DISTRIBUTOR_USER_TYPE."
			inner join shop_table st on st.id=".$shop_id." and rct.region_name in (select taluk from pincodes where pincode=st.pincode)
			inner join distributor_table dt on ds.distributor_id=dt.id and dt.active=1;";
	// $sql="select distributor_id as id from distributor_product_table where distributor_id in (select candidate_id from pincode_candidate_table where pincode_id in (select id from pincode_allocation_table where pincode=".$pincode.") and candidate_type=3) and product_id=".$product_id;
	// $sql="select * from distributor_table where pincode in (select pincode from pincode_allocation_table where id=(select pincode_id from pincode_candidate_table where candidate_type=3))";
	$id=false;
	// echo $sql;
	if($res=mysqli_query($dbc,$sql))
	{
		if($row=mysqli_fetch_assoc($res))
		{
			$count=$row['count'];
			if($count!=0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		return false;
	}
	else
	{
		// echo mysqli_error($dbc);
		return false;
	}
}

function make_notifications($dbc,$notifications)
{
	//complete this function!!
	return true;
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

function update_distributor($dbc,$dis_id,$name, $firm_name)
{
	$sql="UPDATE `distributor_table` SET `name` = '".$name."', `firm_name` = '".$firm_name."' WHERE `distributor_table`.`id` =".$dis_id;
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
			$data->id=$row['id'];
			$data->email=$row['email'];	
			$data->name=$row['name'];
			$data->active=$row['active'];
			$data->firm_name=$row['firm_name'];
			$data->gst_number=$row['gst_number'];
			// if($row['pincode_id']!=0)
			// {
			// 	if(empty($data->pincodes=get_pincodes_array($dbc,$row['pincode_id'])))
			// 	{
			// 		$data->pincodes=array();
			// 	}
			// }
			
			
			
		}
		return json_encode($data);
		
		
	}
	return false;
}

?>