<?php
include("../common/initialization.php");


$data=new stdClass;

$test_id=handle_escaping($dbc,$_POST["test_id"]);
$student_id=handle_escaping($dbc,$_POST["student_id"]);
$test=json_decode(get_test($dbc,$test_id,$student_id,2));
//echo json_encode($test->test_paper->questions[29]->solution);
$i=0;
if($test->test_type==1 or $test->test_type==2)
{
	for($i=0;$i<count($test->test_paper->questions);$i++) {
		if(!empty($test->test_paper->questions[$i]->solution->text)){
		$test->test_paper->questions[$i]->solution->text=$test->test_paper->questions[$i]->solution->text;
		// echo $test->test_paper->questions[29]->solution->text;
		}
	}
}




if($test)
{
	$data->test=$test;
	$data->status="success";
}
else
{
	$data->status="failed";

}

echo json_encode($data);
mysqli_close($dbc);
?>