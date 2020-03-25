<div class="w3-black w3-row w3-card" style="margin-right:50px;margin-bottom: 10px;">
	<div class=" w3-col w3-padding w3-center" style="margin:0px;width:25%;border-radius:1px 0px 0px 0px;border:1px;">
		<h4 class="w3-text-teal"><?php echo $t->test_name; ?></h4>
	</div>
	
	<div class="w3-white w3-col w3-padding w3-text-teal" style="margin:0px;width:10%">
		<h6>Test Type</h6>
		<h5 class=""><?php 
		if($t->test_type==1 or $t->test_type==2)
		{
			echo "Simple Test";
		}
		else
		{
			echo "Teachers Test";
		}
		?></h5>
	</div>
	<div class="w3-white w3-col w3-padding w3-text-teal" style="margin:0px;width:20%">
		<h6>Date</h6>
		<h5 class=""><?php echo $t->date?></h5>
	</div>
	<a class=" w3-col w3-padding w3-black" href='<?php echo "tm.php?test_id=".$t->test_id; ?>' style="margin:0px;width:20%;height:100%;">
 		<div class="w3-text-white w3-hover-text-teal w3-padding" >
			<h5>View Class Results</h5>
		</div>
	</a>
</div>