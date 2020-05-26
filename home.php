<?php
include 'login.php';
require 'mysql.php';
require 'datachart.php';
require 'datachart2.php';



if(!isset($_SESSION['login_user'])){
  header("location: index.php");
  }

  if($_SESSION['userType']=="Accountant")
  {
    $hideattr="hidden";
  }

  $sql= "select * from tbl_employees ";

  $result=mysqli_query($conn,$sql);
  $emp_no=mysqli_num_rows($result);
  

$query = "select emp_Id,emp_name from tbl_employees";
$data = mysqli_query($conn, $query);


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
  <link href="css/sb-admin.css" rel="stylesheet">
  
 
  <script type="text/javascript" src="sysTime.js"> </script>
  <script type="text/javascript" src="formulas.js"> </script>


  <script>

 

function loadChart() {
 
var chart = new CanvasJS.Chart("chartContainer", {
        theme: "light1",
        zoomEnabled: true,
        animationEnabled: true,
        title: {
            text: "Employees"
        },
        
        data: [
        {
            type: "bar",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }
        ]
    });
    chart.render();
  
 }
 function loadChart2() {
 
 var chart = new CanvasJS.Chart("chartContainer2", {
         theme: "light1",
         zoomEnabled: true,
         animationEnabled: true,
         title: {
             text: "Payments"
         },
         
         data: [
         {
             type: "bar",
             dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
         }
         ]
     });
     chart.render();
   
  }
 

</script>

</head>

<body id="page-top" onload="startTime();loadChart();loadChart2()" >
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
        <li class="nav-item active">
            <a class="nav-link" href="#">Home</a>
   
            </li>
            <li class="nav-item">
            <a class="nav-link" href="myprofile.php" onclick="getURL('homeurl')">My Profile</a>
   
            </li>
            <li class="nav-item" <?php echo $hideattr ?>>
          <a class="nav-link"  href="javascript:lastPage('settings');" onclick="getURL('homeurl')">Settings</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout </a>
            </li>
        </ul>
    </div>
</nav>
    

  <div id="wrapper">

  
    <ul class="sidebar navbar-nav">
  
      <li class="nav-item active" >
        <a class="nav-link" href="home.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>DashBoard</span>
        </a>
      </li>
      <li class="nav-item" >
        <a class="nav-link" href="payments.php" >
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Payments</span></a>
      </li>
      <li class="nav-item " <?php echo $hideattr ?>>
        <a class="nav-link" href="payhistory.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Payments - Admin Panel</span></a>
      </li>
      <li class="nav-item" <?php echo $hideattr ?>>
        <a class="nav-link" href="employees.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Employees</span></a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <ol class="breadcrumb">
          <li class="breadcrumb-item">
          <span style="font-weight: bold;">Welcome <?php echo
              $_SESSION['login_user'];
              ?> !</span>
          </li>
        </ol>
        <table >
          <tr >
          <td style="padding-right:500px">
          <div style="height: 370px; width: 20%;">
          <div id="chartContainer" style="height: 370px; width: 20%;"></div></div></td>
          <td style="padding-right:1px">
          <div style="height: 370px; width: 20%;">
          <div id="chartContainer2" style="height: 370px; width: 20%;"></div></div>
          </td>
          <td width="600"align="right" style="font-size: 50px;">
   
          </td>
  </tr>
  <tr>
  <td style="padding-left:50px;padding-top:100px">
  <span style="font-weight:bold"> Total Employees :   </span><?php echo $emp_no ?>
</td>
</tr>
<tr>
<td>

</td>

</tr>
          </table>     
        
       

      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Charles Sturt University 2019</span>
          </div>
        </div>
      </footer>

      

    </div>
 
    

  </div>
 
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="canvasjs.min.js"></script>

  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <script src="js/sb-admin.min.js"></script>
  
</body>

</html>
