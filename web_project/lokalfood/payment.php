<?php
session_start();
include("include/config.php");

if(!isset($_SESSION["UID"])){
		
		echo "Please Login First";

	}
	else {
		
		$customer_ID= $_SESSION["UID"];
		$total_pay =$_SESSION["total_all_price"];

		$sql = "INSERT INTO order_invoice (order_datetime, 			order_status, order_amt, cust_id)
				VALUES (now(), 0, '$total_pay', '$customer_ID')";

			if (mysqli_query($conn, $sql)) {
				echo "New record created successfully";

			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		$order_id = mysqli_insert_id($conn);
		foreach ($_SESSION["cart_item"] as $item) {
			$food_id = $item["prodID"];
			$food_qty = $item["quantity"];

		$sql2 = "INSERT INTO order_line (order_id, food_id,	food_qty)
				VALUES ($order_id, $food_id, $food_qty)";
		if (mysqli_query($conn, $sql2)) {
				echo "New record created successfully Second";

			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}
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
<!-- Page content row -->
<div class="row">
<?php
include("include/sideNav.php");
?>
<br><br>

<style type="text/css">

.checkout_table{
  border-collapse: collapse;
  width:25em;
  background-color: #5E6BB5;
  border-radius:5px;
  box-shadow: 0px 10px 30px rgba(0,0,0,.15);
  margin: 30px auto;
}
 .checkout_table thead tr{
  border-bottom:1px dashed grey;
 }

 .checkout_table tfoot tr{
  border-top:1px dashed grey;
 }

.checkout_table thead tr td{
  font-size:16px;
  letter-spacing:1px;
  color:grey;
  padding:8px;
 }

 .checkout_table tfoot tr td{
  font-size:18px;
  letter-spacing:1px;
  color:green;
  padding:8px;
 }

  .checkout_table tbody tr td{
  padding:8px;
  text-align: center;
 }
 .checkout_table thead tr td:nth-last-child(1),
 .checkout_table tbody tr td:nth-last-child(1),
 .checkout_table tfoot tr td:nth-last-child(1){
  text-align: center;
 }

 .checkout_table tr:nth-child(even) {
  background-color: #eee;
}
.checkout_table tr:nth-child(odd) {
  background-color: #fff;

  }
  h1{
  	text-align: center;
  	font-size:50px;
  	color: #5E6BB5;
  	font-family:'Courier New';
  }
}

</style>

<h1>lokalfood Receipt</h1>

<table class="checkout_table">
	<thead>
  <tr>
    <th>  Order #<?php echo $order_id?></th>
    <th>Quantity </th>
    <th>Cost</th>
  </tr>
  </thead>

 	<tbody>

<?php
foreach ($_SESSION["cart_item"] as $item){
$item_price = $item["price"];
?>
	
  <tr>
  	<td><?php echo $item["name"];?></td>
    <td><?php echo $item["quantity"]; ?></td>
    <td><?php echo number_format($item_price,2); ?></td>
  </tr>
  <?php
 }?>

 	<tr>
 		<td>
 			Delivery Fee
 		</td>

 		<td>
 			
 		</td>
 		<td>
 			5.00
 		</td>
 	</tr>
 </tbody>

 <tfoot>
 	<tr>
 		<td colspan="2" align = "right">
 			Total:
 		</td>
 
 		<td>
 			<?php
 				echo number_format($total_pay + 5.00,2)
 			?>
 		</td>
 	</tr>
 	</tfoot>
</table>
</div>

</body>
</html>

