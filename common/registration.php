<!DOCTYPE html>
<html>


<head>
	<title>Student Registration</title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
	<script src="js/registration.js"></script>
	
</head>
<body onload="initialize_installments();">
	<style type="text/css">
	*{
		font-size:90%;
	}

margin-left: 50%;
			width:50%;
	@media screen and (min-width: 0px) and (max-width: 1000px) {
  		.center{
			
			margin: 0;
			width:100%;

			
			
			
		}
		.logo{
			margin:20%;
			width:200px;
			height:100px;
			position:relative;
			
			
			
		}
}


@media screen and (min-width: 1000px) and (max-width: 100000px) {
  		.center{
			
			margin-left: 50%;
			width:50%;

			
			
			
		}
		.logo{
			
			margin:0%;
			position:fixed;
			left:10%;
			top:100px;
			
			
			
			
		}
}

	input[type=text], select {
    width: 90%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
input[type=checkbox] {
    width: 10%;
    
}

input[type=submit]:hover {
    background-color: #45a049;
}
		*{margin;0;
			padding:0;
		}

		.center{
			
			overflow:scroll;
			
			opacity:0.99;
			margin-bottom:300px;
			
			
		}
		.background{
			position:fixed;
			width:100%;
			height:100%;
			z-index:-1;
			-webkit-filter: blur(10px); /* Safari 6.0 - 9.0 */
    		filter: blur(10px);
    	}
		input{
			width:60%;
		}
		.logo{
			margin:10%;
			width:400px;
			height:200px;
			opacity:0.7;
		}
		.subbutton{
			position:fixed;
			left:10%;
			top:400px;
			opacity:0.79;
		}
		.bottom_logo{
			position:fixed;
			left:10%;
			top:600px;
			opacity:0.7;
			width:300px;
		}
	</style>
	<img class="background" src="stairs.png"/>
	<img class="logo w3-padding w3-grey w3-round" src="g.png" onclick="goFullScreen();"/>
	<h1 class="w3-heading w3-top w3-padding w3-round w3-left w3-block w3-text-green" style="opacity:0.8;text-align:left;width:50%;">Registration Form</h1>
	
<div class=" w3-round w3-padding center" style="" id="fullscreen">
	
	<br><br>
	<div class="  w3-text-cyan" style="margin-top:100px;">
		<h1 class=" w3-padding w3-round w3-white" style="opacity:0.8;text-align:center;width:100%;">Take the first <span class="w3-text-cyan" style="font-size:200%;">step...</span></h1>

<form id="registration_form" class="w3-form w3-round w3-padding" >
<input class="w3-card w3-border-white w3-padding w3-margin" type="text" maxlength="15" name="first_name" placeholder="First Name*" required/><br>
<input class=" w3-card w3-padding w3-margin" type="text" maxlength="15" name="last_name" placeholder="Last Name*" required/><br>
<input class=" w3-card w3-padding w3-margin" type="text" maxlength="30" name="email" placeholder="Email Id*" required/><br>
<span class="w3-white w3-round w3-padding w3-margin" style="opacity:0.9;">Date of Birth*: <input  class=" w3-card w3-padding w3-round w3-margin" type="date" name="dob" placeholder="Date of Birth" required/>
</span>
<input type="text" class=" w3-card w3-padding w3-margin"  maxlength="15" name="mobile" placeholder="Mobile Number*" required/><br>


<input class=" w3-card w3-padding w3-margin" type="text" maxlength="30" name="guardian_name" placeholder="Guardian Name*" required/><br>
<input class=" w3-card w3-padding w3-margin"  type="text" maxlength="15" name="guardian_mobile" placeholder="Guardian Mobile*" required/><br>

<hr>
<div class="w3-card w3-light-grey w3-text-grey w3-padding w3-margin w3-round">
<span class="w3-text-cyan w3-round" style="opacity:0.5;font-size:140%;width:80%;">Class*:</span><br><select class=" w3-card w3-padding w3-margin" name="class_id" style="width:30%;">
	<option value="0">Select Class</option>
	<option value="8">Class 8th</option>
	<option value="9">Class 9th CBSE</option>
	<option value="10">Class 9th ICSE</option>
	<option value="11">Class 10th CBSE</option>
	<option value="12">Class 10th ICSE</option>
	<option value="13">Class 11th JEE</option>
	<option value="14">Class 11th NEET</option>
	<option value="15">Class 12th JEE</option>
	<option value="16">Class 12th NEET</option>
	<option value="17">Class Passout JEE</option>
	<option value="18">Class Passout NEET</option>
</select><br>

<span class="w3-text-cyan w3-round" style="opacity:0.5;font-size:140%;">Gender*:</span><br>

   <input class=" w3-paddin w3-margin w3-dark-grey" label="Male" type="radio" name="gender" value="M" checked ><label>Male</label><br>
   <input class=" w3-padding w3-margin" type="radio" name="gender" value="F">Female <br>
   <input class=" w3-padding w3-margin" type="radio" name="gender" value="O">Other  <br>





</div>
<hr>
<br>
<span style="font-size:150%;color:#fff;"></span><br>
<span style="font-size:180%;margin:10px;">Correspondence Address*</span> <br>
<br><input class="w3-input w3-card" type="text" name="laddress" placeholder="address" /><br>
<br><input class="w3-input w3-card" type="text" max-length="6" name="lpincode" onkeyup="getPincode(this.value,true);" placeholder="pincode"/><br>
<br><input class="w3-input w3-card" type="text" name="lcity" placeholder="city"/><br>
<br><input class="w3-input w3-card" type="text" name="lstate" placeholder="state"/><br>
<br>
<br>

Is same as above?<input class="w3-left" type="checkbox" name="sameAddress" onclick="sameAdd();"/><br><span style="font-size:180%;margin:10px;">Permanent Address*:</span><br>
<br> <input class="w3-input w3-card" type="text" name="paddress" placeholder="address"/><br>
<br><input class="w3-input w3-card" type="text" max-length="6" name="ppincode" onkeyup="getPincode(this.value,false);" placeholder="pincode"/><br>
<br><input class="w3-input w3-card" type="text" name="pcity" placeholder="city"/><br>
<br><input class="w3-input w3-card" type="text" name="pstate" placeholder="state"/><br>



<hr>
<div class="w3-round w3-card w3-dark-grey w3-padding">
	<span class="w3-text-cyan" style="font-size:200%;margin:10px;">UPLOAD*</span> <br>

<span style="font-size:130%;">a passport size picture of the student<span><br> (not heavier than 10MB)<input class="  w3-margin w3-padding" id="dp_upload" type="file" name="picture"/>
</div>
<hr>

<div class="w3-light-grey w3-text-grey w3-round w3-padding w3-text-white"><span style="font-size:130%;color:#111;">Fee section*:</span><br>
	First Installment payment Mode*: <select class="w3-input w3-card w3-padding w3-margin" name="fi_payment_mode" style="width:50%;"><br>
	<option value="0">Select Mode</option>
	<option value="1">Cash</option>
	<option value="2">Cheque</option>
	<!-- <option value="3">Online Transfer</option> -->
</select><br>
Total Fee(INR)*:<input class=" w3-card w3-padding w3-margin" type="text" name="total_fee" required/><br>
Number of Installments*:<input class=" w3-card w3-padding w3-margin" type="text" placeholder="number_installments" value="1" name="number_installments" onkeyup="setInstallments(this.value);" required/><br>
<div class="w3-row w3-dark-grey w3-round w3-padding">
	
	<div class="w3-third">

		<input class="w3-round w3-left w3-margin-top w3-margin-bottom" type="checkbox" placeholder="tax_paid" width="20px;" name="tax_paid"/><br>
Tax Paid?
	</div>
	
	</div>
<!-- <button onclick="calculateInstallments();">Calculate Installments</button><br> -->

1st Installment Date*:<br><input class="w3-padding w3-margin w3-card" type="date"  placeholder="f_installment_date" name="f_installment_date" required/><br>
1st Installment Amount*:<br><input class="w3-padding w3-margin w3-card" type="number" value="0" placeholder="f_installment_amount" name="f_installment_amount" step="any" required/><br>
<div id="s_installment">
2nd Installment Date*:<br><input class="w3-padding w3-margin w3-card" type="date" placeholder="s_installment_date" name="s_installment_date"/><br>
2nd Installment Amount*:<br><input class="w3-padding w3-margin w3-card" type="number" value="0" placeholder="s_installment_amount" name="s_installment_amount" step="any" /><br>
</div>
<div id="t_installment">
3rd Installment Date*:<br><input class="w3-padding w3-margin w3-card" type="date" placeholder="t_installment_date" name="t_installment_date"/><br>
3rd Installment Amount*:<br><input class="w3-padding w3-margin w3-card" type="number" value="0" placeholder="t_installment_amount" name="t_installment_amount" step="any" /><br>
</div>
<div id="l_installment">
4th Installment Date*:<br><input class="w3-padding w3-margin w3-card" type="date" placeholder="l_installment_date" name="l_installment_date"/><br>
4th Installment Amount*:<br><input class="w3-padding w3-margin w3-card" type="number" value="0" placeholder="l_installment_amount" name="l_installment_amount" step="any" /><br>
</div>


<input class="w3-input w3-card" type="text" placeholder="fee remarks" name="fee_remarks" required/><br>
<input class="w3-input w3-card" type="text" placeholder="enrollment number" name="enrollment_number" required/><br>

<h4>Please select a center of admission*</h4>
 <input class=" w3-paddin w3-margin w3-dark-grey" label="Male" type="radio" name="center_id" value="1"><label>Indira Nagar Center</label><br>
   <input class=" w3-padding w3-margin" type="radio" name="center_id" value="2">Hazratganj Center<br>
  


</div>


</form>
</div>
<p onclick="attemptRegistration();" class=" w3-button w3-right w3-card w3-round w3-cyan w3-text-white w3-large w3-margin w3-padding">Let's Begin...</p>

</div>
</body>

</html>
