<?php
include("../common/initialization.php");
$data=new stdClass;

//$test_id=handle_escaping($dbc,$_POST["test_id"]);
$student_id=handle_escaping($dbc,$_POST["student_id"]);
$test_id=handle_escaping($dbc,$_POST["test_id"]);
// echo $email;
// echo $pass;
$rank=json_decode(get_rank_test($dbc,$student_id,$test_id));

if($rank)
{
	$data->rank=json_decode($rank);
	$data->status="success";
}
else
{
	$data->status="failed";

}

echo json_encode($data);
?>