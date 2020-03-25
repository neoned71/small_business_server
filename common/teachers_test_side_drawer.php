<div id="nav" class="w3-round" style="margin-top:7%;width:20%;max-height:90%;overflow-y:scroll;">
	<div class="w3-text-dark-grey w3-hover-text-black w3-padding" >
		<h4 class="w3-text-white">Teachers Test</h4>
		<h2 class="w3-text-cyan w3-round w3-margin w3-padding w3-center" style="width:100%;">
			Time:<span class="w3-text-red clock"><?php 
			if(is_null($test_status)){
				if($test->test_type==3)
				{
					echo $test->duration_minutes.":00";
				}
				else if($test->test_type==4)
				{
					echo intval((($start_unix+$duration_unix)-$current_time)/60).":00";
				}
				
			}
			else
			{
				if($test->test_type==3)
				{
					echo $test_status->lrt;
				}
				else if($test->test_type==4)
				{
					echo intval((($start_unix+$duration_unix)-$current_time)/60).":00";
				}
			}
			 ?>
			 	
			 </span>
		</h2>

		
		
	</div>
	<hr>
	<div id="omr" style="height:50vh;">
		<?php 
		if(empty($test_status))
		{
			for($i=0;$i<$q_count;$i++)
			{
				echo "<div class='w3-row w3-margin'>
				<div class='w3-col' style='width:20%;'>Q".($i+1)."</div>
				<div class='w3-col' style='width:80%;'>
					(A)<input type='radio' id='".($i+1)."-1' name='".($i+1)."' onclick='toggleSingleOption(this.id)' />
					(B)<input type='radio' id='".($i+1)."-2' name='".($i+1)."' onclick='toggleSingleOption(this.id)' /> 
					(C)<input type='radio' id='".($i+1)."-3' name='".($i+1)."' onclick='toggleSingleOption(this.id)' /> 
					(D)<input type='radio' id='".($i+1)."-4' name='".($i+1)."' onclick='toggleSingleOption(this.id)' /><br>
				</div>
				</div><hr style='width:90%;'>";
			}
		}
		else
		{

			for($i=0;$i<$q_count;$i++)
			{
				$choice=$test_status[$i]->choice;
				echo "<div class='w3-row w3-margin'>
				<div class='w3-col' style='width:20%;'>Q".($i+1)."</div>
				<div class='w3-col' style='width:80%;'>
					(A)<input type='radio' id='".($i+1)."-1' name='".($i+1)."' onclick='toggleSingleOption(this.id)' ".($choice==1)?"checked":""."/>
					(B)<input type='radio' id='".($i+1)."-2' name='".($i+1)."' onclick='toggleSingleOption(this.id)' ".($choice==2)?"checked":""."/> 
					(C)<input type='radio' id='".($i+1)."-3' name='".($i+1)."' onclick='toggleSingleOption(this.id)' ".($choice==3)?"checked":""."/> 
					(D)<input type='radio' id='".($i+1)."-4' name='".($i+1)."' onclick='toggleSingleOption(this.id)' ".($choice==4)?"checked":""."/><br>
				</div>
			</div><hr style='width:90%;'>";
			}
		}
		


		?>


	</div>
	<div class="w3-row w3-margin w3-margin w3-round">
			
			
		</div>
	<div class="w3-row w3-margin w3-right w3-round" style="max-height:300px;overflow-y: scroll">
		<!-- here -->
		

	</div>
	
	
<hr>
	<div class="w3-round w3-margin w3-round" style="opacity:01;" onclick="askForFinish();">
		<h5 class="w3-button w3-hover-teal w3-black w3-padding w3-margin w3-round" style="width:90%;">SUBMIT PAPER</h5>
	</div>
	
		
</div>
