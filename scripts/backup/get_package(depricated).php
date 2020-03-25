<?php
include("../common/initialization.php");

$data=new stdClass;

$package_id=handle_escaping($dbc,$_POST["package_id"]);

// echo $email;
// echo $pass;
$package=get_test_status($dbc,$package_id);

if($package)
{
	$data->package=json_decode($package);
	$data->status="success";
}
else
{
	$data->status="failed";

}

echo json_encode($data);
?>