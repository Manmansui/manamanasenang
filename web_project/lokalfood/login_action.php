<?php
session_start();
include("include/config.php");
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
<h2>Login Information</h2>
<?php
//login values from login form
$username = $_POST['custEmail']; 
$password = $_POST['custPwd'];

$sql = "SELECT * FROM customer WHERE cust_email='$username' LIMIT 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {	
	//check password hash
	$row = mysqli_fetch_assoc($result);
	if (password_verify($_POST['custPwd'],$row['pwdHash'])) {
        //echo 'Pwd Verified'; // password_verify success!
		echo "Login success. <br> Thank you for filling out the login form, <b>".$username."</b>.<br /><br />";		
		$_SESSION["UID"] = $row["cust_id"];//the first record set, bind to userID
		$_SESSION["userName"] = $row["cust_name"];
		header("location:index.php"); 
    } else {
    echo 'Login error, username or password is incorrect.';
	echo $row['pwdHash'];
	
    }
		
} else {
		echo "Login error, username does not exist.";
} 

mysqli_close($conn);
?>
</body>
</html>