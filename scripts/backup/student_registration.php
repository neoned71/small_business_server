<?php

include("../common/initialization.php");
$path="../images/pictures_display";
error_reporting(E_ERROR | ~E_WARNING);
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
	$filename = $photo['name'];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	//can use these values for the pathinfo
	//PATHINFO_DIRNAME
	//PATHINFO_BASENAME
	if(!in_array($ext,$allowed)) {
		$result->message="only gif,png or jpg is allowed for the image, ext submitted:  ".$ext;
	    $failed=true;
	    my_rollback($dbc,$result);
	}

	if($photo['size'] > 1024*1024*2)
	{ //2 MB= 1024*1024*2 (size is also in bytes)
	        // File too big
		$result->message="file size should be less than 2MB";
		$failed=true;
		my_rollback($dbc,$result);
	} 
	    

	if(!$failed)
	{
		$dp_name=file_save($photo,$path);
		// echo $dp_name;
		if(!$dp_name){
			$result->message="file saving failed";
			$failed=true;
			my_rollback($dbc,$result);
		}
		
	}
}
else
{
	$dp_name=NULL;
}

//last checkpoint

if(!empty($_POST['guardian_name']))
{
	$guardian_name=handle_escaping($dbc,$_POST["guardian_name"]);
}
else
{
	$result->message="9";
	my_rollback($dbc,$result);
	exit();
}

if(!empty($_POST['guardian_phone']))
{
	$guardian_phone=handle_escaping($dbc,$_POST["guardian_phone"]);
}
else
{
	$result->message="8";
	my_rollback($dbc,$result);
	exit();
}

if(!empty($_POST['school']))
{
	$school=handle_escaping($dbc,$_POST["school"]);
}
else
{
	$school="-";
}


if(!empty($_POST['mobile']))
{
	$mobile=handle_escaping($dbc,$_POST["mobile"]);
}
else
{
	$mobile="-";
}

// if(!empty($_POST['center_id']))
// {
// 	$center_id=handle_escaping($dbc,$_POST["center_id"]);
// }
// else
// {
// 	$result->message="7";
// 	my_rollback($dbc,$result);
// 	exit();
// }

// if(!empty($_POST['employee_id']))
// {
// 	$center_id=handle_escaping($dbc,$_POST["center_id"]);
// }
// else
// {
// 	$result->message="6";
// 	my_rollback($dbc,$result);
// 	exit();
// }
//

if(!empty($_POST['dob']))
{
	$date_of_birth=handle_escaping($dbc,$_POST["dob"]);
}
else
{
	$result->message="7";
	my_rollback($dbc,$result);
	exit();
}


if(!empty($_POST['center_id']))
{
	$center_id=handle_escaping($dbc,$_POST["center_id"]);
}
else
{
	$result->message="6";
	my_rollback($dbc,$result);
	exit();
}



if(!empty($_POST['first_name']))
{
	$first_name=handle_escaping($dbc,$_POST["first_name"]);
}
else
{
	$result->message="5";
	my_rollback($dbc,$result);
	exit();
}


if(!empty($_POST['email']))
{
	$email=handle_escaping($dbc,$_POST["email"]);
}
else
{
	$result->message="4";
	my_rollback($dbc,$result);
	exit();
}



if(!empty($_POST['last_name']))
{
	$last_name=handle_escaping($dbc,$_POST["last_name"]);
}
else
{
	$result->message="3";
	my_rollback($dbc,$result);
	exit();
}


if(!empty($_POST['gender']))
{
	$gender=handle_escaping($dbc,$_POST["gender"]);
	if($gender=='M' and empty($dp_name))
	{
		$dp_name="male.png";
	}
	else if($gender=='F' and empty($dp_name))
	{
		$dp_name="female.png";
	}
	else if($gender=='O' and empty($dp_name))
	{
		$dp_name="profile.png";
	}
}
else
{
	$result->message="2";
	my_rollback($dbc,$result);
	exit();
}

