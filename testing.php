<?php

include("initialization.php");

// get_pincodes_array($dbc,$employee_id,$candidate_type)

$employee_id=2;
// $candidate_type=2;
// echo get_pincodes_array($dbc,$employee_id,$candidate_type);

$order_obj=new stdClass;

$order_obj->orders_array=array();
$order_obj->shop_id=5;
$order_obj->taxed=0;

//$a->order_id,$a->product_id,$a->quantity,$discount,$a->serviced_by,$a->tax

$first_ord=new stdClass;
$first_ord->product_id=2;
$first_ord->serviced_by=0;
$first_ord->quantity=2;
// $first_ord->serviced_by=1;
$first_ord->tax=10;

// array_push($order_obj->orders_array, $first_ord);

// echo json_encode($order_obj);

$dis=json_decode(get_distributors_for_shop_product($dbc,1,3));
var_dump($dis);
mysqli_close($dbc);


// echo json_encode(check_distributor_for_shop_product($dbc,1,1,3));



?>