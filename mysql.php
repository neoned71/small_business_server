<?php
DEFINE ('DB_USER', 'neon');
DEFINE ('DB_PASSWORD', 'Mac@neoned71');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'reiki');
$test="neoned71";
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_set_charset($dbc, 'utf8');
/*function escape_data($dbc,$data){
	return mysqli_real_escape_string($dbc,trim($data));
}*/
if(!$dbc){
$err="cant connect";
//echo $err;
}
else
{
// echo "connected to the database";
}
//print isset($err);
?>
