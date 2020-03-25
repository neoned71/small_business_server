<?php
function create_product($dbc,$name,$variant,$photo,$unit_size,$employee_id)
{
	$sql="INSERT INTO `product_table`(name,variant,photo,unit_size)
	 VALUES ('".$name."','".$variant."','".$photo."',".$unit_size.")";
	//echo $sql;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	return $id;
}

function update_product($dbc,$product_id,$name,$photo,$variant,$unit_size)
{
	$sql="UPDATE `product_table` SET `name` = '".$name."', `photo` = '".$photo."', `variant` = '".$variant."',`unit_size` = ".$unit_size." WHERE `product_table`.`id` =".$product_id;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		return true;
	}
	return false;
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
			return false;
		}

		return json_encode($ret);
}

function get_product($dbc,$product_id){

		$data= new stdClass();
		$sql="select * from product_table where id=".$product_id;
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
			return false;
		}

		return json_encode($ret);
}

function disable_product($dbc,$product_id)
{
	$sql="UPDATE `product_table` SET `active` = 0 WHERE `product_table`.`id` =".$product_id;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		return true;
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
	return $id;
}

?>