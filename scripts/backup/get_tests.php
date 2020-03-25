<?php
include("../common/initialization.php");


$data=new stdClass;

$batch_id=handle_escaping($dbc,$_POST["class_id"]);
// $package_id=handle_escaping($dbc,$_POST["package_id"]);
$student_id=handle_escaping($dbc,$_POST["student_id"]);
// echo $email;
// echo $pass;
$tests=get_tests($dbc,$batch_id,$student_id,2);

if($tests)
{
	$data->tests=json_decode($tests);
	$data->status="success";
}
else
{
	$data->status="failed";

}

echo json_encode($data);
?>