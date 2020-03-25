<?php

include("../includes/config.php");
//session_start();
include("../includes/mysql.php");
//$pincode="243002";
$pincode=$_POST["pincode"];
$sql = 'SELECT districtname,statename FROM pincodes where pincode=?'; 
$stmt = mysqli_prepare($dbc,$sql);
mysqli_stmt_bind_param($stmt,'s', $pincode);
mysqli_stmt_execute($stmt);

mysqli_stmt_bind_result($stmt, $a, $b);
mysqli_stmt_store_result($stmt);
//initialize the object;
$result = new stdClass();
if(mysqli_stmt_num_rows($stmt)>0)
{
//$result->message="login successful";
mysqli_stmt_fetch($stmt);
$result->status="success";
$result->state=$b;
$result->city=$a;

}
else
{
$result->status="failed";
}

echo json_encode($result);
    /* close statement */
mysqli_stmt_close($stmt);

mysqli_close($dbc);



?>
