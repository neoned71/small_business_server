<div class="question w3-row">
	<style>
		.martrix-match-item{height: 100px;}
		.martrix-match-item-holder{padding:20px;height:130px}
	</style>
	<div class="w3-half w3-padding">
			<h2 class="w3-text-teal w3-center w3-round">QUESTION</h2>
			<div class="w3-padding w3-margin">
			<?php
			foreach($question->question as $key)
			{
				if($key->type=="image"){
					echo '<br><b><i>'.$key->label.'</i></b>: <img class="martrix-match-item w3-margin" src="'.$question_images.'/'.$key->value.'" \><br>'; 
				}
				else{
					echo '<br><b><i>'.$key->label.'</i></b>: '.stripslashes($key->value).'';
				}
			}
			

			
			?>
			
			
			</div>
		</div>
		<div class="w3-half w3-padding">
			<h2 class="w3-text-teal ">OPTIONS</h2>
			<?php
			$question_options=$question->options;
			$option_number=0;
			$i=0;
			$a=["Assertion is true, Reason is true Reason is a correct explanation for Assertion","Assertion is true, Reason is true, Reason is not a correct explanation for Assertion","Assertion is true, Reason is False","Assertion is False, reason is true"];
			for(;$i<4;$i++)
			{
				$marked=null;
				$option_number++;
				if(!empty($state) and $state->choice==$option_number)
				{
					$marked="checked";
				}
				echo '<input id="'.$question_number.'-'.$option_number.'" class="w3-margin" type="radio" name="ans'.$question_number.'" onclick="toggleAssertionReasonOption(this.id)" '.$marked.'>'.$a[$i].'<br>';
			}
			?>
		</div>
	

</div>