<?php
include("../common/initialization.php");
include("../common/check_login.php");
// include("../includes/constants.php");
$res=new stdClass;


$data=json_decode($_SESSION['data_json']);
$student_id=$data->id;
$test_status=handle_escaping($dbc,$_POST['test_status']);
$lrt=handle_escaping($dbc,$_POST['last_registered_time']);
$test_id=handle_escaping($dbc,$_POST['test_id']);

// echo $id,$test_status,$lrt;

if(insert_test_status($dbc,$test_id,$student_id,$test_status,$lrt))
{
	$res->status="success";
	$res->current_time=time();
	$res->date_time=date("Y-M-D H:i:s");

}
else
{
	$res->status="failed";
}



echo json_encode($res);

mysqli_close($dbc);



?>