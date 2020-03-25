<?php
include("../common/initialization.php");


$ret=new stdClass;




// $image_template='<img height=\"250px\" width=\"250px\" src=\"question_images/%s\" />' ;
$options=array();

$topic_name=handle_escaping($dbc,$_POST['topic_name']);
$subject_id=handle_escaping($dbc,$_POST['subject_id']);


// echo "inserting data";
//sample insert query
$id=insert_topic($dbc,$topic_name,$subject_id);

if(!$id)
{
	$ret->status="failed";
	echo json_encode($ret);

}
else
{
	$ret->status="success";
	$ret->id=$id;
	// header('upload_topic.php');
	// echo "\n".$id."\n";
	echo json_encode($ret);
	
}
// echo "inserted";
// echo $id;
?>