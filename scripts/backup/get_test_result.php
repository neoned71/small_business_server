<?php
include("../common/initialization.php");


$data=new stdClass;

$test_id=handle_escaping($dbc,$_POST["test_id"]);
$student_id=handle_escaping($dbc,$_POST["student_id"]);
// echo $email;
// echo $pass;
$test_result=get_test_result($dbc,$student_id,$test_id);

if($test_result)
{
	$data->test_result=json_decode($test_result);
	$data->status="success";
}
else
{
	$data->status="failed";

}

echo json_encode($data);
?>
