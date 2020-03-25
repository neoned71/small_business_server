<?php
$login=json_decode(check_login());
// echo json_encode($login);
if(empty($login)){
// {	echo "yes";
		header("Location: ../login.php");
}
else
{
	$login->candidate_type_id=$login->candidate_type_id;
}



?>