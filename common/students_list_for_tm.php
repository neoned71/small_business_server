<div class="w3-black w3-row w3-card" style="margin-right:50px;margin-bottom: 10px;">
	<div class=" w3-col w3-padding w3-center" style="margin:0px;width:25%;border-radius:1px 0px 0px 0px;border:1px;">
		<h4 class="w3-text-teal"><?php echo $t->candidate->name; ?></h4>
	</div>
	
	<div class="w3-white w3-col w3-padding w3-text-teal" style="margin:0px;width:10%">
		<h6>Rank</h6>
		<h5 class=""><?php 
		echo $t->rank;
		?></h5>
	</div>
	<div class="w3-white w3-col w3-padding w3-text-teal" style="margin:0px;width:20%">
		<h6>Marks_obtained</h6>
		<h5 class=""><?php echo $t->marks_obtained?></h5>
	</div>
	<a class=" w3-col w3-padding w3-black" href='<?php echo "result_page.php?test_id=".$t->test_id."&candidate_id=".$t->candidate->id; ?>' style="margin:0px;width:20%;height:100%;">
 		<div class="w3-text-white w3-hover-text-teal w3-padding" >
			<h5>View Detailed Result</h5>
		</div>
	</a>
</div>