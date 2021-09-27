<!DOCTYPE html>
<html lang="en">
<?php
include("include/config.php");
error_reporting(0);
session_start();
//unset ($_SESSION["UID"]);
?>

<head>
	<title>mylokalFood</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/w3.css">
	<link rel="stylesheet" type="text/css" href="css/mystyle.css">
	<!-- Load font and icon library -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link type="text/css" href="css/helper.css" rel="stylesheet">
	<link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
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

	<table id="myTable" class="table table-bordered table-striped">
         <thead>
          	<tr>
                <th>Username</th>	
                <th>Order ID</th>
                <th>price</th>
				<th>Address</th>
				<th>status</th>
				<th>Date</th>
				<th>Action</th>
			</tr>
        </thead>
        <tbody>
                                           
			<?php
				$sql = "SELECT * FROM order_invoice,customer WHERE  order_invoice.cust_id = customer.cust_id";

				$query=mysqli_query($conn,$sql);

				if(!mysqli_num_rows($query) > 0 ){
					echo '<td colspan="8"><center>No Orders-Data!</center></td>';
				}
				else{				
					while($rows=mysqli_fetch_array($query)){
				?>
				<?php
					echo ' <tr>
						<td>'.$rows["cust_name"].'</td>
						<td>'.$rows['order_id'].'</td>
						<td>$'.$rows['order_amt'].'</td>;'?>
						<!--<td>'.$rows['address'].'</td>;

				?>--><td>
				<?php 
					$status=$rows['order_status'];
					if($status=="0" or $status=="NULL"){
				?>

				<td> <button type="button" class="btn btn-info" style="font-weight:bold;"><span class="fa fa-bars"  aria-hidden="true" >Dispatch</button></td>
				<?php 
					 }
				if($status=="1"){ 
				?>
					<td> <button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin"  aria-hidden="true" ></span>On a Way!</button></td> 

				<?php
				}
				if($status=="2"){
				?>

				<td> <button type="button" class="btn btn-success" ><span  class="fa fa-check-circle" aria-hidden="true">Delivered</button></td> 

				<?php 
				} 
				?>

				<?php
					if($status=="3"){
				?>
						<td> <button type="button" class="btn btn-danger"> <i class="fa fa-close"></i>cancelled</button></td> 
					<?php 
					} 
					?>

					<?php		

						echo '	<td>'.$rows['order_datetime'].'</td>';
					?>
						<td>
							<a href="delete_orders.php?order_del=<?php echo $rows['order_id'];?>" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px; "></i></a> 
					<?php
							echo '<a href="view_order.php?user_upd='.$rows['o_id'].'" " class="btn btn-info btn-flat fa fa-cog btn-sm m-b-10 m-l-5"><i class="ti-settings"></i></a>
							</td>
						</tr>';
							//echo '<a href="admin_status.php?user_upd='.$rows['order_id'].'" " class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-settings"></i></a>
						//</td>
					//</tr>';
					}	
				}
					?>
				
                 </tbody>

</body>
</html>
