<?php
include("header.php");
$permission=1;

//map regions to taluk in the pincode table!!
include("self_check.php");


if(!empty($_POST['candidate_id']))
{
	$candidate_id=handle_escaping($dbc,$_POST["candidate_id"]);
}
else
{
	$result->message="candidate id not found";
	return_error($dbc,$result);
}

if(!empty($_POST['product_id']))
{
	$product_id=handle_escaping($dbc,$_POST["product_id"]);
}
else
{
	$result->message="product type not found";
	return_error($dbc,$result);
}

if( !empty($_POST['quantity']))
{
	$quantity=handle_escaping($dbc,$_POST["quantity"]);
}
else
{
	$result->message="quantity name not found";
	return_error($dbc,$result);
}



if(!set_employee_stock($dbc,$candidate_id,$product_id,$quantity))
{

	$result->message="adding stock info failed";
	return_error($dbc,$result);
	
}
// $result->region_mapping_id=$region_mapping_id;
return_successful($dbc,$result,"Done setting quantity");
?>

