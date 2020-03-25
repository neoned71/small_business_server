<?php
include("initialization.php");
include("check_login.php");

$test_id=handle_escaping($dbc,$_GET['test_id']);
$test=json_decode(get_test($dbc,$test_id,null,1));
$questions=$test->test_paper->questions;


$test_status=null;

// if($test->test_type==2)
// {
// 	$today=extract_date($test->current_time_string);
// 	$time_right_now=extract_time($test->current_time_string);
// 	$current_time=$test->current_time_unix;


// 	$start_unix=$test->timing_unix;
// 	$duration_unix=$test->duration_minutes*60;
// 	if($current_time<$start_unix or $current_time>($start_unix+$duration_unix))
// 	{
// 		// header("Location: index.php");
// 	}


// 	$exam_start_time=extract_time($test->timing);
// 	$exam_date=extract_date($test->timing);
// }
// echo $test_status->lrt;





?>
<!DOCTYPE html>
<html>


<head>
	<title></title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E=" crossorigin="anonymous"></script>

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
<div id="wrapper">
<div class="w3-container w3-center">
	<img class=" w3-margin w3-padding" style="width:40%;" src="<?php echo $images; ?>/glogoB.png">
	<div class="w3-row w3-padding w3-text-black">
		<div class="w3-half"><h2><?php echo $test->name; ?></h2></div>
		<div class="w3-half"><h4><?php echo "Duration(min): ".$test->duration_minutes; ?></h4></div>
	</div>
	

</div>
    <!-- your html for your website -->
<?php
echo "<div id='main_content' class='body w3-white w3-padding' >
<input type='hidden' id='test_id' value='".$test_id."'>
<input type='hidden' id='test_type' value='".$test->test_type."'>";
$question_number=0;
$total_questions=count($questions);


echo "</div>";

  



 ?>

<div class="w3-margin w3-padding w3-white">
	<h1 class="w3-text-teal">Answers</h1>
	<div class="w3-row">
<?php
$i=0;
foreach($questions as $question)
{
	$i++;
	echo "<div class='w3-col' style='width:10%'>$i)$question->correct_ans</div>";
	
}
mysqli_close($dbc);
 ?>
</div>

 </div>




 </div>





</body>

</html>