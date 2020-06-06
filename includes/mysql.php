<?php
DEFINE ('DB_USER', 'neon');
DEFINE ('DB_PASSWORD','password');
DEFINE ('DB_HOST', 'host');
DEFINE ('DB_NAME', 'database');
$test="neoned71";
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_set_charset($dbc, 'utf8');
// echo "sasd";
if(empty($dbc)){
$err="error";
echo $err;
}
else
{
// echo "Nopes";
}
?>
