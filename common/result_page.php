<?php
include("initialization.php");
//$user is defined in this:
include("check_login.php");

// $user=json_decode($_SESSION['data_json']);

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
	// echo "3";

	if(empty($_GET['candidate_id']))
	{
		$candidate_id=$user->id;
		$user_type=$user->candidate_type_id;
		$candidate=json_decode(get_employee($dbc,$user->id));
		$name=$candidate->name;

	}
	else
	{
		// echo "yes<br>";

		$candidate_id=handle_escaping($dbc,$_GET['candidate_id']);
		$candidate=json_decode(get_student($dbc,$candidate_id));
		$name=$candidate->name;
		$user_type=2;
	}
	$pic_path=$candidate->pic_path;
	// echo $test_id,$candidate_id,$user_type;
	$test=json_decode(get_test($dbc,$test_id,$candidate_id,$user_type,$test_link_id));
	
}
else if($user->candidate_type_id==3 || $user->candidate_type_id==2)
{
	// echo "3";
	$student=json_decode(get_student($dbc,$user->id));
	// echo json_encode($student);
	$student_id=$student->id;
	$name=$student->name;
	// $package_id=$student->package_id;
	$pic_path=$student->pic_path;
	// echo $package_id;
	// $package=json_decode(get_package($dbc,$package_id));
	// if(!empty($package)){
	// 	$subject_ids=$package->subject_available_ids;
	// 	if($subject_ids=="1:2:3")
	// 	{
	// 		$subjects="P C M";
	// 	}
	// 	else if($subject_ids=="1:2:4")
	// 	{
	// 		$subjects="P C B";
	// 	}
	// }
	// else
	// {
	// 	$subjects="-";
	// }

	$class_id=$student->class_id;
	$test=json_decode(get_test($dbc,$test_id,$student_id,2,$test_link_id));
}

$questions=$test->test_paper->questions;
$max_marks=$test->test_paper->total_marks;

$result=$test->test_result;
$total_scored=$result->marks_obtained;

$total_questions=new stdclass;
$total_questions->right=0;
$total_questions->wrong=0;
$total_questions->not_attempted=0;
$total_questions->attempted=0;
$subjects=array();
// echo $result->result_json;
$res_obj=$result->result_json;

foreach($res_obj as $res)
{
	// echo $subjects[$res->subject];
	if(!array_key_exists($res->subject, $subjects)){
		$subjects[$res->subject]=new stdClass;
		$subjects[$res->subject]->name=$res->subject;
		$subjects[$res->subject]->right=0;
		$subjects[$res->subject]->wrong=0;
		$subjects[$res->subject]->attempted=0;
		$subjects[$res->subject]->not_attempted=0;


	}
	if($res->choice!=0)
	{
		if($res->choice == $res->correct_ans)
		{
			$subjects[$res->subject]->right++;
			$total_questions->right++;
		}
		else{
			$subjects[$res->subject]->wrong++;
			$total_questions->wrong++;
		}
		$subjects[$res->subject]->attempted++;
		$total_questions->attempted++;
	}
	else{
		$total_questions->not_attempted++;
		$subjects[$res->subject]->not_attempted++;
	}
	
}

$total_questions->number=$total_questions->attempted + $total_questions->not_attempted;
?><!DOCTYPE html>
<html>


<head>
	<title></title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/main.css" />


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
	width:60%;

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
		include("../admin/side_drawer.php");
	}
	else if($user->candidate_type_id==1)
	{
		$post="faculty";
		// include("../faculty/side_drawer.php");
	}
	else if($user->candidate_type_id==4)
	{
		$post="staff";
		include("../staff/side_drawer.php");
	}
	include("top.php");
}
else if($user->candidate_type_id==2 || $user->candidate_type_id==3)
{
	include("../student/side_drawer.php");
	include("../student/top.php");
}


	?>


<div class="w3-left w3-padding w3-round" style="opacity:0.98;margin-top:10%;width:100%;margin-bottom:0%;">
	<div class="body w3-round w3-text-white" style="margin-top:0px;margin-bottom:0%;padding:0px;">
		<div class="w3-row w3-white">
			<div class="w3-half w3-padding w3-text-grey">
				<h2><?php echo $name; ?></h2>
				<h2>RESULT: <?php echo $test->name; ?></h2>
			</div>
			<div class="w3-half w3-padding w3-right">
				<h1>Test ID: <?php echo $test->id; ?></h1>
				<?php 
				if($test->test_type==1 or $test->test_type==2)
				{
					echo '<a class="w3-text-cyan" href="test_paper_for_printing.php?test_id='.$test->id.'">Download Paper</a>';
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
		<!-- <hr> -->
		<div class="w3-row w3-white w3-text-teal">
			<?php
			$i=1;
				foreach($subjects as $k=>$value)
				{
					echo '<div class="w3-third w3-padding w3-center">
							<div style="width:100%;text">
								'.ucfirst($k).'
							</div>
							<div style="width:100%">
								<canvas id="s'.$i.'-chart-area"></canvas>
							</div>
						</div>';
					$i++;
				}

			?>
		</div>

		

<?php 
$question_number=1;


foreach($questions as $question)
{
	// echo json_encode($questions);
	$result=$res_obj[$question_number-1];
	// echo json_encode($solution);
	$solution=$question->solution;

	include("item_question_solution.php"); 
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

		<?php
		$i=1;
		foreach($subjects as $k=>$value)
				{
					echo "var s".$i." = {
			type: 'pie',
			data: {
				datasets: [{
					data: [
						".$value->right.",".$value->wrong.",".$value->not_attempted."
					],
					backgroundColor: [
						window.chartColors.green,
						window.chartColors.red,
						window.chartColors.grey
						
					],
					label: '".$value->name."'
				}],
				labels: [
					'Right Answers',
					'Wrong Answers',
					'Not Attempted',
					
				]
			},
			options: {
				legend: 
					{
        				display: false
    				},
				responsive: true
			}
		};";
			$i++;
				}

				?>



		window.onload = function() {
			var ctx = document.getElementById('chart-area').getContext('2d');
			window.myPie = new Chart(ctx, config);
			<?php
			$i=1;
			foreach($subjects as $k=>$value)
				{
					echo "var ctx".$i." = document.getElementById('s".$i."-chart-area').getContext('2d');\n";
					echo "window.myPie".$i." = new Chart(ctx".$i.", s".$i.");\n";
					$i++;

				}


			?>
			
		};
		
</script>







</body>

</html>
