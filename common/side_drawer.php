<div class="side_drawer">
	<a class="logo w3-center" href="#" style="width:80%;height:120px;margin-top:15%;margin-bottom:15%;opacity:01;margin-left:auto;margin-right:auto;display:block"></a>
<hr style="width:90%;margin-left:auto;margin-right:auto;color:#111">
<style>
.pic{
	 -webkit-filter: grayscale(100%);  Safari 6.0 - 9.0 
    filter: grayscale(100%);
}

</style>
<div class="container w3-round" style="display:block;">
	<p class="w3-text-teal"><?php echo $student->name; ?></p>
	<?php 
	if($student->gender=="M" || $student->gender=="m")
	{
		echo '<img src="../images/male.png" alt="Avatar" class="image pic" style="width:100%">';
	}
	else
	{
		echo '<img src="../images/female.png" alt="Avatar" class="image pic" style="width:100%">';
	}
	?>
  

  <!-- <img src="images/<?php echo $student->pic_path; ?>" alt="Avatar" class="image" style="width:100%"> -->
  <div class="middle w3-center">
    <a  class="w3-teal text w3-padding w3-hover-shadow w3-text-white" href="scripts/logout.php"><div class=""><h4><i>Sign-out...</i></h4></div></a>
  </div>

</div>
<ul class="list">
<li><a class="w3-margin w3-hover-text-white w3-text-light-grey" href="index.php">ALL TESTS</a></li>
<li><a class=" w3-margin w3-hover-text-white w3-text-light-grey" href="profile.php">MY PROFILE</a></li>
</ul>



</div>