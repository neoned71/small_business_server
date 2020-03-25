<div class="question w3-border">
	
	<div class="w3-padding">
		<div class="w3-white w3-col w3-padding w3-center w3-text-teal" style="margin:0px;width:100%">
				 <h3></h3>
				<h4 class="w3-text-teal w3-light-grey w3-hover-white w3-center w3-round w3-card" style="cursor:pointer;" onclick="qstFull();">Q<?php echo $question_number; ?></h4>
				<br><hr>

				

					
			</div>
			<h2 class="w3-text-teal w3-center w3-round">Multiple Answer Type</h2>
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
		<div class=" w3-padding">
			
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
					echo '<h6><input id="'.$question_number.'-'.$option_number.'" class="w3-margin" type="checkbox" name="ans'.$question_number.'" onclick="toggleMultipleOption(this.id)" '.$marked.'><img class="option_image" src="'.$question_images.'/'.$options->value.'" /></h6><hr>';
				}
				else
				{
					echo '<input id="'.$question_number.'-'.$option_number.'" class="w3-margin" type="checkbox" name="ans'.$question_number.'" onclick="toggleMultipleOption(this.id)" '.$marked.'>'.$options->value.'<br><hr>';
				}
			}
			?>
		</div>
	</div>	
	
		
</div>
