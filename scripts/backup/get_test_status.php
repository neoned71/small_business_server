<?php
include("../common/initialization.php");


$data=new stdClass;

$student_id=handle_escaping($dbc,$_POST["student_id"]);
$test_id=handle_escaping($dbc,$_POST["test_id"]);
// echo $email;
// echo $pass;
$test_status=get_test_status($dbc,$student_id,$test_id);

if($student)
{
	$data->test_status=json_decode($tests);
	$data->status="success";
}
else
{
	$data->status="failed";

}

echo json_encode($data);
?>