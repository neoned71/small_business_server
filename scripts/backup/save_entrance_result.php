<?php
include("../common/initialization.php");
// $path=$question_images."/";
// echo $path;
$result=new stdClass;
$failed=false;
// $session_id,$class_id,$programme_id,$amount,$discount_percent,$subjects_json,$batch_id

if(isset($_POST['admission_id']))
{
	$admission_id=handle_escaping($dbc,$_POST["admission_id"]);
}
else
{
	// my_rollback($dbc,$result);
	$result->status="failed";
	echo json_encode($result);
	exit();
	
}

if(isset($_POST['correct']))
{
	$correct=handle_escaping($dbc,$_POST["correct"]);
}
else
{
	$result->status="failed";
	echo json_encode($result);
	exit();
}

if(isset($_POST['incorrect']))
{
	$incorrect=handle_escaping($dbc,$_POST["incorrect"]);
}
else
{
	// my_rollback($dbc,$result);
	$result->status="failed";
	echo json_encode($result);
	exit();
}



// echo $_POST['programme_id'];
if(isset($_POST['marks_obtained']))
{
	$marks_obtained=handle_escaping($dbc,$_POST["marks_obtained"]);
}
else
{
	// my_rollback($dbc,$result);
	$result->status="failed";
	echo json_encode($result);
	exit();
}


// echo $_POST['programme_id'];
if(isset($_POST['scholarship_discount']))
{
	$scholarship_discount=handle_escaping($dbc,$_POST["scholarship_discount"]);
}
else
{
	$scholarship_discount=0;
}


$entrance_result_id=insert_entrance_result($dbc,$correct,$incorrect,$marks_obtained,$scholarship_discount);
if(!empty($entrance_result_id))
{
	if(!set_admission_entrance_result_id($dbc,$admission_id,$entrance_result_id))
	{
		$result->message="db failed2";
		$failed=true;
		echo json_encode($result);
		exit();
	}
}
else
{
		$result->message="db failed1";
		$failed=true;
		echo json_encode($result);
		exit();
}
	


$result->status="success";
$result->entrance_result_id=$entrance_result_id;
echo json_encode($result);
// mysqli_autocommit($dbc, TRUE);
mysqli_close($dbc);

?>