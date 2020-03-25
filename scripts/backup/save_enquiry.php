<?php
include("../common/initialization.php");
$path=$question_images."/";
// echo $path;



$result=new stdClass;

$failed=false;

if(!empty($_POST['student_name']))
{
	$student_name=handle_escaping($dbc,$_POST["student_name"]);
}
else
{
	$student_name="-";
}

if(!empty($_POST['student_phone']))
{
	$student_phone=handle_escaping($dbc,$_POST["student_phone"]);
}
else
{
	$student_phone="-";
}


if(isset($_POST['guardian_name']))
{
	$guardian_name=handle_escaping($dbc,$_POST["guardian_name"]);
}
else
{
	$guardians_name="-";
}

if(isset($_POST['guardian_phone']))
{
	$guardian_phone=handle_escaping($dbc,$_POST["guardian_phone"]);
}
else
{
	$guardian_phone="-";
}

if(isset($_POST['student_phone']))
{
	$student_phone=handle_escaping($dbc,$_POST["student_phone"]);
}
else
{
	$student_phone="-";
}




if(isset($_POST['school']))
{
	$school=handle_escaping($dbc,$_POST["school"]);
}
else
{
	$school="-";
}


if(isset($_POST["remarks"]))
{
	$remarks=handle_escaping($dbc,$_POST["remarks"]);
}
else
{
	$remarks="-";
}

if(isset($_POST["residence"]))
{
	$residence=handle_escaping($dbc,$_POST["residence"]);
}
else
{
	$residence="-";
}



if(isset($_POST["follow_up_employee_id"]))
{
	$follow_up_employee_id=handle_escaping($dbc,$_POST["follow_up_employee_id"]);
}
else
{
	$follow_up_employee_id=null;
}

if(isset($_POST["class_name"]))
{
	$class_name=handle_escaping($dbc,$_POST["class_name"]);
}
else
{
	$class_name="none";
}




$e_id=1;

// function insert_enquiry($dbc,$center_id,$first_name=null,$last_name=null,$email=null,$phone=null,$query=null,$class=null,$stream=null,$school=null,$guardian_name=null,$guardian_mobile=null,$age=null,$category=null,$address=null,$remarks=null,$board=null)

$tr_id=insert_enquiry($dbc,1,$student_name,"-","-",$student_phone,"-",$class_name,"-",$school,$guardian_name,$guardian_phone,"-",$residence,$remarks,"-",$follow_up_employee_id);
if(!empty($tr_id))
{
	$result->message="enquiry added";
}
else
{
	$result->message="db failed";
	$failed=true;
	my_rollback($dbc,$result);
	exit();
}
	

$result->status="success";
$result->enquiry_id=$tr_id;
echo json_encode($result);
mysqli_autocommit($dbc, TRUE);
mysqli_close($dbc);

?>