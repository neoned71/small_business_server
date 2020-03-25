<?php
include("../common/initialization.php");

$myFile = "../extra/operations.txt";
$fh = fopen($myFile, 'a') or die("can't open file");


$res=new stdClass;


if(!empty($_POST['transaction_id']))
{
	$transaction_id=handle_escaping($dbc,$_POST['transaction_id']);
	if(save_tr_into_a_file($dbc,$transaction_id))
	{
		if(delete_transaction($dbc,$transaction_id))
		{
			$res->status="success";
		}
		else
		{
			$res->message=1;
			$res->status="failed";
		}
	}
	else
	{
		$res->message=2;
		$res->status="failed";
	}
}
else
{
	$res->message=3;
	$res->status="failed";
}


echo json_encode($res);




?>
