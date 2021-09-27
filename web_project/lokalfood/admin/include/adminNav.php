<img src="img/mylokalfood.png" class="imgcenter">	
<?php 


	if(isset($_SESSION["AID"])){
		echo '<p style="text-align:right"><b> '. $_SESSION["admin_user"] . '</b> <a href="admin_logout.php"><i class="fa fa-sign-out" style="font-size:24px" align="right"></i>Logout</a>';	
		
	}
	else {
		echo '<p align="right"><a href= "admin_login.php"><i class="fa fa-sign-in" style="font-size:24px" align="right"></i> Admin Login </a>';
	}
?>
