<?php
include("../common/initialization.php");
// $path=$question_images."/";
// echo $path;



$result=new stdClass;

$failed=false;
// $session_id,$class_id,$programme_id,$amount,$discount_percent,$subjects_json,$batch_id




if(!empty($_POST['admission_id']))
{
	$admission_id=handle_escaping($dbc,$_POST["admission_id"]);
}
else
{
	// my_rollback($dbc,$result);
	$result->status="failed1";
	echo json_encode($result);
	exit();
	
}

if(!empty($_POST['session_id']))
{
	$session_id=handle_escaping($dbc,$_POST["session_id"]);
}
else
{
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
	// my_rollback($dbc,$result);
	$result->status="failed3";
	$result->message="session is not set";
	echo json_encode($result);
	exit();
}



// echo $_POST['programme_id'];
if(isset($_POST['programme_id']))
{
	$programme_id=handle_escaping($dbc,$_POST["programme_id"]);
}
else
{
	// my_rollback($dbc,$result);
	$result->status="failed4";
	echo json_encode($result);
	exit();
}

if(!empty($_POST['amount']))
{
	$amount=handle_escaping($dbc,$_POST["amount"]);
}
else
{
	// my_rollback($dbc,$result);
	$result->status="failed5";
	echo json_encode($result);
	exit();
}


if(!empty($_POST['batch_id']))
{
	$batch_id=handle_escaping($dbc,$_POST["batch_id"]);
}
else
{
	// my_rollback($dbc,$result);
	$result->status="failed6";
	echo json_encode($result);
	exit();
}


if(isset($_POST['discount_percent']))
{
	$discount_percent=handle_escaping($dbc,$_POST["discount_percent"]);
}
else
{
	$discount_percent=0;
}


if(!empty($_POST['subjects_json']))
{
	$subjects_json=handle_escaping($dbc,$_POST["subjects_json"]);
}
else
{
	$subjects_json="[]";
}


if(!empty($_POST['tax_paid']))
{
	$tax_paid=handle_escaping($dbc,$_POST["tax_paid"]);
}
else
{
	$tax_paid="0";
}



$e_id=1;
$plan_id=insert_plan($dbc,$session_id,$class_id,$programme_id,$amount,$discount_percent,$subjects_json,$batch_id,$tax_paid);
if(!empty($plan_id))
{
	if(!set_admission_plan($dbc,$admission_id,$plan_id))
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
$result->plan_id=$plan_id;
echo json_encode($result);
// mysqli_autocommit($dbc, TRUE);
mysqli_close($dbc);

?>
