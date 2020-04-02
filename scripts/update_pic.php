<?php
include("header.php");
$permission=1;
include("self_check.php");

if( !empty($_POST['operation']))
{
	$operation=handle_escaping($dbc,$_POST["operation"]);
}
else
{
	$result->message="operation not found";
	return_error($dbc,$result);
}

if( !empty($_POST['id']))
{
	$id=handle_escaping($dbc,$_POST["id"]);
}
else
{
	$result->message="id not found";
	return_error($dbc,$result);
}

if($operation=="update")
{
	if(!empty($_POST['pic_base64']))
	{
		$temp_pic_name=$time_hash.".png";
		image_base64_save($_POST["pic_base64"],$temp_pic_name,TEMP_IMAGE_PATH,"png");
	}
	else
	{
		$result->message="image not found";
		return_error($dbc,$result);
	}


	


	if(!empty($_POST['destination']))
	{
		$destination=handle_escaping($dbc,$_POST["destination"]);
		switch ($destination) {
			case 'employee':
				if(!update_employee_pic($dbc,$id,$temp_pic_name))
				{

					$result->message="updating employee pic failed";
					return_error($dbc,$result);
					
				}
				
				break;
			case 'product':
			if(!update_product_pic($dbc,$id,$temp_pic_name))
				{

					$result->message="updating product pic failed";
					return_error($dbc,$result);
					
				}
			
				break;
			case 'shop':
			if(!update_shop_pic($dbc,$id,$temp_pic_name))
				{

					$result->message="updating shop pic failed";
					return_error($dbc,$result);
					
				}
			
				break;
			
			// default:
			// 	$update_function=function($dbc,$id,$a){
			// 		return false;
			// 	}
			// 	break;
		}
	}
	else
	{
		$result->message="destination for the image not found";
		return_error($dbc,$result);
	}
}
else if($operation=="remove")
{
	if(!empty($_POST['destination']))
	{
		$destination=handle_escaping($dbc,$_POST["destination"]);
		switch ($destination) {
			case 'employee':
				if(!remove_employee_pic($dbc,$id))
				{
					$result->message="updating employee pic failed";
					return_error($dbc,$result);
					
				}
				
				break;
			case 'product':
			if(!remove_product_pic($dbc,$id))
				{

					$result->message="updating product pic failed";
					return_error($dbc,$result);
					
				}
			
				break;
			case 'shop':
			if(!remove_shop_pic($dbc,$id))
				{

					$result->message="updating shop pic failed";
					return_error($dbc,$result);
					
				}
			
				break;
			
			// default:
			// 	$update_function=function($dbc,$id,$a){
			// 		return false;
			// 	}
			// 	break;
		}
	}
	else
	{
		$result->message="destination for the image not found";
		return_error($dbc,$result);
	}
}
else
{
	$result->message="unknown operation";
		return_error($dbc,$result);
}


/*
//if(update_employee($dbc,$temp_pic_name))
if(!update_function($dbc,$temp_pic_name))
{

	$result->message="updating shop failed";
	return_error($dbc,$result);
	
}
*/
return_successful($dbc,$result,"Done updating image");
?>
