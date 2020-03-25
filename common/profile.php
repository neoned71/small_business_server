<?php
include("../common/initialization.php");
include("../common/check_login.php");
$login=json_decode(get_student($dbc,$login->id));
$student=$login;
$name=$student->name;
$pic_path=$display_picture_path."/".$student->pic_path;

$user=json_decode($_SESSION['data_json']);
if(empty($_GET['student_id'])){
	$student=json_decode(get_student($dbc,$user->id));
}
else
{
	$student=json_decode(get_student($dbc,handle_escaping($_GET['student_id'])));
}

$student_id=$student->id;
// $package_id=$student->package_id;
// // echo $package_id;
// $package=json_decode(get_package($dbc,$package_id));
// $subject_ids=$package->subject_available_ids;
// if($subject_ids=="1:2:3")
// {
// 	$subjects="P C M";
// }
// else if($subject_ids=="1:2:4")
// {
// 	$subjects="P C B";
// }
// else
// {
// 	$subjects="-";
// }
// $plan_id=$student->plan_id;
// $plan=json_decode(get_plan($dbc,$plan_id));
// $class=$plan->class;

$class="-";
$rank_obj=json_decode(get_rank($dbc,$student_id));
if(empty($rank_obj))
{
	$rank="-";
}
else{
	$rank=$rank_obj->rank;
}

$performance=json_decode(get_performance_student($dbc,$student_id));
$test_results=$performance->test_results;
$average_percentage=$performance->average_percentage;
$tests_count=$performance->tests_given_count;
$data=$student;
$first_name=$data->first_name;
		$last_name=$data->last_name;
		$name=$data->name=$first_name." ".$last_name;
		$pic_path=$data->pic_path;
		$phone=$data->phone;
		$email=$data->email;
		// $data->username=$row['username'];
		// $data->password=$row['password'];
		$gender=$data->gender;
		$dob=$data->date_of_birth;
		// $package_id=$data->package_id;
		//$fee=$data->fee;
		$classs=$data->class;
		//$contact=$data->contact;
		
// echo $user->id;
// $tests=json_decode(get_tests($dbc,$class_id,$package_id));

// $test_id=handle_escaping($dbc,$_GET['test_id']);
// $test=json_decode(get_test($dbc,$test_id));
// $questions=$test->test_paper->questions;

// $max_marks=$test->test_paper->total_marks;

// $result=json_decode(get_test_result($dbc,$student_id,$test_id));
// $total_scored=$result->marks_obtained;

// $total_questions=new stdclass;
// $total_questions->right=0;
// $total_questions->wrong=0;
// $total_questions->not_attempted=0;
// $total_questions->attempted=0;



// $subjects=array();
// // echo $result->result_json;
// $res_obj=json_decode($result->result_json);

// foreach($res_obj as $res)
// {
// 	// echo $subjects[$res->subject];
// 	if(!array_key_exists($res->subject, $subjects)){
// 		$subjects[$res->subject]=new stdClass;
// 		$subjects[$res->subject]->name=$res->subject;
// 		$subjects[$res->subject]->right=0;
// 		$subjects[$res->subject]->wrong=0;
// 		$subjects[$res->subject]->attempted=0;
// 		$subjects[$res->subject]->not_attempted=0;


// 	}
// 	if($res->choice!=0)
// 	{
// 		if($res->choice == $res->correct_ans)
// 		{
// 			$subjects[$res->subject]->right++;
// 			$total_questions->right++;
// 		}
// 		else{
// 			$subjects[$res->subject]->wrong++;
// 			$total_questions->wrong++;
// 		}
// 		$subjects[$res->subject]->attempted++;
// 		$total_questions->attempted++;
// 	}
// 	else{
// 		$total_questions->not_attempted++;
// 		$subjects[$res->subject]->not_attempted++;
// 	}
	
// }

// $total_questions->number=$total_questions->attempted + $total_questions->not_attempted;
?><!DOCTYPE html>
<html>


