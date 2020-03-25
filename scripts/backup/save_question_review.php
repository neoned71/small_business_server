<?php
include("../common/initialization.php");


$res=new stdClass;

$question_id=handle_escaping($dbc,$_POST['question_id']);
$review=handle_escaping($dbc,$_POST['review']);
// $dbc,$test_id,$test_result,$student_id,$attempted,$wrong_questions,$total_marks)
if(set_question_review($dbc,$question_id,$review))
{
	$res->status="success";

}
else
{
	$res->status="failed";
	$res->message="Data related to this test may be already there in the database";
}
echo json_encode($res);
mysqli_close($dbc);
?>