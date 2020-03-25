<?php
include("../common/initialization.php");
// $path=$question_images."/";
// echo $path;
// insert_batch($dbc,$class,$program_name, $stream, $max_strength, $center_id,  $name,$session_id)


$result=new stdClass;

$failed=false;
// $session_id,$class_id,$programme_id,$amount,$discount_percent,$subjects_json,$batch_id








if(isset($_POST['installment_id']))
{
	$installment_id=handle_escaping($dbc,$_POST["installment_id"]);
}
else
{
	// my_rollback($dbc,$result);
	$result->status="failed";
	$result->message="no installment id present to be removed";
	echo json_encode($result);
	exit();
}




$e_id=1;
$ret_status=remove_installment($dbc,$installment_id);
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