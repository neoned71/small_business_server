<?php
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
else if($user->candidate_type_id==2)
{
	$student=json_decode(get_student($dbc,$user->id));
	$test_link_id=handle_escaping($dbc,$_GET['test_link_id']);
	$student_id=$student->id;
	$test=json_decode(get_test($dbc,$test_id,$student_id,$user->candidate_type_id,$test_link_id));
	$class_id=$student->class_id;
}




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
	if(!empty($test->link_id))
	{
		header("Location: ".$link."/common/result_page.php?test_link_id=".$test->link_id);
	}
	// else if($test)
	// {
	// 	header("Location: ".$link."/common/result_page.php?test_link_id=".$test->link_id);
	// }
	
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





?>
<!DOCTYPE html>
<html>


<head>
	<title></title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E=" crossorigin="anonymous"></script>
	<script src="../js/test.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/test.css" />
	<link rel="stylesheet" type="text/css" href="nlf/css/default.css" />
	<link rel="stylesheet" type="text/css" href="nlf/css/component.css" />
	<script src="nlf/js/modernizr.custom.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

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
 <body style="background:#f2f7f9">
<body >
<div class="back">
</div>

<div id="warning-message"  class="w3-padding w3-margin-top w3-white w3-white w3-center">
<a class="logo w3-center" href="#" style="width:80%;height:150px;margin-top:15%;margin-bottom:15%;opacity:01;margin-left:auto;margin-right:auto;display:block"></a>
     <img id="turn_sideways" src="images/turn.png" />
     <br>
     <h2>Please turn Landscape!</h2>

 </div>


<div id="wrapper">

    <!-- your html for your website -->





<?php
include("test_side_drawer.php");

include("test_top.php");
include("test_question_top.php");

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
	if($test_status)
	{
		$state=$test_status->test_status[$question_number];
	}
	
	$question_number++;

	include("test_main_body.php");
}

echo "</div>";

  



 ?>


<?php

//include footer
 // include("test_footer.php"); 
mysqli_close($dbc);
 ?>




 </div>
	
	
	<script>
// var slideIndex = 0;
// function carousel() {
	
//     var i;
//     var x = document.getElementsByClassName("main_content");
//     //alert(" "+x.length);
//     for (i = 0; i < x.length; i++) {
//       x[i].style.display = "none"; 
//       console.log(i);
//     }
    
//     slideIndex++;
//     if (slideIndex > x.length) {slideIndex = 1} 
    
//     x[slideIndex-1].style.display = "inline";
//     // alert("hello1"); 
//     // alert("hello2");
//     setTimeout(carousel, 300);
// }



</script>




</body>

</html>