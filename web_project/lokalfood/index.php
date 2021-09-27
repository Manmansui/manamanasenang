<?php
session_start();
include("include/config.php");
echo "The administrator func was located at the bottom right page";
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
<?php
include("include/sideNav.php");
?>

<!-- Page content col-mid-->
<div class="col-mid">
<!-- food division-->
<div class="w3-row-padding w3-padding-16 w3-center" id="food">
<?php

if (empty($_GET["search"])){ //if search box empty

if(isset($_GET['action']) && $_GET['action']=="view"){
	$food_cat = $_GET['cat'];
	if($food_cat == 6){ // for rating
		
		for($i=5; $i>0; $i--){ //star rating
			$sql = "SELECT fr.*, f.*, r.* 
					FROM food_review fr 
					INNER JOIN food f on fr.food_id = f.food_id 
					LEFT JOIN restaurant r on f.rest_id = r.rest_id 
					WHERE fr.food_ratings = '$i'";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
?>
			<p><strong><?php echo $i ?> <span class="fa fa-star checked"></span> food </strong></p>	
<?php
				while($row = mysqli_fetch_assoc($result)) {
?>
					<div class="w3-quarter">
					  
					  <img src="<?php echo htmlentities($row['food_img']); ?>" style="width:100%; border-radius: 10px;"></img>
					  <b><?php echo htmlentities($row['food_name']);?></b><br>
					  RM <?php echo htmlentities($row['food_price']);?><br>	 
					  By : <?php echo htmlentities($row['rest_name']);?><br>
							  
					<form method="post" action="cart_action.php?action=add&id=<?php echo $row['food_id'];?>">
						<input type="text" name="quantity" value="1" size="2" />
						<button type="submit"><i class="fa fa-shopping-cart" style="font-size:20px"></i> Add to Cart</button>
					</form></b><br>
					</div>
<?php
				}
				echo "<br>" . "<br>" . "<br>" . "<br>" . "<br>" . "<br>" . "<br>"
				 . "<br>" . "<br>" . "<br>" . "<br>" . "<br>" . "<br>" . "<br>"
				  . "<br>" . "<br>" . "<br>" . "<br>" . "<br>";
				
			}else{
?>
				<p><strong><?php echo $i ?> <span class="fa fa-star checked"></span> food </strong></p>
<?php
				echo "No food for this ratings";
				echo "<br>" . "<br>";
			}
		}
		
	}else{//else for cat 1,2,3,4,5
		$sql = "SELECT *
			FROM food, restaurant WHERE food.rest_id = restaurant.rest_id AND food_cat = $food_cat";

		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
	?>
				<div class="w3-quarter">
				  <img src="<?php echo htmlentities($row['food_img']); ?>" style="width:100%; border-radius: 10px;"></img>
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
			}
		}else{
			echo "no food cat found";
		}
	}//else for cat 1,2,3,4,5

	
}else{
$sql = "SELECT *
		FROM food, restaurant WHERE food.rest_id = restaurant.rest_id AND food_availability = 1";
$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
  // output data of each row
	while($row = mysqli_fetch_assoc($result)) {
		//echo "id: " . $row["food_id"]. " - Name: " . $row["food_name"]. " " . "<br>";
			
	?>
		<!-- food resultset <a href="index.php?page=product&action=add&id=<?php //echo $row['food_id']; ?>"><i class="fa fa-shopping-cart" ></i> Add to Cart</a><br><br>-->
		<div class="w3-quarter">
		  <img src="<?php echo htmlentities($row['food_img']); ?>" style="max-width:100%;border-radius: 10px;"></img>
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
}

}//closing if statement (if search box empty)

