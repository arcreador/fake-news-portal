<?php
ob_start();
session_start();
require_once("db.php");

// if session is set direct to index
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['btn-login'])) {
    $email = $_POST['email'];
    $upass = $_POST['password'];

    $password = md5($upass); // password hashing using SHA256
    $stmt = $conn->prepare("SELECT id_user, email, password FROM admin WHERE email= ?");
    $stmt->bind_param("s", $email);
    /* execute query */
    $stmt->execute();
    //get result
    $res = $stmt->get_result();
    $stmt->close();

    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

    $count = $res->num_rows;
    if ($count == 1 && $row['password'] == $password) {
        $_SESSION['user'] = $row['id_user'];
        header("Location: index.php");
    } elseif ($count == 1) {
        $errMSG = "Invalid password";
    } else $errMSG = "User not found";
}
?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Fake News Portal</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Pooled Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="css/jquery-ui.css"> 
<!-- jQuery -->
<script src="js/jquery-2.1.4.min.js"></script>
<!-- //jQuery -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
</head> 
<body>
	<div class="main-wthree">
	<div class="container">
	<div class="sin-w3-agile">
		<h2>FAKE NEWS PORTAL<br><br>Sign In</h2>
		<form method="post" autocomplete="off">
			
			<?php
                if (isset($errMSG)) {

                    ?>
                        <div class="alert alert-danger">
                             <?php echo $errMSG; ?>
                        </div>
                    <?php
                }
                ?>

			<div class="username">
				<span class="username">Email:</span>
				<input type="text" name="email" class="password" placeholder="" required="">
				<div class="clearfix"></div>
			</div>
			
			<div class="password-agileits">
				<span class="username">Password:</span>
				<input type="password" name="password" class="password" placeholder="" required="">
				<div class="clearfix"></div>
			</div>
			<!-- <div class="rem-for-agile">
				<input type="checkbox" name="remember" class="remember">Remember me<br>
				<a href="#">Forgot Password</a><br>
			</div> -->
			<div class="login-w3">
					<input type="submit" name="btn-login" class="login" value="Sign In">
			</div>
			<div class="clearfix"></div>
		</form>
				<!-- <div class="back">
					<a href="index.php">Back to home</a>
				</div>
				 --><div class="footer">
					<p>© 2018 State Election Commission, Rajasthan<br>Developed By - <a href="https://github.com/arcreador" target="_blank">code-bosster</a></p>
				</div>
	</div>
	</div>
	</div>
</body>
</html>