<div class="question w3-border">
	<div class="w3-padding">

			
			<div class="w3-white w3-col w3-padding w3-center w3-text-teal" style="margin:0px;width:100%">
				 <h3></h3>
				<h4 class="w3-text-teal w3-light-grey w3-hover-white w3-center w3-round w3-card" style="cursor:pointer;" onclick="qstFull();">Q<?php echo $question_number; ?></h4>
				<br><hr>

				

					
			</div>
			<h2 class="w3-text-teal w3-center w3-round">Integer Answer Type</h2>
			
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
		
		<div class="w3-padding">
			<h2 class="w3-text-black w3-center w3-round">Answer</h2>
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
	
		
</div>
