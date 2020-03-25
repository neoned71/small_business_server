<?php
include("initialization.php");
include("../includes/constants.php");
include("check_login.php");
$user=json_decode($_SESSION['data_json']);
$test_id=handle_escaping($dbc,$_GET['test_id']);
if($user->candidate_type_id==4 || $user->candidate_type_id==0 || $user->candidate_type_id==1)
{if(empty($_GET['candidate_id']))
	{
		$candidate_id=$user->id;
		$user_type=1;
	}
	else
	{
		$candidate_id=handle_escaping($dbc,$_GET['candidate_id']);
		$user_type=2;
	}
	$candidate=json_decode(get_employee($dbc,$user->id));
	$test=json_decode(get_test($dbc,$test_id,$candidate_id,$user_type));
	$name=$candidate->name;
	$pic_path=$candidate->pic_path;
	$pic_path=$candidate->pic_path;

}
else if($user->candidate_type_id==3 || $user->candidate_type_id==2)
{
	$student=json_decode(get_student($dbc,$user->id));
	$student_id=$student->id;
	$package_id=$student->package_id;
	// echo $package_id;
	$package=json_decode(get_package($dbc,$package_id));
	if(!empty($package)){
		$subject_ids=$package->subject_available_ids;
		if($subject_ids=="1:2:3")
		{
			$subjects="P C M";
		}
		else if($subject_ids=="1:2:4")
		{
			$subjects="P C B";
		}
	}
	else
	{
		$subjects="-";
	}

	$class_id=$student->class_id;
	$test=json_decode(get_test($dbc,$test_id,$student_id,2));
	// echo $user->id;
	// $tests=json_decode(get_tests($dbc,$class_id,$package_id));
}

$answers=json_decode($test->test_paper->answers);
$max_marks=$test->test_paper->total_marks;

// $result=json_decode(get_test_result($dbc,$student_id,$test_id));
$result=$test->test_result;
$total_scored=$result->marks_obtained;

$total_questions=new stdclass;
$total_questions->right=0;
$total_questions->wrong=0;
$total_questions->not_attempted=0;
$total_questions->attempted=0;
// echo $result->result_json;
$res_obj=$result->result_json;

foreach($res_obj as $res)
{
	
	if($res->choice!=0)
	{
		if($res->choice == $res->correct_ans)
		{	
			$total_questions->right++;
		}
		else{
			$total_questions->wrong++;
		}

		$total_questions->attempted++;
	}
	else{
		$total_questions->not_attempted++;
	}
	
}

$total_questions->number=($total_questions->attempted + $total_questions->not_attempted);
// echo $test->test_paper->question_pdf;
$pdf=$link.'/pdfs/'.$test->test_paper->question_pdf;
// echo $pdf;
?><!DOCTYPE html>
<html>


<head>
	<title></title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
	<script src="js/registration.js"></script>
	
	<script src="nlf/js/modernizr.custom.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
	<link rel="stylesheet" type="text/css" href="css/main.css" />


	<script type="text/x-mathjax-config">
MathJax.Hub.Config({
  tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]},
  TeX: { equationNumbers: { autoNumber: "AMS" } }
});
</script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/latest.js?config=TeX-MML-AM_CHTML' async></script>


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
<script>
function solutionToggle(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>
</head>
<body >
<div class="back">
</div>


<?php 
	$page="Result Page";

if($user->candidate_type_id==4 || $user->candidate_type_id==0 || $user->candidate_type_id==1)
{
	
	
	if($user->candidate_type_id==0)
	{
		$post="admin";
		include($link."/admin/side_drawer.php");
	}
	else if($user->candidate_type_id==1)
	{
		$post="faculty";
		include($link."/faculty/side_drawer.php");
	}
	else if($user->candidate_type_id==4)
	{
		$post="staff";
		include($link."/staff/side_drawer.php");
	}
	include($link."/common/top.php");
}
else if($user->candidate_type_id==2 || $user->candidate_type_id==3)
{
	include($link."/student/side_drawer.php");
	include($link."/student/top.php");
}


	?>


<div class="w3-left w3-padding w3-round" style="opacity:0.98;margin-top:10%;width:100%;margin-bottom:0%;">
	<div class="body w3-round w3-text-white" style="margin-top:0px;margin-bottom:0%;padding:0px;">
		<div class="w3-row w3-white">
			<div class="w3-half w3-padding w3-text-grey">
				<h2>RESULT: <?php echo $test->name; ?></h2>
			</div>
			<div class="w3-half w3-padding w3-right">
				<h1>Test ID: <?php echo $test->id; ?></h1>
				<?php if(!empty($test->pdf))
				{
					echo '<a class="w3-text-cyan" href="'.$link.'pdfs/'.$test->pdf.'">Download Paper</a>';
				}
				?>
			</div>
		</div>
		<div class="w3-row w3-black w3-padding">
			<div class="w3-half w3-padding">
				<h4>Total Aquired<h4>
					<h1 class="w3-text-teal w3-center"><?php echo $total_scored; ?>/<?php echo $max_marks; ?></h1>
					<h4>Total Questions<h4>
					<h1 class="w3-text-teal w3-center"><?php echo $total_questions->number; ?></h1>

			</div>
			<div class="w3-half w3-padding">
				<div style="width:100%">
					<canvas id="chart-area"></canvas>
				</div>
			</div>
		</div>
		<iframe style="width:100%;" height="700px" src="<?php echo $pdf; ?>"></iframe>
		<!-- <hr> -->

		

<?php

$question_number=1;


while($question_number < (count($answers)+1))
{
	// echo json_encode($questions);
	$result=$res_obj[$question_number-1];
	// echo json_encode($solution);

	include("teachers_item_result.php"); 
	$question_number++;
}
    ?>

	</div>
	
</div>




	
	
	<script>
	window.chartColors = {
	red: 'rgb(255, 0, 0)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 19)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(100, 3, 207)'
};

var config = {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
						<?php echo "$total_questions->right,$total_questions->wrong,$total_questions->not_attempted"; ?>
					],
					backgroundColor: [
						window.chartColors.green,
						window.chartColors.red,
						window.chartColors.grey
						
					],
					label: 'TOTAL'
				}],
				labels: [
					'Right Answers',
					'Wrong Answers',
					'Not Attempted',
					
				]
			},
			options: {
				
				responsive: true
			}
		};

		



		window.onload = function() {
			var ctx = document.getElementById('chart-area').getContext('2d');
			window.myPie = new Chart(ctx, config);
			
			
		};
		
</script>







</body>

</html>
