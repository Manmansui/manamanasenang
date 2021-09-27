<?php
include("include/config.php"); //connection to db
error_reporting(0);
session_start();


// sending query
//mysqli_query($conn,"DELETE order_invoice, order_line FROM order_line WHERE order_line = '".$_GET['order_del']."'" AND order_line = $_SESSION['UID'}); 
mysqli_query($conn,"DELETE  FROM order_line WHERE order_id = '".$_GET['order_del']."'"); // deletig records on the bases of ID
mysqli_query($conn,"DELETE  FROM order_invoice WHERE order_id = '".$_GET['order_del']."'");
header("location:projects.php");  //once deleted success redireted back to current page

?>
