<div id="q<?php echo $question_number; ?>" class="qbody w3-left" style="opacity:0.98;margin-top:0%;width:100%;margin-bottom:10%;font-weight:bold">

	<div  class=" w3-white" style="margin-top:0px;margin-bottom:0%;padding:0px;">
		
		<div class="w3-white w3-round w3-row w3-large-padding ">
			
			
			<div class="w3-hide-small w3-black w3-col w3-padding w3-text-white w3-center" style="margin:0px;width:20%">
				<h6>No.</h6>
				<h5 class=""><?php echo $question_number; ?></h5>
			</div>
			<div class="w3-hide-small w3-white w3-col w3-padding w3-text-black " style="margin:0px;width:40%">
				<h6>SUBJECT</h6>
				<h5 class="w3-text-teal"><?php echo $question->subject; ?></h5>
			</div>
			
			<div class="w3-hide-small w3-teal w3-col w3-padding" style="margin:0px;width:40%">
				<h6>MARKING</h6>
				<h5 class="">4::-1</h5>
			</div>
			
			

		</div>
		<?php
		// if(isset($question->image) and !empty($question->image)){
		if($question->question_type==1)
		{
			include("test_q_i.php");
		}
		if($question->question_type==2)
		{
			include("test_question_multiple.php");
		}
		else if($question->question_type==3)
		{
			include("test_question_comprehension.php");
		}
		else if($question->question_type==4)
		{
			include("test_question_matrix_match.php");
		}
		else if($question->question_type==6)
		{
			include("test_question_integer.php");
		}
		else if($question->question_type==7)
		{
			include("test_question_fillups.php");
		}
		else if($question->question_type==8)
		{
			include("test_question_assertion_reason.php");
		}
		else if($question->question_type==9)
		{
			include("test_question_boards.php");
		}
		else if($question->question_type==10)
		{
			include("test_question_matrix_match_3.php");
		}
		else if($question->question_type==11)
		{
			include("test_question_decimal.php");
		}
		// } 
		// else{
		// 	include("test_q.php");
		// }
		 ?>
			
			




	</div>


	
</div>