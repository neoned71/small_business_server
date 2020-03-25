<?php
//this file is for testing of the tests by the faculties!
include("initialization.php");
include("check_login.php");

$user=json_decode($_SESSION['data_json']);
$test_id=handle_escaping($dbc,$_GET['test_id']);
$test=json_decode(get_test($dbc,$test_id,null,1));
$questions=$test->test_paper->questions;
$test_status=null;

?>
<!DOCTYPE html>
<html>


<head>
	<title></title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E=" crossorigin="anonymous"></script>
	<script src="../js/test_for_testing.js"></script>
	<!-- <link rel="stylesheet" type="text/css" href="css/test.css" /> -->

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
     <img id="turn_sideways" src="../images/turn.png" />
     <br>
     <h2>Please turn Landscape!</h2>

 </div>


<div id="wrapper">

    <!-- your html for your website -->





<?php
include("test_side_drawer_for_testing.php");

include("test_top.php");
include("test_question_top.php");

echo "<div id='main_content' class='body w3-white' >
<input type='hidden' id='test_id' value='".$test_id."'>
<input type='hidden' id='test_type' value='".$test->test_type."'>";
$question_number=0;
$total_questions=count($questions);
foreach($questions as $question)
{
	if(!empty($test_status))
	{
		$state=$test_status->test_status[$question_number];
	}
	
	$question_number++;

	include("test_main_body_for_testing.php");
}

echo "</div>";

  

mysqli_close($dbc);

 ?>


</div>





</body>

</html>