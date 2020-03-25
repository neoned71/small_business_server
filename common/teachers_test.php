<?php
include("initialization.php");
include("check_login");

$user=json_decode($_SESSION['data_json']);
$test_id=handle_escaping($dbc,$_GET['test_id']);
if($user->candidate_type_id==4 || $user->candidate_type_id==0 || $user->candidate_type_id==1)
{
	$candidate=json_decode(get_employee($dbc,$user->id));
	// $tests=json_decode(get_all_tests($dbc));
	$name=$candidate->name;
	$pic_path=$candidate->pic_path;
	$test=json_decode(get_test($dbc,$test_id,null,1));
	// $questions=$test->test_paper->questions;
}
else if($user->candidate_type_id==2 || $user->candidate_type_id==3)
{
	$student=json_decode(get_student($dbc,$user->id));
	$student_id=$student->id;
	$test=json_decode(get_test($dbc,$test_id,$student_id,2));
	$class_id=$student->class_id;
	
}

if($test->test_type==1 or $test->test_type==2)
{
	$questions=$test->test_paper->questions;
}
else if($test->test_type==3 or $test->test_type==4)
{
	$answers=json_decode($test->test_paper->answers);
	$q_count=count($answers);
	// echo "qcount: ".$q_count;
	$pdf=$link."/pdfs/".$test->test_paper->question_pdf;

}









$test_status=null;
// $test_status=json_decode(get_test_status($dbc,$student_id,$test_id));
if(!empty($test->test_status))
{
	$test_status=$test->test_status;
}

if(!empty($test->test_result))
{
	//alert("Sorry, You have already attempted this test");
	header("Location: result_page.php?test_id=".$test_id);
}
if($test->test_type==2)
{
	$today=extract_date($test->current_time_string);
	$time_right_now=extract_time($test->current_time_string);
	$current_time=$test->current_time_unix;


	$start_unix=$test->timing_unix;
	$duration_unix=$test->duration_minutes*60;
	if($current_time<$start_unix or $current_time>($start_unix+$duration_unix))
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
	<script src=<?php echo $link; ?>"/js/teachers_test.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo $link; ?>css/teachers_test.css" />

	<sript src="<?php echo $link; ?>js/pdfObject.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

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
	<script>
	<?php
	echo 'var pdf = new PDFObject({
  url: "'.$pdf.'",
  id: "pdfRendered",
  pdfOpenParams: {
    view: "FitW"
  }
}).embed("pdfRenderer");';

?>
</script>
<?php
	if($test_status)
	{
	 	echo "<script> arr=".stripslashes(json_encode($test_status->test_status))."	; </script>";
	}
	// else
	// {
	// 	echo "<script> arr=''; </script>";
	// }



	?>


	
	
</head>
 <body style="background:#f2f7f9">
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
include("teachers_test_side_drawer.php");

include("test_top.php");
// include("test_question_top.php");

 ?>


<div id='main_content' class='body w3-white' style="heigth:1000px;background:red" >
	<input type='hidden' id='test_id' value='<?php echo $test_id; ?>'>
	<input type='hidden' id='questions_count' value='<?php echo $q_count; ?>'>
	<input type='hidden' id='test_type' value='<?php echo $test_type; ?>'>
	<iframe style="width:100%;" height="100%" src="<?php echo $pdf; ?>"></iframe>


</div>

  





<?php

//include footer
 // include("test_footer.php"); 
mysqli_close($dbc);
 ?>




 </div>
	
	
	<script>
	



</script>
<script src="nlf/js/nlform.js"></script>
		<script>
			var nlform = new NLForm( document.getElementById( 'nl-form' ) );
		</script>




</body>

</html>