<?php

include("template.php");
$params=new stdClass;

if($candidate->candidate_type_id==2)
{
  header("Location: https://gravityclasses.in/office");
}
else
{
  $params=null;
  $students=get_students($dbc,$params);
}



// echo json_encode($login);
// echo json_encode($transactions);
 

?>
<style type="text/css">
	.element{
		width:20%;
		color:#000;
	}
	.e2{
		width:10%;
	}
</style>
<div class="w3- w3-margin w3-white w3-round w3-card w3-padding">
  <h1>Students</h1>
  <dic class="w3-row">
  	<div class='w3-col e2 w3-padding'>T-ID</div>
  	<div class='w3-col element w3-padding'>Center Name</div>
  	<div class='w3-col element w3-padding'>Payment Mode</div>
  	<div class='w3-col element w3-padding'>Date</div>
  	<div class='w3-col element w3-padding'>Amount</div>
  	<div class='w3-col e2 w3-padding'>Cash-Flow</div>
  	<div class="w3-col" style="width:100%"><hr></div>
  	<?php

  	foreach ($transactions as $key) {

  		echo "<div class='w3-col e2 w3-padding'>".$key->id."</div>";


  	$center=$key->center;
  	echo "<div class='w3-col element w3-padding'>".$center->name."</div>";

  	// if($key->transaction_type_id==5)
  	// {
  	// 	try{
	  // 		$remarks=json_decode($key->remarks);
	  // 		if(!empty($remarks->roll_number))
	  // 		{
	  // 			echo "<div class='w3-col element w3-padding'>".$remarks->roll_number."</div>";
	  // 		}
	  // 		else if(empty($remarks))
	  // 		{
	  // 			echo "<div class='w3-col element w3-padding '>-</div>";
	  // 		}
	  		
	  // 	}
	  // 	catch(Exception $e)
	  // 	{
	  // 		$remarks="-";
	  // 		echo "<div class='w3-col element w3-padding '>".$remarks."</div>";
	  // 	}
  	// }
  	// else
  	// {
  	// 	$remarks="-";
  	// 	echo "<div class='w3-col element w3-padding '>".$remarks."</div>";
  	// }
 
 	$payment_mode=$key->payment_mode;
	echo "<div class='w3-col element w3-padding'>".$payment_mode."</div>";
  	
  	$date=$key->date_time;
  	echo "<div class='w3-col element w3-padding'>".$date."</div>";
  	$amount=$key->amount;

  	if($key->taxable==1)
  	{
  		$amount+=$key->tax_amount;
  	}

  	echo "<div class='w3-col element w3-padding'>".$amount."</div>";


  	$cash_flow=$key->cash_flow;
  	if($cash_flow=="+")
  	{
  		echo "<div class='w3-col e2 w3-round  w3-text-green w3-center w3-padding' style='font-size:200%;'>".$cash_flow."</div>";
  	}
  	else
  	{
  		echo "<div class='w3-col e2 w3-round w3-card w3-text-red w3-padding w3-center' style='font-size:200%;'>".$cash_flow."</div>";
  	}

  	
  	
  	
  	$roll_number;

  	// echo json_encode($remarks),$date,$amount;
  	
  }

  	?>
  	

  </div>



</div>
<!-- <script type="text/javascript" src="js/transac.js"></script> -->
</body>

</html>
