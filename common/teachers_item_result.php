<div class="w3-white w3-round w3-margin-top">
	<div class="w3-white w3-round w3-row">
		<style type="text/css">
			.martrix-match-item{height: 100px;}
			.martrix-match-item-holder{padding:20px;height:130px;}
		</style>
		
		<div class="w3-black w3-text-teal w3-padding w3-col w3-center" style="margin:0px;width:25%">
			
			<h3 class="">Q<?php echo $question_number; ?></h3>
		</div>

		<?php 
		if($result->choice == $result->correct_ans)
		{
			echo '<div class="w3-white w3-text-green w3-col w3-padding w3-center" style="margin:0px;width:25%">
			<h6>RIGHT</i></h6></div>';
		}
		else if($result->choice !=0)
		{
			echo '<div class="w3-white w3-text-red w3-col w3-padding w3-center" style="margin:0px;width:25%">
				<h6>WRONG</i></h6></div>';
		}
		else{
			echo '<div class="w3-white w3-text-blue w3-col w3-padding w3-center" style="margin:0px;width:25%">
				<h6>N.A.</h6></div>';
		}

		?>
		

		<div class="w3-white w3-col w3-padding w3-text-dark-grey" style="margin:0px;width:25%">
			<h6>Marked:<?php echo !empty($result->choice)?$result->choice:"-"; ?></h6>
			
		</div>
		
		<div class="w3-white w3-col w3-padding w3-text-dark-grey" style="margin:0px;width:25%">
			<h6>Correct:<?php echo ($result->correct_ans); ?></h6>
			
		</div>

		
	</div>
</div>