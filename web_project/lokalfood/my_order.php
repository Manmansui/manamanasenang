<?php
session_start();
include("include/config.php");
//check login
if(!isset($_SESSION["UID"])){
	header("location:login.php");	
}
else {
	$cust_id = $_SESSION["UID"];
	$current_id = $_GET["order_id"];
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
<p style="margin: 15px;"><i class="fa fa-shopping-cart" style="font-size:24px"></i> / My Order</p>

<?php
$sql = "SELECT * FROM order_invoice WHERE cust_id = '$cust_id' AND order_id = $current_id ORDER BY order_id DESC";
$result1 = mysqli_query($conn, $sql);	
	if (mysqli_num_rows($result1) > 0) {	
	while($row1 = mysqli_fetch_assoc($result1)) {			
?>
	<p></p>
	<table cellpadding="10" cellspacing="1" id="carttable" width="60%" style="margin: 0 10px 0 10px;">
		<tr id="carttable tr">
		<th style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #824554; color: white;" width="15%">Order ID</th>
		<th style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #824554; color: white;" width="15%">Order Date Time</th>
		<th style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #824554; color: white;" width="15%">Order Status</th>
		<th style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #824554; color: white;" width="15%">Order Amount (RM)</th>
		</tr>
		<tr>
		<td id="#carttable td" style="text-align:center;"><?php echo $row1["order_id"];?></td>		
		<td id="#carttable td" style="text-align:center;"><?php echo date("d/m/Y",strtotime($row1["order_datetime"]));?></td>
		<td id="#carttable td" style="text-align:center;"><?php echo $row1["order_status"]; ?></td>
		<td id="#carttable td" style="text-align:center;"><?php echo number_format($row1["order_amt"],2); ?></td>
		</tr>
		<tr></tr>
	</table>
	
<?php
	$sql2 = "SELECT food.food_id, food.food_name, order_line.food_qty, food.food_price
	FROM order_line, food WHERE
	order_line.food_id = food.food_id AND order_line.order_id = '" . $row1["order_id"] ."'";
	
	$result2 = mysqli_query($conn, $sql2);
	if (mysqli_num_rows($result2) > 0) {
	$itemNum = 0;	
?>		
	<table cellpadding="10" cellspacing="1" id="carttable" width="60%" style="margin: 0 10px 0 10px;">
	<tbody>
	<tr id="carttable tr">
	<th style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #909090; color: white;" width="15%">Item #</th>
	<th style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #909090; color: white;" width="15%">Item Name</th>
	<th style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #909090; color: white;" width="15%">Quantity</th>
	<th style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #909090; color: white;" width="15%">Price</th>	
	</tr>	
	<?php	
		while($row2 = mysqli_fetch_assoc($result2)) {	
		$itemNum++;
		//see if item has been reviewed
		$query = "SELECT review_id FROM food_review WHERE order_id = '" . $row1["order_id"] ."' AND food_id ='" . $row2["food_id"] ."'";
		
		$review = mysqli_query($conn, $query);
		if (mysqli_num_rows($review) > 0) {
			$reviewFlag = "Y";
		}
		else {
			$reviewFlag = "N";
		}
	?>		
	<tr>
		<td id="#carttable td" style="text-align:center;"><?php echo $itemNum ?></td>
		<td id="#carttable td" style="text-align:center;"><?php echo $row2["food_name"]; ?></td>
		<td id="#carttable td" style="text-align:center;"><?php echo $row2["food_qty"]; ?></td>
		<td id="#carttable td" style="text-align:center;"><?php echo number_format($row2["food_price"] *$row2["food_qty"],2) ; ?>
		<?php 
		if ($reviewFlag == "Y"){
			
		}
		else {
			echo '<a href="review.php?food-id=' . $row2["food_id"] . '&order-id='. $row1["order_id"]. '&food-name='. $row2["food_name"].'">' . ' </a>';
		}
		?>
		
		</td>	
	</tr>
		<?php
		}//end while child
	echo "</tbody></table>";
		mysqli_free_result($result2);
		}//end if child
	} //end while parent
mysqli_free_result($result1);	
}//end if parent 
else {
?>
<p style="margin: 15px;">Your Order is Empty</p>
<?php 
}
mysqli_close($conn);
?>

</div>
</body>
</html>