else { //if search box not empty
	$search = $_GET["search"];
	$result_exist = 0;
	
	$sql = "SELECT * FROM food, restaurant, food_category 
			WHERE food.rest_id = restaurant.rest_id AND food_availability = 1 AND food_category.cat_id = food.food_cat";

	$result = mysqli_query($conn, $sql);
	
	if (mysqli_num_rows($result) > 0) {
    // output data of each row
	?>	
	
	<p style='text-align:left;'>Filter by: 
	<input type="button" value="Price" id="btnPrice" name = "filter"
		onClick="document.location.href='index.php?search=<?php echo $search ?>&filter=<?php echo "price" ?>' " />
	<input type="button" value="Rating" id="btnRating" name = "filter"
		onClick="document.location.href='index.php?search=<?php echo $search ?>&filter=<?php echo "rating" ?>' " />
	</p>

	<?php
	if (empty($_GET["filter"])){
	
	while($row = mysqli_fetch_assoc($result)) {
		if(stripos($row["food_name"], $search) !== false || stripos($row["rest_name"], $search) !== false || stripos($row["cat_name"], $search) !== false){
		$result_exist++;
		//echo "id: " . $row["food_id"]. " - Name: " . $row["food_name"]. " " . "<br>";
			
	?>
		<!-- food resultset <a href="index.php?page=product&action=add&id=<?php //echo $row['food_id']; ?>"><i class="fa fa-shopping-cart" ></i> Add to Cart</a><br><br>-->
		<div class="w3-quarter">
		  <img src="<?php echo htmlentities($row['food_img']); ?>" style="max-width:100%;border-radius: 10px;"></img>
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
		}//if
		}//while
		if($result_exist == 0){
			echo "Sorry, 0 result found";
		}	
		
		}?>
	
	<?php
	if (!empty($_GET["filter"])){
		$filter= $_GET["filter"];
		
		if($filter == "price"){
			$sql_price = "SELECT * FROM food, restaurant, food_category
						  WHERE food.rest_id = restaurant.rest_id AND food_availability = 1 AND food_category.cat_id = food.food_cat 
						  ORDER BY food.food_price";
			$result_price = mysqli_query($conn, $sql_price);
			
			while($row_price = mysqli_fetch_assoc($result_price)) {
				if(stripos($row_price["food_name"], $search) !== false || stripos($row_price["rest_name"], $search) !== false || stripos($row_price["cat_name"], $search) !== false){
	?>
				<div class="w3-quarter">
			  <img src="<?php echo htmlentities($row_price['food_img']); ?>" style="max-width:100%;border-radius: 10px;"></img>
			  <b><?php echo htmlentities($row_price['food_name']);?></b><br>
			  RM <?php echo htmlentities($row_price['food_price']);?><br>	 
			  By : <?php echo htmlentities($row_price['rest_name']);?><br>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star"></span>
				<span class="fa fa-star"></span>	  
			<form method="post" action="cart_action.php?action=add&id=<?php echo $row_price['food_id'];?>">
				<input type="text" name="quantity" value="1" size="2" />
				<button type="submit"><i class="fa fa-shopping-cart" style="font-size:20px"></i> Add to Cart</button>
			</form></b><br>
			</div>  			
	<?php
	
				}
			}
		} else if ($filter == "rating"){
			$sql_price = "SELECT * FROM food, restaurant, food_review, food_category 
						  WHERE food.rest_id = restaurant.rest_id AND food_availability = 1 
						  AND food.food_id = food_review.food_id AND food_category.cat_id = food.food_cat
						  ORDER BY food_ratings DESC";
			$result_price = mysqli_query($conn, $sql_price);
			
			while($row_price = mysqli_fetch_assoc($result_price)) {
				if(stripos($row_price["food_name"], $search) !== false || stripos($row_price["rest_name"], $search) !== false || stripos($row_price["cat_name"], $search) !== false){
	?>
				<div class="w3-quarter">
			  <img src="<?php echo htmlentities($row_price['food_img']); ?>" style="max-width:100%;border-radius: 10px;"></img>
			  <b><?php echo htmlentities($row_price['food_name']);?></b><br>
			  RM <?php echo htmlentities($row_price['food_price']);?><br>	 
			  By : <?php echo htmlentities($row_price['rest_name']);?><br>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star"></span>
				<span class="fa fa-star"></span>	  
			<form method="post" action="cart_action.php?action=add&id=<?php echo $row_price['food_id'];?>">
				<input type="text" name="quantity" value="1" size="2" />
				<button type="submit"><i class="fa fa-shopping-cart" style="font-size:20px"></i> Add to Cart</button>
			</form></b><br>
			</div>  			
	<?php
	
				}
			}
			
			echo "<b>Unrated items are not shown.</b>";
		}	
	} ?>
		
		
<?php
	}//if
		else {
			echo "Sorry, 0 result found";
	} 
	mysqli_close($conn);
	
}//closing else statement (if searchbox not empty)

?>

	

	</div>	<!-- food division-->
	</div> <!-- Page content col-mid-->
</div>  <!-- Page content row -->

<!-- Footer -->
<footer>
	<div class="footer">
	<small><i>Copyright &copy; 2021 lokalFood</i></small>
	<strong><a href="admin/admin.php" style= "float: right; color: red;" id= "admin_hover"><i class="fa fa-cog"></i> Administrator</a> </strong>
	</div>
</footer>

<!-- End page content </div>-->

</body>
</html>
