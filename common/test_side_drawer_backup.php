<div class="side_drawer w3-round" style="margin-top:10%;">
	<!-- <a class="logo w3-center" href="#" style="width:80%;height:150px;margin-top:15%;margin-bottom:15%;opacity:01;margin-left:auto;margin-right:auto;display:block"></a> -->
	<div class="w3-text-dark-grey w3-hover-text-black w3-padding" >
		<h2 class="w3-text-cyan w3-round w3-margin w3-padding w3-center" style="width:100%;">
			Time:<span class="w3-text-red clock"><?php 
			if(is_null($test_status)){
				echo $test->duration_minutes.":00";
			}
			else
			{
				echo $test_status->lrt;
			}
			




			 ?></span>
		</h2>
		
	</div>
	<hr>
	<?php
		$question_number=0;
		$total_questions=count($questions);
		$subjects=array();
		$qstns=array();
		// $i=0;

foreach($questions as $question)
{
	// $i++;
	// if(empty($question))
	// {
	// 	echo $i;
	// }
	$subject=$question->subject;
	if(!isset($qstns[$subject]))
	{
		$qstns[$subject]=array();
	}
	$col="-black";
	if(!empty($test_status))
	{
		$state=$test_status->test_status[$question_number];
	}
	$question_number++;
	if($question_number==1)
	{
		array_push($qstns[$subject],'<a href="#" class="question_number w3-col w3-text-teal w3-white w3-center w3-round w3-card" onclick="showQuestion('.$question_number.')">Q'.$question_number.'.<i id="star'.$question_number.'" class="star fa fa-star w3-text-grey text_small" aria-hidden="true"></i></a>');

	}
	else
	{
		// echo json_encode($state);
		if(!empty($state->visited) and $state->choice!=0)
		{
			// echo "yes1";
			$col="-green";
		}
		else if(!empty($state->visited) and $state->choice==0)
		{
			// echo "yes2";
			$col="-dark-grey";
		}
		array_push($qstns[$subject],'<a href="#" class=" question_number w3-col w3-text-teal w3'.$col.' w3-center w3-round w3-card" onclick="showQuestion('.$question_number.')">Q'.$question_number.'.<i id="star'.$question_number.'" class="star fa fa-star w3-text-grey text_small" aria-hidden="true"></i></a>');
	}
}

// echo json_encode($qstns);

?>
	<div class="w3-row w3-margin w3-margin w3-round">
			<?php
		foreach ($qstns as $key => $value) {
			echo '<div class="w3-third w3-padding w3-center">'.$key.'</div>';
			# code...
		}


		?>
			
		</div>
	<div class="w3-row w3-margin w3-right w3-round" style="max-height:300px;overflow-y: scroll">
		<!-- here -->
		<?php
		foreach ($qstns as $key => $value) {
			echo '<div id="qst_tab_'.$key.'" style="display:block;">';
			foreach($value as $qtag)
			{
				echo $qtag;
			}
			echo '</div>';
			# code...
		}


		?>


	</div>
	
	
<hr>
	<div class="w3-round w3-margin w3-round" style="opacity:01;" onclick="askForFinish();">
		<h5 class="w3-button w3-hover-teal w3-black w3-padding w3-margin w3-round" style="width:90%;">SUBMIT PAPER</h5>
	</div>
	
		
</div>
