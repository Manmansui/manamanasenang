<?php
// Change this to your connection info.

session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'mywebsite';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {

	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if (!isset($_POST['userRating'], $_POST['userReview'])) {
	exit('Please complete the registration form!');
}

if (empty($_POST['userRating']) || empty($_POST['userReview'])) {
	exit('Please complete the registration form');
}



//check existing username
$user_id = $_SESSION['id'];

if (!empty($_POST['userRecommend'])) {
	$user_recommend = $_POST['userRecommend'];
}else{
	$user_recommend = 'No';
}

if ($stmt = $con->prepare('INSERT INTO review (rating, review, recommend, User_id) VALUES (?, ?, ?, ?)')) {

	$stmt->bind_param('sssi', $_POST['userRating'], $_POST['userReview'], $user_recommend, $user_id);
	$stmt->execute();
	//echo 'Success insert..';
	//echo $_SESSION['id'];
	
	
	header('location: reviewform.html');
	exit;
	
	//echo '<script type="text/JavaScript"> alert("Review submitted!"); </script>';
	
	$stmt->close();
	
} else {

	echo 'Could not prepare statement!';
}


$con->close();
?>