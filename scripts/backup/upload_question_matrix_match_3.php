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





$value_A_type=handle_escaping($dbc,$_POST['value_A_type']);

if($value_A_type==1)
{
	$file=$_FILES['value_A'];
	$value_A_name=@file_save($file,$path);
	if(!$value_A_name)
	{
		
		exit_function();
	}
	else
	{
		// $value_A=sprintf($image_temAlate,$value_A_name);
		$value_A=new stdClass;
		$value_A->type="image";
		$value_A->label="A";
		$value_A->value="../question_images/".$value_A_name;
		$values->A=$value_A;
	}
}
else
{
	$value_A=new stdClass;
	$value_A->type='text';
	$value_A->label="A";
	$value_A->value=addslashes(handle_escaping($dbc,$_POST['value_A']));
	$values->A=$value_A;
}

$value_P_type=handle_escaping($dbc,$_POST['value_P_type']);

if($value_P_type==1)
{
	$file=$_FILES['value_P'];
	$value_P_name=@file_save($file,$path);
	if(!$value_P_name)
	{
		
		exit_function();
	}
	else
	{
		// $value_P=sprintf($image_template,$value_P_name);
		$value_P=new stdClass;
		$value_P->type="image";
		$value_P->label="P";
		$value_P->value="../question_images/".$value_P_name;
		$values->P=$value_P;
	}
}
else
{
	$value_P=new stdClass;
	$value_P->type='text';
	$value_P->label="P";
	$value_P->value=addslashes(handle_escaping($dbc,$_POST['value_P']));
	$values->P=$value_P;
}

$value_1_type=handle_escaping($dbc,$_POST['value_1_type']);

if($value_1_type==1)
{
	$file=$_FILES['value_1'];
	$value_1_name=@file_save($file,$path);
	if(!$value_1_name)
	{
		
		exit_function();
	}
	else
	{
		// $value_1=sprintf($image_tem1late,$value_1_name);
		$value_1=new stdClass;
		$value_1->type="image";
		$value_1->label="J";
		$value_1->value="../question_images/".$value_1_name;
		$values->J=$value_1;
	}
}
else
{
	$value_1=new stdClass;
	$value_1->type='text';
	$value_1->label="J";
	$value_1->value=addslashes(handle_escaping($dbc,$_POST['value_1']));
	$values->J=$value_1;
}



$value_B_type=handle_escaping($dbc,$_POST['value_B_type']);

if($value_B_type==1)
{
	$file=$_FILES['value_B'];
	$value_B_name=@file_save($file,$path);
	if(!$value_B_name)
	{
		
		exit_function();
	}
	else
	{
		// $value_B=sprintf($image_temBlate,$value_B_name);
		$value_B=new stdClass;
		$value_B->type="image";
		$value_B->label="B";
		$value_B->value="../question_images/".$value_B_name;
		$values->B=$value_B;
	}
}
else
{
	$value_B=new stdClass;
	$value_B->type='text';
	$value_B->label="B";
	$value_B->value=addslashes(handle_escaping($dbc,$_POST['value_B']));
	$values->B=$value_B;
}

$value_Q_type=handle_escaping($dbc,$_POST['value_Q_type']);

if($value_Q_type==1)
{
	$file=$_FILES['value_Q'];
	$value_Q_name=@file_save($file,$path);
	if(!$value_Q_name)
	{
		
		exit_function();
	}
	else
	{
		// $value_Q=sprintf($image_temQlate,$value_Q_name);
		$value_Q=new stdClass;
		$value_Q->type="image";
		$value_Q->label="Q";
		$value_Q->value="../question_images/".$value_Q_name;
		$values->Q=$value_Q;
	}
}
else
{
	$value_Q=new stdClass;
	$value_Q->type='text';
	$value_Q->label="Q";
	$value_Q->value=addslashes(handle_escaping($dbc,$_POST['value_Q']));
	$values->Q=$value_Q;
}

$value_2_type=handle_escaping($dbc,$_POST['value_2_type']);

