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
include("include/adminNav.php");
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
$username = validateInput($_POST['admin_username'], "Name"); 
$password = validateInput($_POST['adminPwd'], "Password");

if ($errorCount>0) {
     echo "Please use the \"Back\" button to re-enter the 
          data.<br />\n";		  
}
else {
    //validation ok
	//echo "<p>Thank you for filling out the registration form, <b>".$username."</b>. <br /></br></p>";
	
//STEP 2: Check if admin already exist
	$sql = "SELECT * FROM admin WHERE admin_username ='$username' LIMIT 1";
	$result = mysqli_query($conn, $sql);
	
	if (mysqli_num_rows($result) == 1) {
		echo "<p ><b>Error:</b> Admin Exist, cannot register</p>";		
	} else {
		// Admin does not exist, insert new admin record, hash the password		
		$pwdHash = trim(password_hash($_POST['adminPwd'], PASSWORD_DEFAULT)); 
		//echo $pwdHash;
		$sql = "INSERT INTO admin (admin_username, admin_Pwd )
		VALUES ('" . $username . "','" . $password . "')";
		
		if (mysqli_query($conn, $sql)) {
			echo "<p>New admin record created successfully. Welcome <b>".$username."</b></p>";			
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