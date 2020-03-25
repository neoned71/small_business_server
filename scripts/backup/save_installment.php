<?php
include("../common/initialization.php");
// $path=$question_images."/";
// echo $path;



$result=new stdClass;

$failed=false;
 // 	id 	plan_id 	amount_intended 	amount_submitted 	payment_mode 	pending 	date_of_submission



if(!empty($_POST['plan_id']))
{
	$plan_id=handle_escaping($dbc,$_POST["plan_id"]);
}
else
{
	// my_rollback($dbc,$result);
	$result->status="failed3";
	echo json_encode($result);
	exit();
	
}

if(!empty($_POST['amount']))
{
	$amount_intended=handle_escaping($dbc,$_POST["amount"]);
}
else
{
	$result->status="failed2";
	echo json_encode($result);
	
	exit();
}



if(!empty($_POST['date_of_submission']))
{
	$date_of_submission=handle_escaping($dbc,$_POST["date_of_submission"]);
	$date_of_submission=date("Y-m-d H:i:s",strtotime($date_of_submission));
}
else
{
	// my_rollback($dbc,$result);
	$result->status="failed1";
	echo json_encode($result);
	exit();
}




$e_id=1;
$installment_id=insert_installment($dbc,$plan_id,$amount_intended,$date_of_submission);
if(empty($installment_id))
{
	$result->message="db failed1";
	$failed=true;
	echo json_encode($result);
	exit();
}

	


$result->status="success";
$result->installment_id=$installment_id;
echo json_encode($result);
// mysqli_autocommit($dbc, TRUE);
mysqli_close($dbc);

?>