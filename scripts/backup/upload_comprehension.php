<?php
include("../common/initialization.php");
$path="../images/question_images";

$ret=new stdClass;
$ret->image="";
$ret->text="";
$ret->name="default";
$ret->subject_id=0;

$image_name=NULL;


if(isset($_FILES['comprehension_image']['name'])){
	// echo "question image found!";
	$file=$_FILES['comprehension_image'];

		$image_name=@file_save($file,$path);
		if(!$image_name)
		{
			// echo "exiting";
			exit_function();
		}
		else{
			$ret->image=$image_name;
		}	
	
}

if(isset($_POST['name']))
{
	$name=handle_escaping($dbc,$_POST['name']);
}
else
{
	$name="";
}

if(isset($_POST['content']))
{
	$ret->text=handle_escaping($dbc,$_POST['content']);
}
else
{
	exit_function();
}

if(isset($_POST['subject_id']))
{
	$subject_id=handle_escaping($dbc,$_POST['subject_id']);
}
else
{
	exit_function();
}

$content=addslashes(json_encode($ret));

$id=insert_comprehension($dbc,$name,$content,$subject_id);

// $id=insert_comprehension($dbc,"name","hello",2);

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