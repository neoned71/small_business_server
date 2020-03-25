<!DOCTYPE html>
<html>


<head>
	<title>Student Registration</title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
	<script src="js/registration.js"></script>
	
</head>
<body >
	<style type="text/css">
	*{
		font-size:90%;
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
			margin-left: 50%;
			width:50%;
			opacity:0.99;
			
			
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
			/*position:fixed;
			left:10%;
			top:100px;*/
			margin-top:100px;
			opacity:0.7;
			max-width:100%;
			height:auto;
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
		table{
			width:100%;
		}
	</style>
	
	<img class="background" src="stairs.jpg"/>
	
	<h1 class="w3-heading w3-top w3-padding w3-round w3-left w3-block w3-text-green" style="opacity:0.8;text-align:left;width:50%;">Registration Successful!</h1>
	<table class="w3-striped">
	<tr>
		<td>
			<img class="logo w3-padding w3-grey w3-round" src="g.png"/>
		</td>
		<td>
			<img class="logo w3-padding w3-grey w3-round" src="g.png"/>
		</td>
		<td>
			<img class="logo w3-padding w3-grey w3-round" src="g.png"/>
		</td>
	</tr>
	</table>

<!-- <div class=" w3-round w3-padding center" style="margin-bottom:300px;">
	
	<br><br>
	<div class="  w3-text-cyan" style="margin-top:100px;">
		<h1 class=" w3-padding w3-round w3-white" style="opacity:0.8;text-align:center;width:100%;">Take the first <span class="w3-text-cyan" style="font-size:200%;">step...</span></h1>


</div>
<p onclick="attemptRegistration();" class=" w3-button w3-right w3-card w3-round w3-cyan w3-text-white w3-large w3-margin w3-padding">Let's Begin...</p>

</div> -->
</body>

</html>