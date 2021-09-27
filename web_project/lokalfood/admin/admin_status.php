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
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

<script language="javascript" type="text/javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
 if(popUpWin)
{
if(!popUpWin.closed) popUpWin.close();
}
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}

</script>
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
<h4 class="card-title">View user Orders</h4>
<!-- Page content row --> <table id="myTable" class="table table-bordered table-striped">
                                       
    <tbody>
    <?php
		$sql="SELECT * FROM order_line,order_invoice,customer WHERE order_invoice.order_id= '".$_GET['user_upd']."' AND order_invoice.cust_id = customer.cust_id";

		$query=mysqli_query($conn,$sql);

		$rows=mysqli_fetch_array($query);									
	?>
	<tr>
		<td><strong>username:</strong></td>
	    <td><center><?php echo $rows['cust_name']; ?></center></td>
		<td><center>
			<a href="javascript:void(0);" onClick="popUpWindow('order_update.php?form_id=<?php echo htmlentities($rows['order_id']);?>');" title="Update order">
			<button type="button" class="btn btn-primary">Take Action</button></a>
		</center></td>
	</tr>	
	<tr>
		<td><strong>Order Number:</strong></td>
		<td><center><?php echo $rows['order_id']; ?></center></td>
		<td><center>
		<a href="javascript:void(0);" onClick="popUpWindow('userprofile.php?newform_id=<?php echo htmlentities($rows['order_id']);?>');" title="Update order">
		<button type="button" class="btn btn-primary">View User Detials</button></a>
		</center></td>
	</tr>	
	<!--<tr>
		<td><strong>Quantity:</strong></td>
		<td><center><?php //echo $rows['food_qty']; ?></center></td>
	</tr>-->
	<tr>
		<td><strong>Price:</strong></td>
		<td><center>$<?php echo $rows['order_amt']; ?></center></td>
	</tr>
	<tr>
		<td><strong>Address:</strong></td>
		<td><center><?php echo $rows['cust_addr']; ?></center></td>
	</tr>
	<tr>
		<td><strong>Date:</strong></td>
		<td><center><?php echo $rows['order_datetime']; ?></center></td>
	</tr>
	<tr>
		<td><strong>status:</strong></td>
		<?php 
			$status=$rows['order_status'];
			if($status=="0" or $status=="NULL"){
		?>

		<td> <center><button type="button" class="btn btn-info" style="font-weight:bold;"><span class="fa fa-bars"  aria-hidden="true" >Dispatch</button></center></td>

		<?php 
			}

		if($status=="1"){ ?>
			<td>   <center><button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin"  aria-hidden="true" ></span>On The Way!</button></center></td> 
			<?php
		}
		if($status=="2"){?>
			<td>  <center><button type="button" class="btn btn-success" ><span  class="fa fa-check-circle" aria-hidden="true">Delivered</button></center></td> 
			<?php 
		}?>
		<?php
		if($status=="3"){?>
			<td>  <center><button type="button" class="btn btn-danger"> <i class="fa fa-close"></i>cancelled</button> </center></td> <?php 
			}?>
		</tr>
	</tbody>
</table>
</body>
</html>