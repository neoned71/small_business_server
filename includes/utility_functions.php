<?php

include("distributor_functions.php");
// include("location_functions.php");
include("region_functions.php");
include("employee_functions.php");
// include("order_functions.php");
include("shop_functions.php");
include("product_functions.php");
include("authentication_functions.php");


function show_error($a)
{
	if(STAGING)
	{
		echo $a;
	}

}

function start_db_transaction($dbc){
	mysqli_autocommit($dbc, FALSE);
	mysqli_begin_transaction($dbc, MYSQLI_TRANS_START_READ_WRITE);
}


function commit_db_transaction($dbc){
	mysqli_commit($dbc);
	mysqli_autocommit($dbc, TRUE);
	
}

function rollback_db_transaction($dbc){
	mysqli_rollback($dbc);
	mysqli_autocommit($dbc, TRUE);
}


function return_error($dbc,$result)
{
	$result->status=0;
	if(!is_null($dbc))
	{
		rollback_db_transaction($dbc,$result);
		mysqli_close($dbc);
	}
	
	echo json_encode($result);
	exit();
}

function return_successful($dbc,$result,$message)
{
	$result->status=1;
	$result->message=$message;
	if(!is_null($dbc))
	{
		commit_db_transaction($dbc,$result);
		mysqli_close($dbc);
	}
	
	echo json_encode($result);
	exit();
}

// types (1: admin, 2: MR, 10: distributor)
function get_user_type_name($dbc,$user_type_id)
{
	$sql="select value from user_types where id=".$user_type_id;
	//echo $sql;
	if($res=mysqli_query($dbc,$sql))
	{
		if($row=mysqli_fetch_assoc($res)){
			return $row['value'];
		}
		else
		{
			return false;
		}
		
		
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
}




#delete from a table
function remove_row($dbc,$table, $id)
{
	$sql="delete from ".$table." where id =".$id;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=true;
	}
	else
	{
		echo mysqli_error($dbc);
	}
	//echo "done ".$id;
	return $id;
}


function image_base64_save($string,$name,$path,$format)
{
	$img = $string;
	
	$img = str_replace('data:image/'.$format.';base64,', '', $img);
	$data = base64_decode($img);
	// show_error("".$path);
	return file_put_contents($path."/".$name, $data);
}

//saving the files from the $_FILE variable
function file_save($file,$path)
{
	// echo count($file['name']);
		if(count($file["name"])>0 and $path)
			{
				$tempfilepath=$file["tmp_name"];
				// echo $tempfilepath;

				if($tempfilepath != "")
				{
					$name=substr(md5(time()."".$tempfilepath),20);

					$filename = $file['name'];
					$ext = pathinfo($filename, PATHINFO_EXTENSION);
					// echo $tempfilepath."\n";
					// echo $path."/".$name.".".$ext;
					if(move_uploaded_file($tempfilepath, $path."/".$name.".".$ext)){
						chmod($path."/".$name.".".$ext,0777);
						// chown($path."/".$name.".".$ext,"neoned71");
						return $name.".".$ext;
					}
					else
					{
						echo "upload failed 0";
						return false;
					}
					// if(move_uploaded_file($tempfilepath,"question_images/".$name.".".$ext)){
					// 	return $name.".".$ext;
					// }
					// else
					// {
					// 	echo "upload failed 0";
					// 	return false;
					// }
				}
				else{
					echo "upload failed 1";
					return false;
				}	

			}
			else
			{
				echo "upload failed 2";
				return false;
			}	
}

//saving the files from the $_FILE variable
function file_delete($file,$path)
{
	if(unlink($path."/".$file))
	{
		return true;

	}
	else
	{
		return false;
	}
}



//handling the escaping of the variables;
function handle_escaping($a,$b)
{

	if(gettype($b)=="string"){
		
		return mysqli_real_escape_string($a,$b);
	}
	else if(gettype($b)=="integer" and is_numeric($b))
	{
		return $b;
	}
	else
	{
		return "not fit";
		
	}
	
}



function my_error_handler($e_number,$e_message,$e_file,$e_line,$e_vars){
	$message="error has been formed in script '$e_file' om the line $e_line:\n$e_message.\n";
	$message.="<pre".print_r(degub_backtrace(),1)."</pre>\n";
	if(!LIVE)
	{
		//nl2br turn new lines int br tags!!
		echo '<div class="alert alert-danger" >'.nl2br($message).'</div>';
	}
	else{
		error_log($message, 1, CONTACT_EMAIL , 'From:neoned71@gmail.com');
		if($e_number!=E_NOTICE)
		{
			echo '<div class="alert alert-danger" > A system error occured. we are sorry for inconvenience</div>';
		}
	}
	return true;
}



?>