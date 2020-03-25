<?php
include("initialization.php");
$test_id=handle_escaping($dbc,$_GET['test_id']);
$test=json_decode(get_test($dbc,$test_id,null,1));
$questions=$test->test_paper->questions;
// echo $question_images;

$test_status=null;
?>
<!DOCTYPE html>
<html>


<head>
	<title></title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E=" crossorigin="anonymous"></script>
	<!-- <script src="js/test.js"></script> -->
	<!-- <link rel="stylesheet" type="text/css" href="css/test_for_pdf.css" /> -->
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

echo "<input type='hidden' id='test_id' value='".$test_id."'>
<input type='hidden' id='test_type' value='".$test->test_type."'>";



	?>


	
	
</head>
 <body style="background:#f2f7f9">
<body >
<div class="back">
</div>
<div id="wrapper">
<div class="w3-container w3-center">
	<img class=" w3-margin w3-padding" style="width:40%;" src="../images/glogoB.png">
	<div class="w3-row w3-padding w3-text-black">
		<div class="w3-half"><h2><?php echo $test->name; ?></h2></div>
		<div class="w3-half"><h4><?php echo "Duration(min): ".$test->duration_minutes; ?></h4></div>
	</div>
</div>
    <!-- your html for your website -->





<?php
// include("test_side_drawer.php");
// include("test_top.php");
// include("test_question_top.php");
echo "<div id='main_content' class='body w3-white' style='width:100%;' >";
$question_number=0;
$total_questions=count($questions);
foreach($questions as $question)
{
	$question_number++;
	include("test_print_question.php");
}
echo "</div>";
?>

<div class="w3-margin w3-padding w3-white">
	<!-- <h1 class="w3-text-teal">Answers</h1> -->
	<div class="w3-row">
<?php
mysqli_close($dbc);
 ?>
</div>

 </div>

</body>

</html>