if(!empty($_POST['class_id']))
{
	$class_id=handle_escaping($dbc,$_POST["class_id"]);
}
else
{
	$result->message="1";
	my_rollback($dbc,$result);
	exit();
}


if(isset($_POST['address_1']))
{
	$address_1=$_POST["address_1"];
	$add_1=explode(";",$address_1);


	if(count($add_1)==4)
	{
		$add_id_1=insert_address($dbc,$add_1,$guardian_phone);
		if(empty($add_id_1))
		{
			$result->message="1st address saving error";
			$failed=true;
			my_rollback($dbc,$result);

		}
		

	}
	else
	{
		$failed=true;
		my_rollback($dbc,$result);
	}
}
else
{
	my_rollback($dbc,$result);
	exit();
}


// $address_1=$_POST["address_1"];
//echo $address_1;


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




// echo "class_id:".$class_id;

//creating parents data and parents_id
// list($username_s,$password_s)=create_user_pass($mobile,$date_of_birth);
// list($username_p,$password_p)=create_user_pass_parents($mobile,$date_of_birth);
// list($username_s,$password_s)=create_user_pass_students($mobile,$date_of_birth);
// echo $guardian_mobile.":";
// echo $guardian_name.":";
// echo $add_id_1.":";
// echo $username.":";
// echo $password;
// echo insert_credential($dbc,5,"username","pass",1);



//creating contact id

	// function insert_contact($dbc,$guardian_name,$email,$guardian_mobile,$add_id_1,$add_id_2)

$contact_id=insert_contact($dbc,$guardian_name,$email,$guardian_phone,$add_id_1,$add_id_2);
if(empty($contact_id))
{
	$failed=true;
	$result->message="creating the contact info failed";
	my_rollback($dbc,$result);
	
}
	



// if($guardian_name and $guardian_mobile and $username_p and $password_p)
// {
// 	$parents_id=insert_parents($dbc,$guardian_name,$guardian_mobile,$contact_id);//change
// 	if(!$parents_id)
// 	{
// 		$failed=true;
		
// 		$result->message="creating the parent account created errors";
// 		my_rollback($dbc,$result);
// 	}
	
// 	$p_c_id=insert_credential($dbc,3,$username_p,$password_p,$parents_id);
// 	if(!$p_c_id)
// 	{
// 		$failed=true;
		
// 		$result->message="creating the parent credentials created errors";
// 		my_rollback($dbc,$result);
// 	}
	

	
// }
// else
// {
// 	$failed=true;
// 	$result->message="parameters not proper for the parents table";
// 	my_rollback($dbc,$result);
// }

//echo $dp_name;




$student_id=insert_student($dbc,$email,$first_name, $last_name,$mobile, $gender, $date_of_birth,$contact_id,$class_id,$guardian_name,$guardian_phone,$school,$dp_name);//change
if(empty($student_id))
{
	$failed=true;
	$result->message="creating student failed";
	my_rollback($dbc,$result);
	
}




//creating the admission in the database:
$admission_id=insert_admission($dbc, $student_id, $center_id);
if(empty($admission_id))
{
	$failed=true;
	$result->message="creating student failed";
	my_rollback($dbc,$result);
	
}

if($email=="empty@thrustacademy.com")
{
	$email=$student_id."@thrustacademy.com";
}
$s_c_id=insert_credential($dbc,2,$email,$guardian_phone,$student_id);
if(empty($s_c_id))
{
	$failed=true;
	
	$result->message="creating the credentials created errors";
	my_rollback($dbc,$result);
}

$emp_id=0;
$center_id=1;
$event_type=1;

insert_event($dbc,$event_type,$emp_id,$center_id,"Admission id: ".$admission_id);
	
//echo "next";
/**/
$result->status="success";
$result->admission_id=$admission_id;
echo json_encode($result);
mysqli_autocommit($dbc, TRUE);
mysqli_close($dbc);

?>

