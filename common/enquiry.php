<?php
include("initialization.php");
$enquiry_id=handle_escaping($dbc,$_GET['id']);
$e=json_decode(get_enquiry($dbc,$enquiry_id));
// echo json_encode($enquiries[0]);
?>


<!DOCTYPE html>
<html>


<head>
	<title></title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
	<link rel="stylesheet" type="text/css" href="../css/main.css" />
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
	
	<style>
		@font-face {
    font-family: myFirstFont;
    src: url(fonts/thinItalic.ttf);
}
@font-face {
    font-family:drugs-font;
    src: url(fonts/Drugs.otf);
}
@font-face {
    font-family: cursive;
    src: url(fonts/segoeuil.ttf);
}
.drugs-font{
  font-family:drugs-font;
}
.slant-font{
  font-family:myFirstFont;
}
*{
  font-family: drugs-font;
}
.big-font{
  font-size:160%;
}
.medium-font{
  font-size: 140%;
}

	h1{
		font-family: drugs-font; font-weight: bold;}
	h2{
		font-family: drugs-font; font-weight: bold;}
	h3{
		font-family: drugs-font; font-weight: bold;}
	h4{
		font-family: drugs-font; font-weight: bold;}
	h5{
		font-family: drugs-font; font-weight: bold;}
	h6{
		font-family: drugs-font; font-weight: bold;}
	a{
		font-family: drugs-font; font-weight: bold;}
	p{
		font-family: drugs-font; font-weight: bold;
	}

.question_image{
	width:100%;

}
	</style>
</head>
<!-- <body style="background:#f2f7f9"> -->
<body >
<div class="back">
</div>



<?php 
	// include("side_drawer.php");
$page="Enquiry Detail";
	include("top.php");


	?>



<div class="w3-left w3-padding" style="opacity:0.98;margin-top:10%;width:100%;margin-bottom:10%;">
	<div class="w3-round w3-black" style="margin-top:0px;margin-bottom:0%;padding:0px;">
		<div class="w3-row w3-padding">
			
			<div class="w3-col w3-center" style="width:10%;"><h4>NAME</h4><hr></div>
			<div class="w3-col w3-center" style="width:10%;"><h4>FATHER'S NAME</h4><hr></div>
			<div class="w3-col w3-row" style="width:30%;">
				<div class="w3-col w3-center" style="width:100%;"><h4>CONTACT</h4><hr></div>
				<div class="w3-half w3-center w3-text-cyan"><p>FATHER</p></div>
				<div class="w3-half w3-center w3-text-cyan"><p>STUDENT</p></div>
			</div>
			
			<div class="w3-col w3-center" style="width:10%;"><h4>SCHOOL</h4><hr></div>
			<div class="w3-col w3-center" style="width:10%;"><h4>CLASS</h4><hr></div>
			<div class="w3-col w3-center" style="width:10%;"><h4>STREAM</h4><hr></div>
			
			<div class="w3-col w3-center" style="width:10%;"><h4>Date</h4><hr></div>
			<div class="w3-col w3-center" style="width:10%;"><h4>UPDATE</h4></div>
			
		</div>

		<?php
		$pos=0;
		$pos++;
		$e_name=$e->name;
		$e_father_name=$e->guardian_name;
		$e_father_phone=$e->guardian_phone;
		$e_phone=$e->phone;
		$e_school=$e->school;
		$e_class=$e->class;
		$e_stream=$e->stream;
		$e_date=$e->datetime;
		$e_id=$e->id;
		include("enquiry_details.php");
		$follow_up=$e->follow_up;
		$gtse_result=$e->entrance_test;
			
		?>
	</div>


	

	<div class="w3-center w3-white">
		<h1>GTSE RESULT</h1>
		<?php 
		if(!empty($gtse_result))
		{
			echo "<h3>Marks <span class='w3-text-teal'>".$gtse_result->marks_obtained."</h3>";
			echo "<h3>Correct <span class='w3-text-teal'>".$gtse_result->correct."</h3>";
			echo "<h3>incorrect <span class='w3-text-teal'>".$gtse_result->incorrect."</h3>";
			echo "<h3>scholarship_percent <span class='w3-text-teal'>".$gtse_result->scholarship_percent."</h3>";
			echo "<h3>final_discount <span class='w3-text-teal'>".$gtse_result->final_discount."</h3>";
			echo "<h3>reference_by <span class='w3-text-teal'>".$gtse_result->reference_by."</h3>";
		}


		// $gtse_result->correct
		// 	$gtse_result->incorrect
		// 	$gtse_result->marks_obtained
		// 	$gtse_result->scholarship_percent
		// 	$gtse_result->final_discount
		// 	$gtse_result->reference_by
		
		?>

	</div>


	<div >
		<?php 
		foreach ($follow_up as $key) {
			include("follow_up_details.php");
			}
		?>

	</div>

</div>






	
	
	<script>
var slideIndex = 0;
function carousel() {
	
    var i;
    var x = document.getElementsByClassName("mySlides");
    //alert(" "+x.length);
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none"; 
      console.log(i);
    }
    
    slideIndex++;
    if (slideIndex > x.length) {slideIndex = 1} 
    
    x[slideIndex-1].style.display = "inline";
    // alert("hello1"); 
    // alert("hello2");
    setTimeout(carousel, 300);
}
//carousel();
</script>





</body>

</html>
