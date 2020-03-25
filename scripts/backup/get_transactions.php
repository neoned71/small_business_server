<?php
include("../common/initialization.php");


$data=new stdClass;

if(!empty($_POST["limit"]))
{
	$limit=handle_escaping($dbc,$_POST["limit"]);
}
else
{
	$limit=0;
}

if(!empty($_POST["offset"]))
{
	$offset=handle_escaping($dbc,$_POST["offset"]);
}
else
{
	$offset=0;
}

// if(!empty($_POST["is_today"]))
// {
// 	$is_today=handle_escaping($dbc,$_POST["is_today"]);
// }
// else
// {
// 	$is_today=null;
// }



if(!empty($_POST["params"]))
{
	// echo $_POST["params"];
	$params=json_decode($_POST["params"],false);
	// echo $params->transaction_type;
}
else
{
	// echo 2;
	$params=null;
}





// $package_id=handle_escaping($dbc,$_POST["package_id"]);
// $student_id=handle_escaping($dbc,$_POST["student_id"]);
// echo $email;
// echo $pass;
// echo 1;
	$transactions=get_transactions($dbc,$limit,$offset,$params);
// }
// else
// {
// 	// echo 1;

// 	//i am tinking of removing this!
// 	$transactions=json_decode(get_todays_transactions($dbc,$limit,$offset,null));
// }
// $tests=get_tests($dbc,$batch_id,$student_id,2);

if(!is_null($transactions))
{
	$data->transactions=json_decode($transactions);
	$data->status="success";
}
else
{
	$data->status="failed";

}

echo json_encode($data);
?>