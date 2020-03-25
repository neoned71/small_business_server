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

			if(!empty($state) and count($state->multiple)>0)
			{
				$checked=$state->multiple;
			}

			foreach($question_options as $options)
			{
				$marked=null;
				$option_number++;
				if(!empty($checked) and in_array($option_number, $checked))
				{
					$marked="checked";
				}

				if($options->type=="image")
				{
					echo '<h6><input id="'.$question_number.'-'.$option_number.'" class="w3-margin" type="checkbox" name="ans'.$question_number.'" onclick="toggleMultipleOption(this.id)" '.$marked.'><img class="option_image" src="'.$question_images.'/'.$options->value.'" /></h6>';
				}
				else
				{
					echo '<input id="'.$question_number.'-'.$option_number.'" class="w3-margin" type="checkbox" name="ans'.$question_number.'" onclick="toggleMultipleOption(this.id)" '.$marked.'>'.$options->value.'<br>';
				}
			}
			?>
		</div>
		
</div>
