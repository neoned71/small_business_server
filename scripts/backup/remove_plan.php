<?php
include("../common/initialization.php");
// $path=$question_images."/";
// echo $path;
// insert_batch($dbc,$class,$program_name, $stream, $max_strength, $center_id,  $name,$session_id)


$result=new stdClass;

$failed=false;
// $session_id,$class_id,$programme_id,$amount,$discount_percent,$subjects_json,$batch_id








if(isset($_POST['admission_id']))
{
	$admission_id=handle_escaping($dbc,$_POST["admission_id"]);
	$admission=json_decode(get_admission($dbc,$admission_id));
	if($admission->enabled==1)
	{

		$result->status="failed";
		$result->message="Admisssion is enabled, cant delete..Contact @: neoned71@gmail.com";
		echo json_encode($result);
		exit();
	}
}
else
{
	// my_rollback($dbc,$result);
	$result->status="failed";
	$result->message="no admission id present to be removed";
	echo json_encode($result);
	exit();
}

$ret_status=reset_admission_plan($dbc,$admission_id);
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