<?php
session_start();

unset($_SESSION['AID']);
unset($_SESSION["admin_user"]);
header("location: ../index.php");
exit();

?>