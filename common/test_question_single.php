<div class="question w3-row w3-margin">
	<div class="w3-half ">
			
			<h6 class="w3-padding">
			<?php echo $question->question; ?>
			</h6>
		<div class=" w3-padding">
			<h2 class="w3-text-teal w3-center w3-round">OPTIONS</h2>
			<?php
			$question_options=$question->options;
			$option_number=0;
			foreach($question_options as $options)
			{
				
				$marked=null;
				$option_number++;
				if($state and $state->choice==$option_number)
				{
					$marked="checked";
				}
				// echo "#$#$".$options;
				// $options=json_decode($options);
				
				if($options->type=="image")
				{
					//echo "#$#";
					echo '<h6><input id="'.$question_number.'-'.$option_number.'" class="w3-margin" type="radio" name="ans'.$question_number.'" onclick="toggleOption(this.id)" '.$marked.'><img class="option_image" src="'.$question_images.'/'.$options->value.'" /></h6>';
				}
				else
				{
				//	echo "123";
					echo '<input id="'.$question_number.'-'.$option_number.'" class="w3-margin" type="radio" name="ans'.$question_number.'" onclick="toggleOption(this.id)" '.$marked.'>'.$options->value.'<br>';
				}
			}
			?>
		</div>
	</div>
	
	
		<?php echo (isset($question->image) and !empty($question->image))?'<div class="w3-half"><img src="'.$question_images.'/'.$question->image.'" class="question_image"></div>':''; ?>



	


	
</div>
