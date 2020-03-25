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
		return false;
	}
}






function create_employee($dbc,$name,$email,$id_type,$id_photo,$id_number, $post, $address, $phone,$mother_name,$father_name)
{
	$sql="INSERT INTO `employee_table`( `name`, `email`, `post`, `address`, `phone`,`id_type`,`id_photo`,`id_number`,`father_name`,`mother_name`)
	 VALUES ('".$name."', '".$email."',".$post.", '".$address."', '".$phone."', '".$id_type."', '".$id_photo."', '".$id_number."', '".$father_name."', '".$mother_name."')";
	$id=false;
	// echo $sql;
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
				$data->post=$row['post'];
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
				show_error("ge:1");
				return false;
			}				
		}
		else
		{
			// show_error("ge:2");
			show_error(mysqli_error($dbc));
			return false;
		}
		return json_encode($data);
}

// function edit_employee($dbc,$name,$address,$gst_number_of_shop,$phone,$email,$name_of_contact,$pincode,$employee_adding_the_shop_id,$location_id=0,$gst_number="-")
// {
// 	$sql="UPDATE `employee_table` SET `name` = '".$name."', `address` = '".$address."', `gst_number` = '".$gst_number."', `phone` = '".$phone."', `email` = '".$email."', `name_of_contact` = '".$name_of_contact."', `location_id` = '".$location_id."', `pincode` = '".$pincode."' WHERE `shop_table`.`id` =".$shop_id;
// 	$id=false;
// 	if($res=mysqli_query($dbc,$sql))
// 	{
// 		$id=mysqli_insert_id($dbc);
// 	}
// 	return $id;
// }
function disable_employee($dbc,$employee_id)
{
	$sql="UPDATE `employee_table` SET `active` = 0 WHERE `employee_table`.`id` =".$employee_id;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		return true;
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
	return false;
}


?>