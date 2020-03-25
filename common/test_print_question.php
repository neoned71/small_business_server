<div class="w3-margin w3-padding" style="border:0 0 1 1;margin-top:2%">
	<!-- <hr> -->
			
				<p><b><?php

				 echo "<span class='w3-text-teal'>".ucfirst($question->subject)."</span> ".$question_number; 

				 ?>. </b><?php
				if(!empty($question->question))
				{
					echo $question->question;
				}
				?></p>
				 <?php
				if(!empty($question->image))
				{
					echo '<img class="w3-center" style="max-width:500px;max-height:180px" style="margin-left:100px;" src="'.$question_images.'/'.$question->image.'">';
				}
				?>
				
				<table style="width:80%">
				
					<tr >
						<td style="width:50%">(A) <?php
						$op=$question->options;
						 if($op[0]->type=="text")
						 {
						 	echo $op[0]->value;
						 }
						 else if($op[0]->type=="image")
						 {
						 	echo '<img width="150px" src="'.$images.'/'.substr(($op[0]->value),3).'">';
						 }
						   ?></td>
						<td style="width:50%">(B) <?php
						 if($op[1]->type=="text")
						 {
						 	echo $op[1]->value;
						 }
						 else if($op[1]->type=="image")
						 {
						 	echo '<img width="150px" src="'.$images.'/'.substr(($op[1]->value),3).'">';
						 }
						   ?></td>
					</tr>
					
					<tr>
						<td style="width:50%">(C) <?php
						 if($op[2]->type=="text")
						 {
						 	echo $op[2]->value;
						 }
						 else if($op[2]->type=="image")
						 {
						 	echo '<img width="150px" src="'.$images.'/'.substr(($op[2]->value),3).'">';
						 }
						   ?></td> 
						<td style="width:50%">(D) <?php
						// $op=$question->options;
						 if($op[3]->type=="text")
						 {
						 	echo $op[3]->value;
						 }
						 else if($op[3]->type=="image")
						 {
						 	echo '<img width="150px" height="100%" src="'.$images.'/'.substr(($op[3]->value),3).'">';
						 }
						   ?></td>
					</tr>
					
		</table></div>