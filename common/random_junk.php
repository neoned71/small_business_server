<div class="w3-hide-small w3-white w3-col w3-padding w3-text-grey " style="margin:0px;width:15%">
				<h6>SUBJECT</h6>
				<h5 class=""><?php echo $question->subject; ?></h5>
			</div>


<div class="w3-hide-small w3-teal w3-col w3-padding" style="margin:0px;width:20%">
	<h6>MARKING</h6>
	<h5 class="">4::-1</h5>
</div>

<span class="w3-text-red clock">
				 	<?php 
			if(is_null($test_status)){
				if($test->test_type==1)
				{
					// echo "**1";
					echo $test->duration_minutes.":00";
				}
				else if($test->test_type==2)
				{
					// echo "**2";
					echo intval((($start_unix+$duration_unix)-$current_time)/60).":00";
				}
				
			}
			else
			{
				if($test->test_type==1)
				{
					// echo "**3";
					echo $test_status->lrt;
				}
				else if($test->test_type==2)
				{
					// echo "**4";
					echo intval((($start_unix+$duration_unix)-$current_time)/60).":00";
				}
			}
			




			 ?></span>