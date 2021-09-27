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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">\

<style>
				form  { display: table; padding-top: 20px; margin-left: 20px;}
				label { display: table-cell; }
				input { display: table-cell; }
				#submit{margin-top: 10px;}
</style>

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
//include("include/sideNav.php");
?>

			<form method= "post" action="admin_add_action.php?action=add&id=12">
			  <p>
				<label for="A">Insert New Food:</label>
			  </p>
			  <p>
				<label for="food_name">Name:</label>
				<input id="food_name" type="text" name="food_name" required>
			  </p>
			  <p>
				<label for="food_cat">Category:</label>
				<input id="food_cat" type="text" name="food_cat" required>
			  </p>
			  <p>
				<label for="food_price">Price:</label>
				<input id="food_price" type="text" name="food_price" required>
			  </p>
			  <p>
				<label for="food_img_dir">Image directory:</label>
				<input id="food_img_dir" type="text" name="food_img_dir" required>
			  </p>
			  <p>
				<label for="food_avail">Stock:</label>
				<input id="food_avail" type="text" name="food_avail" required>
			  </p>

			  <p>
				<input id="submit" type="submit">
			  </p>

			</form>
		<?php
		$admin_id = $_SESSION["AID"];
				if(!empty($_GET["id"])){
					$sql = "INSERT INTO food (rest_id, food_name, food_cat, food_price, food_img, food_availability)
							VALUES (?, ?, ?, ?, ?, ?)";
					if($stmt = $conn -> prepare($sql)){
						$stmt->bind_param('isidsi', $admin_id, $_POST['food_name'], $_POST['food_cat'], $_POST['food_price'], $_POST['food_img_dir'], $_POST['food_avail']);
						$stmt->execute();
						echo "Successfully insert into DB...";
					}
				}			
		?>
</div>
</body>
</html>
