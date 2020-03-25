<div id="q<?php echo $question_number; ?>" class="qbody" >

	<div  class=" w3-white" >
		
		<div class=" w3-round w3-row w3-large-padding ">
			

			<div class="w3-right w3-margin">
				<!-- <h1>
					<a onclick="setStar(<?php
											 echo $question_number; 
											 ?>);" href="#" class="qstar w3-center w3-text-grey">
						<i class="fa fa-star" aria-hidden="true"></i>
					</a>
				</h1> -->


				<!-- <h6 class="w3-center">
					(Mark For Review)
				</h6> -->
			</div>
			<div class="w3-row">

		 	

		 	<a class="w3-col w3-margin" style="margin:0px;width:30%;cursor:pointer;">
				<div class=" w3-text-dark-grey w3-hover-text-black " >	
					<h5 class="w3-text-teal w3-white w3-center w3-round w3-card w3-hide-small" onclick="prev(<?php echo $question_number; ?>);">
						<i class="fas fa-arrow-left"></i>Previous
					</h5>
				</div>
			</a>
			
			
			
			
			<a class="w3-col w3-margin" style="margin:0px;width:30%;cursor:pointer;">
				<div class="w3-hide-small w3-text-dark-grey w3-hover-text-black">
					<h5 class="w3-text-teal w3-white w3-center w3-round w3-card"
					 <?php
						if($question_number==$total_questions)
						{
							echo 'onclick="askForFinish();"> Finish!'; 
						}
						else
						{
							echo 'onclick="next('.$question_number.');">Next';
						}
						?>
						 <i class="fas fa-arrow-right"></i>
					</h5>
				</div>
			</a>


			


		</div>

		</div>
		<?php
		// if(isset($question->image) and !empty($question->image)){
		if($question->question_type==1)
		{
			include("test_q_i_nta.php");
		}
		if($question->question_type==2)
		{
			include("test_question_multiple_nta.php");
		}
		else if($question->question_type==3)
		{
			include("test_question_comprehension_nta.php");
		}
		else if($question->question_type==4)
		{
			include("test_question_matrix_match_nta.php");
		}
		else if($question->question_type==6)
		{
			include("test_question_integer_nta.php");
		}
		else if($question->question_type==7)
		{
			include("test_question_fillups_nta.php");
		}
		else if($question->question_type==8)
		{
			include("test_question_assertion_reason_nta.php");
		}
		else if($question->question_type==9)
		{
			include("test_question_boards_nta.php");
		}
		else if($question->question_type==10)
		{
			include("test_question_matrix_match_3_nta.php");
		}
		else if($question->question_type==11)
		{
			include("test_question_decimal_nta.php");
		}
		 ?>
		<div class="w3-row">
		 	

		 	<a class="w3-col w3-margin" style="margin:0px;width:20%;cursor:pointer;">
				<div class=" w3-text-dark-grey w3-hover-text-black" >	
					<p class="w3-text-white w3-green w3-center w3-round w3-card w3-hide-small" onclick="saveAndNext(<?php echo $question_number; ?>);">
						Save & next
					</p>
				</div>
			</a>

			<a class="w3-col w3-margin" style="margin:0px;width:20%;cursor:pointer;">
				<div class=" w3-text-dark-grey w3-hover-text-black" >	
					<p class="w3-text-white w3-orange w3-center w3-round w3-card w3-hide-small" onclick="saveAndMark(<?php echo $question_number; ?>);">
						Save & Mark for Review
					</p>
				</div>
			</a>

			<a class="w3-col w3-margin" style="margin:0px;width:20%;cursor:pointer;">
				<div class=" w3-text-dark-grey w3-hover-text-black" >	
					<p class="w3-text-grey w3-white w3-center w3-round w3-card w3-hide-small" onclick="skip(<?php echo $question_number; ?>);">
						Clear Response
					</p>
				</div>
			</a>


		</div>



		
			
			




	</div>


	
</div>