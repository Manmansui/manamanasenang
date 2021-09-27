<?php
session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'mywebsite';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if ( !isset($_POST['userName'], $_POST['userPassword']) ) {

	exit('Please fill both the username and password fields!');
}



if ($stmt = $con->prepare('SELECT login_id, userPassword FROM Login WHERE userName = ?')) {

	$stmt->bind_param('s', $_POST['userName']);
	$stmt->execute();

	$stmt->store_result();
	
	if ($stmt->num_rows > 0) {
	$stmt->bind_result($login_id, $userPassword);
	$stmt->fetch();

			//if ($_POST['userPassword'] === $userPassword) {
			$userPassword = substr( $userPassword, 0, 60 );
			if (password_verify($_POST['userPassword'], $userPassword)) {
				session_regenerate_id();
				$_SESSION['loggedin'] = TRUE;
				$_SESSION['name'] = $_POST['userName'];
				$_SESSION['id'] = $login_id;
				header('Location: home.php');
			} else {
				// Incorrect password
				//echo 'Incorrect username and/or password!';
				//echo '<script type="text/JavaScript"> prompt("GeeksForGeeks");</script>';
				$string = 'ERROR 401: Incorrect username and/or password!\nClick OK to continue...';
				//alert('ERROR 401: Incorrect username and/or password!\nClick OK to continue...')
				
				echo "<SCRIPT> //not showing me this
					
					
					alert(\"$string\");
					window.location.replace('index.html');
				</SCRIPT>";


			}
	} else {
		// Incorrect username
		//echo 'Incorrect username and/or password!';
		//echo '<script type="text/javascript"> alert("Incorrect username and/or password!"); </script>';
		//header('location: index.html'); 'ERROR 404: Username not found!'
		
		$string = 'ERROR 404: Username not found!\nClick OK to continue...';
				//alert('ERROR 401: Incorrect username and/or password!\nClick OK to continue...')
				
				echo "<SCRIPT> //not showing me this
					
					
					alert(\"$string\");
					window.location.replace('index.html');
				</SCRIPT>";

	}

	$stmt->close();
}
?>
