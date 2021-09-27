<?php
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'mywebsite';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {

	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if (!isset($_POST['firstname'], $_POST['lastname'], $_POST['userName'], $_POST['userPassword'], $_POST['userEmail'])) {
	exit('Please complete the registration form!');
}

if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['userName']) || empty($_POST['userPassword']) || empty($_POST['userEmail'])) {
	exit('Please complete the registration form');
}// already done with input required

//check existing username
if ($stmt = $con->prepare('SELECT login_id, userPassword FROM login WHERE userName = ?')) {

	$stmt->bind_param('s', $_POST['userName']);
	$stmt->execute();
	$stmt->store_result();

	if ($stmt->num_rows > 0) {
		$string = 'Username already exist!\nPlease try again...';
				//alert('ERROR 401: Incorrect username and/or password!\nClick OK to continue...')
				
				echo "<SCRIPT> //not showing me this
					alert(\"$string\");
					window.location.replace('SignUp.html');
				</SCRIPT>";
	} else {
		//insert into user then....
		if ($stmt = $con->prepare('INSERT INTO user (FirstName, LastName, User_email) VALUES (?, ?, ?)')) {
			$stmt->bind_param('sss', $_POST['firstname'], $_POST['lastname'], $_POST['userEmail']);
			$stmt->execute();
			echo 'registered stage 1!';
			
			$userID = mysqli_insert_id($con);
			//insert into login
			if ($stmt = $con->prepare('INSERT INTO login (UserName, UserPassword, User_id) VALUES (?, ?, ?)')) {
				$password = password_hash($_POST['userPassword'], PASSWORD_DEFAULT);
				$stmt->bind_param('sss', $_POST['userName'], $password, $userID);
				$stmt->execute();
				header("Location: index.html");
				exit;
			} else {

				echo 'Could not prepare statement!';
			}
			
		} else {
			// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
			echo 'Could not prepare statement!';
		}
	}
	$stmt->close();
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
$con->close();
?>