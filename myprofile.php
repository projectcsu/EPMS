<?php
include 'login.php';
require 'mysql.php';


if(!isset($_SESSION['login_user'])){
  header("location: index.php");
  }

  if($_SESSION['userType']=="Accountant")
  {
    $hideattr="hidden";
  }
  
  $username= $_SESSION['userid'];
  $sql="select * from tbl_User where userId='$username' ";
  $result=mysqli_query($conn,$sql);
  $row=mysqli_fetch_array($result);


?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>EPMS</title>

 
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="customstyle.css" rel="stylesheet" type="text/css">
 
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <link href="css/sb-admin.css" rel="stylesheet">
  <script type="text/javascript" src="formulas.js"> </script>
  <script>
    function revealPass(){
    var x = document.getElementById("userPwd");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  
  }
    
</script>
<script type="text/javascript" src="sysTime.js"> </script>
</head>

<body id="page-top" onload="startTime()" >
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
            <a class="navbar-brand" href="">
          <img src="brandicon.png" width="150" height="60" >
          Employee Payroll Management System</a>
            </li>
        </ul>
    </div>
    <div class="mx-auto order-0">
        <a class="navbar-nav ml-auto" ></a>
      
            <span class="navbar-brand" id="time"></span>
</div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
    <ul class="navbar-nav ml-auto">
    <li class="nav-item ">
            <a class="nav-link" href="javascript:lastPage('homeurl');">Home</a>
            </li>
            <li class="nav-item active">
            <a class="nav-link" href="myprofile.php">My Profile</a>
   
            </li>
            <li class="nav-item" <?php echo $hideattr ?>>
          <a class="nav-link" href="javascript:lastPage('settings');">Settings</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout </a>
            </li>
        </ul>
    </div>
</nav>


  <div id="wrapper">

  
    

    <div id="content-wrapper">

      <div class="container-fluid">
      

       
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <span style="font-weight: bold;">Welcome <?php echo
              $_SESSION['login_user'];
              ?> !</span>
          </li>
        </ol>
        
      

        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
           My Details</div>
          <div class="card-body">
            <div class="table-responsive">
              <div style="padding-top:20px">
                <form name="profile" method="post" action="updateProfile.php">
                  <table >
               <tr >
                
               <td><label>My ID</label></td>
               <td><input type="text" name="userId" readonly value="<?php echo $row['userId'] ?>"> </td>
                </tr>
                <tr>
                <td ><label>User Name</label></td>
                <td ><input type="text" name="username" value="<?php echo $row['user_name'] ?>"></td>
                </tr>
             
                <tr>
                <td><label>Password</label></td>
                <td>  <input type="password" id="userPwd" onClick="this.select();" name="userPwd"></td>
                <td style="padding-left:20px"><input type="checkbox" name="option" onchange="revealPass()" >  Show Password </td>
            
                </tr>
                <tr>
                <td><form>
                <br>
                <input type ="submit" value="Update Details" class="btn btn-info"> 
                </form>
                </td>
                </tr>
                </table>
                <p style="color:red">Please Logout and Login to make changes! </p>
                  </form>
                
            
              </div>
            </div>
             
            </div>
          </div>
        </div>
   </div>
          
   </div>

      <div align="right" style="padding-right:20px">
      <script>
          document.write('<a href="' + document.referrer + '" class="backbutton">Go Back</a>');
      </script>
      </div>
      </div>
    </div>
 
  </div>
 
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/sb-admin.min.js"></script>


</body>

</html>
