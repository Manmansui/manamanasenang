<?php
include("include/config.php");
error_reporting(0);
session_start();


// sending query
mysqli_query($conn,"DELETE  FROM order_line WHERE order_id = '".$_GET['order_del']."'"); // deletig records on the bases of ID
mysqli_query($conn,"DELETE  FROM order_invoice WHERE order_id = '".$_GET['order_del']."'");
header("location:all_orders.php");  

?>
