<?php
include("initialization.php");
//session_start();
// include("../includes/mysql.php");
// include("../utility_functions.php");
//header('Content-Type: application/json');

// session_start();


// $add=array();

// array_push($add,"city","state","pincod","address");

// $number_installments=3;
// $f_installment_date="2018-06-03 12:00:00";
// $f_installment_amount=234;
// $s_installment_date="2018-06-03 12:00:00";
// $s_installment_amount=234;
// $t_installment_date="2018-06-03 12:00:00";
// $t_installment_amount=20;
// $l_installment_date="2018-06-03 12:00:00";
// $l_installment_amount=342;
// $total_fee=1000;
// $payment_mode=1;
// $remarks="something";
// $tax_paid=1;
// $guardian_name="some name";
// $email="neoned71@gmail.com";
// $guardian_mobile="8132233223";
// $add_id_1=1;
// $add_id_2=2;
// $name="piyush shukla";
// $user_type=0;
// $post="administration";
// $working_hours="10am to 8pm";
// $username="username";
// $password="password";
// $phone="8132233223";

// $class_id=1;
// $first_name="piyush";
// $last_name="shukla";
// $gender="M";
// $date_of_birth="2015-05-03";
// $fee_id=2;
// $contact_id=2;
// $parents_id=4;


//echo "here";

// $id=save_fee($dbc,$number_installments, $f_installment_date, $f_installment_amount, $total_fee,$payment_mode, $tax_paid,$s_installment_date, $s_installment_amount, $t_installment_date, $t_installment_amount,$l_installment_date,$l_installment_amount);
// $id=insert_contact($dbc,$guardian_name,$email,$guardian_mobile,$add_id_1,$add_id_2);
// $id=insert_employee($dbc,$name, $user_type, $post, $working_hours, $add_id_1, $phone, $username, $password);
// $id=insert_parents($dbc,$guardian_name,$guardian_mobile,$add_id_1,$username,$password);
// insert_student($dbc,$email,$first_name,$last_name,$phone,$gender, $date_of_birth,$fee_id,$contact_id,$class_id,$parents_id,$dp_name="-")
//$id=insert_student($dbc,$email,$first_name, $last_name,$phone, $gender, $date_of_birth,$fee_id,$contact_id,$class_id,$parents_id);
//echo get_address($dbc,1);
// echo get_contact($dbc,1);
// echo get_parents($dbc,1);
// echo get_fee($dbc,1);

// $name,$email,$mobile,$add_id_1,$add_id_2)
// echo insert_contact($dbc,$guardian_name,$email,$guardian_mobile,$add_id_1,$add_id_2);

// $emp_id=0;
// $center_id=1;
// $event_type=1;
// echo get_transactions($dbc,0,3);
// echo insert_event($dbc,$event_type,$emp_id,$center_id);

// echo get_student($dbc,1);
// echo get_admission($dbc,1);
//echo get_employee($dbc,1);
// echo set_session("neoned71");
// echo clear_session();
// echo insert_credential($dbc,5,"username","pass",1);
// set_account_state($dbc,2,1,1);
// echo json_encode($_SERVER);
// $a= check_login();
// if($a)
// {
// 	echo "yes";
// }
// else
// {
// 	echo "no";
// }
// echo "hello";
// echo create_user_pass_parents("sdadsa","sdas-sdas")[1];

//$i=insert_class($dbc,1,1,50,1,"name of the class");
//echo $i;
//echo " this is a seperation ";
// echo get_class_info($dbc,$i);

// echo get_streams($dbc);
// echo get_centers($dbc);
// echo get_subjects($dbc);


// echo get_test($dbc,138,359,2,106);

// echo get_test_status($dbc,958,140);
//echo "hello";
// echo get_upcoming_installments($dbc,15);
// echo no_to_words(883901.01);

echo get_transactions()
mysqli_close($dbc);

?>