<?php
// include("initialization.php");
// include("check_login.php");

// $user=json_decode($_SESSION['data_json']);
// $test_id=handle_escaping($dbc,$_GET['test_id']);
// if($user->candidate_type_id==4 || $user->candidate_type_id==0 || $user->candidate_type_id==1)
// {
// 	$candidate=json_decode(get_employee($dbc,$user->id));
// 	// $tests=json_decode(get_all_tests($dbc));
// 	$name=$candidate->name;
// 	$pic_path=$candidate->pic_path;
// 	$test=json_decode(get_test($dbc,$test_id,null,1));
// 	// echo $pic_path;
// }
// else if($user->candidate_type_id==2 || $user->candidate_type_id==3)
// {
// 	$student=json_decode(get_student($dbc,$user->id));
// 	$student_id=$student->id;
// 	$test=json_decode(get_test($dbc,$test_id,$student_id,2));
// 	$class_id=$student->class_id;
// }
//



include("initialization.php");
include("check_login.php");

$user=$login;
if(!isset($_GET['test_id']) and !isset($_GET['test_link_id']))
{
	header("Location: ".$link);
}
else if(isset($_GET['test_id']))
{
	// echo "1";
	$test_id=handle_escaping($dbc,$_GET['test_id']);
	$test_link_id=0;
}
else
{
	// echo "2";
	$test_link_id=handle_escaping($dbc,$_GET['test_link_id']);
	$test_id=0;
}
if($user->candidate_type_id==4 || $user->candidate_type_id==0 || $user->candidate_type_id==1)
{
	$candidate=json_decode(get_employee($dbc,$user->id));
	// $tests=json_decode(get_all_tests($dbc));
	$name=$candidate->name;
	$pic_path=$candidate->pic_path;
	$test=json_decode(get_test($dbc,$test_id,null,1));
	// echo $pic_path;
}
else if($user->candidate_type_id==2 || $user->candidate_type_id==3)
{
	$student=json_decode(get_student($dbc,$user->id));
	$test_link_id=handle_escaping($dbc,$_GET['test_link_id']);
	$student_id=$student->id;
	$test=json_decode(get_test($dbc,$test_id,$student_id,2,$test_link_id));
	$class_id=$student->class_id;
}

//




$questions=$test->test_paper->questions;


$test_status=null;
// $test_status=json_decode(get_test_status($dbc,$student_id,$test_id));
if(!empty($test->test_status))
{
	$test_status=$test->test_status;
}
if(!empty($test->test_result))
{
	//alert("Sorry, You have already attempted this test");
	header("Location: ../common/result_page.php?test_id=".$test_id);
}
if($test->test_type==2)
{
	$today=extract_date($test->current_time_string);
	$time_right_now=extract_time($test->current_time_string);
	$current_time=$test->current_time_unix;


	$start_unix=$test->timing_unix;
	$duration_unix=$test->duration_minutes*60;
	if($current_time < $start_unix or $current_time > ($start_unix+$duration_unix))
	{
		// header("Location: index.php");
	}


	$exam_start_time=extract_time($test->timing);
	$exam_date=extract_date($test->timing);
}
// echo $test_status->lrt;
?><!DOCTYPE html>
<html>


<head>
	<title></title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" /> 
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E=" crossorigin="anonymous"></script>
	<script src="<?php echo $link; ?>/js/test_nta.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/test_nta.css" />
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous" />

	<script type="text/x-mathjax-config">
MathJax.Hub.Config({
  tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]},
  TeX: { equationNumbers: { autoNumber: "AMS" } },
  "HTML-CSS": { 
      preferredFont: "TeX", 
      availableFonts: ["STIX","TeX"], 
      styles: {".MathJax": {color: "#DDDDDD"}} 
      }
});
</script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/latest.js?config=TeX-MML-AM_CHTML' async></script>
	<?php
	if($test_status)
	{
	 	echo "<script> arr=".stripslashes(json_encode($test_status->test_status))."	; </script>";
	}



	?>


	
	
</head>
 <body style="padding:0;margin:0;background:#aaa;">
<div class="back">
</div>

<div id="warning-message"  class="w3-padding w3-margin-top w3-white w3-white w3-center">
<a class="logo w3-center" href="#" style="width:80%;height:150px;margin-top:15%;margin-bottom:15%;opacity:01;margin-left:auto;margin-right:auto;display:block"></a>
     <img id="turn_sideways" src="<?php echo $link; ?>/images/turn.png" />
     <br>
     <h2>Please turn Landscape!</h2>

 </div>


<div id="wrapper">

    <!-- your html for your website -->



<div style="width:100%;background: white;height: 150px;">
	<div class="w3-row" style="width:100%;background: white;height: 75px;">
		<div class="w3-half">
			<a href="all_tests.php">
			<img src="../images/thrust_logo.png" style="height:60px" /></a>

		</div>
		<div class="w3-half">
			<h5 class="w3-text-black w3-round w3-center" style="width:100%;">
			Time:<span class="w3-text-red clock"><?php 
			if(empty($test_status)){
				if($test->test_type==1)
				{
					echo $test->duration_minutes.":00";
				}
				else if($test->test_type==2)
				{
					echo intval((($start_unix+$duration_unix)-$current_time)/60).":00";
				}
				
			}
			else
			{
				if($test->test_type==1)
				{
					echo $test_status->lrt;
				}
				else if($test->test_type==2)
				{
					echo intval((($start_unix+$duration_unix)-$current_time)/60).":00";
				}
			}
			 ?>
			 	
			 </span>
		</h5>
		</div>

	</div>
	<div  style="width:100%;background: orange;height: 75px;" onclick="askForFinish();">
		<a class=" w3-col w3-right w3-button w3-green" style="height: 75px;margin:0px;width:20%;cursor:pointer;display:block">
				<div class="w3-round  " >
					<h6 class=" w3-round" style="width:100%;">SUBMIT</h6>
				</div>
			</a>
	</div>
</div>

<div class="w3-row w3-white">

	<div class="w3-quarter"><p></p></div>
	<div class="w3-third w3-margin">
		<?php

// include("test_top.php");
// include("test_question_top.php");

echo "<div id='main_content' class='body w3-white' >
<input type='hidden' id='test_id' value='".$test_id."'>
<input type='hidden' id='test_type' value='".$test->test_type."'>";

if(isset($_GET['test_link_id']))
{
	echo "<input type='hidden' id='test_link_id' value='".$test_link_id."'>";
}
$question_number=0;
$total_questions=count($questions);
foreach($questions as $question)
{
	if(!empty($test_status))
	{
		$state=$test_status->test_status[$question_number];
	}
	
	$question_number++;

	include("test_main_body_nta.php");
}

echo "</div>";

  



 ?>

	</div>
	<div class="w3-third">
		<?php
		include("test_side_drawer_nta.php");

		?>

	</div>


</div>




<?php mysqli_close($dbc); ?>




 </div>



</body>

</html>