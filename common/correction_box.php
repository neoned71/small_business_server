<div>
	For Faculties:<br>
	<textarea class="w3-margin" id="<?php echo $question->id.'-review'; ?>" rows="4" cols="30" placeholder="Corrections(If any)"><?php 
		if(!empty($question->review)){
			echo $question->review; 
		}

	?></textarea><br>
	<button class="w3-margin" onclick="saveReview('<?php echo $question->id.'-review'; ?>');">Save!</button>
</div>