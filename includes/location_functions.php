<?php
function create_location($dbc,$latitude,$longitude){

	$sql="INSERT INTO `location_table`(`latitude`,`longitude`) VALUES ('".$latitude."','".$longitude."')";
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	else
	{
		return false;
		// echo mysqli_error($dbc);
	}

	return $id;
}

function update_location($dbc,$location_id,$latitude,$longitude)
{
	$sql="UPDATE `location_table` SET `latitude` = '".$latitude."', `longitude` = '".$longitude."' WHERE `location_table`.`id` =".$location_id;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		return true;
	}
	return false;
}




function get_location($dbc,$location_id)
{
	$data=false;
	$id=0;
	$sql="select * from location_table where id=".$location_id;
	//echo $sql;
	if($res=mysqli_query($dbc,$sql))
	{
		if($row=mysqli_fetch_assoc($res))
		{
			$data=new stdClass;
			$id=$row['_id'];
			$data->latitude=$row['latitude'];
			$data->longitude=$row['longitude'];
			$json_data=json_encode($data);
			return $json_data;
		}
		
	}
	else
	{
		return false;
	}
}

?>