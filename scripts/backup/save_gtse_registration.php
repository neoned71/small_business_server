<?php
include("../common/initialization.php");
$path=$question_images+"/";

$result=new stdClass;

$failed=false;
$file=$_FILES["picture"];

//Handling extension check of the file of the uploaded picture
$allowed =  array('gif','png','jpg');
$filename = $file['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);
//can use these values for the pathinfo
//PATHINFO_DIRNAME
//PATHINFO_BASENAME
if(!in_array($ext,$allowed)) {
	$result->message="only gif,png or jpg are allowed for the image and the extension submitted: ".$ext;
    $failed=true;
    my_rollback($dbc,$result);
}

if($file['size'] > 1024*1024*5)
{
	$result->message="file size should be less than 5MB";
	$failed=true;
	my_rollback($dbc,$result);
} 
    

if(!$failed)
{
	$dp_name=file_save($file,"../pictures_display/");
	if(!$dp_name){
		$result->message="file saving failed";
		$failed=true;
		my_rollback($dbc,$result);
	}
	
}
//last checkpoint


$first_name=handle_escaping($dbc,$_POST["first_name"]);
$last_name=handle_escaping($dbc,$_POST["last_name"]);
$guardian_name=handle_escaping($dbc,$_POST["guardian_name"]);
// $class_id=handle_escaping($dbc,$_POST["class_id"]);
// $package_id=handle_escaping($dbc,$_POST["package_id"]);;
$school=handle_escaping($dbc,$_POST["school"]);
$phone=handle_escaping($dbc,$_POST["phone"]);
// $test_type=handle_escaping($dbc,$_POST["test_type"]);
// $stream_id=handle_escaping($dbc,$_POST["stream_id"]);
$programme_id=handle_escaping($dbc,$_POST["programme_id"]);
$center_id=handle_escaping($dbc,$_POST["center_id"]);

//saving fee data

// echo json_encode($_POST);

if(!empty($first_name) and !empty($last_name) and  !empty($guardian_name) and  !empty($center_id) and !empty($programme_id) and  !empty($school) and !empty($phone))
{
	$gtse_reg_id=insert_gtse_registration($dbc,$first_name,$last_name,$guardian_name,$programme_id,$center_id,$school,$dp_name,$phone);
	if(empty($gtse_reg_id))
	{
		$gtse_reg_id=json_decode(try_getting_gtse_reg_id($dbc,$phone))->id;
		if(empty($gtse_reg_id))
		{
			$result->message="Some problem with registration";
			$failed=true;
			// echo "some1";
			my_rollback($dbc,$result);
			exit();
			
		}
		else
		{
			// echo "some1";
			$result->message="user_present";
		}
		
		
		

	}
	
}
else
{
	$result->message="parameters not proper";
	$failed=true;
	my_rollback($dbc,$result);
	exit();
}

$result->status="success";
$result->gtse_reg_id=$gtse_reg_id;
echo json_encode($result);
mysqli_autocommit($dbc, TRUE);
mysqli_close($dbc);

?>

