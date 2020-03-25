<?php
include("initialization.php");

if(empty($_GET['test_id']))
{
	header("Location: sorry.html");
}
else
{
	$test_id=handle_escaping($dbc,$_GET['test_id']);
}
$students_list=json_decode(get_students_list_for_tm($dbc,$test_id));
?>


<!DOCTYPE html>
<html>


<head>
	<title>Gravity</title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
	<link rel="stylesheet" type="text/css" href="../css/main.css" />
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript" src="js/script.js"></script>


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
	// include("../faculty/side_drawer.php");
if($user->candidate_type_id==0)
	{
		$post="admin";
		include("../admin/side_drawer.php");
	}
	else if($user->candidate_type_id==1)
	{
		$post="faculty";
		include("../faculty/side_drawer.php");
	}
	else if($user->candidate_type_id==4)
	{
		$post="staff";
		include("../staff/side_drawer.php");
	}
	$page="Performance Monitor";
	include("../common/top.php");
	?>



<div class="body w3-left w3-padding" style="opacity:0.98;margin-top:10%;width:100%;margin-bottom:10%;">
<?php
	foreach($students_list as $t)
	{
		include("students_list_for_tm.php");
	}

?>
</div>
	
</body>

</html>
