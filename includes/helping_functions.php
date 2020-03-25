<?php
function delete_batch($dbc,$batch_id){
	$sql='delete from batch_table where id='.$batch_id;
	// echo $sql;
	$id=false;

	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	// else{
	// 	echo mysqli_error($dbc);
	// }
	return $id;
}

function enable_test($dbc,$test_id,$enabled){
	$enabled=
	$sql="update test_table set is_enabled=".$enabled." where id=".$test_id;
	// echo $sql;
	$id=false;

	if($res=mysqli_query($dbc,$sql))
	{

		$id=mysqli_insert_id($dbc);
	}
	// else{
	// 	echo mysqli_error($dbc);
	// }
	
	return $id;
}


function set_test_for_batch($dbc,$test_id,$batch_id)
{

}


function insert_plan($dbc,$session_id,$class_id,$programme_id,$amount,$discount_percent,$subjects_json,$batch_id,$tax_paid){
	$sql="INSERT INTO `plan_table` (`session_id`, `class_id`, `programme_id`, `amount`, `discount_percent`, `subjects_json`, `batch_id`,`tax_paid`) VALUES (".$session_id.", ".$class_id.", ".$programme_id.", ".$amount.", ".$discount_percent.", '".$subjects_json."', ".$batch_id.", ".$tax_paid.");";
	// echo $sql;
	$id=false;

	if($res=mysqli_query($dbc,$sql))
	{

		$id=mysqli_insert_id($dbc);
	}
	else{
		echo mysqli_error($dbc);
	}
	
	return $id;
}


function set_admission_plan($dbc,$admission_id,$plan_id){
	$sql="update admission_table set plan_id=".$plan_id." where id=".$admission_id;
	// echo $sql;
	$id=false;

	if($res=mysqli_query($dbc,$sql))
	{

		return true;
	}
	else{
		echo mysqli_error($dbc);
		return false;
	}
	
	// return $id;
}


function get_cash_inventory_plus($dbc)
{
	$sql = "select sum(amount) as total from transaction_table group by cash_flow having cash_flow='+'";
	$ret=new stdClass;
	if($res=mysqli_query($dbc,$sql))
	{
		if($row=mysqli_fetch_assoc($res))
		{
			return $row['total'];
		}
		else
		{
			return 0;
		}

	}
	else
	{
		return false;
	}
}
// select (select sum(amount) as total from transaction_table group by cash_flow having cash_flow='+') - (select sum(amount) as total from transaction_table group by cash_flow having cash_flow='-')  as remaining
function get_cash_inventory_minus($dbc)
{
	$sql = "select sum(amount) as total from transaction_table group by cash_flow having cash_flow='-'";
	$ret=new stdClass;
	if($res=mysqli_query($dbc,$sql))
	{
		if($row=mysqli_fetch_assoc($res))
		{
			return $row['total'];
		}
		else
		{
			return 0;
		}

	}
	else
	{
		return false;
	}
}


function get_cash_inventory($dbc)
{
	return (get_cash_inventory_plus($dbc) - get_cash_inventory_minus($dbc));
}



function reset_admission_plan($dbc,$admission_id){
	return set_admission_plan($dbc,$admission_id,0);
	// $sql="update admission_table set plan_id=0 where id=".$admission_id;
	// // echo $sql;
	// $id=false;

	// if($res=mysqli_query($dbc,$sql))
	// {

	// 	return true;
	// }
	// else{
	// 	echo mysqli_error($dbc);
	// 	return false;
	// }
	
	// return $id;
}


function set_admission_entrance_result_id($dbc,$admission_id,$entrance_result_id){
	$sql="update admission_table set entrance_result_id=".$entrance_result_id." where id=".$admission_id;
	// echo $sql;
	$id=false;

	if($res=mysqli_query($dbc,$sql))
	{

		return true;
	}
	else{
		echo mysqli_error($dbc);
		return false;
	}
	
	// return $id;
}


function reset_admission_entrance_result_id($dbc,$admission_id,$entrance_result_id){
	$sql="update admission_table set entrance_result_id=0 where id=".$admission_id;
	// echo $sql;
	$id=false;

	if($res=mysqli_query($dbc,$sql))
	{

		return true;
	}
	else{
		echo mysqli_error($dbc);
		return false;
	}
	
	// return $id;
}

function remove_enquiry_entrance_result_id($dbc,$enquiry_id){
	$sql="delete from entrance_result_table where enquiry_id=".$enquiry_id;
	// echo $sql;
	$id=false;

	if($res=mysqli_query($dbc,$sql))
	{

		return true;
	}
	else{
		echo mysqli_error($dbc);
		return false;
	}
	
	// return $id;
}


function remove_admission($dbc,$admission_id){
	$sql="delete from admission_table where id=".$admission_id;
	// echo $sql;
	$id=false;

	if($res=mysqli_query($dbc,$sql))
	{

		return true;
	}
	else{
		echo mysqli_error($dbc);
		return false;
	}
}


// function remove_admission($dbc,$admission_id){
// 	$sql="delete from admission_table where id=".$admission_id;
// 	// echo $sql;
// 	$id=false;

// 	if($res=mysqli_query($dbc,$sql))
// 	{

// 		return true;
// 	}
// 	else{
// 		echo mysqli_error($dbc);
// 		return false;
// 	}
// }

function remove_installment($dbc,$installment_id){
	$sql="delete from installment_table where id=".$installment_id;
	// echo $sql;
	$id=false;

	if($res=mysqli_query($dbc,$sql))
	{

		return true;
	}
	else{
		echo mysqli_error($dbc);
		return false;
	}
}


function update_student_dp($dbc,$student_id,$dp){
	$sql="update student_table set dp='".$dp."' where id=".$student_id;
	// echo $sql;
	$id=false;

	if($res=mysqli_query($dbc,$sql))
	{

		return true;
	}
	else{
		echo mysqli_error($dbc);
		return false;
	}
	
	// return $id;
}






function update_admission_center($dbc,$admission_id,$center_id){
	$sql="update admission_table set center_id=".$center_id." where id=".$admission_id;
	// echo $sql;
	$id=false;

	if($res=mysqli_query($dbc,$sql))
	{

		return true;
	}
	else{
		echo mysqli_error($dbc);
		return false;
	}
	
	// return $id;
}

function insert_comprehension($dbc,$comprehension_name,$content,$subject_id){
	$sql='INSERT INTO `comprehension_table`(`name`,`content_json`,`subject_id`) VALUES ("'.$comprehension_name.'","'.$content.'",'.$subject_id.')';
	// echo $sql;
	$id=false;

	if($res=mysqli_query($dbc,$sql))
	{

		$id=mysqli_insert_id($dbc);
	}
	// else{
	// 	echo mysqli_error($dbc);
	// }
	
	return $id;
}

function insert_topic($dbc,$topic_name,$subject_id,$parent_id){
	$sql='INSERT INTO `topic_table`(`subject_id`, `name`,`parent_id`) VALUES ('.$subject_id.',"'.$topic_name.'",'.$parent_id.')';
	// echo $sql;
	$id=false;

	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	// else{
	// 	echo mysqli_error($dbc);
	// }
	
	return $id;
}

function insert_question_single($dbc,$subject_id, $topic_id, $difficulty,$question_json,$options_json,$correct_ans,$solution,$image,$marking,$source){
	
	$sql='INSERT INTO `question_table`(`subject_id`, `topic_id`, `difficulty`,`question_json`,`options_json`,`correct_ans`,`solution`,`image`,`marking`,`question_type`,`source`) VALUES ('.$subject_id.','.$topic_id.','.$difficulty.',\''.$question_json.'\',\''.$options_json.'\',\''.$correct_ans.'\',\''.$solution.'\',\''.$image.'\',\''.$marking.'\',1,\''.$source.'\')';
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	// else{
	// 	echo mysqli_error($dbc);
	// }
	return $id;
}

function insert_question_multiple($dbc,$subject_id, $topic_id, $difficulty,$question_json,$options_json,$correct_ans,$solution,$image,$marking){
	
	$sql='INSERT INTO `question_table`(`subject_id`, `topic_id`, `difficulty`,`question_json`,`options_json`,`correct_ans`,`solution`,`image`,`marking`,`question_type`) VALUES ('.$subject_id.','.$topic_id.','.$difficulty.',\''.$question_json.'\',\''.$options_json.'\',\''.$correct_ans.'\',\''.$solution.'\',\''.$image.'\',"'.$marking.'",2)';
	// echo $sql;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	else{
		echo mysqli_error($dbc);
	}
	return $id;
}

function insert_question_true_false($dbc,$subject_id, $topic_id, $difficulty,$question_json,$options_json,$correct_ans,$solution,$image,$marking){
	
	$sql='INSERT INTO `question_table`(`subject_id`, `topic_id`, `difficulty`,`question_json`,`options_json`,`correct_ans`,`solution`,`image`,`marking`,`question_type`) VALUES ('.$subject_id.','.$topic_id.','.$difficulty.',\''.$question_json.'\',\''.$options_json.'\',\''.$correct_ans.'\',\''.$solution.'\',\''.$image.'\',"'.$marking.'",5)';
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	// else{
	// 	echo mysqli_error($dbc);
	// }
	return $id;
}

function insert_question_decimal($dbc,$subject_id, $topic_id, $difficulty,$question_json,$options_json,$correct_ans,$solution,$image,$marking){
	
	$sql='INSERT INTO `question_table`(`subject_id`, `topic_id`, `difficulty`,`question_json`,`options_json`,`correct_ans`,`solution`,`image`,`marking`,`question_type`) VALUES ('.$subject_id.','.$topic_id.','.$difficulty.',\''.$question_json.'\',\''.$options_json.'\',\''.$correct_ans.'\',\''.$solution.'\',\''.$image.'\',"'.$marking.'",11)';
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	// else{
	// 	echo mysqli_error($dbc);
	// }
	return $id;
}


function insert_question_integer($dbc,$subject_id, $topic_id, $difficulty,$question_json,$options_json,$correct_ans,$solution,$image,$marking){
	
	$sql='INSERT INTO `question_table`(`subject_id`, `topic_id`, `difficulty`,`question_json`,`options_json`,`correct_ans`,`solution`,`image`,`marking`,`question_type`) VALUES ('.$subject_id.','.$topic_id.','.$difficulty.',\''.$question_json.'\',\''.$options_json.'\',\''.$correct_ans.'\',\''.$solution.'\',\''.$image.'\',"'.$marking.'",6)';
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	// else{
	// 	echo mysqli_error($dbc);
	// }
	return $id;
}
function insert_question_comprehension($dbc,$subject_id, $topic_id, $difficulty,$question_json,$options_json,$correct_ans,$solution,$image,$comprehension_id,$marking){
	
	$sql='INSERT INTO `question_table`(`subject_id`, `topic_id`, `difficulty`,`question_json`,`options_json`,`correct_ans`,`solution`,`image`,`marking`,`question_type`,`comprehension_id`) VALUES ('.$subject_id.','.$topic_id.','.$difficulty.',\''.$question_json.'\',\''.$options_json.'\',\''.$correct_ans.'\',\''.$solution.'\',\''.$image.'\',"'.$marking.'",3,'.$comprehension_id.')';
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	return $id;
}
function insert_question_matrix_match($dbc,$subject_id, $topic_id, $difficulty,$question_json,$options_json,$correct_ans,$solution,$image,$marking){
	
	$sql='INSERT INTO `question_table`(`subject_id`, `topic_id`, `difficulty`,`question_json`,`options_json`,`correct_ans`,`solution`,`image`,`marking`,`question_type`) VALUES ('.$subject_id.','.$topic_id.','.$difficulty.',\''.$question_json.'\',\''.$options_json.'\',\''.$correct_ans.'\',\''.$solution.'\',\''.$image.'\',"4::-1",4)';
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	// else{
	// 	echo mysqli_error($dbc);
	// }
	return $id;
}

function insert_question_matrix_match_3($dbc,$subject_id, $topic_id, $difficulty,$question_json,$options_json,$correct_ans,$solution,$image,$marking){
	
	$sql='INSERT INTO `question_table`(`subject_id`, `topic_id`, `difficulty`,`question_json`,`options_json`,`correct_ans`,`solution`,`image`,`marking`,`question_type`) VALUES ('.$subject_id.','.$topic_id.','.$difficulty.',\''.$question_json.'\',\''.$options_json.'\',\''.$correct_ans.'\',\''.$solution.'\',\''.$image.'\',"'.$marking.'",10)';
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	// else{
	// 	echo mysqli_error($dbc);
	// }
	return $id;
}
function insert_question_fillups($dbc,$subject_id, $topic_id, $difficulty,$question_json,$options_json,$correct_ans,$solution,$image,$marking){
	
	$sql='INSERT INTO `question_table`(`subject_id`, `topic_id`, `difficulty`,`question_json`,`options_json`,`correct_ans`,`solution`,`image`,`marking`,`question_type`) VALUES ('.$subject_id.','.$topic_id.','.$difficulty.',\''.$question_json.'\',\''.$options_json.'\',\''.$correct_ans.'\',\''.$solution.'\',\''.$image.'\',"'.$marking.'",7)';
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	// else{
	// 	echo mysqli_error($dbc);
	// }
	return $id;
}

function insert_question_assertion_reason($dbc,$subject_id, $topic_id, $difficulty,$question_json,$options_json,$correct_ans,$solution,$image,$marking){
	
	$sql='INSERT INTO `question_table`(`subject_id`, `topic_id`, `difficulty`,`question_json`,`options_json`,`correct_ans`,`solution`,`image`,`marking`,`question_type`) VALUES ('.$subject_id.','.$topic_id.','.$difficulty.',\''.$question_json.'\',\''.$options_json.'\',\''.$correct_ans.'\',\''.$solution.'\',\''.$image.'\',"'.$marking.'",8)';
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	// else{
	// 	echo mysqli_error($dbc);
	// }
	return $id;
}
function insert_question_boards($dbc,$subject_id, $topic_id, $difficulty,$question_json,$options_json,$correct_ans,$solution,$image,$marking){
	
	$sql='INSERT INTO `question_table`(`subject_id`, `topic_id`, `difficulty`,`question_json`,`options_json`,`correct_ans`,`solution`,`image`,`marking`,`question_type`) VALUES ('.$subject_id.','.$topic_id.','.$difficulty.',\''.$question_json.'\',\''.$options_json.'\',\''.$correct_ans.'\',\''.$solution.'\',\''.$image.'\',"'.$marking.'",9)';
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	// else{
	// 	echo mysqli_error($dbc);
	// }
	return $id;
}


function insert_test_paper($dbc,$total_marks,$questions_json){
	
	$sql='INSERT INTO `test_paper_table`(`total_marks`, `questions_json`) VALUES ('.$total_marks.',\''.$question_json.'\')';
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	// else{
	// 	echo mysqli_error($dbc);
	// }
	return $id;
}

//to be checked
function insert_teacher_test_paper($dbc,$subjects,$file,$answers_json,$employee_id,$total_marks){
	$sql='INSERT INTO `teacher_test_paper_table`(`subjects`,`file`,`answers`, `employee_id`,`total_marks`) VALUES (\''.$subjects.'\',\''.$file.'\',\''.$answers_json.'\','.$employee_id.','.$total_marks.')';
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}

	return $id;
}


function insert_test($dbc,$name,$test_paper_id,$class_id,$duration_minutes,$test_type,$timing,$extra){
	
	$sql='INSERT INTO `test_table`(`name`, `test_paper_id`, `class_id`,`duration_minutes`,`test_type`,`extra`) VALUES (\''.$name.'\','.$test_paper_id.','.$class_id.','.$duration_minutes.','.$test_type.',\''.$extra.'\')';
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	else
	{
		echo mysqli_error($dbc);
	}
	return $id;
}







