<div class="question w3-border">
	<div class="">

		<div class="w3-white w3-col w3-padding w3-center w3-text-teal" style="margin:0px;width:100%">
				 <h3></h3>
				<h4 class="w3-text-teal w3-light-grey w3-hover-white w3-center w3-round w3-card" style="cursor:pointer;" onclick="qstFull();">Q<?php echo $question_number; ?></h4>
				<br><hr>

				

					
			</div>
			<h2 class="w3-text-teal w3-center w3-round">Single Answer Type</h2>
			
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
	<div class=" w3-padding">
			
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
					if(strpos($options->value, 'http') !== false)
					{
						echo '<h6><input id="'.$question_number.'-'.$option_number.'" class="w3-margin" type="radio" name="ans'.$question_number.'" onclick="toggleSingleOption(this.id)" '.$marked.'><img class="option_image" src="'.$options->value.'" /></h6>';
					}
					else
					{
						echo '<h6><input id="'.$question_number.'-'.$option_number.'" class="w3-margin" type="radio" name="ans'.$question_number.'" onclick="toggleSingleOption(this.id)" '.$marked.'><img class="option_image" src="'.$question_images.'/'.$options->value.'" /></h6>';
					}
					
				}
				else
				{
					echo '<div class="w3-row"> <input id="'.$question_number.'-'.$option_number.'" class="w3-margin w3-col" style="width:10%" type="radio" name="ans'.$question_number.'" onclick="toggleSingleOption(this.id)" '.$marked.'><div class="w3-col" style="width:80%" >'.$options->value.'</div></div><hr>';
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