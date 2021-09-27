<?php
session_start();
include("include/config.php");

$food_name = $_POST['food_name'];
$sql= "SELECT * FROM food WHERE food.food_name='$food_name';";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array ($result);

$food_id = $row['food_id'];
$order_id = $_POST['order_id'];
$review = $_POST['review'];
$rate = $_POST['rate'];
$cust_id = $_SESSION["UID"];

$reg = "insert into food_review(cust_id,order_id,food_id,food_review,food_ratings) 
		values ('$cust_id', '$order_id', '$food_id', '$review', '$rate');";
mysqli_query($conn, $reg);


?>

<!DOCTYPE html>
<html>
<head>
<title>mylokalFood</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/w3.css">
<link rel="stylesheet" type="text/css" href="css/mystyle.css">
<link rel="stylesheet" type="text/css" href="css/star.css">
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

<h2>"Thank you for submitting a review!!"</h2>

</body>
</html>

