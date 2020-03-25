<?php

include("../common/initialization.php");


$ret=new stdClass;

$image_name=NULL;
$path="../images/question_images";
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

// $image_template='<img height=\"250px\" width=\"250px\" src=\"question_images/%s\" />' ;
$values=new stdClass;

$value_assertion_type=handle_escaping($dbc,$_POST['value_assertion_type']);

if($value_assertion_type==1)
{
	$file=$_FILES['value_assertion'];
	$value_assertion_name=@file_save($file,$path);
	if(!$value_assertion_name)
	{
		
		exit_function();
	}
	else
	{
		// $value_P=sprintf($image_template,$value_P_name);
		$value_assertion=new stdClass;
		$value_assertion->label="Assertion";
		$value_assertion->type="image";
		$value_assertion->value="../question_images/".$value_assertion_name;
		$values->assertion=$value_assertion;
	}
}
else
{
	$value_assertion=new stdClass;
	$value_assertion->label="Assertion";
	$value_assertion->type='text';
	$value_assertion->value=addslashes(handle_escaping($dbc,$_POST['value_assertion']));
	$values->assertion=$value_assertion;
}


$value_reason_type=handle_escaping($dbc,$_POST['value_reason_type']);

if($value_reason_type==1)
{
	$file=$_FILES['value_reason'];
	$value_reason_name=@file_save($file,$path);
	if(!$value_reason_name)
	{
		
		exit_function();
	}
	else
	{
		// $value_P=sprintf($image_template,$value_P_name);
		$value_reason=new stdClass;
		$value_reason->type="image";
		$value_reason->label="Reason";
		$value_reason->value="../question_images/".$value_reason_name;
		$values->reason=$value_reason;
	}
}
else
{
	$value_reason=new stdClass;
	$value_reason->type='text';
	$value_reason->label="Reason";
	$value_reason->value=addslashes(handle_escaping($dbc,$_POST['value_reason']));
	$values->reason=$value_reason;
}



// $options=handle_escaping($dbc,$_POST['options']);
$question=json_encode($values);
$solution_text=handle_escaping($dbc,$_POST['solution_text']);
$subject_id=handle_escaping($dbc,$_POST['subject_id']);
$topic_id=handle_escaping($dbc,$_POST['topic_id']);
$difficulty=handle_escaping($dbc,$_POST['difficulty']);
$correct_ans=handle_escaping($dbc,$_POST['correct_ans']);
$marking=handle_escaping($dbc,$_POST['marking']);

$solution->text=$solution_text;

$options=array();

//echo json_encode($options);

$id=insert_question_assertion_reason($dbc,$subject_id, $topic_id, $difficulty,$question,json_encode($options),$correct_ans,addslashes(json_encode($solution)),$image_name,$marking);

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
