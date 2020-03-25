<?php
include("../common/initialization.php");
$path=$question_images+"/";

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




// $image_template='<img height=\"250px\" width=\"250px\" src=\"question_images/%s\" />' ;
$options=array();


//for option A
if(isset($_POST['solution_link']))
{
	$solution_link=handle_escaping($dbc,$_POST['solution_link']);
	$solution->link=$solution_link;
}

$option_A_type=handle_escaping($dbc,$_POST['option_A_type']);
// $option_B_type=handle_escaping($dbc,$_POST['option_B_type']);
// $option_C_type=handle_escaping($dbc,$_POST['option_C_type']);
// $option_D_type=handle_escaping($dbc,$_POST['option_D_type']);
if($option_A_type==1)
{
	$file=$_FILES['option_A'];
	$option_A_name=@file_save($file,$path);
	if(!$option_A_name)
	{
		
		exit_function();
	}
	else
	{
		// $option_A=sprintf($image_template,$option_A_name);
		$option_A=new stdClass;
		$option_A->type="image";
		$option_A->value="../question_images/".$option_A_name;
		array_push($options,addslashes(json_encode($option_A)));
	}
}
else
{
	$option_A=new stdClass;
	$option_A->type='text';
	$option_A->value=handle_escaping($dbc,$_POST['option_A']);
	array_push($options,addslashes(json_encode($option_A)));
}



//option B
$option_B_type=handle_escaping($dbc,$_POST['option_B_type']);
// $option_B_type=handle_escaping($dbc,$_POST['option_B_type']);
// $option_C_type=handle_escaping($dbc,$_POST['option_C_type']);
// $option_D_type=handle_escaping($dbc,$_POST['option_D_type']);
if($option_B_type==1)
{
	$file=$_FILES['option_B'];
	$option_B_name=@file_save($file,$path);
	if(!$option_B_name)
	{
		exit_function();
	}
	else
	{
		// $option_A=sprintf($image_template,$option_A_name);
		$option_B=new stdClass;
		$option_B->type="image";
		$option_B->value="../question_images/".$option_B_name;
		array_push($options,addslashes(json_encode($option_B)));
	}
}
else
{
	$option_B=new stdClass;
	$option_B->type='text';
	$option_B->value=handle_escaping($dbc,$_POST['option_B']);
	array_push($options,addslashes(json_encode($option_B)));
}



$option_C_type=handle_escaping($dbc,$_POST['option_C_type']);
// $option_B_type=handle_escaping($dbc,$_POST['option_B_type']);
// $option_C_type=handle_escaping($dbc,$_POST['option_C_type']);
// $option_D_type=handle_escaping($dbc,$_POST['option_D_type']);
if($option_C_type==1)
{
	$file=$_FILES['option_C'];
	$option_C_name=@file_save($file,$path);
	if(!$option_C_name)
	{
		if(!empty($image_name))
		{
			file_delete($image_name,$path);
		}
		exit_function();
	}
	else
	{
		// $option_A=sprintf($image_template,$option_A_name);
		$option_C=new stdClass;
		$option_C->type="image";
		$option_C->value="../question_images/".$option_C_name;
		array_push($options,addslashes(json_encode($option_C)));
	}
}
else
{
	$option_C=new stdClass;
	$option_C->type='text';
	$option_C->value=handle_escaping($dbc,$_POST['option_C']);
	array_push($options,addslashes(json_encode($option_C)));
}



$option_D_type=handle_escaping($dbc,$_POST['option_D_type']);
// $option_B_type=handle_escaping($dbc,$_POST['option_B_type']);
// $option_C_type=handle_escaping($dbc,$_POST['option_C_type']);
// $option_D_type=handle_escaping($dbc,$_POST['option_D_type']);
if($option_D_type==1)
{
	$file=$_FILES['option_D'];
	$option_D_name=@file_save($file,$path);
	if(!$option_D_name)
	{
		if(!empty($image_name))
		{
			file_delete($image_name,$path);
		}
		exit_function();
	}
	else
	{
		// $option_A=sprintf($image_template,$option_A_name);
		$option_D=new stdClass;
		$option_D->type="image";
		$option_D->value="../question_images/".$option_D_name;
		array_push($options,addslashes(json_encode($option_D)));
	}
}
else
{
	$option_D=new stdClass;
	$option_D->type='text';
	$option_D->value=handle_escaping($dbc,$_POST['option_D']);
	array_push($options,addslashes(json_encode($option_D)));
}

// $options=handle_escaping($dbc,$_POST['options']);
$question=handle_escaping($dbc,$_POST['question']);
$solution_text=handle_escaping($dbc,$_POST['solution_text']);
$subject_id=handle_escaping($dbc,$_POST['subject_id']);
$topic_id=handle_escaping($dbc,$_POST['topic_id']);
$difficulty=handle_escaping($dbc,$_POST['difficulty']);
$correct_ans=handle_escaping($dbc,$_POST['correct_ans']);

$solution->text=addslashes($solution_text);
// echo "inserting data";
//sample insert query

// insert_question($dbc,$subject_id, $topic_id, $difficulty,$question_json,$options_json,$correct_ans,$solution,$image)
$id=insert_question($dbc,$subject_id, $topic_id, $difficulty,$question,json_encode($options),$correct_ans,json_encode($solution),$image_name);

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
// echo "inserted";
// echo $id;
?>