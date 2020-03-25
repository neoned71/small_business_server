<div class="question w3-row">
	<div class="w3-half ">
			<h2 class="w3-text-teal w3-center w3-round">QUESTION</h2>
			<h6 class="w3-padding">
			<?php

			if(!empty($question->question))
			{
				echo $question->question; 
			}


			  ?>
			</h6>
			<?php
			if(!empty($question->image))
			{
				echo '<div class=" w3-padding"><img src="'.$question_images.'/'.$question->image.'" class="question_image"></div>'; 
			}
			 ?> 
		
	</div>	
	<div class="w3-half w3-padding">
			<h2 class="w3-text-teal w3-center w3-round">OPTIONS</h2>
			<?php
			$question_options=$question->options;
			$option_number=0;

			foreach($question_options as $options)
			{
				$marked=null;
				$option_number++;
				if(!empty($state) and $state->choice==$option_number)
				{
					$marked="checked";
				}
				if($options->type=="image")
				{
					echo '<h6><input id="'.$question_number.'-'.$option_number.'" class="w3-margin" type="radio" name="ans'.$question_number.'" onclick="toggleSingleOption(this.id)" '.$marked.'><img class="option_image" src="'.$options->value.'" /></h6>';
				}
				else
				{
					echo '<input id="'.$question_number.'-'.$option_number.'" class="w3-margin" type="radio" name="ans'.$question_number.'" onclick="toggleSingleOption(this.id)" '.$marked.'>'.$options->value.'<br>';
				}
			}
			?>
		</div>
		
</div>
<?php
if($user->candidate_type_id==4 || $user->candidate_type_id==0 || $user->candidate_type_id==1)
{
	include 'correction_box.php';
}


?>