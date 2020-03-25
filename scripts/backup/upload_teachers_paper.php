<?php
include("../common/initialization.php");


$result=new stdClass;
mysqli_autocommit($dbc, FALSE);
mysqli_begin_transaction($dbc, MYSQLI_TRANS_START_READ_WRITE);
//for errors along the way!

// echo $_SERVER['DOCUMENT_ROOT'];

$failed=false;
$file=$_FILES["pdf"];

//Handling extension check of the file of the uploaded picture
$allowed =  array('gif','png','jpg','jpeg','pdf');
$filename = $file['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);
//can use these values for the pathinfo
//PATHINFO_DIRNAME
//PATHINFO_BASENAME
if(!in_array($ext,$allowed)) {
	$result->message="only gif,png ,jpg or PDFs are allowed for the image and the extension submitted: ".$ext;
    $failed=true;
    my_rollback($dbc,$result);
}

if($file['size'] > 1024*1024*10)
{
	$result->message="file size should be less than 10MB";
	$failed=true;
	my_rollback($dbc,$result);
} 
    

if(!$failed)
{
	$dp_name=file_save($file,"../pdfs/");
	if(!$dp_name){
		$result->message="file saving failed";
		$failed=true;
		my_rollback($dbc,$result);
	}
	
}
//last checkpoint


 $name=handle_escaping($dbc,$_POST["name"]);

$class_id=handle_escaping($dbc,$_POST["class_id"]);
// $package_id=handle_escaping($dbc,$_POST["package_id"]);;
$duration_minutes=handle_escaping($dbc,$_POST["duration_minutes"]);
// $test_type=handle_escaping($dbc,$_POST["test_type"]);
$timing=NULL;
$extra=NULL;
$subjects=handle_escaping($dbc,$_POST["subjects"]);

$answers_json=handle_escaping($dbc,$_POST["answers_json"]);
$employee_id=handle_escaping($dbc,$_POST["employee_id"]);
// $total_marks=handle_escaping($dbc,$_POST["total_marks"]);
$total_marks=4*count(json_decode($answers_json));
//saving fee data

// echo json_encode($_POST);

if(!empty($file) and !empty($answers_json) and  !empty($employee_id) and  !empty($total_marks) and  !empty($name))
{
	$test_paper_id=insert_teacher_test_paper($dbc,$subjects,$dp_name,$answers_json,$employee_id,$total_marks);
	if(!empty($test_paper_id))
	{
		$test_id=insert_test($dbc,$name,$test_paper_id,$class_id,0,$duration_minutes,3,$timing,$extra);
		if(empty($test_id))
		{
			$result->message="Test not inserted";
			$failed=true;
			my_rollback($dbc,$result);
			exit();
		}
	}
	else{
		$result->message="Test Paper not inserted";
		$failed=true;
		my_rollback($dbc,$result);
		exit();
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
$result->test_id=$test_id;
echo json_encode($result);
mysqli_autocommit($dbc, TRUE);
mysqli_close($dbc);

?>

