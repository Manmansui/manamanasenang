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
<div class="row">
<?php
//include("include/sideNav.php");
?>

<div style= "margin-top: 20px; margin-left: 10px;">
					<form method= "post" action= "admin_delete_action.php?action=delete&id=4">
					<p>
						<label for="food_id_delete">Enter food ID to DELETE: </label>
						<input id="food_id_delete" type="text" name="food_id_delete" style= "width: 30px; margin-left: 10px;" required>
					</p>
					<p>
						<input id="submit_delete" type="submit" onclick="return confirm('Delete food confirmation?');">
					</p>
					</form>
				</div>
			<?php
				if(!empty($_GET["id"])){
					$food_id_delete = $_POST['food_id_delete'];
					$sql_delete = "DELETE FROM food WHERE food_id='$food_id_delete' AND food.rest_id = '$admin_id'";
					$sql = "SELECT FROM food WHERE food_id='$food_id_delete' AND food.rest_id = '$admin_id'";


				$result = mysqli_query($conn, $sql);

					/*if (mysqli_num_rows($result) >0) {
				$itemArray = array('rest_id'=>$row["rest_id"]);
  				foreach($itemArray as $x => $id) {
  					echo " ".$id."<br>";

				}
			}*/


					if (mysqli_query($conn, $sql_delete) ) {
					  echo "Record deleted successfully";
					} else {
					  echo "Error deleting record! <br>";
					  echo("Error description: " . mysqli_error($conn));
					}
				}
			?>
		</div>
	</body>
</html>