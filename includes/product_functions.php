<?php
function create_product($dbc,$name,$variant,$photo,$unit_size,$employee_id,$price)
{
	$sql="INSERT INTO `product_table`(name,variant,product_pic,unit_size,price)
	 VALUES ('".$name."','".$variant."','".$photo."',".$unit_size.",".$price.")";
	//echo $sql;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	else{
		if(STAGING)
		{
			echo mysql_error($dbc);
		}
	}
	return $id;
}

function update_product($dbc,$product_id,$name,$variant,$unit_size,$price)
{
	$sql="UPDATE `product_table` SET `name` = '".$name."',  `variant` = '".$variant."',`unit_size` = ".$unit_size.",`price` = ".$price." WHERE `product_table`.`id` =".$product_id;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		return true;
	}
	else
	{
		if(STAGING)
		{
			echo mysql_error($dbc);
		}
	}
	return false;
}

function update_product_pic($dbc,$product_id,$temp_image_name)
{
	$new_name="product_".$temp_image_name;
	if(rename($temp_image_path."/".$temp_image_name, $product_image_path."/".$new_name)){

		$sql="UPDATE `product_table` SET `product_pic` = '".$new_name."' WHERE `id` =".$shop_id;
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


function get_products($dbc)
{
		$data= new stdClass();
		$sql="select * from product_table";
		//echo $sql;
		$ret=array();
		if($res=mysqli_query($dbc,$sql))
		{

			while($row=mysqli_fetch_assoc($res))
			{
				$data=json_decode(get_product($dbc,$row['id']));
				array_push($ret, $data);
			}	
		}
		else
		{
			if(STAGING)
			{
				echo mysql_error($dbc);
			}
			return false;
		}

		return json_encode($ret);
}

function get_product($dbc,$product_id){

		$data= new stdClass;
		$sql="select * from product_table where id=".$product_id;
		// $ret=array();
		if($res=mysqli_query($dbc,$sql))
		{
			if($row=mysqli_fetch_assoc($res))
			{
				$data->id=$row['id'];
				$data->product_name=$row['name'];
				$data->variant=$row['variant'];
				$data->product_pic=$row['product_pic'];
				$data->unit_size=$row['unit_size'];
				$data->active=$row['active'];
				$data->price=$row['price'];

				// array_push($ret, $data);
			}	
		}
		else
		{
			if(STAGING)
			{
				echo mysql_error($dbc);
			}
			return false;
		}

		return json_encode($data);
}

function disable_product($dbc,$product_id)
{
	$sql="UPDATE `product_table` SET `active` = 0 WHERE `product_table`.`id` =".$product_id;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		return true;

	}
	else
	{
		if(STAGING)
		{
			echo mysql_error($dbc);
		}
	}
	return $id;
}


function enable_product($dbc,$product_id)
{
	$sql="UPDATE `product_table` SET `active` = 1 WHERE `product_table`.`id` =".$product_id;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		return true;
	}
	else
	{
		if(STAGING)
		{
			echo mysql_error($dbc);
		}
	}
	return $id;
}

?>