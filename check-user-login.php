<?php

//To Handle Session Variables on This Page
session_start();

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");

//If user Actually clicked login button 
if(isset($_POST)) {

	//Escape Special Characters in String
	$mobile_number = mysqli_real_escape_string($conn, $_POST['mobile_number']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	//Encrypt Password
	$password = md5($password);

	//sql query to check company login
	$sql = "SELECT id_user, first_name, mobile_number, active_status FROM 
	
	user WHERE mobile_number='$mobile_number' AND password='$password'";
	$result = $conn->query($sql);

	//if company table has this this login details
	if($result->num_rows > 0) {
		//output data
		while($row = $result->fetch_assoc()) {

			if($row['active_status'] == '0') {
				$_SESSION['companyLoginError'] = "Your Account Is Still Pending Approval.";
				header("Location: login-user.php");
				exit();
			} else if($row['active_status'] == '1') {
				// active 1 means admin has approved account.
				//Set some session variables for easy reference
				$_SESSION['first_name'] = $row['first_name'];
				$_SESSION['id_user'] = $row['id_user'];

				//Redirect them to company dashboard once logged in successfully
				header("Location: user/index.php");
				exit();
			}
		}
 	} else {
 		//if no matching record found in user table then redirect them back to login page
 		$_SESSION['loginError'] = $conn->error;
 		header("Location: login-user.php");
		exit();
 	}

 	//Close database connection. Not compulsory but good practice.
 	$conn->close();

} else {
	//redirect them back to login page if they didn't click login button
	header("Location: login-user.php");
	exit();
}