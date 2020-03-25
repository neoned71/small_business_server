<?php
include("../common/initialization.php");
$path="../images/question_images";

$ret=new stdClass;

$image_name=NULL;

$solution=new stdClass;

if(isset($_FILES['question_image']['name'])){
	// echo "question image found!";
	$file=$_FILES['question_image'];

		$image_name=@file_save($file,$path);
		if(!$image_name)
		{
			// echo "exiting";
			exit_function();
		}	
	
}


if(isset($_FILES['solution_image']['name'])){
	// echo "question image found!";
	$file=$_FILES['solution_image'];

		$solution_image_name=@file_save($file,$path);

		if(!$solution_image_name)
		{
			// echo "exiting";
			exit_function();
		}	
		$solution->image=$solution_image_name;
	
}


//for option A
if(isset($_POST['solution_link']))
{
	$solution_link=handle_escaping($dbc,$_POST['solution_link']);
	$solution->link=$solution_link;
}


// $options=handle_escaping($dbc,$_POST['options']);
$question=handle_escaping($dbc,$_POST['question']);
$solution_text=handle_escaping($dbc,$_POST['solution_text']);
$subject_id=handle_escaping($dbc,$_POST['subject_id']);
$topic_id=handle_escaping($dbc,$_POST['topic_id']);
$difficulty=handle_escaping($dbc,$_POST['difficulty']);
$correct_ans=handle_escaping($dbc,$_POST['correct_ans']);
$marking=handle_escaping($dbc,$_POST['marking']);

$solution->text=$solution_text;

$options=array();

//echo json_encode($options);

$id=insert_question_boards($dbc,$subject_id, $topic_id, $difficulty,$question,json_encode($options),$correct_ans,addslashes(json_encode($solution)),$image_name,$marking);

if(!$id)
{
	$ret->status="failed";
	echo json_encode($ret);

}
else
{
	$ret->status="success";
	$ret->id=$id;
	// echo "\n".$id."\n";
	echo json_encode($ret);
	
}


mysqli_close($dbc);

?>
