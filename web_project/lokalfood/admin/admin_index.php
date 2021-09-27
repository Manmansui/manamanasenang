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
include("include/admin_topNav.php");
?>
</nav>
<!-- Page content row -->
<div class="row">
<?php
include("../include/sideNav.php");
?>

<div class="col-mid">

<div class="w3-row-padding w3-padding-16 w3-center" id="food">
<?php
$admin_id = $_SESSION["AID"];

if(isset($_GET['action']) && $_GET['action']=="view"){
	$food_cat = $_GET['cat'];
	$sql = "SELECT *
		FROM food, restaurant WHERE food.rest_id = restaurant.rest_id AND food_availability = 1";
}
else {
$sql = "SELECT *
		FROM food, restaurant WHERE food.rest_id = restaurant.rest_id AND food_availability = 1";
}

$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
	//echo "id: " . $row["food_id"]. " - Name: " . $row["food_name"]. " " . "<br>";
		
?>
	
	<div class="w3-quarter">
	  <img src="<?php echo htmlentities($row['food_img']); ?>" style="width:100%"></img>
	  <b><?php echo htmlentities($row['food_name']);?></b><br>
	  RM <?php echo htmlentities($row['food_price']);?><br>	 
	  By : <?php echo htmlentities($row['rest_name']);?><br>
	 	<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star checked"></span>
		<span class="fa fa-star"></span>
		<span class="fa fa-star"></span>	  
	<form method="post" action="cart_action.php?action=add&id=<?php echo $row['food_id'];?>">
		<input type="text" name="quantity" value="1" size="2" />
		<button type="submit"><i class="fa fa-shopping-cart" style="font-size:20px"></i> Add to Cart</button>
	</form></b><br>
	</div>  
<?php 
	}//while
}//if
	else {
		echo "Sorry, 0 result found";
} 

mysqli_close($conn);
?>
	</div>	<!-- food division-->
	</div> 
</div>  

<!-- Footer -->
<footer>
	<div class="footer">
	<small><i>Copyright &copy; 2021 lokalFood</i></small>
	</div>
</footer>

<!-- End page content </div>-->

</body>
</html>
