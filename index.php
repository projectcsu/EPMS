<?php
include 'login.php'; 
if(isset($_SESSION['login_user'])){
header("location: home.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>EPMS - Login</title>

  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


  <link href="css/sb-admin.css" rel="stylesheet">
  <script type="text/javascript" src="sysTime.js"> </script>
</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Employee Payroll Management System - Login</div>
      <div class="card-body">
        <form action="login.php" method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="username" class="form-control"  required="required" autofocus="autofocus">
              <label for="username">Username</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="password" class="form-control"  required="required">
              <label for="password">Password</label>
            </div>
          </div>
          
          <input type="submit" class="btn btn-primary btn-block" value="Login" name="submit">
          <span><?php echo $_SESSION['error']; 
            unset($_SESSION['error']);
            
            ?></span>
        </form>
        
      </div>
    </div>
  </div>


  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
