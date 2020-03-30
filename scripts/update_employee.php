<?php
include("header.php");
$permission=1;
include("self_check.php");

if(!empty($_POST['name']))
{
	$name=handle_escaping($dbc,$_POST["name"]);
}
else
{
	$result->message="name not found";
	return_error($dbc,$result);
}

if( !empty($_POST['phone']))
{
	$phone=handle_escaping($dbc,$_POST["phone"]);
}
else
{
	$result->message="phone not found";
	return_error($dbc,$result);
}

if(!empty($_POST['email']))
{
	$email=handle_escaping($dbc,$_POST["email"]);
}
else
{
	$result->message="email not found";
	return_error($dbc,$result);
}

if( !empty($_POST['address']))
{
	$address=handle_escaping($dbc,$_POST["address"]);
}
else
{
	$result->message="address not found";
	return_error($dbc,$result);
}


// if(!empty($_POST['post']))
// {
// 	$post=handle_escaping($dbc,$_POST["post"]);
// }
// else
// {
// 	$result->message="post not found";
// 	return_error($dbc,$result);
// }



if( !empty($_POST['employee_id']))
{
	$employee_id=handle_escaping($dbc,$_POST["employee_id"]);
}
else
{
	$result->message="employee id not found";
	return_error($dbc,$result);
}




if(!update_employee($dbc,$employee_id,$name,$email,$address,$phone))
{

	$result->message="updating employee failed";
	
	return_error($dbc,$result);
	
}
return_successful($dbc,$result,"Done updating employee");
?>

