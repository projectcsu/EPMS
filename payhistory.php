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

  $sql="select * from tbl_payhistory where paystat!='Paid' ";
  $result=mysqli_query($conn,$sql);

  $sql2="select *from tbl_payhistory where paystat='Paid'";
  $result2=mysqli_query($conn,$sql2);

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
  <script type="text/javascript" src="sysTime.js"> </script>
  <script type="text/javascript" src="formulas.js"></script>
  <script type="text/javascript">
  
  function search(tbl,search) {

var input, filter, table, tr, td, i, txtValue;
input = document.getElementById(search);
filter = input.value.toUpperCase();
table = document.getElementById(tbl);
tr = table.getElementsByTagName("tr");


for (i = 0; i < tr.length; i++) {
 
  td = tr[i].getElementsByTagName("td")[0];
  if (td) {
    txtValue = td.textContent || td.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      tr[i].style.display = "";
    } else {
      tr[i].style.display = "none";
    }
  }

}
  }




function submitForm(action)
    {

      document.getElementById('payhform').action = action;
      document.getElementById('payhform').submit(); 
        
       
  }
</script>

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
    <li class="nav-item active ">
            <a class="nav-link" href="payhistory.php">Home</a>
   
            </li>
        
            <li class="nav-item">
            <a class="nav-link" href="myprofile.php" onclick="getURL('homeurl')">My Profile</a>
   
            </li>
            <li class="nav-item" <?php echo $hideattr ?>>
          <a class="nav-link" href="javascript:lastPage('settings');" onclick="getURL('homeurl')">Settings</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout </a>
            </li>
        </ul>
    </div>
</nav>
  <div id="wrapper">

  
    <ul class="sidebar navbar-nav">
    <li class="nav-item " >
        <a class="nav-link" href="home.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>DashBoard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="payments.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Payments</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Payments - Admin Panel</span></a>
      </li>
      <li class="nav-item" style="<?php echo $userCtrl ?>">
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
        
       

        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
          Ongoing Payments </div>
          <div class="card-body">
          <div align="right">
            <label> <b> Search : </b> </label>
            <input type="text" id="searchpay" onkeyup="search('tbl_pay','searchpay')"></div>
            <div class="table-responsive">
            <table id="tbl_pay" class="table table-bordered" >
                <thead>
                  <tr>
                <th>Employee ID</th>    
                <th>Payment ID</th>
                <th>Employee Name</th>
                <th>Start date</th>
                <th>End date</th>
                <th>Total Hours</th>  
                <th>Salary ($)</th>
                <th>Payment Added Date</th>
                <th>Pay Status</th>
                <form id="payhform" method="post" >
                <th><input type="checkbox" class="checkbox" name="selectKey[]" onclick="selectAll()"></th>
                </tr>
                </thead>
                <tbody>
               <?php while($row=mysqli_fetch_array($result))
              {
                $payid=$row["pay_id"];
                echo '
                <tr>
                <td>'.$row["emp_id"].'</td>
                <td>'.$row["pay_id"].'</td>
                <td>'.$row["emp_name"].'</td>
                <td>'.$row["start_date"].'</td>
                <td>'.$row["end_date"].'</td>
                <td>'.$row["tot_hours"].'</td>
                <td>'.$row["salary"].'</td>
                <td>'.$row["pay_date"].'</td>
                <td>'.$row["paystat"].'</td>

                <td> <input type="checkbox" class="checkbox" name="deleteKey[]" value="'.$payid.'"></td>
               
                </tr>
              ';
              }
               ?>
               </tbody>
              </table>
              <div align="right">
              <input name="btnpay" type="submit" value ="Pay" class="btn btn-info" onclick="submitForm('pay.php')">
           
              <input name="btnamend" type="submit" value ="Amend" class="btn btn-info" onclick="submitForm('amendPay.php')">
            </form>
            </div>
            </div>
          </div>
          
        </div>

        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
           Payments History</div>
          <div class="card-body">
          <div align="right">
            <label> <b> Search : </b> </label>
            <input type="text" id="searchhis" onkeyup="search('tbl_his','searchhis')"></div>
            <div class="table-responsive">
            <table id="tbl_his" class="table table-bordered" >
                <thead>
                  <tr>
                <th>Employee ID</th>    
                <th>Payment ID</th>
                <th>Employee Name</th>
                <th>Start date</th>
                <th>End date</th>
                <th>Total Hours</th>  
                <th>Salary ($)</th>
                <th>Payment Added Date</th>
                <th>Pay Status</th>
                <form method="post">
                </tr>
                </thead>
                <tbody>
               <?php while($row2=mysqli_fetch_array($result2))
              {

                echo '
                <tr>
                <td>'.$row2["emp_id"].'</td>
                <td>'.$row2["pay_id"].'</td>
                <td>'.$row2["emp_name"].'</td>
                <td>'.$row2["start_date"].'</td>
                <td>'.$row2["end_date"].'</td>
                <td>'.$row2["tot_hours"].'</td>
                <td>'.$row2["salary"].'</td>
                <td>'.$row2["pay_date"].'</td>
                <td>'.$row2["paystat"].'</td>
               
                </tr>
              ';
        
              }
               ?>   
               </tbody>
              </table>       
            </form>
            </div>
          </div>
        </div>
      </div>

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
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <script src="js/sb-admin.min.js"></script>


</body>

</html>
