<?php
include("../common/initialization.php");
// echo count("https://gravitiyclasses.in");
$picture_path="../images/pictures_display";

error_reporting(~E_ERROR | ~E_WARNING);
//check_login();


$result=new stdClass;
mysqli_autocommit($dbc, FALSE);
mysqli_begin_transaction($dbc, MYSQLI_TRANS_START_READ_WRITE);
//for errors along the way!
$failed=false;


if(isset($_FILES['picture']))
{
	$photo=$_FILES["picture"];
	//Handling extension check of the file of the uploaded picture
	$allowed =  array('gif','png','jpg','jpeg');
	if(!empty($_POST['employee_id']) and !empty($_POST['center_id']) and !empty($photo['name']))
	{
		$filename = $photo['name'];
		$employee_id = handle_escaping($dbc,$_POST['employee_id']);
		$center_id=handle_escaping($dbc,$_POST["center_id"]);
	}
	else
	{
		$result->message="Parameters Missing ";
	    $failed=true;
	    my_rollback($dbc,$result);
	}

	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	//can use these values for the pathinfo
	//PATHINFO_DIRNAME
	//PATHINFO_BASENAME
	if(!in_array($ext,$allowed)) {
		$result->message="Only gif,png or jpg is allowed for the image, ext submitted:  ".$ext;
	    $failed=true;
	    my_rollback($dbc,$result);
	}

	if($photo['size'] > 10*1024*1024)
	{ //2 MB= 1024*1024*2 (size is also in bytes)
	        // File too big
		$result->message="File size should be less than 2MB";
		$failed=true;
		my_rollback($dbc,$result);
	} 
	    

	if(!$failed)
	{
		$dp_name=file_save($photo,$picture_path);
		if(!$dp_name){
			$result->message="File saving failed";
			$failed=true;
			my_rollback($dbc,$result);
		}
		
	}

}
else
{
	$dp_name="-";
}


//last checkpoint

if(!empty($_POST["guardian_name"]))
{
	$guardian_name=handle_escaping($dbc,$_POST["guardian_name"]);
}
else
{
	$guardian_name="-";
}

if(!empty($_POST["guardian_mobile"]))
{
	$guardian_mobile=handle_escaping($dbc,$_POST["guardian_mobile"]);
}
else
{
	$guardian_mobile="-";
}


if(!empty($_POST["mobile"]))
{
	$mobile=handle_escaping($dbc,$_POST["mobile"]);
}
else
{
	$mobile="-";
}




//last checkpoint


if(empty($_POST['address_1']) or empty($_POST['address_2']))
{
	$result->message="Addresses not recieved";
	$failed=true;
	my_rollback($dbc,$result);
}
//address variables
$address_1=$_POST["address_1"];
//echo $address_1;
$add_1=explode(";",$address_1);




if(count($add_1)==4)
{
	$add_id_1=insert_address($dbc,$add_1,$guardian_mobile);
	if(!$add_id_1)
	{
		$result->message="1st address saving error";
		$failed=true;
		my_rollback($dbc,$result);

	}
	

}
else
{
	$result->message="address 1 incomplete";
	$failed=true;
	my_rollback($dbc,$result);
}

// $same_address=$_POST["same_address"];
//address 2 saving
if(isset($_POST["address_2"]))
{
	$address_2=$_POST["address_2"];
	//echo $address_2;
	
	$add_2=explode(";",$address_2);
	if(count($add_2)==4)
	{
		$add_id_2=insert_address($dbc,$add_2,$mobile);
		if(!$add_id_2)
		{
			$result->message="2nd address saving error";
			$failed=true;
			my_rollback($dbc,$result);

		}
		
	}
	else
	{
		$result->message="address 2 incomplete";
		$failed=true;
		my_rollback($dbc,$result);
	}
	
	
}
else
{
	$add_id_2=$add_id_1;
}

$date_of_birth=handle_escaping($dbc,$_POST["dob"]);
//get student related information!
$first_name=handle_escaping($dbc,$_POST["first_name"]);
$email=handle_escaping($dbc,$_POST["email"]);
$last_name=handle_escaping($dbc,$_POST["last_name"]);
$gender=handle_escaping($dbc,$_POST["gender"]);

