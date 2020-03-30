<?php

if(!check_credentials($_POST['self']))
{
	$result->message="name not found";
	return_error($dbc,$result);
}
else
{
	$employee_id=handle_escaping($dbc, $_POST['self']);
	$employee=json_decode(get_employee($dbc,$employee_id));
	if(empty($employee))
	{
		$result->message="Unkown Employee";
		return_error($dbc,$result);
	}
	$employee_type=$employee->type;
}


?>