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
include("include/adminNav.php");
?>	
</header>	
<!-- Navigation Menu -->
<nav class="topnav">
<?php
include("include/topNav.php");
?>
</nav>

<div class="row">
<div class="col-secLeft">
	<div class="header">
		<h4>| Login</h4>
	</div>
	<form action="admin_login_action.php" method="post">
	<p>Username: 
	<input type="text" name="admin_username" required placeholder="Your username"></p>
	<p>Password: 
    <input type="password" name="adminPwd" required></p>
    <button type="submit">Login</button>
	<br> 
	</form>	
</div>

<div class="col-secRight">
	<div class="header">
		<h4>| New Registration</h4>
	</div>
	<form action="admin_register.php" method="post">
	<p>Username: 
	<input type="text" name="admin_username" required></p>
	<p>Password: 
	<input type="password" name="adminPwd" required></p>
	<button type="submit">Register</button>&nbsp;<input type="reset"> 
	</form>
</div>

<!-- End page content -->
</div>
</div>