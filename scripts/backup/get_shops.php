<?php
include("../initialization.php");
$data=new stdClass;

$employee_id=handle_escaping($dbc,$_POST["employee_id"]);
// $package_id=handle_escaping($dbc,$_POST["package_id"]);
// $student_id=handle_escaping($dbc,$_POST["student_id"]);
// echo $email;
// echo $pass;
$shops=get_shops($dbc,$employee_id);

if(!empty($shops))
{
	$data->shops=json_decode($shops);
	$data->status="success";
}
else
{
	$data->status="failed";

}

echo json_encode($data);
?>