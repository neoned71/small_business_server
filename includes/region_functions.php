<?php
function get_region_candidate($dbc,$candidate_id,$candidate_type)
{
	$sql="select * from region_candidate_table where candidate_id=".$candidate_id." and candidate_type=".$candidate_type;
	$id=false;
	$ret=array();
	
	if($res=mysqli_query($dbc,$sql))
	{
		while($row=mysqli_fetch_assoc($res))
		{
			array_push($ret, $row['region_name']);
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

function add_region_candidate($dbc,$region_name,$candidate_id,$candidate_type)
{
	$sql="insert into region_candidate_table (region_name,candidate_id,candidate_type) values ('".$region_name."',".$candidate_id.",".$candidate_type.")";
	$id=false;
	$ret=array();
	
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
		return $id;
	}
	else
	{
		if (STAGING) {
			echo mysqli_error($dbc);
		}
		return false;
	}
}

function delete_region_candidate($dbc,$region_name,$candidate_id,$candidate_type)
{
	$sql="delete from region_candidate_table where candidate_id=".$candidate_id." and candidate_type=".$candidate_type." and region_name='".$region_name."'";
	$id=false;
	$ret=array();
	
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

?>