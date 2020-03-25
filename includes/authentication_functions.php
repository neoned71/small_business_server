<?php

function login($dbc,$username,$password)
{
	$data=false;
	$id=0;
	$sql="select * from login_table where username='".$username."' and password='".$password."'";
	//echo $sql;
	if($res=mysqli_query($dbc,$sql))
	{
		if($row=mysqli_fetch_assoc($res))
		{
			$data=new stdClass;
			//$row=mysqli_fetch_assoc($res);
			$id=$row['user_id'];

			if(empty($id))
			{
				//echo "1";
				return false;
				
			}
			$token=md5(microtime());
			if(!update_user_token($dbc,$token,$row['id']))
			{
				//echo "2";
				return false;
			}
			else
			{
				$data->token=$token;
				update_user_last_login($dbc,$row['id']);
			}
			
			$candidate_type=$row['user_type'];
			$data->id=$id;
			$data->token=$token;

			$data->candidate_type=get_user_type_name($dbc,$candidate_type);
			$data->candidate_type_id=$candidate_type;
			$data->employee=json_decode(get_employee($dbc,$id));
			$json_data=json_encode($data);
			// set_session($json_data);
			return $json_data;
		}
		else
		{

			return false;
		}
	}
	else
	{

		return false;
	}
}

function get_credentials($dbc,$employee_id)
{
		$temp=false;
		$id=$candidate_id;

		$data= new stdClass();
		$sql="select * from login_table where candidate_id=".$employee_id;
		// echo $sql;
		if($res=mysqli_query($dbc,$sql))
		{
			if($row=mysqli_fetch_assoc($res)){
				$data->username=$row['username'];
				$data->password=$row['password'];	
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
		return json_encode($data);


}

function create_login_item($dbc,$candidate_id)
{
	$candidate=json_decode(get_employee($dbc,$candidate_id));
	if(empty($candidate))
	{
		// show_error("error01:".$candidate_id);
		return false;
	}

	$candidate_type=$candidate->post;
	if($candidate_type==1)
	{
		$pref="admin";
	}
	else
	{

		$pref="staff";
	}
	
	

	$mid=sprintf('%04s', $candidate_id);
	$username = $pref."".$mid."@zorr.com";
	$password=$candidate->phone;

	$sql="INSERT INTO `login_table`(`user_id`, `user_type`, `username`,`password`) VALUES (".$candidate_id.",".$candidate_type.",'".$username."','".$password."')";
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	else
	{
		show_error(mysqli_error($dbc));
	}

	return $id;
}


function reset_password($dbc,$old_password,$password,$login_id)
{
	$sql="UPDATE `login_table` SET `password` = '".$password."' WHERE `id` =".$login_id." and password='".$old_password."'";
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		return true;
	}
	return false;
}


function forgot_password($dbc,$old_password,$password,$login_id)
{
	// I really dont know what to do here
	
}

function update_user_token($dbc,$token,$login_id)
{
	$sql="UPDATE `login_table` SET `token` = '".$token."' WHERE `login_table`.`id` =".$login_id;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		return true;
	}
	return false;
}

function update_user_last_login($dbc,$login_id)
{
	$sql="UPDATE `login_table` SET `last_login` = now() WHERE `login_table`.`id` =".$login_id;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		return true;
	}
	return false;
}


function check_credentials($a)
{
	// $user_id=explode("_",$a)[0];
	// $user_type=explode("_",$a)[1];
	// $token=explode("_",$a)[2];
	// $sql="select * from login_table where user_id=".$user_id." and user_type=".$user_type." and token='".$token."'";
	// $id=false;
	// if($res=mysqli_query($dbc,$sql))
	// {
	// 	if($row=mysqli_fetch_assoc($res))
	// 	{
	// 		return true;
	// 	}
	// 	else
	// 	{
	// 		return false;
	// 	}
		
	// }
	// return false;
	return true;
}

?>