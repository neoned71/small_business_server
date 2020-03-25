<?php
function create_shop($dbc,$name,$shop_pic,$address,$phone,$email,$name_of_contact,$pincode,$employee_adding_the_shop_id,$gst_number){

	$sql="INSERT INTO `shop_table`(name,shop_pic,address,gst_number,phone,email,name_of_contact,pincode,added_by_user_id)
	 VALUES ('".$name."','".$shop_pic."','".$address."','".$gst_number."','".$phone."','".$email."','".$name_of_contact."',".$pincode.",".$employee_adding_the_shop_id.")";
	//echo $sql;
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

function update_shop($dbc,$name,$shop_pic,$address,$gst_number_of_shop,$phone,$email,$name_of_contact,$pincode,$employee_adding_the_shop_id,$gst_number="-")
{
	$sql="UPDATE `shop_table` SET `name` = '".$name."',`shop_pic`='".$shop_pic."', `address` = '".$address."', `gst_number` = '".$gst_number."', `phone` = '".$phone."', `email` = '".$email."', `name_of_contact` = '".$name_of_contact."', `pincode` = '".$pincode."' WHERE `shop_table`.`id` =".$shop_id;
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


function get_shops($dbc){
		$data= new stdClass();
		$ret=array();
		if($res=mysqli_query($dbc,$sql))
		{
			while($row=mysqli_fetch_assoc($res)){
				$data=json_decode(get_shop($dbc,$row['id']));
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


function get_shop($dbc,$shop_id)
{
	$data=false;
	$id=0;
	$sql="select * from shop_table where id=".$shop_id;
	//echo $sql;
	if($res=mysqli_query($dbc,$sql))
	{
		
			// id 	name 	address 	gst_number 	phone 	email 	name_of_contact 	location_id 	pincode 
		if($row=mysqli_fetch_assoc($res))
		{
			$data=new stdClass;
			$id=$row['_id'];
			//echo "id is: ".$row['id'];
			$data->name=$row['name'];
			$data->address=$row['address'];
			$data->shop_pic=$row['shop_pic'];
			$data->gst_number=$row['gst_number'];
			$data->phone=$row['phone'];
			$data->email=$row['email'];
			$data->name_of_contact=$row['name_of_contact'];
			$data->pincode=$row['pincode'];
			$data->added_by_user_id=json_decode(get_employee($dbc,$row['added_by_user_id']));
			$data->id=$id;
			$json_data=json_encode($data);
			// set_session($json_data);
			return $json_data;
		}
		
	}
	else
	{
		if (STAGING) {
				echo mysqli_error($dbc);
			}
		return false;
	}
}


function disable_shop($dbc,$shop_id)
{
	$sql="UPDATE `shop_table` SET `active` = 0 WHERE `product_table`.`id` =".$product_id;
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

function enable_shop($dbc,$shop_id)
{
	$sql="UPDATE `shop_table` SET `active` = 1 WHERE `product_table`.`id` =".$product_id;
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


//query to be fixed
function get_shops_for_employee($dbc,$employee_id)
{
	$sql="select * from shop_table where pincode in (select pincode from pincode_table where id=(select pincode_id from pincode_candidate_table where candidate_id=".$employee_id." and candidate_type=".$employee_type."))";
	$id=false;
	$ret=array();
	
	if($res=mysqli_query($dbc,$sql))
	{
		while($row=mysqli_fetch_assoc($res))
		{
			array_push($ret, $row['pincode']);
		}
		return $ret;
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