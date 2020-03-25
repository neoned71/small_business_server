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
			<h2 class="w3-text-teal w3-center w3-round">ANSWER</h2>
			<?php
				if(!empty($state) and !empty($state->choice))
				{
					echo '<input id="'.$question_number.'-field" class="w3-center w3-margin w3-border w3-round" type="text" value="'.$state->choice.'" name="ans'.$question_number.'" onkeyup="toggleIntegerOption(this.id)">';
				}
				else
				{
					echo '<input id="'.$question_number.'-field" class="w3-center w3-margin w3-border w3-round" type="text" name="ans'.$question_number.'" onkeyup="toggleIntegerOption(this.id)">';
				}
				
			
			?>
		</div>
		
</div>
