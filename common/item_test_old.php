<div class="w3-white w3-row w3-margin w3-card">
			<div class=" w3-hover-text-green w3-col w3-padding w3-center" style="margin:0px;width:25%;border-radius:1px 0px 0px 0px;border:1px;">
				
				<h4 class="w3-text-red"><?php echo $test->name; ?></h4>
			</div>
			<div class="w3-white w3-col w3-padding w3-text-teal" style="margin:0px;width:10%">
				<h6>Rank<h6>
				<h5 class=""><?php echo $test_result->rank; ?></h5>
			</div>
			<div class="w3-white w3-col w3-padding w3-text-teal" style="margin:0px;width:10%">
				
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
			<div class=" w3-col w3-padding" style="margin:0px;width:15%">
				<h6>Score<h6>
				<h5 class=""><?php echo $test_result->marks_obtained; ?>/<?php echo $test->test_paper->total_marks; ?></h5>
			</div>
			<div class="w3-white w3-col w3-padding w3-text-teal" style="margin:0px;width:20%">
				<h6>Date<h6>
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
		<a class=" w3-col" href="result_page.php?test_link_id=<?php echo $test_link_id;?>" style="margin:0px;width:20%"><div class=" w3-red w3-text-white w3-hover-grey w3-hover-text-white w3-padding" >
				<h6>Visit<h6>
				<h5 class="w3-text-white">Score Board  <i class="w3-text-black fas fa-arrow-right"></i></h5>


			</div></a>

		</div>