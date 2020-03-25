<div class="question w3-row w3-margin">
	<style>
		.martrix-match-item{height: 100px;}
		.martrix-match-item-holder{padding:20px;height:130px;}
	</style>
	<div class="w3-half ">
			<h2 class="w3-text-teal w3-center w3-round">QUESTION</h2>
			<div class="w3-row">
			<?php
			
			
			foreach($question->question as $key)
			{
				if($key->type=="image"){
					echo '<div class="martrix-match-item-holder w3-third">'.$key->label.') <img class=" w3-center martrix-match-item" src="'.$question_images.'/'.$key->value.'" ></div>';
				}
				else{
					echo '<div class="w3-third martrix-match-item-holder" >'.$key->label.') '.stripslashes($key->value).'</div>';
				}

			
			}
			

			
			?>
			
			</div>
		</div>
		<div class="w3-half w3-padding">
			<h2 class="w3-text-teal w3-center w3-round">OPTIONS</h2>
			<?php
			// $question_options=$question->options;
			// $option_number=0;
			// $i=0;
			// $a=["A~S, B~R, C~Q, D~P","A~Q, B~S, C~R, D~P","A~R, B~S, C~P, D~Q","A~R, B~S, C~P, D~R"];
			// for(;$i<4;$i++)
			// {
			// 	$marked=null;
			// 	$option_number++;
			// 	if(!empty($state) and $state->choice==$option_number)
			// 	{
			// 		$marked="checked";
			// 	}
			// 	echo '<input id="'.$question_number.'-'.$option_number.'" class="w3-margin" type="radio" name="ans'.$question_number.'" onclick="toggleOption(this.id)" '.$marked.'>'.$a[$i].'<br>';
			// }
			?>
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
					echo '<h6><input id="'.$question_number.'-'.$option_number.'" class="w3-margin" type="radio" name="ans'.$question_number.'" onclick="toggleOption(this.id)" '.$marked.'><img class="option_image" src="'.$question_images.'/'.$options->value.'" /></h6><hr>';
				}
				else
				{
				//	echo "123";
					echo '<input id="'.$question_number.'-'.$option_number.'" class="w3-margin" type="radio" name="ans'.$question_number.'" onclick="toggleOption(this.id)" '.$marked.'>'.$options->value.'<br><hr>';
				}
			}
			?>
		</div>
	

</div>