function insert_test_status($dbc,$test_id,$student_id,$test_status,$lrt){
	$sql='INSERT INTO `test_status_table`(`student_id`,`test_id`, `test_status`, `last_registered_time`) VALUES ('.$student_id.','.$test_id.',"'.$test_status.'","'.$lrt.'") on duplicate key update test_status="'.$test_status.'", last_registered_time="'.$lrt.'"';
	// echo $sql;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=true;
	}
	// else{
	// 	echo mysqli_error($dbc);
	// }
	return $id;
}


function insert_test_result($dbc,$test_id,$test_link_id,$test_result,$student_id,$attempted,$wrong_questions,$total_marks){
$sql='INSERT INTO `test_result_table`(`test_id`,`test_link_id`, `result_json`, `marks_obtained`, `questions_attempted`, `questions_negative`,`candidate_id`) VALUES ('.$test_id.','.$test_link_id.',"'.$test_result.'",'.$total_marks.','.$attempted.','.$wrong_questions.','.$student_id.')';
	// echo $sql;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=true;
	}
	else{
			// echo mysqli_error($dbc);
	}
	return $id;
}

function insert_test_result_temp($dbc,$test_id,$test_result,$student_id,$attempted,$wrong_questions,$total_marks){
	$sql='INSERT INTO `test_result_temp_table`(`test_id`, `result_json`, `marks_obtained`, `questions_attempted`, `questions_negative`,`candidate_id`) VALUES ('.$test_id.',"'.$test_result.'",'.$total_marks.','.$attempted.','.$wrong_questions.','.$student_id.')';
	// echo $sql;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=true;
	}
	else{
			echo mysqli_error($dbc);
	}
	return $id;
}


function delete_entry($dbc,$table,$id)
{
	$sql="delete from ".$table." where id=".$id;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=true;
	}
	// else{
	// 		echo mysqli_error($dbc);
	// }
	return $id;
}

function delete_plan($dbc,$plan_id){
	$sql="delete from plan_table where id=".$plan_id;
	// echo $sql;
	$id=false;

	if($res=mysqli_query($dbc,$sql))
	{

		return true;
	}
	else
	{
		return false;
	}
	
}

function calculate_result_for_teachers_test($dbc,$test_id,$test_status,$student_id)
{
	$ret=new stdClass;
	$data=array();
	$status=json_decode(stripslashes($test_status));
	// echo $test_status;
	// echo json_encode($status);
	$right_questions=0;
	$wrong_questions=0;
	$attempted_q=0;
	$total_marks=0;
	$test=json_decode(get_test($dbc,$test_id,null,1));
	$answers=json_decode($test->test_paper->answers);
	$count=count($answers);

	for($i=0;$i<$count;$i++)
	{
		$result=new stdClass;
		$marking="4::-1";
		$p_marks=intval(explode("::", $marking)[0]);
		$n_marks=intval(explode("::", $marking)[1]);
		$attempted=($status[$i]->attempted == 1)?true:false;

		if($attempted)
		{
			$result->choice=$status[$i]->choice;
			$result->correct_ans=$answers[$i];
			if($status[$i]->choice==$answers[$i])
			{

				$result->marks_obtained=$p_marks;
				$total_marks=$total_marks+$p_marks;
				$right_questions++;

				$attempted_q++;

			}
			else
			{
				$result->marks_obtained=$n_marks;
				$total_marks=$total_marks+$n_marks;
				$wrong_questions++;
				$attempted_q++;
			}
		}
		else
		{
			$result->choice=0;
			$result->correct_ans=$answers[$i];
			$result->marks_obtained=0;
		}

		array_push($data, $result);

	}

	$ret->result_json=$data;
	$ret->total_marks=$total_marks;
	$ret->right_questions=$right_questions;
	$ret->wrong_questions=$wrong_questions;
	$ret->attempted=$attempted_q;
	$ret->test_id=$test_id;

	return json_encode($ret);




}

function calculate_result($dbc,$test_id,$test_status,$student_id,$test_link_id=null)
{
	$ret=new stdClass;
	$data=array();
	$status=json_decode(stripslashes($test_status));
	// echo $test_status;
	// echo json_encode($status);
	$right_questions=0;
	$wrong_questions=0;
	$attempted_q=0;
	$total_marks=0;
	$test=json_decode(get_test($dbc,$test_id,$student_id,2,$test_link_id));
	$questions=$test->test_paper->questions;

	$i=0;
	foreach($questions as $q)
	{
		$result=new stdClass;
		$marking=$q->marking;
		// echo $marking;
		$p_marks=intval(explode("::", $marking)[0]);
		$n_marks=intval(explode("::", $marking)[1]);
		// echo "n:".$n_marks.":n";
		$result->question_id=$q->id;
		$result->subject=$q->subject;
		$result->time=$status[$i]->time;
		$attempted=($status[$i]->attempted == 1)?true:false;
		if($attempted and ($q->question_type==1 or $q->question_type==3 or $q->question_type==4 or $q->question_type==5 or $q->question_type==8 or $q->question_type==10))
		{
			if($status[$i]->choice==intval($q->correct_ans))
			{
				// echo "1";
				$result->choice=intval($q->correct_ans);
				$result->correct_ans=intval($q->correct_ans);
				$result->marks_obtained=$p_marks;
				$total_marks=$total_marks+$p_marks;
				$right_questions++;

				$attempted_q++;

			}
			else if($status[$i]->choice!=0)
			{
				// echo "2";
				$result->choice=$status[$i]->choice;
				$result->correct_ans=intval($q->correct_ans);
				$result->marks_obtained=$n_marks;
				$total_marks=$total_marks+$n_marks;
				$wrong_questions++;
				$attempted_q++;
			}
			
		}
		else if($attempted and $q->question_type==2)
		{
			$multiple=$status[$i]->multiple;
			$res=explode(":", $q->correct_ans);
			
			if(count($res)==count($multiple))
			{
				$j=0;
				$all_true=true;
				foreach ($res as $key) 
				{
					if($key != $multiple[$j])
					{
						$all_true=false;
					}
					$j++;

				}
				if($all_true)
				{
					$result->choice=join(",",array_map("chr", array_map("add_64",$res)));
				$result->correct_ans=join(",",array_map("chr", array_map("add_64",$res)));
				$result->marks_obtained=$p_marks;
				$total_marks=$total_marks+$p_marks;
				$right_questions++;
				$attempted_q++;
				}
			
			}
			else
			{
				$result->choice=join(",",array_map("chr", array_map("add_64",$multiple)));
				$result->correct_ans=join(",",array_map("chr", array_map("add_64",$res)));
				$result->marks_obtained=$n_marks;
				$total_marks=$total_marks+$n_marks;
				$wrong_questions++;
				$attempted_q++;
			}
			
		}
		else if($attempted and ($q->question_type==6 or $q->question_type==7 or $q->question_type==9 or $q->question_type==11))
		{
			if($q->correct_ans==$status[$i]->answer)
			{
				$result->choice=$q->correct_ans;
				$result->correct_ans=$q->correct_ans;
				$result->marks_obtained=$p_marks;
				$total_marks=$total_marks+$p_marks;
				$right_questions++;
				$attempted_q++;


			}
			else
			{
				$result->choice=$status[$i]->answer;
				$result->correct_ans=$q->correct_ans;
				$result->marks_obtained=$n_marks;
				$total_marks=$total_marks+$n_marks;
				$wrong_questions++;
				$attempted_q++;
			}
		}
		else if(!$attempted)
			{
				// echo "3";
				$result->choice=0;
				$result->correct_ans=intval($q->correct_ans);
				$result->marks_obtained=0;
			}
	
		$i++;
		array_push($data, $result);
	}

	$ret->result_json=$data;
	$ret->total_marks=$total_marks;
	$ret->right_questions=$right_questions;
	$ret->wrong_questions=$wrong_questions;
	$ret->attempted=$attempted_q;
	$ret->test_id=$test_id;

	return json_encode($ret);


}


function add_64($val)
{
	return $val+64;
}

function extract_time($date_time){
	$dt=explode(" ", $date_time);
	return $dt[1];
}

function extract_date($date_time){
	$dt=explode(" ", $date_time);
	return $dt[0];
}


