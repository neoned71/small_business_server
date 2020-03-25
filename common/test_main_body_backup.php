<div id="q<?php echo $question_number; ?>" class="qbody w3-left" style="display:none;opacity:0.98;margin-top:0%;width:100%;margin-bottom:10%;">

	<div  class=" w3-white" style="margin-top:0px;margin-bottom:0%;padding:0px;">
		
		<div class="w3-white w3-round w3-row w3-large-padding ">
			<div class="w3-white w3-col w3-padding w3-center w3-text-teal" style="margin:0px;width:10%">
				<h6>Currently on</h6>
				<h4 class="w3-text-teal w3-black w3-center w3-round w3-card" style="cursor:pointer;" onclick="qstFull();">Q<?php echo $question_number; ?></h4>

				

					
			</div>
			<a class="w3-col" style="margin:0px;width:20%;cursor:pointer;">
				<div class=" w3-white w3-text-dark-grey w3-hover-text-black w3-padding" >
					
				<h3 class="w3-text-teal w3-black w3-center w3-round w3-card w3-hide-small" onclick="showQuestion(<?php echo $question_number==1?$question_number:($question_number-1); ?>);"><i class="fas fa-arrow-left"></i>   Previous</h3>
				</div>
			</a>
			
			<div class="w3-hide-small w3-black w3-col w3-padding w3-text-teal " style="margin:0px;width:15%">
				<h6>SUBJECT</h6>
				<h5 class=""><?php echo $question->subject; ?></h5>
			</div>
			<div class="w3-hide-small w3-teal w3-col w3-padding" style="margin:0px;width:20%">
				<h6>Marking</h6>
				<h5 class="">4::-1</h5>
			</div>
			<div class="w3-hide-small w3-black w3-col w3-padding w3-text-teal" style="margin:0px;width:15%;">
				<h6>TOPIC ID</h6>
				<h5 class=""><?php echo json_decode($question->topic)->id; ?></h5>
			</div>

			<a class=" w3-col" style="margin:0px;width:20%;cursor:pointer;">
				<div class="w3-hide-small w3-white w3-text-dark-grey w3-hover-text-black w3-padding">
					<h3 class="w3-text-teal w3-black w3-center w3-round w3-card" onclick="showQuestion(<?php echo $question_number==$total_questions?$question_number:($question_number+1); ?>);">
						Next    <i class="fas fa-arrow-right"></i>
					</h3>
				</div>
				
				<h1 class="w3-right w3-margin w3-padding">
					<a onclick="setStar(<?php echo $question_number; ?>);" href="#" class="qstar w3-center w3-text-grey">
						<i class="fa fa-star" aria-hidden="true"></i>
					</a>
				</h1>
			</a>

		</div>

		

		


		<?php include("test_question.php"); ?>
		
		<a class=" w3-col w3-right" style="margin:0px;width:20%;cursor:pointer;"><div class="  w3-text-dark-grey w3-hover-text-black w3-padding" >
				
				<h3 class="w3-text-teal w3-black w3-center w3-round w3-card" onclick="showQuestion(<?php echo $question_number==$total_questions?$question_number:($question_number+1); ?>);"> Next    <i class="fas fa-arrow-right"></i></h3>


			</div></a>


	</div>


	
</div>