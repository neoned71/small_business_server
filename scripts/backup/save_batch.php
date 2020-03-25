<?php
include("../common/initialization.php");
// $path=$question_images."/";
// echo $path;
// insert_batch($dbc,$class,$program_name, $stream, $max_strength, $center_id,  $name,$session_id)


$result=new stdClass;

$failed=false;
// $session_id,$class_id,$programme_id,$amount,$discount_percent,$subjects_json,$batch_id








if(!empty($_POST['center_id']))
{
	$center_id=handle_escaping($dbc,$_POST["center_id"]);
}
else
{
	// my_rollback($dbc,$result);
	$result->status="failed1";
	echo json_encode($result);
	exit();
}


if(!empty($_POST['stream_id']))
{
	$stream_id=handle_escaping($dbc,$_POST["stream_id"]);
}
else
{
	// my_rollback($dbc,$result);
	$result->status="failed2";
	echo json_encode($result);
	exit();
}


if(!empty($_POST['class_id']))
{
	$class_id=handle_escaping($dbc,$_POST["class_id"]);
}
else
{
	$result->status="failed3";
	echo json_encode($result);
	exit();
}

if(isset($_POST['programme_id']))
{
	$programme_id=handle_escaping($dbc,$_POST["programme_id"]);
}
else
{
	$result->status="failed4";
	echo json_encode($result);
	exit();
}


if(isset($_POST['batch_name']))
{
	$batch_name=handle_escaping($dbc,$_POST["batch_name"]);
}
else
{
	// my_rollback($dbc,$result);
	$result->status="failed5";
	echo json_encode($result);
	exit();
	
}


if(!empty($_POST['subjects_json']))
{
	$subjects_json=handle_escaping($dbc,$_POST["subjects_json"]);
}
else
{
	$subjects_json="[]";
}


$e_id=1;
$batch_id=insert_batch($dbc,$class_id,$programme_id, $stream_id, $center_id, $batch_name,1,$subjects_json);
if(empty($batch_id))
{
	$result->message="db failed1";
	$failed=true;
	echo json_encode($result);
	exit();
}

		
	


$result->status="success";
$result->batch_id=$batch_id;
echo json_encode($result);
// mysqli_autocommit($dbc, TRUE);
mysqli_close($dbc);

?>