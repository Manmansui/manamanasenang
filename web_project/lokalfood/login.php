<?php
session_start();
include("include/config.php");

?>

<!DOCTYPE html>
<html>
<head>
<title>mylokalFood</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/w3.css">
<link rel="stylesheet" type="text/css" href="css/mystyle.css">
<!-- Load font and icon library -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<!-- Header -->
<header>
<?php
include("include/userNav.php");
?>	
</header>	
<!-- Navigation Menu -->
<nav class="topnav">
<?php
include("include/topNav.php");
?>
</nav>
<!-- Page content row -->
<div class="row">
<div class="col-secLeft">
	<div class="header">
		<h4>| Login</h4>
	</div>
	<form action="login_action.php" method="post">
	<p>Username: 
	<input type="text" name="custEmail" required placeholder="Your email"></p>
	<p>Password: 
    <input type="password" name="custPwd" required></p>
    <button type="submit">Login</button>
	<br> 
	</form>	
</div>

<div class="col-secRight">
	<div class="header">
		<h4>| New Registration</h4>
	</div>
	<form action="register_action.php" method="post">
	<p>Name: 
	<input type="text" name="custName" required></p>
	<p>Adress: 
	<input type="text" name="custadress" required></p>
	<p>Email: 
	<input type="email" name="custEmail" required></p>
	<p>Password: 
	<input type="password" name="custPwd" required></p>
	<button type="submit">Register</button>&nbsp;<input type="reset"> 
	</form>
</div>
<!-- End page content -->
</div>
</div>

</body>
</html>
