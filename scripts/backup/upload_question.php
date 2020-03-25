<?php

if(isset($_REQUEST['question_type']))
{
	if($_REQUEST['question_type']==1)
	{
		include("upload_question_single.php");
	}
	else if($_REQUEST['question_type']==2)
	{
		include("upload_question_multiple.php");
	}
	else if($_REQUEST['question_type']==3)
	{
		include("upload_question_comprehension.php");
	}
	else if($_REQUEST['question_type']==4)
	{
		include("upload_question_matrix_match.php");
	}
	else if($_REQUEST['question_type']==5)
	{
		include("upload_question_true_false.php");
	}
	else if($_REQUEST['question_type']==6)
	{
		include("upload_question_integer.php");
	}
	else if($_REQUEST['question_type']==7)
	{
		include("upload_question_fillups.php");
	}
	else if($_REQUEST['question_type']==8)
	{
		include("upload_question_assertion_reason.php");
	}
	else if($_REQUEST['question_type']==9)
	{
		include("upload_question_boards.php");
	}
	else if($_REQUEST['question_type']==10)
	{
		include("upload_question_matrix_match_3.php");
	}
	else if($_REQUEST['question_type']==11)
	{
		include("upload_question_decimal.php");
	}

}
else
{
	echo "mention question type";
}


?>

