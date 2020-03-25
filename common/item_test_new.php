
		<div class="w3-white  w3-row w3-margin w3-card">
			<div class=" w3-hover-text-green w3-col w3-padding w3-center" style="margin:0px;width:25%;border-radius:1px 0px 0px 0px;border:1px;">
				
				<h4 class="w3-text-teal"><?php echo $test->name; ?></h4>
			</div>
			<div class="w3-white w3-col w3-padding w3-text-teal" style="margin:0px;width:10%">
				<h6>Rank</h6>
				<h5 class="">-</h5>
			</div>
			<div class="w3-white w3-col w3-padding w3-text-teal" style="margin:0px;width:10%">
				<!-- <h6>Category</h6> -->
				<h5 class=""><?php 
				if($test->test_type==2)
				{
					echo "Time Test";
				}
				else if($test->test_type==1)
				{
					echo "Simple Test"; 
				}
				else if($test->test_type==3)
				{
					echo "Teacher's Test"; 
				}
				?></h5>
			</div>
			<div class="w3-white w3-col w3-padding" style="margin:0px;width:15%">
				<h6>Score</h6>
				<h5 class="">-/<?php echo $test->test_paper->total_marks; ?></h5>
			</div>
			<div class="w3-white w3-col w3-padding w3-text-teal" style="margin:0px;width:20%">
				<h6>Date</h6>
				<h5 class=""><?php
				if($test->test_type==2)
				{
					echo date("d M Y",$test->timing_unix);
				}
				else if($test->test_type==1)
				{
					echo explode(" ",$test->date)[0]; 
				}

				 ?></h5>
			</div>
		<a class=" w3-col w3-card w3-round" href='<?php
		if($test->test_type==1)
			 {

			 	if(empty($test_link_id))
			 	{
			 		echo "test_nta.php?test_id=".$test->id;
			 	}
			 	else
			 	{
			 		// echo "sdadad";
			 		echo "test_nta.php?test_link_id=".$test_link_id;
			 	}
			 	
			 }
		else if($test->test_type==2)
		 {
		 	
		 		
		 	if($test->timing_unix<time() and ($test->timing_unix+$test->duration_minutes*60)>time())
				{
					if(empty($test_link_id))
				 	{
				 		echo "test_timing.php?test_id=".$test->id;
				 	}
				 	else
				 	{
				 		echo "test_timing.php?test_link_id=".$test_link_id;
				 	}
					// echo ".php?test_id=".$test->id;
				}
				else
				{
					echo "#";
				}
		 	
		 }
		else if($test->test_type==3)
		{
			if(empty($test_link_id))
		 	{
		 		echo "teachers_test.php?test_id=".$test->id;
		 	}
		 	else
		 	{
		 		echo "teachers_test.php?test_link_id=".$test_link_id;
		 	}
			// echo ".php?test_id=".$test->id;
		}

		 ?>' style="margin:0px;width:20%">
		 <div class=" w3-black w3-text-white w3-hover-white w3-hover-text-black w3-padding" >
				<h6><?php
				if($test->test_type==1 or $test->test_type==3)
				{
					echo "Let's Go!";
				}
				else if($test->test_type==2)
				{
					if($test->timing_unix<time() and ($test->timing_unix+$test->duration_minutes*60)>time())
					{
						echo "Test has already begun!!";
					}
					else
					{
						echo "Test Scheduled at:";
					}
						
				}
				?></h6>
				<h5 class="w3-text-cyan"><?php
				if($test->test_type==2)
				{
					if($test->timing_unix<time() and ($test->timing_unix+$test->duration_minutes*60)>time())
					{
						echo "CLICK HERE!!<i class='w3-text-green fas fa-arrow-right'></i>";
					}
					else
					{
						echo explode(" ",$test->timing)[1];
					}
				}
				else if($test->test_type==1 or $test->test_type==3 )
				{
					echo "Start<i class='w3-text-green fas fa-arrow-right'></i>";
				}
				?></h5>


			</div></a>



		</div>