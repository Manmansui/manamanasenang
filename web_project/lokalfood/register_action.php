<?php
session_start();
include("include/config.php");
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

<?php
//========================================================================
function validateInput($data, $fieldName) {
    global $errorCount;
	if (empty($data)) {
		displayRequired($fieldName);
		++$errorCount;
		$retval = "";
	} else { // Only clean up the input if it isn't empty
		
		//email validation		
		if($fieldName == "Guest Email"){
			if (!filter_var($data, FILTER_VALIDATE_EMAIL)){
					$errorCount++;
					echo("$data is not a valid email address <br />");
			}
		}
		
		/*//password validation - length at least 8
		if($fieldName == "Password"){
			echo "Password is $data, Length =" . strlen($data) . " <br />";
		}*/
	
		$retval = trim($data);
		$retval = stripslashes($retval);
	}
	return($retval);
}

function displayRequired($fieldName) {
     echo "The field \"$fieldName\" is required.<br />\n";
}

//============================================================================
//Step 1: Input validation
$errorCount = 0;
$cust_name = validateInput($_POST['custName'], "Name"); 
$cust_email = validateInput($_POST['custEmail'], "Email"); 
$cust_pwd = validateInput($_POST['custPwd'], "Password");
$cust_addr = $_POST['custadress'];

if ($errorCount>0) {
     echo "Please use the \"Back\" button to re-enter the 
          data.<br />\n";		  
}
else {
    //validation ok
	//echo "<p>Thank you for filling out the registration form, <b>".$cust_name."</b>. <br /></br></p>";
	
//STEP 2: Check if user already exist
	$sql = "SELECT * FROM customer WHERE cust_email='$cust_email' AND cust_pwd='$cust_pwd' LIMIT 1";	
	$result = mysqli_query($conn, $sql);
	
	if (mysqli_num_rows($result) == 1) {
		echo "<p ><b>Error:</b> Customer Exist, cannot register</p>";		
	} else {
		// User does not exist, insert new user record, hash the password		
		$pwdHash = trim(password_hash($_POST['custPwd'], PASSWORD_DEFAULT)); 
		//echo $pwdHash;
		$sql = "INSERT INTO customer (cust_name,cust_addr, cust_email, cust_pwd, pwdHash )
		VALUES ('" . $cust_name . "','" . $cust_addr . "','" . $cust_email . "','" . $cust_pwd . "', '$pwdHash')";
		
		if (mysqli_query($conn, $sql)) {
			echo "<p>New customer record created successfully. Welcome <b>".$cust_name."</b></p>";			
		} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}	
	}
}
mysqli_close($conn);
?>
<p><a href="login.php">Please login to continue</a></p>
</body>
</html>