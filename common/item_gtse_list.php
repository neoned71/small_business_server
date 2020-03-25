<div class="w3-white w3-round w3-margin-top">
	<div class="w3-white w3-round w3-row">
		<style type="text/css">
			.martrix-match-item{height: 100px;}
			.martrix-match-item-holder{padding:20px;height:130px;}
		</style>
		
		<div class="w3-black w3-text-teal w3-padding w3-col w3-center" style="margin:0px;width:10%">
			
			<h3 class="">Q<?php echo $i; ?></h3>
		</div>

		<?php 
		
			echo '<div class="w3-white w3-text-green w3-col w3-padding w3-center" style="margin:0px;width:15%">
			<h6>'.$gtse->name.'</i></h6></div>';
		
		
		?>
		
		<div class=" w3-col w3-padding w3-text-dark-grey" style="margin:0px;width:15%">
			<h6><?php echo $gtse->phone; ?></h6>
		</div>
		<div class="w3-white w3-col w3-padding w3-text-dark-grey" style="margin:0px;width:10%">
			<h6><?php echo $gtse->phone; ?></h6>
			
		</div>

		<div class="w3-white w3-col w3-padding w3-text-dark-grey" style="margin:0px;width:10%">
			<h6><?php echo $gtse->guardian_name; ?></h6>
			
		</div>
		
		<div class="w3-white w3-col w3-padding w3-text-dark-grey" style="margin:0px;width:10%">
			<h6>Correct:<?php echo ($result->correct_ans); ?></h6>
			
		</div>
				
				
				
		<div class=" w3-col w3-padding w3-text-black w3-center" style="margin:0px;width:20%">
			<h6>Marks:<?php 
				if($result->choice == $result->correct_ans)
				{
					echo explode("::",$question->marking)[0]; 
				}
				else if($result->choice != 0)
				{
					echo explode("::",$question->marking)[1]; 

				}
				else
				{
					echo "0"; 

				}
				

				?></h6>
		</div>

		<a class="w3-center w3-hover-white w3-col" onclick="solutionToggle('sol<?php  echo $question_number; ?>');" style="margin:0px;width:10%">
			<div class=" w3-white w3-text-dark-grey w3-hover-light-grey w3-hover-text-black w3-padding" >
			
				<h6 class=""><i class="fa fa-angle-double-down"></i></h6>


			</div>
		</a>
	</div>
</div>



<div id="sol<?php echo $question_number; ?>" class="w3-white w3-round w3-row w3-border w3-card w3-hide">
	<div class="w3-white w3-text-black w3-padding w3-half w3-center">
		QUESTION
		<?php
		if($question->question_type==3)
		{
			$comp=$question->comprehension->content;
			echo "<h6>COMPREHENSION</h6>";
			if(!empty($comp->text))
			{
				echo "<h6>".$comp->text."</h6>";
			}
			if(!empty($comp->image))
			{
				echo "<img src='question_images/".$comp->image."' class='question_image' />";
			}
		}


		if($question->question_type==1 or $question->question_type==2 or $question->question_type==3 or $question->question_type==5 or $question->question_type==6 or $question->question_type==7 or $question->question_type==9 or $question->question_type==11)
		{
			if(!empty($question->image))
			{
				echo "<img src='question_images/".$question->image."' class='question_image' />";
			}
			if(!empty($question->question))
			{
				echo "<h6>".$question->question."</h6>";
			}

		}
		else if($question->question_type==4){
			echo '<div class="w3-row">';
	
			foreach($question->question as $key)
			{
				if($key->type=="image"){
					echo '<div class="martrix-match-item-holder w3-half">'.$key->label.') <img class=" w3-center martrix-match-item" src="question_images/'.$key->value.'" /></div>';
				}
				else{
					echo '<div class=" w3-half martrix-match-item-holder" >'.$key->label.') '.stripslashes($key->value).'</div>';
				}
			}

			echo '</div>';

		}
		else if($question->question_type==10){
			echo '<div class="w3-row">';
	
			foreach($question->question as $key)
			{
				if($key->type=="image"){
					echo '<div class="martrix-match-item-holder w3-third">'.$key->label.') <img class=" w3-center martrix-match-item" src="question_images/'.$key->value.'" /></div>';
				}
				else{
					echo '<div class=" w3-third martrix-match-item-holder" >'.$key->label.') '.stripslashes($key->value).'</div>';
				}
			}

			echo '</div>';

		}
		else if($question->question_type==8){
			
	
			foreach($question->question as $key)
			{
				if($key->type=="image"){
					echo '<div class="martrix-match-item-holder">'.$key->label.': <img class=" w3-center martrix-match-item" src="question_images/'.$key->value.'" /></div>';
				}
				else{
					echo '<div class="martrix-match-item-holder" >'.$key->label.': '.stripslashes($key->value).'</div>';
				}
			}

			

		}
		?>
	
	</div>
	<div class=" w3-text-teal w3-padding w3-half w3-center">
		SOLUTION
		<?php 
		// echo json_encode($solution);
		if(!empty($solution->image)){
			echo "<img src='question_images/".$solution->image."' class='question_image' />"; 
		}

		if(!empty($solution->text))
		{
			echo '<h6 style="overflow:scroll">'.$solution->text.'</h6>';
		}
		
		?>
		
	</div>
</div>