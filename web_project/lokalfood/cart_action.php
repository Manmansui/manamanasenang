<?php
session_start();
include("include/config.php");

if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$food_id = $_GET["id"];
			
			$sql = "SELECT * FROM food WHERE food_id = '$food_id'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);
			$pid = "pid".$row["food_id"];
			
			$itemArray = array(
				$pid=>array ('name'=>$row["food_name"], 'img'=>$row["food_img"], 'prodID'=>$row["food_id"], 'quantity'=>$_POST["quantity"], 'price'=>$row["food_price"], 'restaurant'=>$row["rest_id"]));
								
			if(!empty($_SESSION["cart_item"])) {				
				if(in_array($pid,array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($pid == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}								
							}
					}
				} else {					
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);					
				}
			} else {				
				$_SESSION["cart_item"] = $itemArray;
			}						
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if("pid".$_GET["prodID"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "edit":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if("pid".$_GET["id"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
		if(!empty($_POST["quantity"])) {
			$food_id = $_GET["id"];
			
			$sql = "SELECT * FROM food WHERE food_id = '$food_id'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);
			$pid = "pid".$row["food_id"];
			
			$itemArray = array(
				$pid=>array ('name'=>$row["food_name"], 'img'=>$row["food_img"], 'prodID'=>$row["food_id"], 'quantity'=>$_POST["quantity"], 'price'=>$row["food_price"], 'restaurant'=>$row["rest_id"]));
								
			if(!empty($_SESSION["cart_item"])) {				
				if(in_array($pid,array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($pid == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}								
							}
					}
				} else {					
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);					
				}
			} else {				
				$_SESSION["cart_item"] = $itemArray;
			}						
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
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
//include("include/sideNav.php");
?>
<body>
<div class="row">
<p style="margin: 15px;"><i class="fa fa-shopping-cart" style="font-size:24px"></i> / My Cart</p>

<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table cellpadding="10" cellspacing="1" id="carttable" width="60%" style="margin: 0 10px 0 10px;">
<tbody>
<tr id="carttable tr">
	<th style="padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #909090; color: white;">Item</th>
	<th style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #909090; color: white;">Code</th>
	<th style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #909090; color: white;" width="15%">Quantity</th>
	<th style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #909090; color: white;" width="15%">Unit Price (RM)</th>
	<th style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #909090; color: white;" width="15%">Price (RM)</th>
	<th style="padding-top: 12px; padding-bottom: 12px; text-align: center; background-color: #909090; color: white;" width="15%">Delete</th>
</tr>	

<?php		
foreach ($_SESSION["cart_item"] as $item){
	$item_price = $item["quantity"]*$item["price"];
	?>
	<tr>
	<td id="#carttable td" style="text-align:left;"><?php echo $item["name"];?></td>				
	<td id="#carttable td" style="text-align:center;"><?php echo $item["prodID"]; ?></td>
	<td id="#carttable td" style="text-align:center;">
	<form method="post" action="cart_action.php?action=edit&id=<?php echo $item["prodID"]; ?>">
		<input style ="width:20%"; type="text" name="quantity" value=<?php echo $item["quantity"]?> size="2" />
		<button type="submit"><i class="fa fa-pencil" style="font-size:20px"></i> Edit</button>
	</form></td>
	<td id="#carttable td" style="text-align:center;"><?php echo $item["price"]; ?></td>
	<td id="#carttable td" style="text-align:center;"><?php echo number_format($item_price,2); ?></td>
	<td id="#carttable td" style="text-align:center;"><a href="cart_action.php?action=remove&prodID=<?php echo $item["prodID"]; ?>"><i class="fa fa-times-circle" ></i> Remove</a></td>
	</tr>
	<?php
	$total_quantity += $item["quantity"];
	$total_price += ($item["price"]*$item["quantity"]);
	$_SESSION["AmountPay"] = $total_price;
	}
	?>

<tr>
<td colspan="3" align="right"><b>Total:</b></td>
<td style="text-align:center;"><?php echo $total_quantity; ?></td>
<td style="text-align:center;" ><strong><?php echo "RM ".number_format($total_price, 2); ?></strong></td>
<td style="text-align:center;" colspan="2"><button type="submit"><a href="checkout.php">Checkout</button></td>
</tr>
</tbody>
</table>	
<div class="empty_shopping">
<div class="column left"> 
<p style="margin: 15px;"><a href="index.php"><i class="fa fa-shopping-cart" style="font-size:24px"></i> Back to Shopping</a></p>
</div>
<div class="column right">
<p style="margin: 15px;"><a href="cart_action.php?action=empty"><i class="fa fa-trash" style="font-size:24px"></i> Empty Cart</a></p>
</div>

</div>
<?php
} else {
?>
<p style="margin: 15px;">Your Cart is Empty</p>  
<?php 
}
?>
</div>


</body>
</html>