<?php
session_start();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta name="viewport" content="device-width, initial-scale=1.0">
		<title>Home</title>
		<link rel= "icon" href= "img/Dragon.jpeg" type="image/x-icon">
		<link rel="stylesheet" href="site.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
		
		<style>
			.topnav .noHover{
				pointer-events: none;
			}
		</style>
		
	</head>

	<body>
	
		<!-- Header -->
		<header>
		<div class="header">
			<img class= "image" src= "img/a2.jpg" alt="books">
			<h1 style="background: linear-gradient(#F0777E, #ffe5b4); text-align: center; font-size: 3.125em;"> My Personal Site </h1>
		</div>
		</header>
		
		<!-- Navigation Menu -->
		<nav class="topnav">
			<a href= "home.php"> Home </a>
			<a href= "projects.html"> My Software Projects </a>
			<a href= "reviewform.html"> Software Review Form </a>
			<a href= "contact.html"> Contact Me </a>
			<a href= "logout.php" style= "float:right;" onclick="return confirm('Are you sure to logout?');"> Logout </a>
			<a href= "#" class= "noHover" style= "float:right;" > 
				<?php
					echo "[";
					echo $_SESSION["name"];
					echo "]";
				?>
			</a>
		</nav>
		
		<!-- Page content -->
		<div class="row">
			<div class="col-left">
				<img src="img/firman.jpeg" alt="avatar image"style="width:200px;height:200px;border: none; box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px;">
			</div>
			<div class="col-mid">
				<h1>About Me</h1>
				<p>My name is Firman Ridwan.</p>
				<p>A 2<sup>nd</sup> year Software Engineering student in Faculty of Computing and Informatics, UMS.</p>
				<p>This is My Personal Site.</p>
			</div>
			<div class="col-right">
				<div class="aside">
				<h2>What?</h2>
				<p>Web Engineering course covers client-side scripting and server side scripting </p>
				<h2>Where?</h2>
				<p>Makmal Computer, Block B, Level 4 FKJ</p>
				<h2>When? </h2>
				<p> Every Tuesday 8 - 10 am</p>
				</div>
			</div>
		</div>
		
		<!-- Footer -->
		<footer>
		<div class="footer">
			<small><i>Copyright &copy; 2021 Firman Ridwan. All Rights Reserved.</i></small>
		</div>
		<footer>
	
	</body>
</html>