<?php
include("initialization.php");
//$user is defined in this:
include("check_login.php");

$user=json_decode($_SESSION['data_json']);
$student=json_decode(get_student($dbc,$user->id));
$student_id=$student->id;
$package_id=$student->package_id;
// echo $package_id;
$package=json_decode(get_package($dbc,$package_id));
$subject_ids=$package->subject_available_ids;
if($subject_ids=="1:2:3")
{
	$subjects="P C M";
}
else if($subject_ids=="1:2:4")
{
	$subjects="P C B";
}
else
{
	$subjects="-";
}

$class_id=$student->class_id;
// echo $user->id;
// $tests=json_decode(get_tests($dbc,$class_id,$package_id));

$test_id=handle_escaping($dbc,$_GET['test_id']);
$test=json_decode(get_test($dbc,$test_id));
$questions=$test->test_paper->questions;

$result=json_decode(get_test_result($dbc,$student_id,$test_id));

$subjects=array();
// echo $result->result_json;
$res_json=json_decode($result->result_json);

foreach($res_json as $res)
{
	// echo $subjects[$res->subject];
	if(!array_key_exists($res->subject, $subjects)){
		$subjects[$res->subject]=new stdClass;
		$subjects[$res->subject]->name=$res->subject;
		$subjects[$res->subject]->right=0;
		$subjects[$res->subject]->wrong=0;
		$subjects[$res->subject]->attempted=0;

	}
	if($res->choice!=0)
	{
		if($res->choice == $res->correct_ans)
		{
			$subjects[$res->subject]->right++;
		}
		else{
			$subjects[$res->subject]->wrong++;
		}
		$subjects[$res->subject]->attempted++;
	}
	
}

echo json_encode($subjects);


// echo json_encode($tests);

//echo $test->name;

?>


<!DOCTYPE html>
<html>


<head>
	<title></title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
	<script src="js/registration.js"></script>
	<link rel="stylesheet" type="text/css" href="nlf/css/default.css" />
	<link rel="stylesheet" type="text/css" href="nlf/css/component.css" />
	<script src="nlf/js/modernizr.custom.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
	<link rel="stylesheet" type="text/css" href="css/main.css" />


<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
	
	<style>
		@font-face {
    font-family: myFirstFont;
    src: url(../fonts/thinItalic.ttf);
}
@font-face {
    font-family:drugs-font;
    src: url(../fonts/Drugs.otf);
}
@font-face {
    font-family: cursive;
    src: url(../fonts/segoeuil.ttf);
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
		font-family: drugs-font;}
	h2{
		font-family: drugs-font;}
	h3{
		font-family: drugs-font;}
	h4{
		font-family: drugs-font;}
	h5{
		font-family: drugs-font;}
	h6{
		font-family: drugs-font;}
	a{
		font-family: drugs-font;}
	p{
		font-family: drugs-font;
	}

	</style>

</head>
<!-- <body style="background:#f2f7f9"> -->
<body >
<div class="back">
</div>


<?php 
	include("side_drawer.php");
	include("top.php");


	?>


