<div class="side_drawer w3-round">
	<!-- <a class="logo w3-center" href="#" style="width:80%;height:150px;margin-top:15%;margin-bottom:15%;opacity:01;margin-left:auto;margin-right:auto;display:block"></a> -->
	<div class="w3-text-dark-grey w3-hover-text-black w3-padding" >
		<p class = "w3-text-black w3-center "><u><b>LEGENDS</b></u></p>
		<div class="w3-row w3-padding">
			<div class="w3-half w3-padding ">
				<span class="w3-margin"><img src="../images/unseen.png" style="height: 40px;"></span>Not Visited
			</div>
			<div class="w3-half w3-padding">
				<span class="w3-margin"><img src="../images/unanswered.png" style="height: 40px;"></span>Not Answered
			</div>
			<div class="w3-half w3-padding">
				<span class="w3-margin"><img src="../images/answered.png" style="height: 40px;"></span>Answered
			</div>
			<div class="w3-half w3-padding">
				<span class="w3-margin"><img src="../images/marked.png" style="height: 40px;"></span>Marked for Review
			</div>

			<div class="w3-half w3-padding w3-center">
				<span class="w3-margin"><img src="../images/marked_answered.png" style="height: 40px;"></span>Answered & Marked for Review
			</div>
		</div>
		<h4 class="w3-text-white"><?php
		if($test->test_type==2)
		{
			echo "Test Finishes automatically at: ".date("H:i",($start_unix+$duration_unix));
		}
		?>
	</h4>
		

		
		
	</div>
	<hr>
	<?php
		$question_number=0;
		$total_questions=count($questions);
		$subjects=array();
		$qstns=array();
		$links=array();
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
		$links[$subject]=$question_number+1;
		$qstns[$subject]=array();
	}
	$col="unseen_question";
	if(!empty($test_status))
	{
		$state=$test_status->test_status[$question_number];
		if(!isset($state->marked))
		{
			$state->marked=0;
		}
	}
	$question_number++;
	
		// echo json_encode($state);
		// $state->marked=1;

		if(!empty($state->visited) and $state->attempted==1 and $state->marked==1)
		{
			// echo "yes1";
			$col="marked_answered_question";
		}
		else if(!empty($state->visited) and $state->attempted==0 and $state->marked==1)
		{
			// echo "yes1";
			$col="marked_question";
		}
		else if(!empty($state->visited) and $state->attempted==1 and $state->marked==0)
		{
			// echo "yes1";
			$col="answered_question";
		}
		else if(!empty($state->visited) and $state->attempted==0)
		{
			// echo "yes2";
			$col="unanswered_question";
		}
		
		array_push($qstns[$subject],'<a href="#" class="question_number w3-col w3-padding'.$col.'" onclick="showQuestion('.$question_number.')">Q'.$question_number.'</a>');
	
}

// echo json_encode($qstns);

?>
	<div class="w3-row w3-margin w3-margin w3-round">
			<?php
		foreach ($qstns as $key => $value) {
			echo '<div class="w3-quarter w3-round w3-light-grey w3-hover-white w3-card  w3-center"><p class="w3-text-black " style="cursor:pointer"  onclick=showQuestion('.$links[$key].')>'.strtoupper($key).'</p></div>';
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
			
		}

		?>

	</div>
	
	
<hr>
	
	
		
</div>
