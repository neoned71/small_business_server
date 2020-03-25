<?php
include("../common/initialization.php");
$result=new stdClass;

$failed=false;

if(!empty($_POST['transaction_type']))
{
	$transaction_type=handle_escaping($dbc,$_POST["transaction_type"]);
}
else
{
	my_rollback($dbc,$result);
	exit();
}

if(!empty($_POST['center_id']))
{
	$center_id=handle_escaping($dbc,$_POST["center_id"]);
}
else
{
	$center_id=0;
}

if(!empty($_POST['payment_mode']))
{
	$payment_mode=handle_escaping($dbc,$_POST["payment_mode"]);
}
else
{
	$payment_mode=1;
}

if(!empty($_POST['direction']))
{
	$direction=handle_escaping($dbc,$_POST["direction"]);
}
else
{
	$direction="-";
}

if(!empty($_POST['target_id']))
{
	$target_id=handle_escaping($dbc,$_POST["target_id"]);
}
else
{
	$target_id=0;
}


if(!empty($_POST['amount']))
{
	$amount=handle_escaping($dbc,$_POST["amount"]);
}
else
{
	$amount=0;
}

if(!empty($_POST['remarks']))
{
	$remarks=handle_escaping($dbc,$_POST['remarks']);
}
else
{
	$remarks=null;
}

if(!empty($_POST['pic_path']))
{
	$file_name=handle_escaping($dbc,$_POST['pic_path']);
}
else
{
	$file_name=null;
}

if(!empty($_POST['taxable']))
{
	$taxable=intval(handle_escaping($dbc,$_POST['taxable']));
	if($taxable==1)
	{
		if(!empty($_POST['tax_amount']))
		{
			$tax_amount=handle_escaping($dbc,$_POST['tax_amount']);
		}
		else
		{
			$tax_amount=null;
		}
	}
}
else
{
	$taxable=0;
	$tax_amount=0;
}

$e_id=1;

if(!empty($remarks) and !empty($amount) and is_numeric($amount) and is_numeric($transaction_type))
{
	// echo $center_id;
	$tr_id=insert_transaction($dbc,$transaction_type, $amount, $direction, $e_id,$target_id, $file_name, $remarks,$taxable,$tax_amount,$payment_mode,$center_id);
	if(!empty($tr_id))
	{
		// echo "some1";
		$result->message="transaction added";
	}
	else
	{
		$result->message="db failed";
		$failed=true;
		my_rollback($dbc,$result);
		exit();
	}
	
}
else
{
	$result->message="parameters not proper";
	$failed=true;
	my_rollback($dbc,$result);
	exit();
}

$result->status="success";
$result->tr_id=$tr_id;
echo json_encode($result);
mysqli_autocommit($dbc, TRUE);
mysqli_close($dbc);

?>