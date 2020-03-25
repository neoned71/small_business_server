
		<div class="w3-white  w3-row w3-margin w3-card">
			<div class=" w3-hover-text-green w3-col w3-padding w3-center" style="margin:0px;width:25%;border-radius:1px 0px 0px 0px;border:1px;">
				
				<h4 class="w3-text-black"><?php echo $test->name; ?></h4>
				<?php 
				if($test->test_type==1 or $test->test_type==2)
				{
					echo '<a class="w3-text-cyan" href="test_for_printing.php?test_id='.$test->id.'">View Paper</a>';
				}
				
				?>
			</div>
			<div class="w3-white w3-col w3-padding w3-text-teal" style="margin:0px;width:10%">
				<h6>Rank<h6>
				<h5 class="">-</h5>
			</div>
			<div class="w3-white w3-col w3-padding w3-text-teal" style="margin:0px;width:10%">
				<h5 class=""><?php echo "Time Test"; ?></h5>
			</div>
			<div class="w3-white w-border w3-col w3-padding" style="margin:0px;width:15%">
				<h6>Score<h6>
				<h5 class="">-/<?php echo $test->test_paper->total_marks; ?></h5>
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
			<a class=" w3-col" style="margin:0px;width:20%"><div class=" w3-dark-black w3-text-white w3-hover-light-grey w3-hover-text-black w3-padding" >
				<h6>Sorry...<h6>
					<?php 
				// if($user->candidate_type==1 or $user->candidate_type==0)
				// {
				// 	echo '<a class="w3-text-cyan" href="test_timing.php?test_id='.$test->id.'">start</a>';
				// }
				
				?>
				<h5 class="w3-text-red ">Test has Expired!</h5></div></a>

		</div>