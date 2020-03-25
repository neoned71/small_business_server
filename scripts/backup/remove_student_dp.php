<?php
include("../common/initialization.php");
// $path=$question_images."/";
// echo $path;
// insert_batch($dbc,$class,$program_name, $stream, $max_strength, $center_id,  $name,$session_id)


$result=new stdClass;

$failed=false;
// $session_id,$class_id,$programme_id,$amount,$discount_percent,$subjects_json,$batch_id








if(isset($_POST['student_id']))
{
	$student_id=handle_escaping($dbc,$_POST["student_id"]);
}
else
{
	// my_rollback($dbc,$result);
	$result->status="failed";
	$result->message="no student id present to be removed";
	echo json_encode($result);
	exit();
}




$e_id=1;
$student=json_decode(get_student($dbc,$student_id));
if($student->gender=='M')
{
	$dp="male.png";
}
else if($student->gender=='F')
{
	$dp="female.png";
}
else if($student->gender=='O')
{
	$dp="profile.png";
}
$ret_status=update_student_dp($dbc,$student_id,$dp);
if(!$ret_status)
{
	$result->message="db failed";
	$result->status="failed";
	$failed=true;
	echo json_encode($result);
	exit();
}

		
	


$result->status="success";
echo json_encode($result);
// mysqli_autocommit($dbc, TRUE);
mysqli_close($dbc);

?>