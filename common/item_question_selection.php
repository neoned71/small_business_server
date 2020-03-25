<div class="w3-white w3-round w3-margin-top">
	<div class="w3-white w3-round w3-row">
			<div class="w3-black w3-text-teal w3-padding w3-col" style="margin:0px;width:10%">
				<h6 class="">Q<?php echo $question->id; ?></h6>
			</div>
			<div class="w3-white w3-text-blue w3-col w3-padding w3-center" style="margin:0px;width:15%;overflow:hidden">
				<h6><?php echo $question->question; ?><h6>
				
			</div>


			<div class=" w3-col w3-padding w3-text-teal" style="margin:0px;width:20%">
				<h6><?php echo strtoupper($question->subject); ?><h6>
			</div>
			<div class="w3-white w3-col w3-padding w3-text-teal" style="margin:0px;width:25%">
				<h6><?php echo $result->time." sec"; ?><h6>
				
			</div>
			
			
			<div class=" w3-col w3-padding w3-text-teal w3-center" style="margin:0px;width:20%">
				<h6><h6>
			</div>

			<a class="w3-center w3-hover-white w3-col" onclick="solutionToggle('sol<?php  echo $question_number; ?>');" style="margin:0px;width:10%"><div class=" w3-white w3-text-dark-grey w3-hover-light-grey w3-hover-text-black w3-padding" >
				
				<h6 class=""><i class="fa fa-angle-double-down"></i></h6>
			</div></a>
</div>


<div id="sol<?php echo $question_number; ?>" class="w3-white w3-round w3-row w3-border w3-card w3-hide">

			<div class="w3-white w3-text-black w3-padding w3-half w3-center">
				<div class="w3-half ">
			
					<h6 class="w3-padding">
					<?php echo $question->question; ?>
					</h6>
					<div class=" w3-padding">
						<h2 class="w3-text-teal w3-center w3-round">OPTIONS</h2>
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
								//echo "#$#";
								echo '<h6><img class="option_image" src="'.$question_images.'/'.$options->value.'" /></h6>';
							}
							else
							{
							//	echo "123";
								echo $options->value.'<br>';
							}
						}
						?>
					</div>
				</div>	
		<?php echo '<div class="w3-half"><img src="'.$question_images.'/'.$question->image.'" class="question_image"></div>'; ?> 
			</div>
			<div class=" w3-text-teal w3-padding w3-half w3-center">
				Solution
				<?php
				if(!empty($solution->image)){
					echo "<img src='".$question_images."/".$solution->image."' class='question_image' />"; 
				}

				if(!empty($solution->text))
				{
					echo '<h6 style="overflow:scroll">'.$solution->text.'</h6>';
				}
				
				?>
				
			</div>
			
</div>
</div>