<?php

//To Handle Session Variables on This Page
session_start();

//Expire the session if user is inactive for 30
//minutes or more.
$expireAfter = 1;
 


	include_once("Location: verifyotp.php");




//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");

//if(isset($_GET['id']) && $_GET['id'] !== ''){
  $mobile_number = $_GET['id'];
  
//} 


//If user Actually clicked login button 
if(isset($_POST)) {

	//Escape Special Characters in String
	$otp = mysqli_real_escape_string($conn, $_POST['otp']);
    
	
	//sql query to check company login
	$sql = "SELECT id_user, otp FROM user WHERE md5(mobile_number) = '$mobile_number' AND otp = '$otp' ";
	$result = $conn->query($sql);

	//if company table has this this login details
	if($result->num_rows > 0) {
		//output data
		while($row = $result->fetch_assoc()) {

            $sql = "UPDATE user SET active_status = '1' WHERE md5(mobile_number) = '$mobile_number'";
            $result = $conn->query($sql);
			header("Location: login-user.php");
			exit();
		}
	}
 	else { 
		$_SESSION['OTPError'] = true;
		header('Location:verifyotp.php?id='.$mobile_number);
		exit();
	
 	}

 	//Close database connection. Not compulsory but good practice.
 	$conn->close();

}
 
 else {
	//redirect them back to login page if they didn't click login button
	header("Location: login-user.php");
	exit();
}