<div class="question w3-border w3-margin">
	<style>
		.martrix-match-item{height: 100px;}
		.martrix-match-item-holder{padding:20px;height:130px;}
	</style>
	<div class="w3-padding ">
		<div class="w3-white w3-col w3-padding w3-center w3-text-teal" style="margin:0px;width:100%">
				 
				<h4 class="w3-text-teal w3-light-grey w3-hover-white w3-center w3-round w3-card" style="cursor:pointer;" onclick="qstFull();">Q<?php echo $question_number; ?></h4>
		</div>
		<h2 class="w3-text-teal w3-center w3-round">Matrix Match</h2>
			
		<div class="w3-margin w3-container">
		<?php
		foreach($question->question as $key)
		{
			if($key->type=="image"){
				echo '<div class="martrix-match-item-holder w3-half w3-border">'.$key->label.') <img class=" w3-center martrix-match-item" src="'.$question_images.'/'.$key->value.'" ></div>';
			}
			else{
				echo '<div class="w3-border w3-half martrix-match-item-holder" >'.$key->label.') '.stripslashes($key->value).'</div>';
			}
		}
		

		
		?>
		
		</div>
			<div class="w3-padding" style="margin-top:20px;">

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
				
				echo '<div class="w3-row w3-margin w3-padding"> <input id="'.$question_number.'-'.$option_number.'" class=" w3-col" style="width:10%" type="radio" name="ans'.$question_number.'" onclick="toggleSingleOption(this.id)" '.$marked.'><div class="w3-col" style="width:80%" >'.$options->value.'</div></div><hr>';
				
			}
			?>
		</div>
		</div>
		<br><br><hr>
		
	

</div>