<?php
include("header.php");
$permission=1;

//map regions to taluk in the pincode table!!
if(!check_credentials($_POST['self']))
{
	$result->message="name not found";
	return_error($dbc,$result);
}
else
{
	//this has to change
	$employee_id=handle_escaping($dbc, $_POST['self']);
	$employee=json_decode(get_employee($dbc,$employee_id));
}

if(!empty($_POST['candidate_id']))
{
	$candidate_id=handle_escaping($dbc,$_POST["candidate_id"]);
}
else
{
	$result->message="candidate id not found";
	return_error($dbc,$result);
}

if(!empty($_POST['candidate_type']))
{
	$candidate_type=handle_escaping($dbc,$_POST["candidate_type"]);
}
else
{
	$result->message="candidate type not found";
	return_error($dbc,$result);
}

if( !empty($_POST['region_name']))
{
	$region_name=handle_escaping($dbc,$_POST["region_name"]);
}
else
{
	$result->message="region name not found";
	return_error($dbc,$result);
}


$region_mapping_id=add_region_candidate($dbc,$region_name,$candidate_id,$candidate_type);
if(empty($region_mapping_id))
{

	$result->message="Creating mapping failed";
	return_error($dbc,$result);
	
}
$result->region_mapping_id=$region_mapping_id;
return_successful($dbc,$result,"Done creating region mapping");
?>