$class_id=handle_escaping($dbc,$_POST["class_id"]);
// echo "sdasd";

// echo "class_id:".$class_id;

//creating parents data and parents_id
list($username_s,$password_s)=create_user_pass($mobile,$date_of_birth);
// list($username_p,$password_p)=create_user_pass_parents($mobile,$date_of_birth);
// list($username_s,$password_s)=create_user_pass_students($mobile,$date_of_birth);
// echo $guardian_mobile.":";
// echo $guardian_name.":";
// echo $add_id_1.":";
// echo $username.":";
// echo $password;
// echo insert_credential($dbc,5,"username","pass",1);



//creating contact id

if($email and $guardian_mobile and $add_id_1 and $add_id_2)
{
	// function insert_contact($dbc,$guardian_name,$email,$guardian_mobile,$add_id_1,$add_id_2)

	$contact_id=insert_contact($dbc,$guardian_name,$email,$guardian_mobile,$add_id_1,$add_id_2);
	if(!$contact_id)
	{
		$failed=true;
		$result->message="Creating the contact info failed";
		my_rollback($dbc,$result);
		
	}
	
}
else
{
	$failed=true;
	$result->message="Parameters not proper for the contact table";
	my_rollback($dbc,$result);
}


if($guardian_name and $guardian_mobile)
{
	$parents_id=insert_parents($dbc,$guardian_name,$guardian_mobile,$contact_id);//change
	if(!$parents_id)
	{
		$failed=true;
		
		$result->message="Creating the parent account created errors";
		my_rollback($dbc,$result);
	}
	
	// $p_c_id=insert_credential($dbc,3,$username_p,$password_p,$parents_id);
	// if(!$p_c_id)
	// {
	// 	$failed=true;
		
	// 	$result->message="creating the parent credentials created errors";
	// 	my_rollback($dbc,$result);
	// }
	

	
}
else
{
	$failed=true;
	$result->message="Parameters not proper for the parents table";
	my_rollback($dbc,$result);
}

//echo $dp_name;



if($first_name and $email and $last_name and $gender and $date_of_birth and $class_id)
{
	//insert_student($dbc,$email,$first_name,$last_name,$phone,$gender, $date_of_birth,$contact_id,$class_id,$parents_id,$dp_name="-")
	
	$student_id=insert_student($dbc,$email,$first_name, $last_name,$mobile, $gender, $date_of_birth,$contact_id,$class_id,$parents_id,$dp_name);//change
	if(!$student_id)
	{
		$failed=true;
		$result->message="Creating student failed";
		my_rollback($dbc,$result);
		
	}
	$s_c_id=insert_credential($dbc,2,$username_s,$password_s,$student_id);
	if(!$s_c_id)
	{
		$failed=true;
		
		$result->message="Creating the parent credentials created errors";
		my_rollback($dbc,$result);
	}
	
}
else
{
	$failed=true;
	$result->message="Parameters not proper for the student table";
	my_rollback($dbc,$result);
	
}

$admission=null;
//creating the admission in the database:
if(!empty($_POST['center_id']))
{
	if(!empty($_POST['enquiry_id']))
	{
		$enquiry_id = handle_escaping($dbc,$_POST['enquiry_id']);
		if(!empty($_POST['gtse_result_id']))
		{
			$gtse_result_id = handle_escaping($dbc,$_POST['gtse_result_id']);
			$admission_id=insert_admission($dbc, $student_id,$center_id,$enquiry_id,$gtse_result_id);
		}
		else
		{
			$admission_id=insert_admission($dbc, $student_id,$center_id,$enquiry_id);
		}
	}
	else
	{
		$admission_id=insert_admission($dbc, $student_id,$center_id);
	}
}
else
{
	$failed=true;
	$result->message="No Center-Id is present";
	my_rollback($dbc,$result);
	
}


	if(empty($admission_id))
	{
		$failed=true;
		$result->message="Center Id Missing";
		my_rollback($dbc,$result);
		
	}

$event_type=1;
insert_event($dbc,$event_type,$employee_id,$center_id,"Admission id: ".$admission_id);
	
//echo "next";
/**/
$result->status="success";
$result->admission_id=$admission_id;
echo json_encode($result);
mysqli_autocommit($dbc, TRUE);
mysqli_close($dbc);

?>

