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




if(!empty($_POST['payment_mode']))
{
	$payment_mode=handle_escaping($dbc,$_POST["payment_mode"]);
}
else
{
	// my_rollback($dbc,$result);
	$result->status="failed2";
	echo json_encode($result);
	exit();
}

if(!empty($_POST['amount_submitted']))
{
	$amount_submitted=handle_escaping($dbc,$_POST["amount_submitted"]);
}
else
{
	// my_rollback($dbc,$result);
	$result->status="failed3";
	echo json_encode($result);
	exit();
}


if(!empty($_POST['plan_id']))
{
	$plan_id=handle_escaping($dbc,$_POST["plan_id"]);
	$plan=json_decode(get_plan($dbc,$plan_id));
	$admission=json_decode(get_admission_from_plan($dbc,$plan_id));
	// echo $admission->id;

}
else
{
	// my_rollback($dbc,$result);
	$result->status="failed4";
	echo json_encode($result);
	exit();
}


if(!empty($_POST['employee_id']))
{
	$employee_id=handle_escaping($dbc,$_POST["employee_id"]);
}
else
{
	$result->status="failed5";
	echo json_encode($result);
	exit();
}

if(!empty($_POST['installment_id']))
{
	$installment_id=handle_escaping($dbc,$_POST["installment_id"]);
	// $plan_id=get_plan_id_from_installment($dbc,$installment_id);
	
}
else
{
	$result->status="failed6";
	echo json_encode($result);
	exit();
}


$e_id=1;
// $dbc,$installment_id,$amount_submitted,$employee_id,$center_id,$payment_mode


$received=receive_installment($dbc,$installment_id,$amount_submitted,$employee_id, $center_id, $payment_mode);
if($received)
{
	// $dbc,$transaction_type, $amount, $cash_flow, $employee_id,$target_id, $pic_path, $remarks,$taxable,$tax_amount,$payment_mode,$center_id)
	$transaction_id=insert_transaction($dbc,5,$amount_submitted,"+",$employee_id,$installment_id,"-","-",$plan->tax_paid,0,$payment_mode,$center_id);
	// insert_event($dbc,$event_type,$emp_id,$center_id,$remarks);
	insert_event($dbc,1,$employee_id,$center_id,"Tr. ID: ".$transaction_id." was registered for the installment of admission_id:".$admission->id." and installment_id:".$installment_id);
	set_admission_enabled($dbc,$admission->id,1);
	$result->message="all done";
	
}
else
{
		$result->message="db failed1";
		$failed=true;
		echo json_encode($result);
		exit();
}
	


$result->status="success";
// $result->=$plan_id;
echo json_encode($result);
// mysqli_autocommit($dbc, TRUE);
mysqli_close($dbc);

?>