<div id="q<?php echo $question_number; ?>" class="qbody w3-left" style="display:none;opacity:0.98;margin-top:0%;width:100%;margin-bottom:10%;font-weight:bold">

	<div  class=" w3-white" style="margin-top:0px;margin-bottom:0%;padding:0px;">
		
		<div class="w3-white w3-round w3-row w3-large-padding ">
			
			<a class="w3-col" style="margin:0px;width:20%;cursor:pointer;">
				<div class=" w3-white w3-text-dark-grey w3-hover-text-black w3-padding" >
					
				<h5 class="w3-text-teal w3-black w3-center w3-round w3-card w3-hide-small" onclick="showQuestion(<?php echo $question_number==1?$question_number:($question_number-1); ?>,'<?php echo $question->subject_id; ?>');showQuestion2(<?php echo $question_number==1?$question_number:($question_number-1); ?>,'<?php echo $question->subject_id; ?>');"><i class="fas fa-arrow-left"></i>Previous</h5>
				</div>
			</a>
			
			<div class="w3-hide-small w3-teal w3-col w3-padding w3-text-white " style="margin:0px;width:15%">
				<h6>SUBJECT</h6>
				<h5 class=""><?php echo $question->subject; ?></h5>
			</div>
			<div class="w3-white w3-col w3-padding w3-center w3-text-teal" style="margin:0px;width:25%">
				 <h3><span class="w3-text-red clock">
				 	<?php 
			if(is_null($test_status)){
				if($test->test_type==1)
				{
					// echo "**1";
					echo $test->duration_minutes.":00";
				}
				else if($test->test_type==2)
				{
					// echo "**2";
					echo intval((($start_unix+$duration_unix)-$current_time)/60).":00";
				}
				
			}
			else
			{
				if($test->test_type==1)
				{
					// echo "**3";
					echo $test_status->lrt;
				}
				else if($test->test_type==2)
				{
					// echo "**4";
					echo intval((($start_unix+$duration_unix)-$current_time)/60).":00";
				}
			}
			




			 ?></span></h3>
				<h4 class="w3-text-teal w3-black w3-center w3-round w3-card" style="cursor:pointer;" onclick="qstFull();">Q<?php echo $question_number; ?></h4>

				

					
			</div>
			<div class="w3-hide-small w3-teal w3-col w3-padding" style="margin:0px;width:20%">
				<h6>MARKING</h6>
				<h5 class="">4::-1</h5>
			</div>
			<a class="w3-col" style="margin:0px;width:20%;cursor:pointer;">
				<div class="w3-hide-small w3-white w3-text-dark-grey w3-hover-text-black w3-padding">
					<h5 class="w3-text-teal w3-black w3-center w3-round w3-card"
					 <?php
				if($question_number==$total_questions){
					echo 'onclick="askForFinish();"> Finish!';
					// 
				}else
				{
					echo 'onclick="showQuestion('.($question_number+1).');showQuestion2('.($question_number+1).');">Save & Next';

				}
				 
				 ?><i class="fas fa-arrow-right"></i>
					</h5>
				</div>
				
				
			</a>
			<div class="w3-right w3-margin w3-padding">

				<h1>
					<a onclick="setStar(<?php echo $question_number; ?>);" href="#" class="qstar w3-center w3-text-grey">
						<i class="fa fa-star" aria-hidden="true"></i>
					</a>

				</h1>
				<h6 class="w3-center">
					(Mark For Review)
				</h6>
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



		<a class=" w3-col w3-right w3-padding" style="margin:0px;width:20%;cursor:pointer;display:block"><div class="  w3-text-dark-grey w3-hover-text-black w3-padding" >
				
				<h5 class="w3-text-teal w3-black w3-center w3-round w3-card w3-padding"
				<?php
				if($question_number==$total_questions){
					echo 'onclick="askForFinish();"> Finish!';
					// 
				}else
				{
					echo 'onclick="skip('.$question_number.');showQuestion('.($question_number+1).');showQuestion2('.($question_number+1).');">Skip';
				}
				 ?>
				<i class="fas fa-arrow-right"></i></h5>


			</div></a>
			
			




	</div>


	
</div>