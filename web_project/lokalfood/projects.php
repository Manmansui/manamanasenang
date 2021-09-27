<?php
session_start();
include("include/config.php");
if(!isset($_SESSION["UID"])){
	header("location:login.php");	
}
else {
	$cust_id = $_SESSION["UID"];
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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
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

		<?php



			$sql = "SELECT * FROM order_invoice,customer WHERE  $cust_id = order_invoice.cust_id AND order_invoice.cust_id = customer.cust_id";

			$result = mysqli_query($conn, $sql);



		?>
		<br>
			<table class = " table table-bordered table-striped row " style="width:100%;">
				<thead>
				<tr>
					<th><center>Customer Name</center></th>
					<th><center>Order ID</center></th>
					<th><center>Order Date</center></th>
					<th><center>Status</center></th>
					<th><center>Total</center></th>
					<th><center>Action</center></th>
					<th><center>Review</center></th>
					<th><center>Detail</center></th>
				</tr>
				</thead>

			<tbody style = "text-align: center">
				<?php 
						// displaying current session user login orders 
						$query_res= mysqli_query($conn,$sql);
												if(!mysqli_num_rows($query_res) > 0 )
														{
															echo '<td colspan="6"><center>You have No orders Placed yet. </center></td>';
														}
													else
														{			      
										  
										  while($row=mysqli_fetch_array($query_res))
										  {
						
							?>
												<tr>	
														 <td data-column="Customer Name"> <?php echo $row['cust_name']; ?></td>
														  <td data-column="Order ID"> <?php echo $row['order_id']; ?></td>
														  <td data-column="Order Date">$<?php echo $row['order_datetime']; ?></td>
														   <td data-column="Status"> 
														   <?php 
																			$status=$row['order_status'];
																			if($status=="0" or $status=="NULL")
																			{
																			?>
																			<button type="button" class="btn btn-info" style="font-weight:bold;">Pending</button>
																		   <?php 
																			  }
																			   if($status=="1")
																			 { ?>
																				<button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin"  aria-hidden="true" ></span>Processing</button>
																			<?php
																				}
																			if($status=="2")
																				{
																			?>
																			 <button type="button" class="btn btn-success" ><span  class="fa fa-check-circle" aria-hidden="true">Delivered</button> 
																			<?php 
																			} 
																			?>
																			<?php
																			if($status=="3")
																				{
																			?>
																			 <button type="button" class="btn btn-danger"> <i class="fa fa-close"></i>cancelled</button>
																			<?php 
																			} 
																			?>
														   
														   
														   
														   
														   
														   
														   </td>
														  <td data-column="Total"> <?php echo $row['order_amt']; ?></td>

														   <td data-column="Action"> <a href="delete_orders.php?order_del=<?php echo $row['order_id'];?>" onclick="return confirm('Are you sure you want to cancel your order?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
															</td>

															<td	data-column="Review"> <a href="review.php?order_del= <?php echo $row['order_id'];?>" onclick="return confirm('Are you sure you want to give review?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-cloud" style="font-size:16px"></i></a> 
															</td>

															<td	data-column="Detail"> <a href="my_order.php?order_id= <?php echo $row['order_id'];?>" onclick="return confirm('Are you sure you want to view order detail?');" class="btn btn-info btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-eye" style="font-size:16px"></i></a> 
															</td>
														 
												</tr>
												
											
														<?php }} ?>					
							
							
										
						
						  </tbody>


		<br>

	</body>
</html>

