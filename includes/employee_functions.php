<?php
function get_all_employees($dbc)
{
	$sql="select id from employee_table";
	$ret=array();
	if($res=mysqli_query($dbc,$sql))
	{
		while($row=mysqli_fetch_assoc($res))
		{
			$data=json_decode(get_employee($dbc,$row['id']));
			if(empty($data))
			{
				return false;
			}
			array_push($ret, $data);
		}
	}
	else
	{
		if (STAGING) {
			echo mysqli_error($dbc);
		}
		return false;
	}
	return json_encode($ret);
}



function receive_android_token($dbc,$token)
{
	$sql="update employee_table set android_id=".$token;
	
	if($res=mysqli_query($dbc,$sql))
	{
		return true;
	}
	else
	{
		if (STAGING) {
			echo mysqli_error($dbc);
		}
		return false;
	}
}






function create_employee($dbc,$name,$email,$id_type,$id_photo,$id_number, $type, $address, $phone,$mother_name,$father_name)
{
	$sql="INSERT INTO `employee_table`( `name`, `email`, `type`, `address`, `phone`,`id_type`,`id_photo`,`id_number`,`father_name`,`mother_name`)
	 VALUES ('".$name."', '".$email."',".$type.", '".$address."', '".$phone."', '".$id_type."', '".$id_photo."', '".$id_number."', '".$father_name."', '".$mother_name."')";
	$id=false;
	// echo $sql;
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

function update_employee($dbc,$employee_id,$name,$email,$address, $phone)
{
	$sql="UPDATE `employee_table` SET `name` = '".$name."', `email` = '".$email."', `address` = '".$address."',`phone` = '".$phone."' WHERE `employee_table`.`id` =".$employee_id;
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
	return $id;
}

function update_employee_pic($dbc,$employee_id,$temp_image_name)
{
	$new_name="face_".$temp_image_name;
	if(rename($temp_image_path."/".$temp_image_name, $dp_path."/".$new_name)){

		$sql="UPDATE `employee_table` SET `display_pic` = '".$new_name."' WHERE `employee_table`.`id` =".$employee_id;
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
	
	return $id;
}

function set_employee_stock($dbc,$employee_id,$product_id,$quantity)
{
	$sql="INSERT INTO `employee_stock_table`( `employee_id`, `product_id`, `quantity`)
	 VALUES ('".$employee_id."', '".$product_id."',".$quantity.") on duplicate key update quantity=".$quantity;
	$id=false;
	// echo $sql;
	if($res=mysqli_query($dbc,$sql))
	{
		return true;
	}
	else
	{
		if (STAGING) {
			echo mysqli_error($dbc);
		}
		return false;
	}
	return $id;
}

function get_employee($dbc,$employee_id){
		$temp=false;
		$id=$employee_id;

		$data= new stdClass;
		$sql="select * from employee_table where id=".$id;
		// echo $sql;
		// echo $sql;
		if($res=mysqli_query($dbc,$sql))
		{
			if($row=mysqli_fetch_assoc($res))
			{
				$data->name=$row['name'];
				$data->email=$row['email'];
				$data->type=$row['type'];
				$data->phone=$row['phone'];
				$data->address=$row['address'];
				$data->datetime=$row['datetime'];
				$data->id_type=$row['id_type'];
				$data->id_number=$row['id_number'];
				$data->id_photo=$row['id_photo'];
				$data->active=$row['active'];
				$data->mother_name=$row['mother_name'];
				$data->father_name=$row['father_name'];
			}
			else
			{
				
				return false;
			}				
		}
		else
		{
			// show_error("ge:2");
			//show_error(mysqli_error($dbc));

			if (STAGING) 
			{
				echo mysqli_error($dbc);
			}
			return false;
		}
		return json_encode($data);
}

function disable_employee($dbc,$employee_id)
{
	$sql="UPDATE `employee_table` SET `active` = 0 WHERE `employee_table`.`id` =".$employee_id;
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
	return $id;
}

function enable_employee($dbc,$employee_id)
{
	$sql="UPDATE `employee_table` SET `active` = 1 WHERE `employee_table`.`id` =".$employee_id;
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
	return $id;
}

function set_location_to_employee($dbc,$employee_id,$location_id)
{
	$sql="UPDATE `employee_table` SET `location_id` = '".$location_id."' WHERE `employee_table`.`id` =".$employee_id;
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
	return false;
}


function get_pincodes_array($dbc,$employee_id,$candidate_type)
{
	$sql="select distinct pincode from pincodes WHERE taluk in (select region_name from region_candidate_table where candidate_id=".$employee_id." and candidate_type=".$candidate_type.") ";
	$ret=array();
	if($res=mysqli_query($dbc,$sql))
	{
		while($row=mysqli_fetch_assoc($res))
		{
			
			array_push($ret, $row['pincode']);
		}
	}
	else
	{
		if (STAGING) {
			echo mysqli_error($dbc);
		}
		return false;
	}
	return json_encode($ret);
}


?>