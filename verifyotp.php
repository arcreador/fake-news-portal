<?php
  session_start(); 
  $mobile_number = $_GET['id']; 

if(isset($_SESSION['id_user'])) { 
  header("Location: ../index.php");
  exit();
}


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Fake News Portal</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>Fake News</b> Portal</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
  <p> Please Do Not Refresh The Page Or Press Back Button</p>
  <br><br>
    <form method="post" action="checkotp.php?id=<?php echo $_GET['id']; ?>">
      <div class="form-group has-feedback">
        <input type="text" name="otp" class="form-control" placeholder="Enter OTP" require>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
        <!-- /.col -->
        <div class="">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Verify OTP</button>
        </div>
        <!-- /.col -->
        <div class="col-xs-12">
          <?php 
                //If Company have successfully registered then show them this success message
                //Todo: Remove Success Message without reload?
                if(isset($_SESSION['OTPVerified'])) {
                  ?>
                  <div>
                    <br> <br>
                    <p class="text-center">OTP Verified Successfully! Your Account Has Been Activated.</p>
                  </div>
                <?php
                 unset($_SESSION['OTPVerified']); }
               ?>   
              <?php 
                //If Company Failed To log in then show error message.
                if(isset($_SESSION['OTPError'])) {
              ?>
                <div>
                  <br> <br>
                    <p class="text-center">Invalid OTP, Try Again!</p>
                </div>
              <?php
               unset($_SESSION['OTPError']); }
              ?>   
          </div>          
      </div>
      <div>seesion closes in <span id="time">05:00</span></div>
      <form id="form1" runat="server">

    </form>

    <br>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
<!-- iCheck -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>

<script>
    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        var end =setInterval(function () {
            minutes = parseInt(timer / 60, 10)
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                window.location = "http://localhost/fake_news/index.php";
                clearInterval(end);
            }
        }, 1000);
    }

    window.onload = function () {
        var fiveMinutes = 30,
            display = document.querySelector('#time');
        startTimer(fiveMinutes, display);
    };
</script>
</body>
</html>
