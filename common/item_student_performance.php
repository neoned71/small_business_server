
		<div class="w3-white  w3-row w3-margin w3-card">
			<div class=" w3-hover-text-green w3-col w3-padding w3-center" style="margin:0px;width:25%;border-radius:1px 0px 0px 0px;border:1px;">
				
				<h4 class="w3-text-teal"><?php echo $s_performance->student_name; ?></h4>
			</div>
			<div class="w3-white w3-col w3-padding w3-text-teal" style="margin:0px;width:10%">
				<h6>Total Score</h6>
				<h5 class=""><?php echo $s_performance->score; ?></h5>
			</div>
			
			<div class="w3-white w3-col w3-padding" style="margin:0px;width:25%">
				<h6>Attempted(Total|Positive|Negative)</h6>
				<h5 class="">-/<?php echo $performance->maximum."/".$performance->total_marks; ?></h5>
			</div>
			<div class="w3-white w3-col w3-padding w3-text-teal" style="margin:0px;width:20%">
				<h6>Test Date</h6>
				<h5 class=""><?php
				
					echo explode(" ",$performance->test_date)[0]; 
			

				 ?></h5>
			</div>
		<a class=" w3-col w3-card w3-round" href=.'common/tp.php?test_id=<?php echo $performance->test_id; ?>' style="margin:0px;width:20%">
		 <div class=" w3-black w3-text-white w3-hover-white w3-hover-text-black w3-padding" >
				<h6><?php
				
					echo "View";
				
				?></h6>
				<h5 class="w3-text-cyan"><?php echo "Start<i class='w3-text-green fas fa-arrow-right'></i>"; ?></h5>


			</div></a>



		</div>