<?php
session_start();
include("include/config.php");

if(isset($_GET["order_del"])){
	$order_id = $_GET["order_del"];
}

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

<div class="row">

<p style="margin: 15px;"><i class="fa fa-comment" style="font-size:24px"></i> / My Review</p>
	<p style="margin: 15px;">Food Name : </p>
	<form method="post" action="review_process.php">
	<select style="margin: 15px;" name = "food_name" >
	<?php
	$sql= "SELECT order_line.order_id, food.food_id, food.food_name
		FROM order_line 
		INNER JOIN food ON order_line.food_id = food.food_id AND order_line.order_id= '$order_id'";
		
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result)) { 
	
?>
		<option> <?php echo $row['food_name']?> </option>
		<?php } ?> 
	</select>
	
	
		<input type = "hidden" name = "order_id" value="<?php echo $order_id;?>">
		<p style="margin: 15px;">Review: <textarea name="review" rows="4" cols="50"></textarea></p>
		<p style="margin: 15px;">Ratings:</p>
		 <div class="rate">
			<input type="radio" id="star5" name="rate" value="5" checked>
			<label for="star5" title="text">5 stars</label>
			<input type="radio" id="star4" name="rate" value="4" />
			<label for="star4" title="text">4 stars</label>
			<input type="radio" id="star3" name="rate" value="3" />
			<label for="star3" title="text">3 stars</label>
			<input type="radio" id="star2" name="rate" value="2" />
			<label for="star2" title="text">2 stars</label>
			<input type="radio" id="star1" name="rate" value="1" />
			<label for="star1" title="text">1 star</label>
		  </div>
		<input type="submit" name="submitdata" value="Submit">
	</form>
</div>
</body>
</html>