<?php
include("header.php");
//check if the person is capable to perform this task


if(!check_credentials($_POST['self']))
{
	$result->message="name not found";
	return_error($dbc,$result);
}

if(!empty($_POST['face_pic_base64']))
{
	$face_pic_name="face_".$time_hash.".png";
	// echo $face_name;
	image_base64_save($_POST["face_pic_base64"],$face_pic_name,$dp_path,"png");
}
else
{
	//ill have to think about this!
	// if(!empty($_FILES['face_pic']))
	// {
	// 	$face_pic_name="face_".$time_hash.".png";
	// 	// echo $face_name;
	// 	image_base64_save($_POST["face_pic_base64"],$face_pic_name,$dp_path,"png");
	// }
	// else
	// {
	// 	$face_pic_name="profile.png";
	// }
	$face_pic_name="profile.png";
}

if(!empty($_POST['id_pic_base64']))
{
	
	$id_pic_name="id_temp_".$time_hash.".png";
	image_base64_save($_POST["id_pic_base64"],$id_pic_name,$id_path,"png");
}
else
{
	$id_pic_name="blank.png";
}

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

if(!empty($_POST['id_type']))
{
	$id_type=handle_escaping($dbc,$_POST["id_type"]);
}
else
{
	$result->message="id-type not found";
	return_error($dbc,$result);
}

if(!empty($_POST['id_number']))
{
	$id_number=handle_escaping($dbc,$_POST["id_number"]);
}
else
{
	$result->message="id-number not found";
	return_error($dbc,$result);
}


if(!empty($_POST['post']))
{
	$post=handle_escaping($dbc,$_POST["post"]);
}
else
{
	$result->message="post not found";
	return_error($dbc,$result);
}

if(!empty($_POST['father_name']))
{
	$father_name=handle_escaping($dbc,$_POST["father_name"]);
}
else
{
	$result->message="father name not found";
	return_error($dbc,$result);
}

if(!empty($_POST['mother_name']))
{
	$mother_name=handle_escaping($dbc,$_POST["mother_name"]);
}
else
{
	$result->message="mother name not found";
	return_error($dbc,$result);
}



$employee_id=create_employee($dbc,$name,$email,$id_type,$id_pic_name,$id_number, $post, $address, $phone,$mother_name,$father_name);
if(empty($employee_id))
{

	$result->message="creating employee failed";
	return_error($dbc,$result);
	
}

//mysqli_commit($dbc);

if(empty(create_login_item($dbc,$employee_id))){
	$result->message="creating employee login failed";
	return_error($dbc,$result);
}

return_successful($dbc,$result,"created successfully");

?>

