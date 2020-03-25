
	<div class=" submit-top w3-round w3-margin w3-round" style="opacity:01;" onclick="askForFinish();">
		<h5 class="w3-button w3-hover-teal w3-black w3-padding w3-margin w3-round" style="width:90%;">SUBMIT PAPER</h5>
	</div>
	<div class="small-top-test">

		<!-- here -->
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
		array_push($qstns[$subject],'<a href="#" class="question_number_2 w3-text-teal w3-white w3-center w3-round w3-card" onclick="showQuestion2('.$question_number.',3)">Q'.$question_number.'.<i id="star_2_'.$question_number.'" class="star_2 fa fa-star w3-text-grey text_small" aria-hidden="true"></i></a>');

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
		array_push($qstns[$subject],'<a href="#" class="question_number_2 w3-text-teal w3'.$col.' w3-center w3-round w3-card" onclick="showQuestion2('.$question_number.',3)">Q'.$question_number.'.<i id="star_2_'.$question_number.'" class="star_2 fa fa-star w3-text-grey text_small" aria-hidden="true"></i></a>');
	}
}

// echo json_encode($qstns);

?>


		<?php
		foreach ($qstns as $key => $value) {
			
			foreach($value as $qtag)
			{
				echo $qtag;
			}
			
			# code...
		}

		?>

	</div>

