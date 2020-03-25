<?php
include("../common/initialization.php");
include("../common/check_login.php");

$res=new stdClass;
// $test_id=handle_escaping($dbc,$_POST['test_id']);
$user=$login;
if(!isset($_POST['test_id']) and !isset($_POST['test_link_id']))
{
	header("Location: ".$link);
}
else if(!empty($_POST['test_id']))
{
	// echo "1";
	$test_id=handle_escaping($dbc,$_POST['test_id']);
	$test_link_id=0;
}
else if(!empty($_POST['test_link_id']))
{
	// echo "2";
	$test_link_id=handle_escaping($dbc,$_POST['test_link_id']);
	$test_id=0;
}
// else
// {
// 	echo "1";
// }

$data=json_decode($_SESSION['data_json']);
if(!empty($test_id) && ($data->candidate_type_id==1 || $data->candidate_type_id==0 || $data->candidate_type_id==4))
{
	$student_id=$data->id;
	$test_status=handle_escaping($dbc,$_POST['test_status']);
	
	
	$result=json_decode(calculate_result($dbc,$test_id,$test_status,$student_id));
	// echo json_encode($result);
	// $dbc,$test_id,$test_result,$student_id,$attempted,$wrong_questions,$total_marks)
	if(insert_test_result_temp($dbc,$test_id,addslashes(json_encode($result->result_json)),$student_id,$result->attempted,$result->wrong_questions,$result->total_marks,$data->candidate_type_id))
	{
		$res->status="success";
		$res->test_id=$test_id;

	}
	else
	{
		$res->status="failed";
		$res->message="Data related to this test may be already there in the database!";
	}
}
else if(!empty($test_link_id) && $data->candidate_type_id==2){
	// echo "3";
	$student_id=$data->id;
	$test_status=handle_escaping($dbc,$_POST['test_status']);

	$test_id=get_test_id_from_link($dbc,$test_link_id);
	// echo "testId is: ".$test_id;
	// $test_link_id=handle_escaping($dbc,$_POST['test_link_id']);
	$result=json_decode(calculate_result($dbc,$test_id,$test_status,$student_id,$test_link_id));
	if(insert_test_result($dbc,$test_id,$test_link_id,addslashes(json_encode($result->result_json)),$student_id,$result->attempted,$result->wrong_questions,$result->total_marks))
	{
		$res->status="success";
		$res->test_link_id=$test_link_id;
	}
	else
	{
		$res->status="failed";
		$res->message="Data related to this test may be already there in the database!!";
	}
	
	
	
}

else
{
	$res->status="failed";
	$res->message="step 1 failure!";
}

echo json_encode($res);
mysqli_close($dbc);
?>