if($value_2_type==1)
{
	$file=$_FILES['value_2'];
	$value_2_name=@file_save($file,$path);
	if(!$value_2_name)
	{
		
		exit_function();
	}
	else
	{
		// $value_2=sprintf($image_tem2late,$value_2_name);
		$value_2=new stdClass;
		$value_2->type="image";
		$value_2->label="K";
		$value_2->value="../question_images/".$value_2_name;
		$values->K=$value_2;
	}
}
else
{
	$value_2=new stdClass;
	$value_2->type='text';
	$value_2->label="K";
	$value_2->value=addslashes(handle_escaping($dbc,$_POST['value_2']));
	$values->K=$value_2;
}


$value_C_type=handle_escaping($dbc,$_POST['value_C_type']);

if($value_C_type==1)
{
	$file=$_FILES['value_C'];
	$value_C_name=@file_save($file,$path);
	if(!$value_C_name)
	{
		
		exit_function();
	}
	else
	{
		// $value_C=sprintf($image_temClate,$value_C_name);
		$value_C=new stdClass;
		$value_C->type="image";
		$value_C->label="C";
		$value_C->value="../question_images/".$value_C_name;
		$values->C=$value_C;
	}
}
else
{
	$value_C=new stdClass;
	$value_C->type='text';
	$value_C->label="C";
	$value_C->value=addslashes(handle_escaping($dbc,$_POST['value_C']));
	$values->C=$value_C;
}


$value_R_type=handle_escaping($dbc,$_POST['value_R_type']);

if($value_R_type==1)
{
	$file=$_FILES['value_R'];
	$value_R_name=@file_save($file,$path);
	if(!$value_R_name)
	{
		
		exit_function();
	}
	else
	{
		// $value_R=sprintf($image_temRlate,$value_R_name);
		$value_R=new stdClass;
		$value_R->type="image";
		$value_R->label="R";
		$value_R->value="../question_images/".$value_R_name;
		$values->R=$value_R;
	}
}
else
{
	$value_R=new stdClass;
	$value_R->type='text';
	$value_R->label="R";
	$value_R->value=addslashes(handle_escaping($dbc,$_POST['value_R']));
	$values->R=$value_R;
}

$value_3_type=handle_escaping($dbc,$_POST['value_3_type']);

if($value_3_type==1)
{
	$file=$_FILES['value_3'];
	$value_3_name=@file_save($file,$path);
	if(!$value_3_name)
	{
		
		exit_function();
	}
	else
	{
		// $value_3=sprintf($image_tem3late,$value_3_name);
		$value_3=new stdClass;
		$value_3->type="image";
		$value_3->label="L";
		$value_3->value="../question_images/".$value_3_name;
		$values->L=$value_3;
	}
}
else
{
	$value_3=new stdClass;
	$value_3->type='text';
	$value_3->label="L";
	$value_3->value=addslashes(handle_escaping($dbc,$_POST['value_3']));
	$values->L=$value_3;
}



$value_D_type=handle_escaping($dbc,$_POST['value_D_type']);

if($value_D_type==1)
{
	$file=$_FILES['value_D'];
	$value_D_name=@file_save($file,$path);
	if(!$value_D_name)
	{
		
		exit_function();
	}
	else
	{
		// $value_D=sprintf($image_temDlate,$value_D_name);
		$value_D=new stdClass;
		$value_D->type="image";
		$value_D->label="D";
		$value_D->value="../question_images/".$value_D_name;
		$values->D=$value_D;
	}
}
else
{
	$value_D=new stdClass;
	$value_D->type='text';
	$value_D->label="D";
	$value_D->value=addslashes(handle_escaping($dbc,$_POST['value_D']));
	$values->D=$value_D;
}


$value_S_type=handle_escaping($dbc,$_POST['value_S_type']);

if($value_S_type==1)
{
	$file=$_FILES['value_S'];
	$value_S_name=@file_save($file,$path);
	if(!$value_S_name)
	{
		
		exit_function();
	}
	else
	{
		// $value_S=sprintf($image_temSlate,$value_S_name);
		$value_S=new stdClass;
		$value_S->type="image";
		$value_S->label="S";
		$value_S->value="../question_images/".$value_S_name;
		$values->S=$value_S;
	}
}
else
{
	$value_S=new stdClass;
	$value_S->type='text';
	$value_S->label="S";
	$value_S->value=addslashes(handle_escaping($dbc,$_POST['value_S']));
	$values->S=$value_S;
}