<div class="w3-left w3-padding" style="opacity:0.98;margin-top:10%;width:100%;margin-bottom:10%;">
	<div class="body w3-round w3-light-grey w3-text-grey" style="margin-top:0px;margin-bottom:0%;padding:0px;">
		<div class="w3-row">
			<div class="w3-half w3-padding w3-text-grey">
				<h2>RESULT: <?php echo $test->name; ?></h2>
			</div>
			<div class="w3-half w3-text-grey w3-padding">
				<h1>Test ID: <?php echo $test->id; ?></h1>
			</div>
		</div>
		<div class="w3-row">
			<div class="w3-half w3-padding">
				<h4>Total Aquired<h4>
					<h1 class="w3-text-teal w3-center">345/540</h1>
					<h4>Total Questions<h4>
					<h1 class="w3-text-teal w3-center">90</h1>

			</div>
			<div class="w3-half w3-padding">
				<div style="width:100%">
					<canvas id="chart-area"></canvas>
				</div>
			</div>
			
		</div>
		<!-- <hr> -->
		<div class="w3-row w3-white w3-text-teal">
			<div class="w3-third w3-padding w3-center">
				<div style="width:100%">
					Physics
				</div>
				<div style="width:100%">
					<canvas id="s1-chart-area"></canvas>
				</div>

			</div>
			<div class="w3-third w3-padding w3-center">
				<div style="width:100%">
					Chemistry
				</div>
				<div style="width:100%">
					<canvas id="s2-chart-area"></canvas>
				</div>
			</div>
			<div class="w3-third w3-padding w3-center">
				<div id="s3-canvas-holder" style="width:100%">
					Mathematics
				</div>
				<div style="width:100%">
					<canvas id="s3-chart-area"></canvas>
				</div>
			</div>
			
		</div>

		<!-- <div class="w3-row w3-dark-grey w3-padding">
			<div class="w3-third w3-padding">
				<div style="width:100%">
					<canvas id="s1-chart-area"></canvas>
				</div>

			</div>
			<div class="w3-third w3-padding">
				<div style="width:100%">
					<canvas id="s2-chart-area"></canvas>
				</div>
			</div>
			<div class="w3-third w3-padding">
				<div id="s3-canvas-holder" style="width:100%">
					<canvas id="s3-chart-area"></canvas>
				</div>
			</div>
			
		</div> -->

		<?php

		// include("");

			?>



	</div>
	
</div>




	
	
	<script>
	window.chartColors = {
	red: 'rgb(255, 0, 0)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 19)',
	// blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(100, 3, 207)',
};

var config = {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
						9,2,1
					],
					backgroundColor: [
						window.chartColors.green,
						window.chartColors.red,
						window.chartColors.grey
						
					],
					label: 'Dataset 1'
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
var s1 = {
			type: 'pie',
			data: {
				datasets: [{
					data: [
						5,1,4
					],
					backgroundColor: [
						window.chartColors.green,
						window.chartColors.red,
						window.chartColors.grey
						
					],
					label: 'Physics'
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
		};
var s2 = {
			type: 'pie',
			data: {
				datasets: [{
					data: [
						3,9,4
					],
					backgroundColor: [
						window.chartColors.green,
						window.chartColors.red,
						window.chartColors.grey
						
					],
					label: 'Chemistry'
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
		};

var s3 = {
			type: 'pie',
			data: {
				datasets: [{
					data: [
						1,1,9
					],
					backgroundColor: [
						window.chartColors.green,
						window.chartColors.red,
						window.chartColors.grey
						
					],
					label: 'Mathematics'
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
		};

		window.onload = function() {
			var ctx = document.getElementById('chart-area').getContext('2d');
			var ctx1 = document.getElementById('s1-chart-area').getContext('2d');
			var ctx2 = document.getElementById('s2-chart-area').getContext('2d');
			var ctx3 = document.getElementById('s3-chart-area').getContext('2d');
			window.myPie = new Chart(ctx, config);
			window.myPie1 = new Chart(ctx1, s1);
			window.myPie2 = new Chart(ctx2, s2);
			window.myPie3 = new Chart(ctx3, s3);
		};

		document.getElementById('randomizeData').addEventListener('click', function() {
			config.data.datasets.forEach(function(dataset) {
				dataset.data = dataset.data.map(function() {
					return randomScalingFactor();
				});
			});

			window.myPie.update();
		});

		var colorNames = Object.keys(window.chartColors);
		document.getElementById('addDataset').addEventListener('click', function() {
			var newDataset = {
				backgroundColor: [],
				data: [],
				label: 'New dataset ' + config.data.datasets.length,
			};

			for (var index = 0; index < config.data.labels.length; ++index) {
				newDataset.data.push(randomScalingFactor());

				var colorName = colorNames[index % colorNames.length];
				var newColor = window.chartColors[colorName];
				newDataset.backgroundColor.push(newColor);
			}

			config.data.datasets.push(newDataset);
			window.myPie.update();
		});

		document.getElementById('removeDataset').addEventListener('click', function() {
			config.data.datasets.splice(0, 1);
			window.myPie.update();
		});
//carousel();
</script>





</body>

</html>
