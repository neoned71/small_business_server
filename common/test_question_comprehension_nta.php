<div class="question w3-border">
	<?php
		$comprehension=$question->comprehension;

	?>
	<div class="w3-center comprehension">
		<div class="w3-white w3-col w3-padding w3-center w3-text-teal" style="margin:0px;width:100%">
				 <h3></h3>
				<h4 class="w3-text-teal w3-light-grey w3-hover-white w3-center w3-round w3-card" style="cursor:pointer;" onclick="qstFull();">Q<?php echo $question_number; ?></h4>
				<br><hr>

				

					
			</div>
		<h2 class="w3-text-teal w3-center w3-round">COMPREHENSION</h2>
		<?php 
		if(!empty($comprehension->content->text))
		{
			echo $comprehension->content->text;
		}
		if(!empty($comprehension->content->image))
		{
			echo '<hr><img src="'.$question_images.'/'.$comprehension->content->image.'" style="max-height:300px;">';
		}

		?>
		
		
	</div>
	<div class="w3-padding ">
			
			<h6 class="w3-padding">
			<?php echo $question->question; ?>
			</h6>
			<?php
			if(!empty($question->image))
			{
				echo '<div class=" w3-padding"><img src="'.$question_images.'/'.$question->image.'" class="question_image">'; 
			}
			 ?> 
		<div class="w3-padding">
			
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
					echo '<h6><input id="'.$question_number.'-'.$option_number.'" class="w3-margin" type="radio" name="ans'.$question_number.'" onclick="toggleComprehensionOption(this.id)" '.$marked.'><img class="option_image" src="'.$question_images.'/'.$options->value.'" /></h6><br><hr>';
				}
				else
				{
					echo '<input id="'.$question_number.'-'.$option_number.'" class="w3-margin" type="radio" name="ans'.$question_number.'" onclick="toggleComprehensionOption(this.id)" '.$marked.'>'.$options->value.'<br><hr>';
				}
			}
			?>
		</div>
	</div>	
	
		
</div>