$value_4_type=handle_escaping($dbc,$_POST['value_4_type']);

if($value_4_type==1)
{
	$file=$_FILES['value_4'];
	$value_4_name=@file_save($file,$path);
	if(!$value_4_name)
	{
		
		exit_function();
	}
	else
	{
		// $value_4=sprintf($image_tem4late,$value_4_name);
		$value_4=new stdClass;
		$value_4->type="image";
		$value_4->label="M";
		$value_4->value="../question_images/".$value_4_name;
		$values->M=$value_4;
	}
}
else
{
	$value_4=new stdClass;
	$value_4->type='text';
	$value_4->label="M";
	$value_4->value=addslashes(handle_escaping($dbc,$_POST['value_4']));
	$values->M=$value_4;
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

$option_A_type=handle_escaping($dbc,$_POST['option_A_type']);
// $option_B_type=handle_escaping($dbc,$_POST['option_B_type']);
// $option_C_type=handle_escaping($dbc,$_POST['option_C_type']);
// $option_D_type=handle_escaping($dbc,$_POST['option_D_type']);
if($option_A_type==1)
{
	$file=$_FILES['option_A'];
	$option_A_name=file_save($file,$path);
	if(!$option_A_name)
	{
		
		exit_function();
	}
	else
	{
		// $option_A=sprintf($image_template,$option_A_name);
		$option_A=new stdClass;
		$option_A->type="image";
		$option_A->value=$question_images."/".$option_A_name;
		array_push($options,$option_A);
	}
}
else
{
	$option_A=new stdClass;
	$option_A->type='text';
	$option_A->value=addslashes(handle_escaping($dbc,$_POST['option_A']));
	array_push($options,$option_A);
}



//option B
$option_B_type=handle_escaping($dbc,$_POST['option_B_type']);
// $option_B_type=handle_escaping($dbc,$_POST['option_B_type']);
// $option_C_type=handle_escaping($dbc,$_POST['option_C_type']);
// $option_D_type=handle_escaping($dbc,$_POST['option_D_type']);
if($option_B_type==1)
{
	$file=$_FILES['option_B'];
	$option_B_name=file_save($file,$path);
	if(!$option_B_name)
	{
		exit_function();
	}
	else
	{
		// $option_A=sprintf($image_template,$option_A_name);
		$option_B=new stdClass;
		$option_B->type="image";
		$option_B->value=$question_images."/".$option_B_name;
		array_push($options,$option_B);
	}
}
else
{
	$option_B=new stdClass;
	$option_B->type='text';
	$option_B->value=addslashes(handle_escaping($dbc,$_POST['option_B']));
	array_push($options,$option_B);
}

$option_C_type=handle_escaping($dbc,$_POST['option_C_type']);

if($option_C_type==1)
{
	$file=$_FILES['option_C'];
	$option_C_name=file_save($file,$path);
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
		$option_C->value=$question_images."/".$option_C_name;
		array_push($options,$option_C);
	}
}
else
{
	$option_C=new stdClass;
	$option_C->type='text';
	$option_C->value=addslashes(handle_escaping($dbc,$_POST['option_C']));
	array_push($options,$option_C);
}



$option_D_type=handle_escaping($dbc,$_POST['option_D_type']);
// $option_B_type=handle_escaping($dbc,$_POST['option_B_type']);
// $option_C_type=handle_escaping($dbc,$_POST['option_C_type']);
// $option_D_type=handle_escaping($dbc,$_POST['option_D_type']);
if($option_D_type==1)
{
	$file=$_FILES['option_D'];
	$option_D_name=file_save($file,$path);
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
		$option_D->value=$question_images."/".$option_D_name;
		array_push($options,$option_D);
	}
}
else
{
	$option_D=new stdClass;
	$option_D->type='text';
	$option_D->value=addslashes(handle_escaping($dbc,$_POST['option_D']));
	array_push($options,$option_D);
}

//echo json_encode($options);

$id=insert_question_matrix_match_3($dbc,$subject_id, $topic_id, $difficulty,$question,json_encode($options),$correct_ans,addslashes(json_encode($solution)),$image_name,$marking);

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
