<?php
include("../common/initialization.php");

$data=new stdClass;

$student_id=handle_escaping($dbc,$_POST["student_id"]);
// echo $email;
// echo $pass;
$performance=get_performance_student($dbc,$student_id);

if($rank)
{
	$data->performance=json_decode($performance);
	$data->status="success";
}
else
{
	$data->status="failed";

}

echo json_encode($data);
?>