function get_test_result_report($dbc,$params=null)
{
	// $temp="";
	// $count=0;

	// // echo "assad";
	// if(!empty($params))
	// {
	// 	// echo "".json_encode($params);
		
	// 	$temp="where ";
		
	// 	if(!empty($params->class_id))
	// 	{
	// 		// echo "".json_encode($params);
	// 		$temp.=("class_id=".$params->class_id);
	// 		$count++;
	// 	}
	// 	if(!empty($params->center_id))
	// 	{
	// 		// echo "".json_encode($params);
	// 		if($count>0)
	// 		{

	// 			$temp.=" and ";
	// 		}
	// 		$temp.="center_id=".$params->center_id;
	// 		$count++;
	// 	}
	// 	if(!empty($params->timing_date))
	// 	{
	// 		// echo $params->date;
	// 		if($count>0)
	// 		{
	// 			$temp.=" and ";
	// 		}
	// 		$temp.="date(timing)='".$params->timing_date."'";
	// 		$count++;
	// 	}
	// 	if(!empty($params->date))
	// 	{
	// 		// echo $params->date;
	// 		if($count>0)
	// 		{
	// 			$temp.=" and ";
	// 		}
	// 		$temp.="date(date)='".$params->date."'";
	// 		$count++;
	// 	}
	// 	if(!empty($params->subject_id))
	// 	{
	// 		// echo "".json_encode($params);
	// 		if($count>0)
	// 		{
	// 			$temp.=" and ";
	// 		}
	// 		$temp.="subject_id='".$params->subject_id."'";
	// 	}
	// }
	
	$sql="SELECT sd.first_name,sd.last_name,sd.phone,tt.total_marks,trt.marks_obtained,trt.questions_attempted ,trt.questions_negative ,trt.date FROM `test_result_table` trt,student_table sd,test_paper_table tt WHERE test_id=".$test_id." and sd.id=trt.candidate_id and tt.id=(select test_paper_id from test_table where id = trt.test_id) order by trt.marks_obtained desc";
	// echo $sql;
	$id=false;
	
	if($res=mysqli_query($dbc,$sql))
	{
		$arr=array();
		while($row=mysqli_fetch_assoc($res)){
			$data=new stdClass();
			$data->id=$row['id'];
			$data->test_paper_id=$row['test_paper_id'];
			$data->class_id=$row['class_id'];
			
			$data->name=$row['name'];
			$data->pdf=null;
			// $data->package_id=$row['package_id'];
			$data->duration_minutes=$row['duration_minutes'];
			$data->is_enabled=$row['is_enabled'];
			$data->date=$row['date'];
			$data->timing=$row['timing'];
			if(!empty($data->timing))
			{
				$data->timing_unix=strtotime($data->timing);
			}
			$data->test_type=$row['test_type'];
			$data->current_time_string=date("Y-M-D H:i:s");
			$data->current_time_unix=time();
			array_push($arr, $data);
			// array_push($arr, $data);
		}
		
		return json_encode($arr);
		
		
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
}

function get_test_list_for_pm($dbc){
	$sql="select * from test_table order by date desc";
	$id=false;
	$ret=array();
	
	if($res=mysqli_query($dbc,$sql))
	{
		
		while($row=mysqli_fetch_assoc($res))
		{
			$data=new stdClass();
			$data->test_name=$row['name'];
			$data->test_id=$row['id'];
			$data->date=$row['date'];
			$data->timing=$row['timing'];
			$data->test_type=$row['test_type'];
			array_push($ret, $data);
		}
		return json_encode($ret);
	}
	else
	{
		return false;
	}
}


function get_students_list_for_tm($dbc,$test_id){
	$sql="select * from test_result_table where test_id=".$test_id." order by marks_obtained desc";
	$id=false;
	$ret=array();
	
	if($res=mysqli_query($dbc,$sql))
	{
		$i=1;
		
		while($row=mysqli_fetch_assoc($res))
		{
			$data=new stdClass();
			$data->rank=$i;
			$data->test_id=$test_id;
			$i++;
			$data->candidate=json_decode(get_student($dbc,$row['candidate_id']));
			$data->marks_obtained=$row['marks_obtained'];
			
			array_push($ret, $data);
		}
		return json_encode($ret);
	}
	else
	{
		return false;
	}
}

function get_admission_from_plan($dbc,$plan_id)
{
	$param=new stdClass;
	$param->plan_id=$plan_id;
	$ad_list=json_decode(get_admissions($dbc,$param));
	if(count($ad_list)>0)
	{
		$admission=$ad_list[0];
		return json_encode($admission);
	}
	else
	{
		return false;
	}
}


function get_plan_id_from_installment($dbc,$installment_id)
{
	$installment=json_decode(get_installment($dbc,$installment_id));

	if(!empty($installment))
	{
		return $installment->plan_id;
	}
	else
	{
		return false;
	}
}


function get_admissions($dbc,$params=NULL,$order=NULL,$is_desc=false,$limit=0,$offset=0)
{
	$temp="";
	$count=0;
	// echo "assad";
	if(!empty($params))
	{
		
		$temp="where ";
		// echo json_encode($params);
		
		if(isset($params->plan_id))
		{
			$temp.="plan_id=".$params->plan_id;
			$count++;
		}
		if(isset($params->student_id))
		{
			if($count>0)
			{

				$temp.=" or ";
			}
			$temp.=("student_id=".$params->student_id);
			$count++;
		}

		if(isset($params->center_id))
		{
			if($count>0)
			{

				$temp.=" or ";
			}
			$temp.=("center_id=".$params->center_id);
			$count++;
		}

		if(isset($params->enabled))
		{
			if($count>0)
			{

				$temp.=" or ";
			}
			$temp.=("enabled=".$params->enabled);
			$count++;
		}

	}

	if(!empty($order))
	{
		if($is_desc==true)
		{
			if($count>0)
			{
				$temp.=" ";
			}
			$temp.=$order." desc";

		}
		
	}
	else
	{
		$temp.=" order by datetime desc";
	}
	if(is_numeric($limit) and $limit!=0)
	{
		if(is_numeric($offset) and $offset!=0)
		{
			$temp.="limit ".$offset.",".$limit;
		}
		else
		{
			$temp.="limit ".$limit;
		}
	}

	$sql="select id from admission_table ".$temp;
	// echo $sql;

	$id=false;
	
	if($res=mysqli_query($dbc,$sql))
	{
		$arr=array();
		while($row=mysqli_fetch_assoc($res)){
			
			$admission_id=$row['id'];
			$admission=json_decode(get_admission($dbc,$admission_id));
			if(!empty($admission))
			{
				array_push($arr, $admission);
			}
			// array_push($arr, $data);
		}
		
		return json_encode($arr);
		
		
	}
	else
	{
		echo mysqli_error($dbc);
		return false;
		
	}


}


function get_students($dbc,$param=NULL)
{
	$temp="";
	$count=0;
	// echo "assad";
	if(!empty($params))
	{
		
		$temp="where ";
		
		if(!empty($params->class_id))
		{
			$temp.=("class_id = ".$params->class_id."");
			$count++;
		}
		if(!empty($params->name))
		{
			if($count>0)
			{

				$temp.=" or ";
			}
			$temp.="name like '%".$params->name."%'";
			$count++;
		}

		if(!empty($params->email))
		{
			if($count>0)
			{

				$temp.=" or ";
			}
			$temp.="email like '%".$params->email."%'";
			$count++;
		}
		

		if(!empty($params->phone))
		{
			if($count>0)
			{

				$temp.=" or ";
			}
			$temp.="phone like '%".$params->phone."%'";
			$count++;
		}
		if(!empty($params->date))
		{
			if($count>0)
			{

				$temp.=" or ";
			}
			$temp.="date(date_time)='".$params->date."'";
			$count++;
		}
		if(!empty($params->school))
		{
			if($count>0)
			{

				$temp.=" or ";
			}
			$temp.="school like '%".$params->school."%'";
			$count++;
		}

		// if(!empty($params->registered))
		// {
		// 	if($count>0)
		// 	{

		// 		$temp.=" or ";
		// 	}
		// 	$temp.="enabled like '%".$params->school."%'";
		// 	$count++;
		// }


	}

	if(!empty($order))
	{
		if($is_desc==true)
		{
			$temp.=$order." desc";

		}
		
	}
	if(is_numeric($limit) and $limit!=0)
	{
		if(is_numeric($offset) and $offset!=0)
		{
			$temp.="limit ".$offset.",".$limit;
		}
		else
		{
			$temp.="limit ".$limit;
		}
	}

	$sql="select id from student_table ".$temp;

	$id=false;
	
	if($res=mysqli_query($dbc,$sql))
	{
		$arr=array();
		while($row=mysqli_fetch_assoc($res)){
			
			$id=$row['id'];
			$employee=json_decode(get_employee($dbc,$employee_id));
			if(!empty($employee))
			{
				array_push($arr, $employee);
			}
			// array_push($arr, $data);
		}
		
		return json_encode($arr);
		
		
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}


}


//checked
function get_test($dbc,$test_id,$candidate_id,$candidate_type,$test_link_id=null)
{
	// echo $candidate_id,$candidate_type,$test_link_id,$test_id;
	//echo $transaction_id;
	// $test_id=get_test_id_from_link($dbc,$test_link_id);
	
	if(!empty($test_link_id))
	{
		// echo 1;
		$sql="select * from test_table where id=(select test_id from test_link_table where id=".$test_link_id.")";
	}
	else if(!empty($test_id))
	{
		// echo 2;
		$sql="select * from test_table where id=".$test_id;
	}
	else
	{
		return false;
	}
	// echo $sql;
	$id=false;
	// echo $sql;
	$data=new stdClass();
	// echo "yes<br>";
	if($res=mysqli_query($dbc,$sql))
	{
		// echo "yes<br>";
		if($row=mysqli_fetch_assoc($res))
		{
			$data->class_id=$row['class_id'];
			$data->id=$row['id'];
			$data->name=$row['name'];
			// echo "yes".$candidate_type;
			$data->test_paper_id=$row['test_paper_id'];
			$data->test_link_id=$test_link_id;
			if($candidate_type==1 or $candidate_type==0)
			{
				if(!empty($candidate_id) and !empty($test_id))
				{
					// echo "sssss";
					$data->test_result=json_decode(get_test_result_temp($dbc,$candidate_id,$test_id));
					// echo "hello".json_encode($data->test_result);
					$data->test_status=null;
				}
				else
				{
					// echo "yes<br>";
					$data->test_result=null;
					$data->test_status=null;
				}
			}
			else if($candidate_type==2)
			{
				if(!empty($candidate_id) and !empty($test_link_id))
				{
					// echo "yes<br>";
					$data->test_result=json_decode(get_test_result($dbc,$candidate_id,$test_link_id));
					$data->test_status=json_decode(get_test_status($dbc,$candidate_id,$test_id));
				}
				else
				{
					$data->test_result=null;
					$data->test_status=null;
				}
			}
		
			// $data->package_id=$row['package_id'];
			$data->duration_minutes=$row['duration_minutes'];
			$data->is_enabled=$row['is_enabled'];
			$data->date=$row['date'];
			$data->pdf=null;
			$data->timing=$row['timing'];
			if(!empty($data->timing))
			{
				$data->timing_unix=strtotime($data->timing);
			}
			$data->test_type=$row['test_type'];
			if($data->test_type==1 or $data->test_type==2)
			{
				$data->test_paper=json_decode(get_test_paper($dbc,$row['test_paper_id']));
			}
			else if($data->test_type==3)
			{
				$data->test_paper=json_decode(get_teacher_test_paper($dbc,$row['test_paper_id']));
			}

			
			$data->current_time_string=date("Y-M-D H:i:s");
			$data->current_time_unix=time();



			return json_encode($data);
		}
		else
		{
			mysqli_error($dbc);
			return false;
		}
		
		
		
	}
	else
	{
		echo mysqli_error($dbc);
		return false;
		
	}
	
}



function get_test_overview($dbc,$candidate_id,$candidate_type,$test_id,$test_link_id=null)
{
	//echo $transaction_id;
	// $test_id=get_test_id_from_link($dbc,$test_link_id);
	if(empty($test_id))
	{
		return false;
	}
	$sql="select * from test_table where id=".$test_id;
	$id=false;
	// echo $sql;
	$data=new stdClass();
	// echo "yes<br>";
	if($res=mysqli_query($dbc,$sql))
	{
		// echo "yes<br>";
		if($row=mysqli_fetch_assoc($res))
		{
		
			$data->class_id=$row['class_id'];
			$data->id=$row['id'];
			$data->name=$row['name'];
			$data->test_link_id=$test_link_id;
			// echo "yes".$candidate_type;
			$data->test_paper_id=$row['test_paper_id'];
			if($candidate_type==1)
			{
				if(!empty($candidate_id))
				{
					// echo "yes<br>";
					$data->test_result=json_decode(get_test_result_temp($dbc,$candidate_id,$test_link_id));
					$data->test_status=null;
				}
				else
				{
					$data->test_result=null;
					$data->test_status=null;
				}
			}
			else if($candidate_type==2)
			{
				if(!empty($candidate_id))
				{
					// echo "yes<br>";
					$data->test_result=json_decode(get_test_result($dbc,$candidate_id,$test_link_id));
					$data->test_status=json_decode(get_test_status($dbc,$candidate_id,$test_id));
				}
				else
				{
					$data->test_result=null;
					$data->test_status=null;
				}
			}
		
			// $data->package_id=$row['package_id'];
			$data->duration_minutes=$row['duration_minutes'];
			$data->is_enabled=$row['is_enabled'];
			$data->date=$row['date'];
			$data->pdf=null;
			$data->timing=$row['timing'];
			if(!empty($data->timing))
			{
				$data->timing_unix=strtotime($data->timing);
			}
			$data->test_type=$row['test_type'];
			$data->current_time_string=date("Y-M-D H:i:s");
			$data->current_time_unix=time();



			return json_encode($data);
		}
		else
		{
			// mysqli_error($dbc);
			return false;
		}
		
		
		
	}
	else
	{
		echo mysqli_error($dbc);
		return false;
		
	}
	
}


function get_test_id_from_link($dbc,$test_link_id)
{
	$sql="select test_id from test_link_table where id=".$test_link_id;
	if($res=mysqli_query($dbc,$sql))
	{
		if($row=mysqli_fetch_assoc($res))
		{
			return $row['test_id'];
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}


function get_package($dbc,$package_id)
{
	$sql="select * from packages where id=".$package_id;
	$id=false;
	// echo $sql;

	if($res=mysqli_query($dbc,$sql))
	{
		if($row=mysqli_fetch_assoc($res))
		{
			$data=new stdClass();
		
		$data->package_id=$row['id'];
		$data->price=$row['price_inr'];
		$data->name=$row['name'];
		$data->subject_available_ids=$row['subject_available_ids'];
		$data->is_enabled=$row['is_enabled'];
		return json_encode($data);
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
}


function get_test_status($dbc,$candidate_id,$test_id)
{
	//change the database for test_status_table
	$sql="select * from test_status_table where student_id=".$candidate_id." and test_id=".$test_id;
	$id=false;

	if($res=mysqli_query($dbc,$sql))
	{
		if($row=mysqli_fetch_assoc($res))
		{
			$data=new stdClass();
		
		$data->student_id=$row['student_id'];
		$data->test_id=$row['test_id'];
		$data->test_status=json_decode($row['test_status']);
		$data->lrt=$row['last_registered_time'];
		return json_encode($data);
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
}



function get_tests($dbc,$class_id,$candidate_id,$candidate_type)
{
	//$test_id_array=json_decode(get_test_ids_for_candidate($dbc,$class_id,$candidate_type));
	if($candidate_type==2)
	{
		$sql="select * from test_link_table where class_id=50 and is_enabled=1 order by id desc";
		// $sql="select * from test_link_table where class_id=".$class_id." and is_enabled=1 order by id desc";
	}
	else
	{

		$sql="select * from test_table order by date desc";
	}
	$id=false;
	// echo $sql;
	if($res=mysqli_query($dbc,$sql))
	{
		$arr=array();
		while($row=mysqli_fetch_assoc($res))
		{
			// $data=new stdClass();
			if($candidate_type==2)
			{
				$test_link_id=$row['id'];
			}
			else
			{
				$test_link_id=null;
			}
			$test_id=$row['test_id'];
			$data=json_decode(get_test_overview($dbc,$candidate_id,$candidate_type,$test_id,$test_link_id));
			$data->link_id=$test_link_id;
			array_push($arr, $data);
		}
		return json_encode($arr);
	}
	else
	{
		echo mysqli_error($dbc);
		return false;
		
	}
	
}



function get_students_1($dbc,$params=null)
{
	$temp="";
	$count=0;

	// echo "assad";
	if(!empty($params))
	{
		// echo "".json_encode($params);
		
		$temp="where ";
		
		if(!empty($params->class_id))
		{
			// echo "".json_encode($params);
			$temp.=("class_id=".$params->class_id);
			$count++;
		}
		if(!empty($params->center_id))
		{
			// echo "".json_encode($params);
			if($count>0)
			{

				$temp.=" and ";
			}
			$temp.="center_id=".$params->center_id;
			$count++;
		}

		if(!empty($params->name))
		{
			// echo "".json_encode($params);
			if($count>0)
			{

				$temp.=" and ";
			}
			$temp.="concat(first_name,concat(' ',second_name)) like '".$params->name."'";
			$count++;
		}
		
		if(!empty($params->parents_id))
		{
			// echo "".json_encode($params);
			if($count>0)
			{
				$temp.=" and ";
			}
			$temp.="parents_id=".$params->parents_id;
		}

		if(!empty($params->enabled))
		{
			// echo "".json_encode($params);
			if($count>0)
			{
				$temp.=" and ";
			}
			$temp.="enabled=".$params->enabled;
		}

		
	}

	$sql="select id from student_table ".$temp." order by class_id";
	// echo $sql;
	$id=false;
	
	if($res=mysqli_query($dbc,$sql))
	{
		$arr=array();
		while($row=mysqli_fetch_assoc($res)){
			
			$id=$row['id'];
			$student=json_decode(get_student($dbc,$id));
			if(!empty($student))
			{
				array_push($arr, $student);
			}
			
		}
		
		return json_encode($arr);
		
		
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
	



}


function get_employees($dbc,$params=null)
{
	$temp="";
	$count=0;

	// echo "assad";
	if(!empty($params))
	{
		// echo "".json_encode($params);
		
		$temp="where ";
		
		if(!empty($params->class_id))
		{
			// echo "".json_encode($params);
			$temp.=("class_id=".$params->class_id);
			$count++;
		}
		if(!empty($params->center_id))
		{
			// echo "".json_encode($params);
			if($count>0)
			{

				$temp.=" and ";
			}
			$temp.="center_id=".$params->center_id;
			$count++;
		}

		if(!empty($params->name))
		{
			// echo "".json_encode($params);
			if($count>0)
			{

				$temp.=" and ";
			}
			$temp.="concat(first_name,concat(' ',second_name)) like '".$params->name."'";
			$count++;
		}
		
		if(!empty($params->parents_id))
		{
			// echo "".json_encode($params);
			if($count>0)
			{
				$temp.=" and ";
			}
			$temp.="parents_id=".$params->parents_id;
		}

		if(!empty($params->enabled))
		{
			// echo "".json_encode($params);
			if($count>0)
			{
				$temp.=" and ";
			}
			$temp.="enabled=".$params->enabled;
		}
	}

	$sql="select id from employee_table ".$temp." order by post_id";
	// echo $sql;
	$id=false;
	
	if($res=mysqli_query($dbc,$sql))
	{
		$arr=array();
		while($row=mysqli_fetch_assoc($res)){
			
			$id=$row['id'];
			$employee=json_decode(get_employee($dbc,$id));
			if(!empty($employee))
			{
				array_push($arr, $employee);
			}
			// array_push($arr, $data);
		}
		
		return json_encode($arr);
		
		
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
}


function get_all_tests($dbc,$params=NULL)
{
	$temp="";
	$count=0;

	// echo "assad";
	if(!empty($params))
	{
		// echo "".json_encode($params);
		
		$temp="where ";
		
		if(!empty($params->class_id))
		{
			// echo "".json_encode($params);
			$temp.=("class_id=".$params->class_id);
			$count++;
		}
		if(!empty($params->center_id))
		{
			// echo "".json_encode($params);
			if($count>0)
			{

				$temp.=" and ";
			}
			$temp.="center_id=".$params->center_id;
			$count++;
		}
		if(!empty($params->timing_date))
		{
			// echo $params->date;
			if($count>0)
			{
				$temp.=" and ";
			}
			$temp.="date(timing)='".$params->timing_date."'";
			$count++;
		}
		if(!empty($params->date))
		{
			// echo $params->date;
			if($count>0)
			{
				$temp.=" and ";
			}
			$temp.="date(date)='".$params->date."'";
			$count++;
		}
		if(!empty($params->subject_id))
		{
			// echo "".json_encode($params);
			if($count>0)
			{
				$temp.=" and ";
			}
			$temp.="subject_id='".$params->subject_id."'";
		}

		if(!empty($params->is_full_test))
		{
			// echo "".json_encode($params);
			if($count>0)
			{
				$temp.=" and ";
			}
			$temp.="is_full_syllabus_test=1";
		}
		if(!empty($params->is_part_test))
		{
			// echo "".json_encode($params);
			if($count>0)
			{
				$temp.=" and ";
			}
			$temp.="is_full_syllabus_test=0";
		}
	}
	
	$sql="select * from test_table ".$temp." order by date desc";
	// echo $sql;
	$id=false;
	
	if($res=mysqli_query($dbc,$sql))
	{
		$arr=array();
		while($row=mysqli_fetch_assoc($res)){
			$data=new stdClass();
			$data->id=$row['id'];
			$data->test_paper_id=$row['test_paper_id'];
			$data->class_id=$row['class_id'];
			// $data->link_id=get_test_id_from_link()
			$data->name=$row['name'];
			$data->pdf=null;
			// $data->package_id=$row['package_id'];
			$data->duration_minutes=$row['duration_minutes'];
			$data->is_enabled=$row['is_enabled'];
			$data->date=$row['date'];
			$data->timing=$row['timing'];
			if(!empty($data->timing))
			{
				$data->timing_unix=strtotime($data->timing);
			}
			$data->test_type=$row['test_type'];
			$data->current_time_string=date("Y-M-D H:i:s");
			$data->current_time_unix=time();
			array_push($arr, $data);
			// array_push($arr, $data);
		}
		
		return json_encode($arr);
		
		
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
}


function get_test_result($dbc,$candidate_id,$test_link_id)
{
	$sql="select * from test_result_table where test_link_id=".$test_link_id." and candidate_id=".$candidate_id;
	$id=false;

	// echo $sql;
	if($res=mysqli_query($dbc,$sql))
	{
		if($row=mysqli_fetch_assoc($res))
		{
			$data=new stdClass();
			$data->test_id=$row['test_id'];
			$data->result_json=json_decode($row['result_json']);
			$data->marks_obtained=$row['marks_obtained'];
			$data->student_id=$candidate_id;
			$data->questions_attempted=$row['questions_attempted'];
			$data->questions_negative=$row['questions_negative'];
			$data->test_link_id=$row['test_link_id'];
			$data->questions_positive=intval($data->questions_attempted)-intval($data->questions_negative);
			$data->date=$row['date'];
			$data->rank=(json_decode(get_rank_test($dbc,$candidate_id,$data->test_id)))->rank;
			return json_encode($data);
		}
		else
		{
			// echo "nothing";
			return false;
		}
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}	
}

function get_test_result_temp($dbc,$candidate_id,$test_id)
{
	$sql="select * from test_result_temp_table where test_id=".$test_id." and candidate_id=".$candidate_id." order by date desc";
	$id=false;
	// echo $sql;
	if($res=mysqli_query($dbc,$sql))
	{
		if($row=mysqli_fetch_assoc($res))
		{
			$data=new stdClass();
			$data->test_id=$row['test_id'];
			$data->result_json=json_decode($row['result_json']);
			$data->marks_obtained=$row['marks_obtained'];
			$data->student_id=$candidate_id;
			$data->questions_attempted=$row['questions_attempted'];
			$data->questions_negative=$row['questions_negative'];
			// $data->test_link_id=$row['test_link_id'];
			$data->questions_positive=intval($data->questions_attempted)-intval($data->questions_negative);
			$data->date=$row['date'];
			// $data->rank=(json_decode(get_rank_test($dbc,$student_id,$test_id)))->rank;
			return json_encode($data);
		}
		else
		{
			// echo "nothing";
			return false;
		}
		
		
		
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}	
}

//checked
function get_test_paper($dbc,$test_paper_id)
{
	//echo $transaction_id;
	
	$sql="select * from test_paper_table where id=".$test_paper_id;
	$id=false;
	$data=new stdClass();
	if($res=mysqli_query($dbc,$sql))
	{
		
		
		if($row=mysqli_fetch_assoc($res))
		{
			$question_ids=json_decode($row['questions_json']);
			// echo "assad".json_encode($question_ids);
			$data->total_marks=$row['total_marks'];
			$data->instructions_pdf=$row['instructions_pdf'];
			// $data->cash_flow=$row['cash_flow'];
			$data->date=$row['date'];
			$id=$test_paper_id;
			$questions=array();
			foreach($question_ids as $qid)
			{
				array_push($questions, json_decode(get_question($dbc,$qid)));
			}
			$data->questions=$questions;
			return json_encode($data);
		}
		else
		{
			return false;
		}
		
		
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
	
}


function get_teacher_test_paper($dbc,$test_paper_id)
{
	//echo $transaction_id;
	
	$sql="select * from teacher_test_paper_table where id=".$test_paper_id;
	$id=false;
	$data=new stdClass();
	if($res=mysqli_query($dbc,$sql))
	{
		
		
		if($row=mysqli_fetch_assoc($res))
		{
			$data->question_pdf=$row['file'];
			$data->total_marks=$row['total_marks'];
			$data->answers=$row['answers'];
			$data->datetime=$row['datetime'];
			return json_encode($data);
			}
		else
		{
			echo mysqli_error($dbc);
			return false;
		}
		
		
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
	
}


function get_performance_student($dbc,$student_id)
{
	$ret=new stdClass;
	$result_array=array();
	$sql="select trt.test_id as test_id,trt.marks_obtained as marks_obtained,trt.questions_attempted as attempted,trt.questions_negative as negative,(trt.questions_attempted-trt.questions_negative) as positive,date(trt.date) as date,tpt.total_marks as max_marks from test_result_table as trt, test_table as tt, test_paper_table as tpt where trt.candidate_id=".$student_id." and tpt.id=tt.test_paper_id and tt.id=trt.test_id order by date";
		// echo $sql;
		$id=false;
		
		if($res=mysqli_query($dbc,$sql))
		{
			$avg=0;
			$count=0;
			while($row=mysqli_fetch_assoc($res))
			{
				$data=new stdClass();
				$data->marks_obtained=$row['marks_obtained'];
				$data->test_id=$row['test_id'];
				$data->attempted=$row['attempted'];
				$data->negative=$row['negative'];
				$data->positive=$row['positive'];
				$data->date=$row['date'];
				$data->max_marks=$row['max_marks'];
				$data->percentage=floatval(($data->marks_obtained*100)/$data->max_marks);
				$avg+=$data->percentage;
				$count++;
				$data->rank=(json_decode(get_rank_test($dbc,$student_id,$data->test_id)))->rank;
				array_push($result_array,$data);
			}
			$ret->test_results=$result_array;
			if($count!=0){
				$ret->average_percentage=$avg/$count;
			}
			else{
				$ret->average_percentage=0;
			}
			
			$ret->tests_given_count=$count;
			return json_encode($ret);	
		}
		else
		{
			return false;
			echo mysqli_error($dbc);
		}
}

function get_question_single($dbc,$row,$question_id)
{
	$data=new stdClass();
	$data->id=$question_id;
	$data->subject=get_subject_name($dbc,$row['subject_id']);
	$data->subject_id=$row['subject_id'];
	$data->difficulty=$row['difficulty'];
	$data->topic=get_topic_name($dbc,$row['topic_id']);
	$data->topic_id=$row['topic_id'];
	$data->question=$row['question_json'];
	$data->options=json_decode(stripslashes($row['options_json']));
	$data->correct_ans=$row['correct_ans'];
	$data->solution=json_decode(stripslashes($row['solution']));
	$data->image=$row['image'];
	$data->marking=$row['marking'];
	$data->question_type=$row['question_type'];
	$data->review=$row['review'];
	return json_encode($data);
}

function get_question_multiple($dbc,$row,$question_id)
{
	$data=new stdClass();
	$data->id=$question_id;
	$data->subject=get_subject_name($dbc,$row['subject_id']);
	$data->subject_id=$row['subject_id'];
	$data->difficulty=$row['difficulty'];
	$data->topic=get_topic_name($dbc,$row['topic_id']);
	$data->topic_id=$row['topic_id'];
	$data->question=$row['question_json'];
	$data->options=json_decode(stripslashes($row['options_json']));
	$data->correct_ans=$row['correct_ans'];
	$data->solution=json_decode(stripslashes($row['solution']));
	$data->image=$row['image'];
	$data->marking=$row['marking'];
	$data->question_type=$row['question_type'];
	return json_encode($data);
}


function get_question_comprehension($dbc,$row,$question_id)
{
	$data=new stdClass();
	$data->id=$question_id;
	$data->comprehension=json_decode(get_comprehension($dbc,$row['comprehension_id']));
	$data->subject=get_subject_name($dbc,$row['subject_id']);
	$data->subject_id=$row['subject_id'];
	$data->difficulty=$row['difficulty'];
	$data->topic=get_topic_name($dbc,$row['topic_id']);
	$data->topic_id=$row['topic_id'];
	$data->question=$row['question_json'];
	$data->options=json_decode(stripslashes($row['options_json']));
	$data->correct_ans=$row['correct_ans'];
	$data->solution=json_decode(stripslashes($row['solution']));
	$data->image=$row['image'];
	$data->marking=$row['marking'];
	$data->question_type=$row['question_type'];
	return json_encode($data);
}

function get_question_matrix_match($dbc,$row,$question_id)
{
	$data=new stdClass();
	$data->id=$question_id;
	$data->subject=get_subject_name($dbc,$row['subject_id']);
	$data->subject_id=$row['subject_id'];
	$data->difficulty=$row['difficulty'];
	$data->topic=get_topic_name($dbc,$row['topic_id']);
	$data->topic_id=$row['topic_id'];
	//keys=> value_[A,B,C,D,P,Q,R,S]
	$data->question=json_decode($row['question_json']);
	$data->options=json_decode(stripslashes($row['options_json']));
	$data->correct_ans=$row['correct_ans'];
	$data->solution=json_decode(stripslashes($row['solution']));
	$data->image=$row['image'];
	$data->marking=$row['marking'];
	$data->question_type=$row['question_type'];
	return json_encode($data);
}
function get_question_true_false($dbc,$row,$question_id)
{
	$data=new stdClass();
	$data->id=$question_id;
	$data->subject=get_subject_name($dbc,$row['subject_id']);
	$data->subject_id=$row['subject_id'];
	$data->difficulty=$row['difficulty'];
	$data->topic=get_topic_name($dbc,$row['topic_id']);
	$data->topic_id=$row['topic_id'];
	$data->question=$row['question_json'];
	$data->options=json_decode(stripslashes($row['options_json']));
	$data->correct_ans=$row['correct_ans'];
	$data->solution=json_decode(stripslashes($row['solution']));
	$data->image=$row['image'];
	$data->marking=$row['marking'];
	$data->question_type=$row['question_type'];
	return json_encode($data);
}
function get_question_integer($dbc,$row,$question_id)
{
	$data=new stdClass();
	$data->id=$question_id;
	$data->subject=get_subject_name($dbc,$row['subject_id']);
	$data->subject_id=$row['subject_id'];
	$data->difficulty=$row['difficulty'];
	$data->topic=get_topic_name($dbc,$row['topic_id']);
	$data->topic_id=$row['topic_id'];
	$data->question=$row['question_json'];
	$data->options=json_decode(stripslashes($row['options_json']));
	$data->correct_ans=$row['correct_ans'];
	$data->solution=json_decode(stripslashes($row['solution']));
	$data->image=$row['image'];
	$data->marking=$row['marking'];
	$data->question_type=$row['question_type'];
	return json_encode($data);
}
function get_question_fillups($dbc,$row,$question_id)
{
	$data=new stdClass();
	$data->id=$question_id;
	$data->subject=get_subject_name($dbc,$row['subject_id']);
	$data->subject_id=$row['subject_id'];
	$data->difficulty=$row['difficulty'];
	$data->topic=get_topic_name($dbc,$row['topic_id']);
	$data->topic_id=$row['topic_id'];
	$data->question=$row['question_json'];
	$data->options=json_decode(stripslashes($row['options_json']));
	$data->correct_ans=$row['correct_ans'];
	$data->solution=json_decode(stripslashes($row['solution']));
	$data->image=$row['image'];
	$data->marking=$row['marking'];
	$data->question_type=$row['question_type'];
	return json_encode($data);
}
function get_question_assertion_reason($dbc,$row,$question_id)
{
	$data=new stdClass();
	$data->id=$question_id;
	$data->subject=get_subject_name($dbc,$row['subject_id']);
	$data->subject_id=$row['subject_id'];
	$data->difficulty=$row['difficulty'];
	$data->topic=get_topic_name($dbc,$row['topic_id']);
	$data->topic_id=$row['topic_id'];
	//keys=> assertion and reason
	$data->question=json_decode($row['question_json']);
	$data->options=json_decode(stripslashes($row['options_json']));
	$data->correct_ans=$row['correct_ans'];
	$data->solution=json_decode(stripslashes($row['solution']));
	$data->image=$row['image'];
	$data->marking=$row['marking'];
	$data->question_type=$row['question_type'];
	return json_encode($data);
}
function get_question_boards($dbc,$row,$question_id)
{
	$data=new stdClass();
	$data->id=$question_id;
	$data->subject=get_subject_name($dbc,$row['subject_id']);
	$data->subject_id=$row['subject_id'];
	$data->difficulty=$row['difficulty'];
	$data->topic=get_topic_name($dbc,$row['topic_id']);
	$data->topic_id=$row['topic_id'];
	$data->question=$row['question_json'];
	$data->options=json_decode(stripslashes($row['options_json']));
	$data->correct_ans=$row['correct_ans'];
	$data->solution=json_decode(stripslashes($row['solution']));
	$data->image=$row['image'];
	$data->marking=$row['marking'];
	$data->question_type=$row['question_type'];
	return json_encode($data);
}
function get_question_matrix_match_3($dbc,$row,$question_id)
{
	$data=new stdClass();
	$data->id=$question_id;
	$data->subject=get_subject_name($dbc,$row['subject_id']);
	$data->subject_id=$row['subject_id'];
	$data->difficulty=$row['difficulty'];
	$data->topic=get_topic_name($dbc,$row['topic_id']);
	$data->topic_id=$row['topic_id'];
	$data->question=json_decode($row['question_json']);
	$data->options=json_decode(stripslashes($row['options_json']));
	$data->correct_ans=$row['correct_ans'];
	$data->solution=json_decode(stripslashes($row['solution']));
	$data->image=$row['image'];
	$data->marking=$row['marking'];
	$data->question_type=$row['question_type'];
	return json_encode($data);
}

function get_question_decimal($dbc,$row,$question_id)
{
	$data=new stdClass();
	$data->id=$question_id;
	$data->subject=get_subject_name($dbc,$row['subject_id']);
	$data->subject_id=$row['subject_id'];
	$data->difficulty=$row['difficulty'];
	$data->topic=get_topic_name($dbc,$row['topic_id']);
	$data->topic_id=$row['topic_id'];
	$data->question=$row['question_json'];
	$data->options=json_decode(stripslashes($row['options_json']));
	$data->correct_ans=$row['correct_ans'];
	$data->solution=json_decode(stripslashes($row['solution']));
	$data->image=$row['image'];
	$data->marking=$row['marking'];
	$data->question_type=$row['question_type'];
	return json_encode($data);
}

function get_comprehension($dbc,$comprehension_id)
{
	$sql="select * from comprehension_table where id=".$comprehension_id;
	$id=false;
	$data=new stdClass();
	if($res=mysqli_query($dbc,$sql))
	{
		if($row=mysqli_fetch_assoc($res))
		{
		$data->id=$comprehension_id;
		$data->subject_id=$row['subject_id'];
		$data->subject=get_subject_name($dbc,$data->subject_id);
		$data->name=$row["name"];
		$data->content=json_decode(stripslashes($row["content_json"]));
		return json_encode($data);
		}
		else
		{
			return false;
		}
		
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
}
//checked
function get_question($dbc,$question_id)
{
	$sql="select * from question_table where id=".$question_id;
	$id=false;
	$data=new stdClass();
	if($res=mysqli_query($dbc,$sql))
	{
		if($row=mysqli_fetch_assoc($res))
		{
			if($row['question_type']==1)
			{
				return get_question_single($dbc,$row,$question_id);
			}
			else if($row['question_type']==2)
			{
				return get_question_multiple($dbc,$row,$question_id);
			}
			else if($row['question_type']==3)
			{
				return get_question_comprehension($dbc,$row,$question_id);
			}
			else if($row['question_type']==4)
			{
				return get_question_matrix_match($dbc,$row,$question_id);
			}
			else if($row['question_type']==5)
			{
				return get_question_true_false($dbc,$row,$question_id);
			}
			else if($row['question_type']==6)
			{
				return get_question_integer($dbc,$row,$question_id);
			}
			else if($row['question_type']==7)
			{
				return get_question_fillups($dbc,$row,$question_id);
			}
			else if($row['question_type']==8)
			{
				return get_question_assertion_reason($dbc,$row,$question_id);
			}
			else if($row['question_type']==9)
			{
				return get_question_boards($dbc,$row,$question_id);
			}
			else if($row['question_type']==10)
			{
				return get_question_matrix_match_3($dbc,$row,$question_id);
			}
			else if($row['question_type']==11)
			{
				return get_question_decimal($dbc,$row,$question_id);
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
		
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
	
}



function get_topic_name($dbc,$topic_id){
	$sql="select * from topic_table where id=".$topic_id;
	$id=false;
	$data=new stdClass();
	if($res=mysqli_query($dbc,$sql))
	{
		if($row=mysqli_fetch_assoc($res))
		{
		$data->id=$topic_id;
		$data->name=$row["name"];
		$data->subject_id=$row['subject_id'];
		
		$data->codeword=$row['codeword'];
		$data->parent_id=$row['parent_id'];
		
		return json_encode($data);
		}
		else
		{
			return false;
		}
		
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
}


function get_questions($dbc)
{
	$sql="select * from question_table";
	$data=array();
	if($res=mysqli_query($dbc,$sql))
	{
		while($row=mysqli_fetch_assoc($res))
		{
			$d=new stdClass();
			$d->id=$row['stream'];
			$d->value=$row['val'];
			array_push($data,$d);
		}
		
		return json_encode($data);
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
}


function get_performance_test($dbc,$student_id,$test_id)
{
	$sql="select trt.marks_obtained as marks_obtained,trt.questions_attempted as attempted,trt.questions_negative as negative,(trt.questions_attempted-trt.questions_negative) as positive,date(trt.date) as date,tpt.total_marks as max_marks from test_result_table as trt, test_table as tt, test_paper_table as tpt where trt.test_id=".$test_id." and trt.candidate_id=".$student_id." and tpt.id=tt.test_paper_id and tt.id=trt.test_id order by date";
		// echo $sql;
		$id=false;
		$data=new stdClass();
		if($res=mysqli_query($dbc,$sql))
		{
			
			if($row=mysqli_fetch_assoc($res))
			{
				$data->marks_obtained=$row['marks_obtained'];
				$data->attempted=$row['attempted'];
				$data->negative=$row['negative'];
				$data->positive=$row['positive'];
				$data->date=$row['date'];
				$data->max_marks=$row['max_marks'];
				$data->rank=(json_decode(get_rank_test($dbc,$student_id,$test_id)))->rank;
			return json_encode($data);
			}
			else
			{
				echo mysqli_error($dbc);
				return false;
			}
			
		}
		else
		{
			return false;
			echo mysqli_error($dbc);
		}
}

function get_rank_test($dbc,$student_id,$test_id)
{
	if(mysqli_query($dbc,"set @rank:=0;")){

		$sql="SELECT * FROM ( SELECT *, @rank := @rank + 1 AS rank FROM test_result_table where test_id=".$test_id." ORDER BY marks_obtained desc) as ranked WHERE candidate_id = ".$student_id;
		// echo $sql;
		$id=false;
		$data=new stdClass();
		if($res=mysqli_query($dbc,$sql))
		{
			// echo "sdas";
			if($row=mysqli_fetch_assoc($res))
			{
			$data->rank=$row["rank"];
			return json_encode($data);
			}
			else
			{
				return false;
			}
			
		}
		else
		{
			return false;
			echo mysqli_error($dbc);
		}
	}
	else{
		return false;
		echo mysqli_error($dbc);
	}
}

function get_rank($dbc,$student_id)
{
	if(mysqli_query($dbc,"set @rank:=0;")){
		$sql="select * from (select *,@rank:=@rank+1 as rank from (select avg(marks_obtained/(select total_marks from test_paper_table where id=(select test_paper_id from test_table where id=trt.test_id))) as tot,candidate_id from test_result_table trt group by candidate_id order by tot desc) as tt) as te where candidate_id=".$student_id;
		$id=false;
		$data=new stdClass();
		if($res=mysqli_query($dbc,$sql))
		{
			if($row=mysqli_fetch_assoc($res))
			{
			// $data->id=$topic_id;
			$data->rank=$row["rank"];
			$data->average_score=$row['tot'];
			return json_encode($data);
			}
			else
			{
				return false;
			}
			
		}
		else
		{
			echo mysqli_error($dbc);
			return false;
		}
	}
	else
		{
			echo mysqli_error($dbc);
			return false;
		}
}


function exit_function(){
	$ret=new stdClass;
	$ret->status="failed";
	echo json_encode($ret);
	exit(-1);
}



//utility starts from here
function create_user_pass($mobile,$dob)
{
	$dob=str_replace("-","",$dob);
	return array($mobile."@gclasses.in",$mobile."".$dob);
}

function create_user_pass_parents($mobile,$dob)
{
	$dob=str_replace("-","",$dob);
	return array($mobile,substr(md5($mobile."".$dob."p"),0,8));
}

function create_user_pass_employee($mobile,$dob)
{
	$dob=str_replace("-","",$dob);
	return array($mobile."@gclasses.in",$mobile."".$dob);
	// $dob=str_replace("-","",$dob);
	// return array($mobile,substr(md5($mobile."".$dob."e"),0,8));
}

function insert_enquiry($dbc,$center_id,$first_name=null,$last_name=null,$email=null,$phone=null,$query=null,$class=null,$stream=null,$school=null,$guardian_name=null,$guardian_mobile=null,$address=null,$remarks=null,$board=null,$course=null,$follow_up_employee_id)
{
	$sql="INSERT INTO `enquiry_table`( `first_name`,`last_name`, `email`, `phone`, `query`,`class`, `stream`, `center_id`, `school`, `guardian_name`, `guardian_mobile`, `address`, `remarks`, `board`,`course`,`follow_up_employee_id`) VALUES ('".$first_name."','".$last_name."','".$email."','".$phone."','".$query."','".$class."','".$stream."',".$center_id.",'".$school."','".$guardian_name."','".$guardian_mobile."','".$address."','".$remarks."','".$board."','".$course."','".$follow_up_employee_id."')";
	// echo $sql;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	else
	{
		echo mysqli_error($dbc);
	}
	return $id;

}




function insert_event($dbc,$event_type,$emp_id,$center_id,$remarks){

	$sql="INSERT INTO `event_table`(`event_type`, `emp_id`, `center_id`,`remarks`) VALUES (".$event_type.",".$emp_id.",".$center_id.",'".$remarks."')";
	//echo $sql;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	
	//echo "done ".$id;
	return $id;
}



function insert_entrance_result($dbc,$correct,$incorrect,$marks_obtained,$scholarship_percent)
{
	$sql="INSERT INTO `entrance_result_table`(`correct`, `incorrect`, `marks_obtained`,`scholarship_percent`) VALUES (".$correct.",".$incorrect.",".$marks_obtained.",".$scholarship_percent.")";
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	return $id;
}






function insert_gtse_registration($dbc,$first_name,$last_name,$guardian_name,$programme_id,$center_id,$school,$pic_path,$phone){

	$sql="INSERT INTO `gtse_registration_table`(`first_name`, `last_name`, `guardian_name`,`school`,`pic_path`,`center_id`,`programme_id`,`phone`) VALUES ('".$first_name."','".$last_name."','".$guardian_name."','".$school."','".$pic_path."',".$center_id.",".$programme_id.",'".$phone."')";
	//echo $sql;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{

		$id=mysqli_insert_id($dbc);
	}
	else
	{
		return false;
	}
	return $id;
}




//check if a user is logged in from either server(session) side or the client(cookie) side
function check_login()
{
	if(isset($_SESSION['data_json']))
	{
		set_session($_SESSION['data_json']);
		return $_SESSION['data_json'];
	}
	else if(isset($_COOKIE['data_json']))
	{
		set_session($_COOKIE['data_json']);
		return $_SESSION['data_json'];
	}
	else
	{
		
		return false;

	}
}

//used by logout script(to be made at this point)
function unset_cookie($key)
{
	if (isset($_COOKIE[$key])) {
    unset($_COOKIE[$key]);
    setcookie($key, '', time() - 3600, '/'); // empty value and old timestamp
	}
}



//used by login script(to be made at this point)
function get_login($dbc,$username,$password)
{

	$data=false;
	$id=0;
	$sql="select * from credential_table where username='".trim($username)."' and password='".trim($password)."'";
	// echo $sql;
	if($res=mysqli_query($dbc,$sql))
	{
		$data=new stdClass;
		$row=mysqli_fetch_assoc($res);

		$candidate_type=$row['user_type'];
		// echo json_encode($row);
		$id=$row['candidate_id'];
		if(empty($id))
		{
			return false;
			
		}
		// echo "id is: ". $row['id'];
		$data->id=$id;
		$data->candidate_type=get_user_type_name($dbc,$candidate_type);
		$data->candidate_type_id=$candidate_type;
		// $data->candidate=get_user($dbc,$data);
		
		$json_data=json_encode($data);
		set_session($json_data);
		return $json_data;
	}
	else
	{
		// echo mysqli_error($dbc);
		return false;
	}
	
}



function get_user($dbc,$data){
		$temp=false;
		$id=$data->id;
		if($data->candidate_type_id==2)
		{
			//student
			$temp=get_student($dbc,$id);
		}
		else if($data->candidate_type_id==3)
		{
			//parents
			$temp=get_parents($dbc,$id);
		}
		else 
		{
			//staff
			$temp=get_employee($dbc,$id);
		}
		return $temp;
}

function get_credential($dbc,$user_type,$id)
{
	$data=new stdClass;
	$sql="select * from credential_table where candidate_id=".$id." and user_type=".$user_type;
	//echo $sql;
	if($res=mysqli_query($dbc,$sql))
	{
		$row=mysqli_fetch_assoc($res);
		
		$data->username=$row['username'];
		$data->password=$row['password'];
	}
	else
	{
		return false;
	}
	return json_encode($data);

}


function get_entrance_result($dbc,$id)
{
	 // id 	correct 	incorrect 	marks_obtained 	scholarship_percent 	extra
	$data=new stdClass;
	$sql="select * from entrance_result_table where id=".$id;
	//echo $sql;
	if($res=mysqli_query($dbc,$sql))
	{
		$row=mysqli_fetch_assoc($res);
		
		$data->id=$row['id'];
		$data->correct=$row['correct'];
		$data->incorrect=$row['incorrect'];
		$data->marks_obtained=$row['marks_obtained'];
		$data->scholarship_percent=$row['scholarship_percent'];

	}
	else
	{
		return false;
	}
	return json_encode($data);

}




function get_next_installment($dbc,$fee_id)
{
	$data=new stdClass;
	$sql="select id from installment_table where fee_id=".$fee_id." and pending = 1 order by date_of_submission limit 1";
	//echo $sql;
	if($res=mysqli_query($dbc,$sql))
	{
		if($row=mysqli_fetch_assoc($res))
		{
			$data->id=$row['id'];
		}
		else
		{
			$data->id=0;
		}
	}
	else
	{
		return false;
	}
	return json_encode($data);
}




function try_getting_gtse_reg_id($dbc,$phone)
{
	$data=new stdClass;
	$sql="select * from gtse_registration_table where phone=".$phone;
	//echo $sql;
	if($res=mysqli_query($dbc,$sql))
	{
		$row=mysqli_fetch_assoc($res);
		
		$data->id=$row['id'];
	}
	else
	{
		return false;
	}
	return json_encode($data);

}




function set_session($data)
{
	$_SESSION['data_json']=$data;
}


function set_fee_into_admission($dbc,$admission_id,$fee_id)
{
	$data=new stdClass;
	$sql="update admission_table set fee_id=".$fee_id." where id=".$admission_id;
	//echo $sql;
	if($res=mysqli_query($dbc,$sql))
	{
		return true;
	}
	else
	{
		return false;
	}
	// return json_encode($data);
}


function set_gtse_result_into_admission($dbc,$admission_id,$gtse_result_id)
{
	$data=new stdClass;
	$sql="update admission_table set gtse_test_result_id=".$gtse_result_id." where id=".$admission_id;
	//echo $sql;
	if($res=mysqli_query($dbc,$sql))
	{
		return true;
	}
	else
	{
		return false;
	}
	// return json_encode($data);

}


function set_admission_enabled($dbc,$admission_id,$enabled)
{
	$data=new stdClass;
	$sql="update admission_table set enabled=".$enabled." where id=".$admission_id;
	//echo $sql;
	if($res=mysqli_query($dbc,$sql))
	{
		return true;
	}
	else
	{
		return false;
	}
	// return json_encode($data);

}





function update_batch_table($dbc,$param)
{

	$temp="";
	$count=0;

	// echo "assad";
	if(!empty($params))
	{
		// echo "".json_encode($params);
		
		$temp="where ";
		
		if(!empty($params->class_id))
		{
			// echo "".json_encode($params);
			$temp.=("class_id=".$params->class_id);
			$count++;
		}
		if(!empty($params->center_id))
		{
			// echo "".json_encode($params);
			if($count>0)
			{

				$temp.=" and ";
			}
			$temp.="center_id=".$params->center_id;
			$count++;
		}
		// if(!empty($params->package_id))
		// {
		// 	// echo "".json_encode($params);
		// 	if($count>0)
		// 	{

		// 		$temp.=" and ";
		// 	}
		// 	$temp.="package_id=".$params->package_id;
		// 	$count++;
		// }
		if(!empty($params->date))
		{
			// echo $params->date;
			if($count>0)
			{
				$temp.=" and ";
			}
			$temp.="date(timing)='".$params->date."'";
			$count++;
		}
		if(!empty($params->subject_id))
		{
			// echo "".json_encode($params);
			if($count>0)
			{
				$temp.=" and ";
			}
			$temp.="subject_id='".$params->subject_id."'";
		}
	}
}


//enable / disable accounts by setting the enabled column
function set_account_state($dbc,$user_type,$id,$access_value)
{
	$table_name="";
	if($user_type==3)//parent
	{
		$table_name="parents_table";
	}
	else if($user_type==2)//student
	{
		$table_name="student_table";
	}
	else//employee
	{
		$table_name="employee_table";
	}

	$sql="update ".$table_name." set enabled=".$access_value." where id=".$id;
	// echo $sql;
	//$sql="INSERT INTO `credential_table`(`candidate_id`, `user_type`, `username`, `password`) VALUES (".$id.",".$user_type.",'".$username."','".$password."')";
	//$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		return true;
		// $id=mysqli_insert_id($dbc);
	}
	else
	{
		return false;
		// echo mysqli_error($dbc);
	}
	//echo "done ".$id;
	// return $id;

}


//review is the part where teachers check and give corrections from!
function set_question_review($dbc,$question_id,$value)
{
	$sql="update question_table set review='".$value."' where id=".$question_id;
	if($res=mysqli_query($dbc,$sql))
	{
		return true;
	}
	else
	{
		return false;
	}
}

//review is the part where teachers check and give corrections from!
function increment_question_correct($dbc,$question_id)
{
	$sql="update question_table set times_correct=(times_correct + 1) where id=".$question_id;
	if($res=mysqli_query($dbc,$sql))
	{
		return true;
	}
	else
	{
		return false;
	}
}

//review is the part where teachers check and give corrections from!
function increment_question_incorrect($dbc,$question_id)
{
	$sql="update question_table set times_incorrect=(times_incorrect + 1) where id=".$question_id;
	if($res=mysqli_query($dbc,$sql))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function get_difficulty($correct,$incorrect)
{
	if($correct!=0 or $incorrect!=0)
	{
		return 10*($incorrect/($correct+$incorrect));
	} 	
}

function get_latest_batch($dbc,$class,$stream,$center_id,$session_id){

	$sql="select max(batch_number) as max from batch_table where class_id=".$class." and stream_id=".$stream." and center_id=".$center_id." and session_id=".$session_id;
	if($res=mysqli_query($dbc,$sql))
	{
		if($row=mysqli_fetch_assoc($res))
		{
			// if(empty($row['max']))
			// {
			// 	return 1;
			// }
			return intval($row['max']);
		}
		else
		{

			return 1;
		}
	}
	else
	{
		// echo "ssa";
		// echo "error[".mysqli_error($dbc)."]";
		return false;
	}
}



function clear_session()
{
	unset_cookie("data_json");
	unset($_SESSION['data_json']);
	session_destroy();
}


//user_type= integer refer user types table
function insert_credential($dbc,$user_type,$username,$password,$id)
{
	$sql="INSERT INTO `credential_table`(`candidate_id`, `user_type`, `username`, `password`) VALUES (".$id.",".$user_type.",'".$username."','".$password."')";
	//echo $sql;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	else
	{
		//echo mysqli_error($dbc);
	}
	return $id;
}

//insert_enquiry does the same
function insert_query($dbc,$email,$query,$name,$mobile,$class,$stream,$center_id,$school,$board,$age,$category,$guardian_name,$guardian_mobile,$remarks)
{
	$sql="INSERT INTO `enquiry_table`(`email`, `query`, `name`, `phone`,  `class`,`stream`, `center_id`,`school`,`board`,`age`,`category`,`guardian_name`,`guardian_mobile`,`remarks`) VALUES ('".$email."','".$query."','".$name."','".$mobile."','".$class."','".$stream."',".$center_id.",'".$school."','".$board."','".$age."','".$category."','".$guardian_name."','".$guardian_mobile."','".$remarks."')";
	
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	else
	{
		echo mysqli_error($dbc);
	}
	//echo "done ".$id;
	return $id;
}

function insert_batch($dbc,$class_id,$programme_id, $stream, $center_id,$name,$session_id,$subjects_json)
{
	$seen_questions="[]";
	$batch_number=get_latest_batch($dbc,$class_id,$stream,$center_id,$session_id)+1;//returns the current required batch number to be inserted!!
	// echo $batch_number;
	$sql="INSERT INTO `batch_table`(`class_id`,`programme_id`, `stream_id`, `center_id`,`batch_number` , `name`,`session_id`,`seen_questions`,`subjects_json`) VALUES (".$class_id.",'".$programme_id."',".$stream.",".$center_id.",".$batch_number.",'".$name."',".$session_id.",'".$seen_questions."','".$subjects_json."')";
	// echo $sql;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	else
	{
		// echo mysqli_error($dbc);
	}
	//echo "done ".$id;
	return $id;
}
//checked
function insert_address($dbc,$add,$phone)
{
	$add[2]=trim($add[2]);
	//echo "here: ".$add[2];
	$sql="INSERT INTO `address_table`(`city`, `state`, `pincode`, `address`, `phone`) VALUES ('".$add[0]."','".$add[1]."','".$add[2]."','".$add[3]."','".$phone."')";
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	else
	{
		echo mysqli_error($dbc);
	}
	//echo "done ".$id;
	return $id;
}

function insert_admission($dbc, $student_id,$center_id, $enquiry_id=0,$gtse_result_id=0)
{
	
	//echo "here: ".$add[2];
	if($enquiry_id=0)
	{
		$sql="INSERT INTO `admission_table`(`student_id`,`center_id`) VALUES (".$student_id.",".$center_id.")";
	}
	else if($gtse_result_id==0)
	{
		$sql="INSERT INTO `admission_table`(`student_id`,`center_id`,`enquiry_id`) VALUES (".$student_id.",".$center_id.",".$enquiry_id.")";
	}
	else
	{
		$sql="INSERT INTO `admission_table`(`student_id`,`center_id`,`enquiry_id`,`gtse_test_result_id`) VALUES (".$student_id.",".$center_id.",".$enquiry_id.",".$gtse_result_id.")";
	}
	
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	else
	{
		echo mysqli_error($dbc);
	}
	//echo "done ".$id;
	return $id;
}

//checked
// function save_fee($dbc,
// 	$number_installments, 
// 	$f_installment_date,
// 	$f_installment_amount, 
// 	$total_fee,$fi_payment_mode,
// 	$tax_paid,$s_installment_date="NULL", 
// 	$s_installment_amount=0, 
// 	$t_installment_date="NULL", 
// 	$t_installment_amount=0,
// 	$l_installment_date="NULL", 
// 	$l_installment_amount=0,
// 	$remarks="none")
// {
// 	//echo $number_installments;
// 	$t=0;
// 	if($tax_paid=="on")
// 	{
// 		$t=1;
// 	}
// 	$t_installment_date = !empty($t_installment_date) ? $t_installment_date : "NULL";
// 	$s_installment_date = !empty($s_installment_date) ? $s_installment_date : "NULL";
// 	$l_installment_date = !empty($l_installment_date) ? $l_installment_date : "NULL";
// 	// echo $s_installment_date;
	

// 	$sql="INSERT INTO `fee_table`(`number_installments`, `total_fee`, `fi_amount`, `fi_date`, `si_amount`, `si_date`, `ti_amount`, `ti_date`, `li_amount`, `li_date`, `fi_payment_mode`, `remarks`, `tax_paid`) VALUES (".$number_installments.",".$total_fee.",".$f_installment_amount.",'".$f_installment_date."',".$s_installment_amount.",'".$s_installment_date."',".$t_installment_amount.",'".$t_installment_date."',".$l_installment_amount.",'".$l_installment_date."',".$fi_payment_mode.",'".$remarks."',".$t.")";
// 	//echo $sql;
// 	$id=false;
// 	if($res=mysqli_query($dbc,$sql))
// 	{
// 		$id=mysqli_insert_id($dbc);
// 	}
// 	else
// 	{
// 		echo mysqli_error($dbc);
// 	}
// 	return $id;
// }

// checked
function insert_parents($dbc,$guardian_name,$guardian_mobile,$contact_id)
{
	$sql="INSERT INTO `parents_table`(`name`,`phone`,`contact_id`) VALUES ('".$guardian_name."','".$guardian_mobile."',".$contact_id.")";
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	else
	{
		//echo mysqli_error($dbc);
	}
	return $id;
}

//checked
function insert_contact($dbc,$name,$email,$mobile,$add_id_1,$add_id_2)
{
	$sql="INSERT INTO `contact_table`(`email`, `phone`, `permanent_address_id`, `local_address_id`, `name`) VALUES ('".$email."','".$mobile."',".$add_id_1.",".$add_id_2.",'".$name."')";
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	else
	{
		echo mysqli_error($dbc);
	}
	return $id;
}

//checked
function insert_employee($dbc,$name, $user_type, $post, $working_hours, $address_id, $phone, $username, $password)
{
	$sql="INSERT INTO `employee_table`( `name`, `user_type`, `post`, `working_hours`, `address_id`, `phone`, `username`, `password`) VALUES ('".$name."', ".$user_type.", '".$post."', '".$working_hours."', ".$address_id.", '".$phone."', '".$username."', '".$password."')";
	// $id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	else
	{
		echo mysqli_error($dbc);
	}
	return $id;


}


//checked working
// $email,$first_name, $last_name,$mobile, $gender, $date_of_birth,$contact_id,$class_id,$dp_name
function insert_student($dbc,$email,$first_name,$last_name,$phone,$gender,$date_of_birth,$contact_id,$class_id,$guardian_name,$guardian_phone,$school="-",$dp_name="-")
{
	$sql="INSERT INTO `student_table`(`email`,`first_name`, `last_name`, `phone`, `gender`, `contact_id`, `date_of_birth`,`dp`,`class_id`,`school`,`guardian_name`,`guardian_phone`) VALUES ('".$email."','".$first_name."','".$last_name."','".$phone."','".$gender."',".$contact_id.",'".$date_of_birth."','".$dp_name."',".$class_id.",'".$school."','".$guardian_name."','".$guardian_phone."')";
	// echo $sql;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	else
	{
		// echo mysqli_error($dbc);
	}
	return $id;
}



//  checked
function insert_transaction($dbc,$transaction_type, $amount, $cash_flow, $employee_id,$target_id, $pic_path, $remarks,$taxable,$tax_amount,$payment_mode,$center_id)
{
	// echo $center_id;
	$sql="INSERT INTO `transaction_table`(`transaction_type`,`amount`,`remarks`,`cash_flow`, `employee_id`,`target_id`,`pic_path`,`taxable`,`tax_amount`,`payment_mode`,`center_id`) VALUES (".$transaction_type.", ".$amount.", '".$remarks."', '".$cash_flow."', ".$employee_id.",".$target_id.",'".$pic_path."',".$taxable.",".$tax_amount.",".$payment_mode.",".$center_id.")";
	// echo $sql;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	else
	{
		echo mysqli_error($dbc);
	}
	return $id;
}

// checked this inserts installment and also include the plan_id
function insert_installment($dbc,$plan_id,$amount_intended,$date_of_submission)
{
	//5 --=--> transaction type
	
	$sql="INSERT INTO `installment_table`( `plan_id`,`amount_intended`, `date_of_submission`) VALUES (".$plan_id.", ".$amount_intended.", '".$date_of_submission."')";
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$id=mysqli_insert_id($dbc);
	}
	else
	{
		echo mysqli_error($dbc);
	}
	return $id;
}

function receive_installment($dbc,$installment_id,$amount_submitted,$employee_id,$center_id,$payment_mode)
{
	//5 --=--> transaction type
	
	$sql="UPDATE `installment_table` set amount_submitted=".$amount_submitted." , employee_id=".$employee_id." ,center_id=".$center_id.",payment_mode=".$payment_mode.",pending=0 where id=".$installment_id;
	// echo $sql;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		return true;
	}
	else
	{
		echo mysqli_error($dbc);
	}
	return $id;
}


function delete_installment($dbc,$installment_id)
{
	$sql="delete from installment_table where id=".$installment_id;
	
	if($res=mysqli_query($dbc,$sql))
	{
		return true;
	}
	else
	{
		echo mysqli_error($dbc);
		return false;
	}
	
}


function delete_transaction($dbc,$transaction_id)
{
	$sql="delete from transaction_table where id=".$transaction_id;
	
	if($res=mysqli_query($dbc,$sql))
	{
		return true;
	}
	else
	{
		echo mysqli_error($dbc);
		return false;
	}
	
}


function save_tr_into_a_file($dbc,$transaction_id)
{
	$myFile = "../extra/operations.txt";
	$fh = fopen($myFile, 'a');
	if(empty($fh))
	{
		return false;
	}

	$transaction=get_transaction($dbc,$transaction_id);
	if(!empty($transaction))
	{
		$stringData = $transaction."\n";
		fwrite($fh, $stringData);
		return true;
	}
	else
	{
		return false;
	}
}



function get_student_id($dbc,$admission_id)
{
	$sql="select student_id from admission_table where id=".$admission_id;
	$id=false;
	if($res=mysqli_query($dbc,$sql))
	{
		$row=mysqli_fetch_assoc($res);
		$id=$row['student_id'];
	}
	else
	{
		echo mysqli_error($dbc);
	}
	return $id;
}

//checked
function get_contact($dbc,$contact_id)
{

	$sql="select * from contact_table where id=".$contact_id;
	$id=false;
	$data=new stdClass();
	if($res=mysqli_query($dbc,$sql))
	{
		$row=mysqli_fetch_assoc($res);
		$id=$row['id'];


		$local_address_id=$row['local_address_id'];
		$permanent_address_id=$row['permanent_address_id'];
		$email=$row['email'];
		$name=$row['name'];
		$phone=$row['phone'];
		//echo $local_address_id;
		//echo $permanent_address_id;
		$add_1=json_decode(get_address($dbc,$local_address_id),false);
		//echo $add_1;
		$add_2=json_decode(get_address($dbc,$permanent_address_id),false);
		

		$data->id=$id;
			$data->name=$name;
			$data->phone=$phone;
			$data->email=$email;
			$data->local_address=$add_1;
			$data->permanent_address=$add_2;
			
			return json_encode($data);
		
	}
	return false;
}




function get_admission($dbc,$admission_id)
{

	$sql="select * from admission_table where id=".$admission_id;
	// echo $sql;
	$id=false;
	$data=new stdClass();
	if($res=mysqli_query($dbc,$sql))
	{
		$row=mysqli_fetch_assoc($res);
		$id=$row['id'];
		$data->id=$id;
		$data->datetime=$row['datetime'];
		$data->student_id=$row['student_id'];
		$data->plan_id=$row['plan_id'];
		$data->enquiry_id=$row['enquiry_id'];
		$data->session_id=$row['session_id'];
		$data->center_id=$row['center_id'];
		$data->entrance_result_id=$row['entrance_result_id'];
		
		
		$data->enabled=$row['enabled'];

		
		return json_encode($data);
		
	}
	return false;
}

function get_admission_objects($dbc,$admission_id)
{
	$admission=json_decode(get_admission($dbc,$admission_id));
	if(!$admission)
	{
		return false;
	}
	// echo $admission->student_id;
	$date=$admission->date;
	$student=$admission->student;
	$parents=$admission->parents;
	$fee=$admission->fee;
	// $enrollment_number=$admission->enrollment_number;
	$is_demo=$admission->is_demo;

	return array($date,$student,$parents,$fee,$is_demo);
}

function get_employee($dbc,$employee_id)
{
	$sql="select * from employee_table where id=".$employee_id;
	$id=false;
	$data=new stdClass();
	if($res=mysqli_query($dbc,$sql))
	{
		$row=mysqli_fetch_assoc($res);
		$id=$row['id'];
		$contact_id=$row['contact_id'];
		$contact=json_decode(get_contact($dbc,$contact_id),false);
		$data->id=$id;

		if($contact)
		{
			$data->contact=$contact;
		}
		$data->name=$row['name'];
		$data->center_id=$row['center_id'];
		$data->post_id=$row['post_id'];
		$data->phone=$row['phone'];

		$data->task_id=$row['task_id'];
		$data->is_enabled=$row['is_enabled'];
		$data->available=$row['available'];
		$data->pic_path=$row['pic_path'];
		$data->permissions=$row['permissions'];
		$data->bio_data=json_decode(get_bio_data($dbc,$row['bio_data_id']));
		$data->working_hours=$row['working_hours'];
		return json_encode($data);
	}
	return false;
	//return $id;
}



function get_bio_data($dbc,$bio_data_id)
{
	$sql="select * from bio_data_table where id=".$bio_data_id;
	$id=false;
	$data=new stdClass();
	if($res=mysqli_query($dbc,$sql))
	{
		$row=mysqli_fetch_assoc($res);
		$id=$row['id'];
		$data->graduation=$row['graduation'];
		$data->post_graduation=$row['post_graduation'];
		$data->experience=$row['experience'];
		$data->achievement=$row['achievement'];
		$data->resume_path=$row['resume_path'];
		$data->subject=get_subject_name($dbc,$row['subject_id']);
		$data->id=$id;
		return json_encode($data);
		}
	return false;
	//return $id;
}


function get_admit_card($dbc,$id)
{
	$sql="select * from gtse_registration_table where id=".$id;
	$id=false;
	$data=new stdClass();
	if($res=mysqli_query($dbc,$sql))
	{
		// echo "yes";
		$row=mysqli_fetch_assoc($res);
		$id=$row['id'];
		$data->first_name=$row['first_name'];
		$data->last_name=$row['last_name'];
		$data->name=$data->first_name." ".$data->last_name;
		$data->guardian_name=$row['guardian_name'];
		$data->phone=$row['phone'];
		$data->pic_path=$row['pic_path'];
		$data->datetime=$row['datetime'];
		$data->class=get_program_name($dbc,$row['programme_id']);
		$data->school=$row['school'];
		$data->center=json_decode(get_center_info($dbc,$row['center_id']));
		$data->id=$id;
		return json_encode($data);
	}
	else
	{
		echo "error: ".mysqli_error($dbc);		
	}
	return false;
	//return $id;
}

function get_batch_strength($dbc,$batch_id){
	$sql="select count(*) as count from plan_table where batch_id=".$batch_id;
	$id=false;
	$data=new stdClass();
	if($res=mysqli_query($dbc,$sql))
	{
		$row=mysqli_fetch_assoc($res);
		return $row['count'];
	}
	else
	{
		return false;
	}

}

function get_student($dbc,$student_id)
{
	$sql="select *,date(datetime) as date from student_table where id=".$student_id;
	$id=false;
	$data=new stdClass();
	if($res=mysqli_query($dbc,$sql))
	{
		$row=mysqli_fetch_assoc($res);
		$id=$row['id'];
		
		$data->first_name=$row['first_name'];
		$data->last_name=$row['last_name'];
		$data->name=$row['first_name']." ".$row['last_name'];
		$data->pic_path=$row['dp'];
		$data->phone=$row['phone'];
		$data->email=$row['email'];
		$data->guardian_name=$row['guardian_name'];

		$data->guardian_phone=$row['guardian_phone'];
		// $data->username=$row['username'];
		// $data->password=$row['password'];
		$data->gender=$row['gender'];
		$data->date=$row['date'];
		$data->date_of_birth=$row['date_of_birth'];
		// $data->package_id=$row['package_id'];
		//$data->fee=$fee;
		// $data->class=$class;
		$data->enabled=$row['enabled'];
		$data->school=$row['school'];
		$data->class_id=$row['class_id'];
		$data->contact_id=$row['contact_id'];
		$data->class=get_class_name($dbc,$row['class_id']);
		//$data->contact=$contact;
		$data->id=$id;
		
		return json_encode($data);
		
	}
	return false;
}




function get_plan($dbc,$plan_id)
{
	// id 	session_id 	class_id 	programme_id 	datetime 	amount 	discount_percent 	subjects_json 	batch_id 	tax_paid 	remarks
	$sql="select *,date(datetime) as date from plan_table where id=".$plan_id;
	$id=false;
	$data=new stdClass();
	if($res=mysqli_query($dbc,$sql))
	{
		$row=mysqli_fetch_assoc($res);
		$id=$row['id'];
		
		$data->session_id=$row['session_id'];
	
		$data->class_id=$row['class_id'];
		$data->batch_id=$row['batch_id'];
		$data->batch=json_decode(get_batch_info($dbc,$row['batch_id']));
		$data->class=get_class_name($dbc,$row['class_id']);
		$data->programme_id=$row['programme_id'];
		$data->programme_name=get_program_name($dbc,$row['programme_id']);
		$data->datetime=$row['datetime'];
		$data->date=$row['date'];
		$data->amount=$row['amount'];
		$data->discount_percent=$row['discount_percent'];
		$data->subjects_json=$row['subjects_json'];

		$array=json_decode($data->subjects_json);
		$subjects=array();
		// echo $array;
		if(count($array)!=0)
		{
			foreach ($array as $key) {
				array_push($subjects,get_subject_name($dbc,$key));
			}
		}
		

		$data->subjects=$subjects;

		// $data->subjects=array_map("get_subject_name",json_decode($data->subjects_json));
		// $data->username=$row['username'];
		// $data->password=$row['password'];

		$data->batch_id=$row['batch_id'];
		$data->tax_paid=$row['tax_paid'];

		// $data->package_id=$row['package_id'];
		//$data->fee=$fee;
		// $data->class=$class;

		$data->remarks=$row['remarks'];

		// $data->class_id=$row['class_id'];
		//$data->contact=$contact;

		$data->id=$id;
		
		return json_encode($data);
		
	}
	return false;
}



function get_enquiries($dbc,$param=NULL,$order=NULL,$is_desc=false,$limit=0,$offset=0)
{
	$temp="";
	$count=0;
	// echo "assad";
	if(!empty($params))
	{
		
		$temp="where ";
		
		if(!empty($params->class))
		{
			$temp.=("class like '%".$params->class."%'");
			$count++;
		}

		if(!empty($params->name))
		{
			if($count>0)
			{

				$temp.=" or ";
			}
			$temp.="name like '%".$params->name."%'";
			$count++;
		}

		if(!empty($params->email))
		{
			if($count>0)
			{

				$temp.=" or ";
			}
			$temp.="email like '%".$params->email."%'";
			$count++;
		}

		if(!empty($params->stream))
		{
			if($count>0)
			{

				$temp.=" or ";
			}
			$temp.="stream like '%".$params->stream."%'";
			$count++;
		}

		if(!empty($params->phone))
		{
			if($count>0)
			{

				$temp.=" or ";
			}
			$temp.="phone like '%".$params->phone."%'";
			$count++;
		}

		if(!empty($params->date))
		{
			if($count>0)
			{

				$temp.=" or ";
			}
			$temp.="date(date_time)='".$params->date."'";
			$count++;
		}

		if(!empty($params->school))
		{
			if($count>0)
			{

				$temp.=" or ";
			}
			$temp.="school like '%".$params->school."%'";
			$count++;
		}

	}

	if(!empty($order))
	{
		if($is_desc==true)
		{
			$temp.=$order." desc";
		}
		
	}
	if(is_numeric($limit) and $limit!=0)
	{
		if(is_numeric($offset) and $offset!=0)
		{
			$temp.="limit ".$offset.",".$limit;
		}
		else
		{
			$temp.="limit ".$limit;
		}
	}


	$sql="select id from enquiry_table ".$temp;
	$id=false;
	
	$ret=array();

	if($res=mysqli_query($dbc,$sql))
	{
		while($row=mysqli_fetch_assoc($res)){
			// $data=new stdClass();
			$id=$row['id'];
			$data=json_decode(get_enquiry($dbc,$id));
			// $data->entrance_test=json_decode(get_entrance_test($dbc,$id));
			// $data->follow_up=json_decode(get_follow_up($dbc,$id));
			array_push($ret,$data);
		}
		
		return json_encode($ret);
		
	}
	return false;
}



function get_enquiry($dbc,$enquiry_id)
{
	$sql="select *,date(date_time) as date from enquiry_table where id=".$enquiry_id;
	$id=false;
	
	$ret=array();

	if($res=mysqli_query($dbc,$sql))
	{
		$row=mysqli_fetch_assoc($res);
		$data=new stdClass();
		$id=$row['id'];
		$class=$row['class'];	
		$data->name=$row['first_name'];
		$data->guardian_name=$row['guardian_name'];
		$data->guardian_phone=$row['guardian_mobile'];
		$data->follow_up_employee_id=$row['follow_up_employee_id'];
		$data->query=$row['query'];
		$data->phone=$row['phone'];
		$data->email=$row['email'];
		$data->school=$row['school'];
		// $data->age=$row['age'];
		$data->date=$row['date'];
		$data->center_id=$row['center_id'];
		if(is_numeric($data->center_id) and (int)$data->center_id>0)
		{
			$data->center=json_decode(get_center_info($dbc,$data->center_id));
		}
		$data->class=$class;
		$data->id=$id;
		$data->stream=$row['stream'];
		$data->board=$row['board'];
		$data->datetime=$row['date_time'];
		$data->entrance_test=json_decode(get_entrance_test($dbc,$id));
		$data->follow_up=json_decode(get_follow_ups($dbc,$id));
		return json_encode($data);
		
	}
	return false;
}


function delete_follow_up($dbc,$follow_up_id)
{
	$sql="delete from follow_up_table where id=".$follow_up_id;
	
	
	if($res=mysqli_query($dbc,$sql))
	{
		return true;
	}
	return false;
}



function delete_gtse_entrance_test($dbc,$id)
{
	$sql="delete from entrance_result_table where id=".$id;
	
	
	if($res=mysqli_query($dbc,$sql))
	{
		return true;
	}
	return false;
}



function get_follow_ups($dbc,$enquiry_id)
{
	$sql="select * from follow_up_table where enquiry_id=".$enquiry_id;
	$id=false;
	$ret=array();
	
	if($res=mysqli_query($dbc,$sql))
	{
		while($row=mysqli_fetch_assoc($res))
		{
			$data=new stdClass();
			$id=$row['id'];	
			$data->id=$id;
			$data->caller_name=$row['caller_name'];
			$data->date=$row['date'];
			$data->status=$row['status'];
			$data->remarks=$row['remarks'];
			array_push($ret, $data);
		}
		
		
		
		
	}
	else
	{
		echo mysqli_error($dbc);
	}
	
	return json_encode($ret);
}


function get_installments($dbc,$params=null,$order=null,$is_desc=false,$limit=0,$offset=0)
{
	$temp="";
	$count=0;
	// echo "assad";
	if(!empty($params))
	{
		
		$temp="where ";
		
		if(!empty($params->amount_intended))
		{
			$temp.=("amount_intended = ".$params->amount_intended);
			$count++;
		}
		if(!empty($params->pending))
		{
			if($count>0)
			{

				$temp.=" and ";
			}
			$temp.="pending =".$params->pending;
			$count++;
		}

		if(!empty($params->amount_submitted))
		{
			if($count>0)
			{

				$temp.=" and ";
			}
			$temp.="amount_submitted =".$params->amount_submitted;
			$count++;
		}

		if(!empty($params->payment_mode))
		{
			if($count>0)
			{

				$temp.=" and ";
			}
			$temp.="payment_mode=".$params->payment_mode;
			$count++;
		}

		if(!empty($params->plan_id))
		{
			if($count>0)
			{

				$temp.=" and ";
			}
			$temp.="plan_id=".$params->plan_id;
			$count++;
		}
		
	}

	if(!empty($order))
	{
		if($is_desc==true)
		{
			$temp.=$order." desc";

		}
		
	}
	if(is_numeric($limit) and $limit!=0)
	{
		if(is_numeric($offset) and $offset!=0)
		{
			$temp.="limit ".$offset.",".$limit;
		}
		else
		{
			$temp.="limit ".$limit;
		}
	}


	$sql="select id from installment_table ".$temp;
	$id=false;
	$ret=array();
	
	if($res=mysqli_query($dbc,$sql))
	{
		while($row=mysqli_fetch_assoc($res))
		{
			
			$id=$row['id'];	
			$data=json_decode(get_installment($dbc,$id));
			array_push($ret, $data);
		}
	}
	else
	{
		echo mysqli_error($dbc);
	}
	
	return json_encode($ret);
}



function get_upcoming_installments($dbc,$days=null)
{
	$num=10;
	if(is_numeric($days))
	{
		$num=$days;
	}
	$sql="select id from installment_table where date(date_of_submission) between date(now()) and  DATE_ADD(date(now()) , INTERVAL ".$num." DAY) and pending = 1 order by date_of_submission";
	// echo $sql;
	$id=false;
	$ret=array();
	$data=null;
	
	if($res=mysqli_query($dbc,$sql))
	{
		while($row=mysqli_fetch_assoc($res))
		{
			
			$id=$row['id'];
			$data=json_decode(get_installment($dbc,$id));
			array_push($ret, $data);
		}
	}
	else
	{
		echo mysqli_error($dbc);
	}
	
	return json_encode($ret);
}



function get_installment($dbc,$id)
{
	
	$sql="select id,amount_intended,amount_submitted,pending,payment_mode,date(date_of_submission) as date_of_submission,plan_id,employee_id,center_id from installment_table where id=".$id;
	$id=false;
	// echo $sql;
	$data=new stdClass();
	
	if($res=mysqli_query($dbc,$sql))
	{
		if($row=mysqli_fetch_assoc($res))
		{
			
			$id=$row['id'];	
			$data->id=$id;
			$data->amount_intended=$row['amount_intended'];
			$data->amount_submitted=$row['amount_submitted'];
			$data->payment_mode_id=$row['payment_mode'];
			$data->payment_mode=get_payment_mode_name($dbc,$data->payment_mode_id);
			$data->date_of_submission=$row['date_of_submission'];
			$data->pending=$row['pending'];
			$data->plan_id=$row['plan_id'];			
			$data->employee_id=$row['employee_id'];	
			$data->center_id=$row['center_id'];	
		}

	}
	else
	{
		echo mysqli_error($dbc);
	}
	
	return json_encode($data);
}

function get_entrance_test($dbc,$enquiry_id)
{
	$sql="select * from entrance_result_table where enquiry_id=".$enquiry_id;
	$id=false;
	$data=new stdClass();
	if($res=mysqli_query($dbc,$sql))
	{
		$row=mysqli_fetch_assoc($res);
		if(!empty($row)){
			$id=$row['id'];	
			$data->correct=$row['correct'];
			$data->incorrect=$row['incorrect'];
			$data->marks_obtained=$row['marks_obtained'];
			$data->scholarship_percent=$row['scholarship_percent'];
			$data->final_discount =$row['final_discount'];
			$data->reference_by=$row['reference_by'];
			return json_encode($data);
		}
		
	}
	
	return false;
}

//not checked
function get_transactions($dbc,$limit=0,$offset=0,$params=null)
{
	$temp="";
	$count=0;

	// echo json_encode($params);
	if(!empty($params))
	{
		// echo "".json_encode($params);
		
		$temp=" where ";
		
		if(!empty($params->transaction_type))
		{
			// echo "".json_encode($params);
			$temp.=("transaction_type=".$params->transaction_type);
			$count++;
		}
		// if(!empty($params->amount))
		// {
		// 	// echo "".json_encode($params);
		// 	if($count>0)
		// 	{

		// 		$temp.=" and ";
		// 	}
		// 	$temp.="amount=".$params->amount;
		// 	$count++;
		// }

		if(!empty($params->cash_flow))
		{
			// echo "".json_encode($params);
			if($count>0)
			{

				$temp.=" and ";
			}
			$temp.="cash_flow='".$params->cash_flow."'";
			$count++;
		}

		if(!empty($params->payment_mode))
		{
			// echo "".json_encode($params);
			if($count>0)
			{

				$temp.=" and ";
			}
			$temp.="payment_mode=".$params->payment_mode;
			$count++;
		}

		if(!empty($params->center_id))
		{
			// echo "".json_encode($params);
			if($count>0)
			{

				$temp.=" and ";
			}
			$temp.="center_id='".$params->center_id."'";
			$count++;
		}

		
	}

	
	$wlimit="";
	if($limit!=0)
	{
		$wlimit=" limit ".$limit;

	}
	$woffset="";

	if($offset!=0)
	{
		$woffset=" offset ".$offset;

	}

	
	$sql="select id from transaction_table".$temp." order by date_time desc"."".$wlimit."".$woffset;
	// $sql="select id from transaction_table order by date_time desc"." limit ".$wlimit." offset ".$woffset;
	// echo $sql;
	$id=false;
	$data=array();
	$c=0;
	if($res=mysqli_query($dbc,$sql))
	{
		while($row=mysqli_fetch_assoc($res))
		{
			$id=$row['id'];
			//echo $id;
			$c+=1;
			array_push($data,json_decode(get_transaction($dbc,$id),false));
		}
		// echo $c;
		// echo json_encode($data);
		return json_encode($data);
	}
	else
	{
		echo mysqli_error($dbc);
		return false;
		
	}
}


//not checked
function get_todays_transactions($dbc,$limit=0,$offset=0)
{
	// $wdate="";
	// if($date!=0)
	// {
	// 	$wdate=" where date(date_time)=curdate()";

	// }
	$wlimit="";
	if($limit!=0)
	{
		$wlimit=" limit ".$limit;
	}
	$woffset="";

	if($offset!=0)
	{
		$woffset=" offset ".$offset;
	}

	
	$sql="select id from transaction_table where date(date_time)=curdate() order by date_time desc"."".$wlimit."".$woffset;
	// $sql="select id from transaction_table where date(date_time)=curdate() order by date_time desc"." limit ".$wlimit." offset ".$woffset;
	// echo $sql;
	$id=false;
	$data=array();
	if($res=mysqli_query($dbc,$sql))
	{
		while($row=mysqli_fetch_assoc($res))
		{
			$id=$row['id'];
			array_push($data,json_decode(get_transaction($dbc,$id),false));
		}
		echo json_encode($data);
		return json_encode($data);
	}
	else
	{
		return false;
		
	}
}


function get_transaction_from_installment($dbc,$installment_id)
{
	$sql="select id from transaction_table where target_id=".$installment_id." and transaction_type=5";
	$id=false;
	$data=new stdClass();
	if($res=mysqli_query($dbc,$sql) and $row=mysqli_fetch_assoc($res))
	{
		$id=$row['id'];
		return get_transaction($dbc,$id);
	}
	else{
		return false;
	}
}



function get_transaction($dbc,$transaction_id)
{
	//echo $transaction_id;
	
	$sql="select *,date(date_time) as date from transaction_table where id=".$transaction_id;
	$id=false;
	$data=new stdClass();
	if($res=mysqli_query($dbc,$sql) and $row=mysqli_fetch_assoc($res))
	{
		
		$data->transaction_type=get_transaction_type_name($dbc,$row['transaction_type']);
		$data->transaction_type_id=$row['transaction_type'];
		$data->payment_mode=get_payment_mode_name($dbc,$row['payment_mode']);
		$data->id=$row['id'];
		$data->amount=$row['amount'];
		$data->taxable=$row['taxable'];
		$data->tax_amount=$row['tax_amount'];
		$data->date_time=$row['date_time'];
		$data->date=$row['date'];
		$data->cash_flow=$row['cash_flow'];
		$data->center_id=$row['center_id'];
		$data->center=json_decode(get_center_info($dbc,$data->center_id));
		$data->pic_path=$row['pic_path'];
		$data->remarks=$row['remarks'];
		$data->employee_id=$row['employee_id'];
		$data->target_id=$row['target_id'];
		return json_encode($data);
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
	
}


function get_time_table($dbc,$class_id=0,$limit=0,$offset=0)
{
	$temp="";
	if($class_id!=0)
	{
		$temp="where class_id=".$class_id;
	}
	$temp.="order by date";


	if(is_numeric($limit) and $limit!=0)
	{
		if(is_numeric($offset) and $offset!=0)
		{
			$temp.="limit ".$offset.",".$limit;
		}
		else
		{
			$temp.="limit ".$limit;
		}
	}


	$sql="select id from time_table_table  ".$temp;
	$id=false;
	$data=array();
	if($res=mysqli_query($dbc,$sql))
	{
		while($row=mysqli_fetch_assoc($res))
		{
			$id=$row['id'];
			//echo $id;
			array_push($data,json_decode(get_transaction($dbc,$id),false));
		}
		return json_encode($data);
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
}




function get_installments_count($dbc,$student_id)
{
	//echo $transaction_id;
	
	$sql="select count(*) as c from transaction_table where transaction_type=5 and involved_person_id=".$student_id;
	$id=false;
	$data=new stdClass();
	if($res=mysqli_query($dbc,$sql) and $row=mysqli_fetch_assoc($res))
	{
		$data->id=$student_id;
		$data->count=$row['c'];
		return json_encode($data);
		
		
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
	
}


function get_transaction_type_name($dbc,$transaction)
{
	$sql="select value from transaction_types where id=".$transaction;
	if($res=mysqli_query($dbc,$sql))
	{
		$row=mysqli_fetch_assoc($res);
		return $row['value'];
	}
	else
	{
		echo mysqli_error($dbc);
		return false;
	}
}


function get_user_type_name($dbc,$user_type_id)
{
	$sql="select val from user_types where user_type=".$user_type_id;
	//echo $sql;
	if($res=mysqli_query($dbc,$sql))
	{
		$row=mysqli_fetch_assoc($res);
		
		return $row['val'];
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
}

//checked
function get_batch_info($dbc,$batch_id)
{
	$sql="select * from batch_table where id=".$batch_id;
	$data=new stdClass;
	if($res=mysqli_query($dbc,$sql))
	{
		$row=mysqli_fetch_assoc($res);
		$data->id=$batch_id;
		$data->name=$row['name'];
		$data->class=get_class_name($dbc,$row['class_id']);
		$data->stream=get_stream_name($dbc,$row['stream_id']);
		$data->center=json_decode(get_center_info($dbc,$row['center_id']));
		// $data->strength=$row['strength'];
		$data->batch_number=$row['batch_number'];
		$data->program_id=$row['programme_id'];
		// $data->assigned_faculties_obj=json_decode($row['assigned_faculties']);
		// $data->seen_questions_array=json_decode($row['seen_questions']);
		return json_encode($data);
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
}


function get_batch($dbc,$batch_id)
{
	$sql="select * from batch_table where id=".$batch_id;
	$d=new stdClass;
	if($res=mysqli_query($dbc,$sql))
	{
		if($row=mysqli_fetch_assoc($res))
		{
			
			$d->id=$row['id'];
			$d->class_id=$row['class_id'];
			$d->programme_id=$row['programme_id'];
			$d->program_name=json_decode(get_program_name($dbc,$d->programme_id));
			$d->stream=json_decode(get_stream_name($dbc,$row['stream_id']));
			$d->batch_number=$row['batch_number'];
			// $d->max_strength=$row['max_strength'];
			$d->center=json_decode(get_center_info($dbc,$row['center_id']));
			$d->name=$row['name'];
			// $d->strength=$row['strength'];
			
			// array_push($data,$d);
		}
		return json_encode($d);
		
		
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
}





function get_classes($dbc)
{
	$sql="select * from classes";
	$data=array();
	if($res=mysqli_query($dbc,$sql))
	{
		while($row=mysqli_fetch_assoc($res))
		{
			$d=new stdClass();
			$d->id=$row['id'];
			$d->value=$row['value'];
			array_push($data,$d);
		}
		
		return json_encode($data);
	}
	else
	{
		echo mysqli_error($dbc);
		return false;
		
	}
}


function get_payment_modes($dbc)
{
	$sql="select * from payment_modes";
	$data=array();
	if($res=mysqli_query($dbc,$sql))
	{
		while($row=mysqli_fetch_assoc($res))
		{
			$d=new stdClass();
			$d->id=$row['id'];
			$d->value=$row['value'];
			array_push($data,$d);
		}
		
		return json_encode($data);
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
}

function get_batches($dbc,$class_id=0)
{
	if($class_id>0)
	{
		$sql="select * from batch_table where class_id=".$class_id." order by session_id desc";
	}
	else
	{
		$sql="select * from batch_table order by session_id desc";
	}
	
	$data=array();
	if($res=mysqli_query($dbc,$sql))
	{

		while($row=mysqli_fetch_assoc($res))
		{
			$d=new stdClass();
			$d->id=$row['id'];
			$d->class_id=$row['class_id'];
			$d->programme_id=$row['programme_id'];
			$d->session_id=$row['session_id'];
			$d->program_name=get_program_name($dbc,$d->programme_id);
			$d->stream=json_decode(get_stream_name($dbc,$row['stream_id']));
			$d->batch_number=$row['batch_number'];
			$d->strength=get_batch_strength($dbc,$d->id);
			// $d->max_strength=$row['max_strength'];
			$d->center=json_decode(get_center_info($dbc,$row['center_id']));
			$d->name=$row['name'];
			// $d->strength=$row['strength'];
			array_push($data,$d);
		}
		
		return json_encode($data);
	}
	else
	{
		echo mysqli_error($dbc);
		return false;
		
	}
}


function get_programmes($dbc)
{
	
	$sql="select * from programmes";
	
	
	$data=array();
	if($res=mysqli_query($dbc,$sql))
	{
		while($row=mysqli_fetch_assoc($res))
		{
			$d=new stdClass();
			$d->id=$row['id'];
			$d->class_id=$row['class_id'];
			$d->name=$row['value'];
			$d->type=$row['type'];
			// $d->strength=$row['strength'];
			array_push($data,$d);
		}
		
		return json_encode($data);
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
}



//days,subjects,centers
function get_centers($dbc)
{
	$sql="select * from centers";
	$data=array();
	if($res=mysqli_query($dbc,$sql))
	{
		while($row=mysqli_fetch_assoc($res))
		{
			$d=new stdClass();
			$d->id=$row['id'];
			$d->address=json_decode(get_address($dbc,$row['address_id']));
			$d->name=$row['name'];
			$d->opening_hours=$row['opening_hours'];
			array_push($data,$d);
		}
		
		return json_encode($data);
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
}

function get_subjects($dbc)
{
	$sql="select * from subjects";
	$data=array();
	if($res=mysqli_query($dbc,$sql))
	{
		while($row=mysqli_fetch_assoc($res))
		{
			$d=new stdClass();
			$d->id=$row['subject'];
			$d->value=$row['val'];
			array_push($data,$d);
		}
		
		return json_encode($data);
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
}

function get_days($dbc)
{
	$sql="select * from days";
	$data=array();
	if($res=mysqli_query($dbc,$sql))
	{
		while($row=mysqli_fetch_assoc($res))
		{
			$d=new stdClass();
			$d->id=$row['day'];
			$d->value=$row['val'];
			array_push($data,$d);
		}
		
		return json_encode($data);
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
}

function get_streams($dbc)
{
	$sql="select * from streams";
	$data=array();
	if($res=mysqli_query($dbc,$sql))
	{
		while($row=mysqli_fetch_assoc($res))
		{
			$d=new stdClass();
			$d->id=$row['id'];
			$d->value=$row['value'];
			array_push($data,$d);
		}
		
		return json_encode($data);
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
}


//checked
function get_stream_name($dbc,$stream)
{
	$sql="select val from streams where stream=".$stream;
	if($res=mysqli_query($dbc,$sql))
	{
		$row=mysqli_fetch_assoc($res);
		
		return $row['val'];
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
}


//checked
function get_class_name($dbc,$id)
{
	$sql="select value from classes where id=".$id;
	if($res=mysqli_query($dbc,$sql))
	{
		$row=mysqli_fetch_assoc($res);
		
		return $row['value'];
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
}

//checked
function get_package_name($dbc,$class)
{
	$sql="select val from packages where id=".$class;
	if($res=mysqli_query($dbc,$sql))
	{
		$row=mysqli_fetch_assoc($res);
		
		return $row['val'];
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
}

function get_program_name($dbc,$id)
{
	$sql="select value from programmes where id=".$id;
	// echo $sql;
	if($res=mysqli_query($dbc,$sql))
	{
		$row=mysqli_fetch_assoc($res);
		
		return $row['value'];
	}
	else
	{
		echo mysqli_error($dbc);
		return false;
		// echo mysqli_error($dbc);
	}
}


function get_payment_mode_name($dbc,$payment_mode)
{
	$sql="select value from payment_modes where id=".$payment_mode;
	if($res=mysqli_query($dbc,$sql))
	{
		$row=mysqli_fetch_assoc($res);
		
		return $row['value'];
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
}

function get_day_name($dbc,$day)
{
	$sql="select val from days where day=".$day;
	if($res=mysqli_query($dbc,$sql))
	{
		$row=mysqli_fetch_assoc($res);
		
		return $row['val'];
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
}

function get_subject_name($dbc,$subject)
{
	$sql="select val from subjects where subject=".$subject;
	if($res=mysqli_query($dbc,$sql))
	{
		$row=mysqli_fetch_assoc($res);
		
		return $row['val'];
	}
	else
	{
		return false;
		// echo mysqli_error($dbc);
	}
}





function get_center_info($dbc,$center_id)
{
	$data=new stdClass();
	if($center_id!=0)
	{
		$sql="select * from centers where id=".$center_id;
		
		if($res=mysqli_query($dbc,$sql))
		{
			$row=mysqli_fetch_assoc($res);
			$data->id=$row['id'];
			$data->name=$row['name'];
			$data->address=json_decode(get_address($dbc,$row['address_id']));
			$data->opening_hours=$row['opening_hours'];
			
		}
		else
		{
			return false;
			echo mysqli_error($dbc);
		}
	}
	else
	{
		$data->id=0;
		$data->name="Global";
		$data->address=null;
		$data->opening_hours=null;
		
	}
	return json_encode($data);
	
}

function get_slot_info($dbc,$slot_id)
{
	$sql="select * from slots where id=".$slot_id;
	$data=new stdClass();
	if($res=mysqli_query($dbc,$sql))
	{
		$row=mysqli_fetch_assoc($res);
		$data->id=$row['id'];
		$data->day=get_day_name($row['day']);
		$data->time=$row['time'];
		$data->duration=$row['duration'];
		return json_encode($data);
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
}


function get_address($dbc,$address_id)
{
	$sql="select * from address_table where id=".$address_id;
	$id=false;
	$data=new stdClass();
	if($res=mysqli_query($dbc,$sql))
	{
		$row=mysqli_fetch_assoc($res);
		$data->city=$row['city'];
		$data->state=$row['state'];
		$data->pincode=$row['pincode'];
		$data->address=$row['address'];
		$data->phone=$row['phone'];
		return json_encode($data);
	}
	else
	{
		return false;
		echo mysqli_error($dbc);
	}
	
}

function get_date()
{
	return date("Y-m-d");
}

function get_fee($dbc,$fee_id)
{
	$sql="select * from fee_table where id=".$fee_id;
	$id=false;
	$data=new stdClass();
	if($res=mysqli_query($dbc,$sql))
	{
		$row=mysqli_fetch_assoc($res);
		$data->total_fee=$row['total_fee'];
		$data->number_installments=$row['number_installments'];
		$data->fi_amount=$row['fi_amount'];
		$data->fi_date=$row['fi_date'];
		$data->si_amount=$row['si_amount'];
		$data->si_date=$row['si_date'];
		$data->ti_amount=$row['ti_amount'];
		$data->ti_date=$row['ti_date'];
		$data->li_amount=$row['li_amount'];
		$data->li_date=$row['li_date'];
		$data->fi_payment_mode=$row['fi_payment_mode'];
		$data->si_payment_mode=$row['si_payment_mode'];
		$data->ti_payment_mode=$row['ti_payment_mode'];
		$data->li_payment_mode=$row['li_payment_mode'];
		$data->installments_fulfilled=$row['installments_fulfilled'];
		$data->remarks=$row['remarks'];
		$data->tax_paid=$row['tax_paid'];
		$data->registration_fee=$row['registration_fee'];
		return json_encode($data);
	}
	else
	{
		return false;
	}
	
}






function my_rollback($dbc,$result)
{
	mysqli_rollback($dbc);
	mysqli_autocommit($dbc, true);
	$result->status="failed";
	echo json_encode($result);
	die();
}


//saving the files from the $_FILE variable
function file_save($file,$path)
{
	// echo count($file['name']);
		if(count($file["name"])>0 and !empty($path))
			{
				$tempfilepath=$file["tmp_name"];
				if($tempfilepath != "")
				{
					$name=substr(md5(time()."".$tempfilepath),20);

					$filename = $file['name'];
					$ext = pathinfo($filename, PATHINFO_EXTENSION);
					if(strpos($path, "https://")!==false)
					{
						$path=substr($path, 26);
					}
					// echo $path."/".$name.".".$ext;
					if(move_uploaded_file($tempfilepath, $path."/".$name.".".$ext)){
						chmod($path."/".$name.".".$ext,0777);
						// chown($path."/".$name.".".$ext,"neoned71");
						return $name.".".$ext;
					}
					else
					{
						echo "upload failed 0";
						return false;
					}
					
				}
				else{
					echo "upload failed 1";
					return false;
				}	

			}
			else
			{
				echo "upload failed 2";
				return false;
			}	
}

//saving the files from the $_FILE variable
function file_delete($file,$path)
{
	if(unlink($path."/".$file))
	{
		return true;

	}
	else
	{
		return false;
	}
}



//handling the escaping of the variables;
function handle_escaping($a,$b)
{
	if(gettype($b)=="string"){
		return mysqli_real_escape_string($a,$b);
	}
	else if(gettype($b)=="integer" and is_numeric($b))
		{
			return $b;
		}
		else
		{
			return false;
		}
	
}
//echo "helo";
function my_error_handler($e_number,$e_message,$e_file,$e_line,$e_vars){
	$message="error has been formed in script '$e_file' om the line $e_line:\n$e_message.\n";
	$message.="<pre".print_r(degub_backtrace(),1)."</pre>\n";
	if(!LIVE)
	{
		//nl2br turn new lines int br tags!!
		echo '<div class="alert alert-danger" >'.nl2br($message).'</div>';
	}
	else{
		error_log($message, 1, CONTACT_EMAIL , 'From:neoned71@gmail.com');
		if($e_number!=E_NOTICE)
		{
			echo '<div class="alert alert-danger" > A system error occured. we are sorry for inconvenience</div>';
		}
	}
	return true;
}
// set_error_handler(my_error_handler);


    function no_to_words($no)
    {   
     $words = array('0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred &','1000' => 'thousand','100000' => 'lakh','10000000' => 'crore');
        if($no == 0)
            return ' ';
        else {
    	$novalue='';
    	$highno=$no;
    	$remainno=0;
    	$value=100;
    	$value1=1000;       
            while($no>=100)    {
                    if(($value <= $no) &&($no  < $value1))    {
                    $novalue=$words["$value"];
                    $highno = (int)($no/$value);
                    $remainno = $no % $value;
                    break;
                    }
                    $value= $value1;
                    $value1 = $value * 100;
                }       
            if(array_key_exists("$highno",$words))
                  return $words["$highno"]." ".$novalue." ".no_to_words($remainno);
            else 
            {
                 $unit=$highno%10;
                 $ten =(int)($highno/10)*10;            
                 return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".no_to_words($remainno);
              }
        }
    }
    


?>