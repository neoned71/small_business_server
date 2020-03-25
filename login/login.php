<?php
include("../common/initialization.php");

$data=new stdClass;

$email=handle_escaping($dbc,$_POST["email"]);
$pass=handle_escaping($dbc,$_POST["password"]);
$pass_hash=md5($pass);
// echo $email;
// echo $pass;
$login=get_login($dbc,$email,$pass);
$login_obj=json_decode($login);

if(!empty($login) and ($login_obj->candidate_type_id==0 or $login_obj->candidate_type_id==1 or $login_obj->candidate_type_id==4))
{
	$data->login=json_decode($login);
	$data->user=json_decode(get_employee($dbc,$data->login->id));
	$data->status="success";
	if($login_obj->candidate_type_id==0)
	{
		$data->link="admin/";
	}
	else if($login_obj->candidate_type_id==1)
	{
		$data->link="faculty/";
	}
	else if($login_obj->candidate_type_id==4)
	{
		$data->link="staff/";
	}

}
else if(!empty($login) and (json_decode($login)->candidate_type_id==2 or json_decode($login)->candidate_type_id==3))
{
	$data->login=json_decode($login);
	$data->user=json_decode(get_student($dbc,$data->login->id));
	$data->status="success";
	if($login_obj->candidate_type_id==2)
	{
		$data->link="student/";
	}
	else if($login_obj->candidate_type_id==3)
	{
		$data->link="parents/";
	}

}
else
{
	$data->status="failed";
}
echo json_encode($data);
mysqli_close($dbc);
?>