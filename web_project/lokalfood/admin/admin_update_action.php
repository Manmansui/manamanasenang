<?php
session_start();
include("include/config.php");
$admin_id = $_SESSION["AID"];
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
			<div style= "margin-top: 20px; margin-left: 10px;">
				<form method= "post" action= "admin_update_action.php?action=update&id=3">
				<p>
					<label for="food_id">Enter food ID to UPDATE: </label>
					<input id="food_id" type="text" name="food_id" style= "width: 30px; margin-left: 10px;" required>
				</p>
				<p>
					<input id="submit_update" type="submit">
				</p>
				</form>
			</div>

			<?php
				if(empty($_GET["id"])){
		?>
					<div class="w3-quarter" width= "auto" style="width: 80%; margin: 10 10 10 10;">
						<table cellpadding="2" cellspacing="1" id="carttable" width="80%" style="margin: 10px 20px 50px 10px;">
							<thead>
								<colgroup>
								   <col span="1" style="width: 8%;">
								   <col span="1" style="width: 8%;">
								   <col span="1" style="width: 10%;">
								   <col span="1" style="width: 8%;">
								   <col span="1" style="width: 10%;">
								   <col span="1" style="width: 20%;">
								   <col span="1" style="width: 10%;">
								</colgroup>
							</thead>
							<tbody>
								<tr id="carttable tr">
									<th style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #909090; color: white;">food_id</th>
									<th style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #909090; color: white;">rest_id</th>
									<th style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #909090; color: white;" width="15%">food_name</th>
									<th style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #909090; color: white;" width="8%">food_cat</th>
									<th style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #909090; color: white;" width="8%">food_price</th>
									<th style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #909090; color: white;" width="15%">food_img</th>
									<th style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #909090; color: white;" width="10%">food_availability</th>
								</tr>
								
								<?php
									

									$sql = "SELECT *
											FROM food, restaurant WHERE food.rest_id = restaurant.rest_id AND food_availability = 1";
									$raw_results = mysqli_query($conn, $sql);
									while($results = mysqli_fetch_assoc($raw_results)){
									$food_id = $results["food_id"];
									$rest_id = $results["rest_id"];
									$food_name = $results["food_name"];
									$food_cat = $results["food_cat"];
									$food_price = $results["food_price"];
									$food_img = $results["food_img"];
									$food_avail = $results["food_availability"];
								?>
									<tr>
										<td style="text-align:center;"> <?php echo $food_id ?> </td>
										<td style="text-align:center;"> <?php echo $rest_id ?> </td>
										<td style= "font-size: 14px;"> <?php echo $food_name ?> </td>
										<td style="text-align:center;"> <?php echo $food_cat ?> </td>
										<td style="text-align:center;"> <?php echo $food_price ?> </td>
										<td style= "font-size: 14px;"> <?php echo $food_img ?> </td>
										<td style="text-align:center;"> <?php echo $food_avail ?> </td>
									</tr>
								<?php
									}
								?>
							</tbody>
						</table>
					</div>	
		<?php					
				}else{//if
					
					$food_id_update = $_POST['food_id'];
					$sql_update_view = "SELECT * FROM food WHERE food_id= '$food_id_update' AND food.rest_id = '$admin_id' LIMIT 1";
					$res = mysqli_query($conn, $sql_update_view);
					if(mysqli_num_rows($res) == 1){
						$row = mysqli_fetch_assoc($res);
						$f_name = $row["food_name"];
						$f_cat = $row["food_cat"];
						$f_price = $row["food_price"];
						$f_img = $row["food_img"];
						$f_avail = $row["food_availability"];
						$f_rest_id = $row["rest_id"];
					}else{
						echo "no entry found!";
					}
					
					if($_GET["id"] == 31){
						//$food_id_update
						$update_name = $_POST['f_name'];
						$update_cat = $_POST['f_cat'];
						$update_price = $_POST['f_price'];
						$update_img = $_POST['f_img'];
						$update_stock = $_POST['f_avail'];
						$update_rest_id = $_POST['f_rest_id'];
						
						$sql_update_action = "UPDATE food SET rest_id='$update_rest_id', food_name='$update_name', 
											  food_cat='$update_cat', food_price='$update_price', food_img= '$update_img', food_availability='$update_stock'
											  WHERE food_id = '$food_id_update'";

						if(mysqli_query($conn, $sql_update_action)){
							echo "Records were updated successfully.";
						} else {
							echo "Error update";
						}
					}else{
		?>
						<p>
							<label for="b">Please only change item that you want to UPDATE:</label>
						 </p>
						<form method= "post" action="admin_update_action.php?action=update&id=31">
						  <p>
							<label for="A">Update Food ID= <?php echo $food_id_update ?>:</label>
							<input type="hidden" id= "food_id" name= "food_id" value= "<?php echo $food_id_update ?>">
						  </p>
						  <p>
							<label for="f_name">Name:</label>
							<input id="f_name" type="text" name="f_name" value="<?php echo $f_name ?>" required>
						  </p>
						  <p>
							<label for="f_cat">Category:</label>
							<input id="f_cat" type="text" name="f_cat" value="<?php echo $f_cat ?>" required>
						  </p>
						  <p>
							<label for="f_price">Price:</label>
							<input id="f_price" type="text" name="f_price" value="<?php echo $f_price ?>" required>
						  </p>
						  <p>
							<label for="f_img">Image directory:</label>
							<input id="f_img" type="text" name="f_img" style= "width: 400px;" value="<?php echo $f_img ?>" required>
						  </p>
						  <p>
							<label for="f_avail">Stock:</label>
							<input id="f_avail" type="text" name="f_avail" value="<?php echo $f_avail ?>" required>
						  </p>
						  <p>
							<label for="f_rest_id">Restaurant ID: </label>
							<input id="f_rest_id" type="text" name="f_rest_id" value="<?php echo $f_rest_id ?>" required>
						  </p>
						  <p>
							<input id="submit" type="submit" value= "Update">
						  </p>
						</form>
					
					
			<?php
					}
				}
		?>

	</body>
</html>