<?php

//To Handle Session Variables on This Page
session_start();

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");

//If user clicked register button
if(isset($_POST)) {

	//Escape Special Characters In String First
	$first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
	$last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$mobile_number = mysqli_real_escape_string($conn, $_POST['mobile_number']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	$country = mysqli_real_escape_string($conn, $_POST['country']);
	$state = mysqli_real_escape_string($conn, $_POST['state']);
	$city = mysqli_real_escape_string($conn, $_POST['city']);

	$active_status = '0';

	//Your message to send, Add URL encoding here.
	$otp=rand(10000, 99999);

	//Encrypt Password & OTP
	$password = md5($password);
	//$otp= md5($otp);

	$mno = md5($mobile_number);

	//sql query to check if email already exists or not
	$sql = "SELECT mobile_number FROM user WHERE mobile_number='$mobile_number'";
	$result = $conn->query($sql);

	//if email not found then we can insert new data
	if($result->num_rows == 0) {



		//sql new registration insert query
		$sql = "INSERT INTO user(first_name, last_name, email, mobile_number, password, country, state, city,account_type, otp, active_status) VALUES ('$first_name','$last_name', '$email', '$mobile_number', '$password', '$country', '$state', '$city', '$account_type', '$otp', '$active_status')";

		if($conn->query($sql)===TRUE) {

			//If data inserted successfully then Set some session variables for easy reference and redirect to company login
			$_SESSION['registerCompleted'] = true;
			header('Location:verifyotp.php?id='.$mno);
			exit();

		} else {
			//If data failed to insert then show that error. Note: This condition should not come unless we as a developer make mistake or someone tries to hack their way in and mess up :D
			echo "Error " . $sql . "<br>" . $conn->error;
		}
	} else {
		//if email found in database then show email already exists error.
		$_SESSION['registerError'] = true;
		header("Location: register-user.php");
		exit();
	}

	//Close database connection. Not compulsory but good practice.
	$conn->close();

} else {
	//redirect them back to register page if they didn't click register button
	header("Location: register-user.php");
	exit();
}