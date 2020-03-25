<?php
include("initialization.php");
include("check_login");
$res=new stdClass;
$data=json_decode($_SESSION['data_json']);
if($data->candidate_type_id==2)
{
	$student_id=$data->id;
	$test_status=handle_escaping($dbc,$_POST['test_status']);
	$test_id=handle_escaping($dbc,$_POST['test_id']);
	$result=json_decode(calculate_result_for_teachers_test($dbc,$test_id,$test_status,$student_id));
	// echo json_encode($result);
	// $dbc,$test_id,$test_result,$student_id,$attempted,$wrong_questions,$total_marks)
	if(insert_test_result($dbc,$test_id,addslashes(json_encode($result->result_json)),$student_id,$result->attempted,$result->wrong_questions,$result->total_marks))
	{
		$res->status="success";
		$res->test_id=$test_id;;
	}
	else
	{
		$res->status="failed";
		$res->message="Data related to this test may be already there in the database";
	}
}
else if($data->candidate_type_id==1 || $data->candidate_type_id==0 || $data->candidate_type_id==4 ){
	$student_id=$data->id;
	$test_status=handle_escaping($dbc,$_POST['test_status']);
	$test_id=handle_escaping($dbc,$_POST['test_id']);
	$result=json_decode(calculate_result_for_teachers_test($dbc,$test_id,$test_status,$student_id));
	if(insert_test_result_temp($dbc,$test_id,addslashes(json_encode($result->result_json)),$student_id,$result->attempted,$result->wrong_questions,$result->total_marks,$data->candidate_type_id))
	{
		$res->status="success";
		$res->test_id=$test_id;

	}
	else
	{
		$res->status="failed";
		$res->message="Data related to this test may be already there in the database";
	}
}

echo json_encode($res);
mysqli_close($dbc);
?>