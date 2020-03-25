<?php
include("../common/initialization.php");


$data=new stdClass;

$student_id=handle_escaping($dbc,$_POST["student_id"]);
// echo $email;
// echo $pass;
$student=get_student($dbc,$student_id);

if($student)
{
	$data->student=json_decode($student);
	$data->status="success";
}
else
{
	$data->status="failed";

}

echo json_encode($data);
?>