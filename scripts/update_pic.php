<?php
include("header.php");
$permission=1;
include("self_check.php");

if(!empty($_POST['pic_base64']))
{
	$temp_pic_name=$time_hash.".png";
	image_base64_save($_POST["shop_pic_base64"],$temp_pic_name,$temp_image_path,"png");
}
else
{
	$result->message="image not found";
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


if( !empty($_POST['destination']))
{
	$destination=handle_escaping($dbc,$_POST["destination"]);
	switch ($destination) {
		case 'employee':
			$update_function=function($dbc,$id,$a){
				return update_employee_pic($dbc,$id,$a);
			}
			break;
		case 'product':
			$update_function=function($dbc,$id,$a){
				return update_product_pic($dbc,$id,$a);
			}
			break;
		case 'shop':
			$update_function=function($dbc,$id,$a){
				return update_shop_pic($dbc,$id,$a);
			}
			break;
		
		default:
			$update_function=function($dbc,$id,$a){
				return false;
			}
			break;
	}
}
else
{
	$result->message="destination for the image not found";
	return_error($dbc,$result);
}

if(!update_function($dbc,$temp_pic_name))
{

	$result->message="updating shop failed";
	return_error($dbc,$result);
	
}
return_successful($dbc,$result,"Done updating shop");
?>
