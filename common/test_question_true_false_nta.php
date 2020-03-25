<div class="question w3-border">
	<div class="">
			<div class="w3-white w3-padding w3-center w3-text-teal" style="margin:0px;width:100%">
				 <h3></h3>
				<h4 class="w3-text-teal w3-light-grey w3-hover-white w3-center w3-round w3-card" style="cursor:pointer;" onclick="qstFull();">Q<?php echo $question_number; ?></h4>
				<br><hr>

				

					
			</div>
			<h2 class="w3-text-teal w3-center w3-round">True False</h2>
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
			$question_options=["True","False"]
			$option_number=0;

			foreach($question_options as $options)
			{
				$marked=null;
				$option_number++;
				if(!empty($state) and $state->choice==$option_number)
				{
					$marked="checked";
				}
				
				echo '<input id="'.$question_number.'-'.$option_number.'" class="w3-margin" type="radio" name="ans'.$question_number.'" onclick="toggleOption(this.id)" '.$marked.'>'.$options->value.'<br>';
				
			}
			?>
		</div>
	</div>	
	
		
</div>