<head>
	<title></title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/main.css" />
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
.small-font{
  font-size: 90%;
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
<script type="text/javascript">
	window.chartColors = {
	red: 'rgb(255, 0, 0)',
	teal: 'rgb(0,100, 100)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 19)',
	purple: 'rgb(153, 102, 255)',
	white: 'rgb(255, 255, 255)',
	grey: 'rgb(200, 200, 207)'
};

var config = {
			type: 'line',
			data: {
				datasets: [{
					data: [0,
					<?php 
					$i=0;
					foreach($test_results as $tr)
					{
						echo $tr->percentage.",";
					}

					?>
					],
					backgroundColor: window.chartColors.grey,
					borderColor: window.chartColors.teal,
					label: 'Percentage plot'
				}],
				labels: [0,
					<?php 
					foreach($test_results as $tr)
					{
						echo $tr->date.",";
					}

					?>
					
				],
				fill:false
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
</head>
<!-- <body style="background:#f2f7f9"> -->
<body >
<div class="back">
</div>


<?php 
	$page="Profile Page";

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
		include("../faculty/side_drawer.php");
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


<div class="body w3-left w3-padding w3-round" style="opacity:0.98;margin-top:10%;width:100%;margin-bottom:0%;">
	<h1 class="w3-margin w3-text-blue">Profile</h1> 
	<div class="w3-row w3-padding w3-round w3-margin">
		<div class="w3-col w3-card w3-round w3-white w3-margin" style="width:20%;">
			<p class="w3-dark-grey  w3-padding small-font">NAME</p>
			<h1 class="w3-text-cyan medium-font  w3-center w3-margin"><?php echo strtoupper($name); ?></h1>
		</div>
		<div class="w3-col w3-round w3-card w3-white w3-margin" style="width:20%;">
			<p class="w3-dark-grey w3-padding small-font">CLASS</p>
			<h3 class="w3-text-teal medium-font  w3-center w3-margin"><?php echo $class; ?></h3>
		</div>
		<div class="w3-col w3-round w3-card w3-white w3-margin" style="width:20%;">
			<p class="w3-dark-grey w3-padding small-font">GENDER</p>
			<h3 class="w3-text-teal medium-font  w3-center  w3-margin"><?php echo strtoupper($gender); ?></h3>
		</div>
		
		<div class="w3-col w3-white  w3-round w3-card w3-black w3-margin" style="width:20%;">
			<p class="w3-dark-grey w3-padding small-font">OVERALL RANK</p>
			<h3 class="w3-text-white big-font  w3-center  w3-margin"><?php echo $rank; ?></h3>
		</div>
		<div class="w3-col w3-white  w3-round w3-card w3-white w3-margin" style="width:20%;">
			<p class="w3-dark-grey w3-padding small-font">TESTS GIVEN</p>
			<p class="w3-text-teal big-font w3-center w3-margin"><?php echo $tests_count; ?></p>
		</div>
		<div class="w3-col w3-white  w3-round w3-card w3-white w3-margin" style="width:20%;">
			<p class="w3-dark-grey w3-padding small-font">AVERAGE %</p>
			<p class="w3-text-teal big-font w3-center w3-margin"><?php echo number_format($average_percentage,2); ?>%</p>
		</div>
		<div class="w3-col w3-white w3-round w3-card w3-margin" style="width:64%;">
			<p class="w3-dark-grey w3-padding small-font">PERFORMANCE</p>
			<canvas id="chart-area"></canvas>
		</div>

	</div>
	
	<div class="w3-row w3-padding  w3-round w3-margin">
		
		
	</div>
	
	<!-- <div class="w3-row w3-padding w3-round w3-margin">
		<h2>Package Details</h2>
		<div class="w3-col w3-white  w3-round w3-card w3-black w3-margin" style="width:20%;">
			<p class="w3-dark-grey w3-padding small-font">TYPE</p>
			<h3 class="w3-text-teal w3-center  w3-margin">JEE-MAINS</h3>
		</div>
		<div class="w3-col w3-white  w3-round w3-card w3-white w3-margin" style="width:20%;">
			<p class="w3-dark-grey w3-padding small-font">COST</p>
			<h3 class="w3-text-teal  w3-center  w3-margin">Rs. 3000</h3>
		</div>
		<div class="w3-col w3-white  w3-round w3-card w3-white w3-margin" style="width:20%;">
			<p class="w3-dark-grey w3-padding small-font">REGISTRATION DATE</p>
			<h3 class="w3-text-teal  w3-center  w3-margin">23/09/2018</h3>
		</div>
	</div> -->
	
</div>









</body>

</html>
