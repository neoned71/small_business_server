<?php
include("initialization.php");
include("check_login.php");
$param=null;
$user=json_decode($_SESSION['data_json']);
if($user->candidate_type_id==4 || $user->candidate_type_id==0 || $user->candidate_type_id==1)
{
	
$param=new stdClass;
	if(!empty($_GET['center_id']))
	{
		$param->center_id=handle_escaping($dbc,$_GET['center_id']);
	}
	if(!empty($_GET['class_id']))
	{
		$param->class_id=handle_escaping($dbc,$_GET['class_id']);
	}
	if(!empty($_GET['date']))
	{
		$param->date=handle_escaping($dbc,$_GET['date']);
	}
	
	if(!empty($_GET['subject_id']))
	{
		$param->subject_id=handle_escaping($dbc,$_GET['subject_id']);
	}
	if(!empty($_GET['is_part_test']))
	{
		$param->is_part_test=handle_escaping($dbc,$_GET['is_part_test']);
	}
	if(!empty($_GET['is_full_test']))
	{
		$param->is_part_test=handle_escaping($dbc,$_GET['is_part_test']);
	}
	$candidate=json_decode(get_employee($dbc,$user->id));
	$array = json_decode(json_encode($param), True);
	if(count($array)>0)
	{
		$tests=json_decode(get_all_tests($dbc,$param));
	}
	else
	{
		$tests=json_decode(get_all_tests($dbc));
	}
	
	$name=$candidate->name;
	$pic_path=$candidate->pic_path;
	// echo $pic_path;
}
else if($user->candidate_type_id==2 || $user->candidate_type_id==3)
{
	$student=json_decode(get_student($dbc,$user->id));
	$student_id=$student->id;
	// $package_id=$student->package_id;
	$name=$student->name;
	$pic_path=$student->pic_path;
	// echo $package_id;
	// $package=json_decode(get_package($dbc,$package_id));
	// $subject_ids=$package->subject_available_ids;
	// if(empty($package))
	// {
	// 	$subject_ids="1:2:3";
	// }
	// else
	// {
	// 	$subject_ids=$package->subject_available_ids;
	// }
	// if($subject_ids=="1:2:3")
	// {
	// 	$subjects="P C M";
	// }
	// else if($subject_ids=="1:2:4")
	// {
	// 	$subjects="P C B";
	// }
	// else
	// {
	// 	$subjects="-";
	// }

	$class_id=$student->class_id;
	// echo $user->id;
	$tests=json_decode(get_tests($dbc,$class_id,$student_id,2));
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
	<link rel="stylesheet" type="text/css" href="../css/main.css" /> 
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
	
</head>
<!-- <body style="background:#f2f7f9"> -->
<body >
<div class="back">
</div>



<?php 
$page="All Tests";

if($user->candidate_type_id==4 || $user->candidate_type_id==0 || $user->candidate_type_id==1)
{
	
	
	if($user->candidate_type_id==0)
	{
		$post="admin";
		// include("../admin/side_drawer.php");
	}
	else if($user->candidate_type_id==1)
	{
		$post="faculty";
		// include("../faculty/side_drawer.php");
	}
	else if($user->candidate_type_id==4)
	{
		$post="staff";
		// include("../staff/side_drawer.php");
	}
	include("top.php");
}
else if($user->candidate_type_id==2 || $user->candidate_type_id==3)
{
	include("../student/side_drawer.php");
	include("../student/top.php");
}


	?>



<div class="w3-left w3-padding" style="opacity:0.98;margin-top:10%;width:100%;margin-bottom:10%;">
	<?php 

?>

	<div class="body w3-round" style="margin-top:0px;margin-bottom:0%;padding:0px;">

		<!--  -->
		
<?php
if($user->candidate_type_id==0 || $user->candidate_type_id==1){
	// echo '<a href="'.$link.'/faculty/create_teachers_test.php"><h1 class="w3-text-red">Create Teacher Test</h1></a>';
}
if(!is_null($tests))
{

	// echo "count:".count($tests);
	foreach($tests as $t)
	{
		$test_id=handle_escaping($dbc,$t->id);
		
		// $test_link
		// echo $test_id;
		if($user->candidate_type_id==2)
		{
			$test_link_id=$t->link_id;
			$test=json_decode(get_test($dbc,intval($test_id),$student_id,2,$test_link_id));
			$test_result=json_decode(get_test_result($dbc,$student_id,$test_link_id));
			$test_status=get_test_status($dbc,$student_id,$test_id);
		}
		else{
			$test=json_decode(get_test($dbc,intval($test_id),null,1));
			$test_status=null;
			$test_result=null;
		}
		if(!empty($test_result))
		{
			// echo "sada";
			include("item_test_old.php");
		}
		else
		{
			if($test->test_type==1)
			{
				if(empty($test_status)){
					include("item_test_new.php");
				}
				else
				{
					include("item_test_resume.php");
				}
			}
			else if($test->test_type==2)
			{
				$expired=(($test->timing_unix+($test->duration_minutes)*60)-$test->current_time_unix)<=0?true:false;
				if($expired)
				{
					include("item_test_expired.php");
				}
				else
				{
					if(!$test_status){
						include("item_test_new.php");
					}
					else 
					{
						include("item_test_resume.php");
					}
				}

			}
			else if($test->test_type==3)
			{
				if(empty($test_status)){
					include("item_test_new.php");
				}
				else
				{
					include("item_test_resume.php");
				}
			}
			
		}	 
	}
}?>

</div>
</body>

</html>
