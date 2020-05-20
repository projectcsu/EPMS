<?php
include 'login.php';
require 'mysql.php';
require 'updateGET.php';


if(!isset($_SESSION['login_user'])){
  header("location: index.php");
  }

if($_SESSION['userType']=="Accountant"){
    $hideattr="hidden";
  }
  $sql="select * from tbl_payrates";
  $result=mysqli_query($conn,$sql);

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
  <script type="text/javascript" src="formulas.js"> </script>

  <script>
function submitForm(action)
    {
    
        document.getElementById('userform').action = action;
        document.getElementById('userform').submit();

    }

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

  
function revealPass(){
    var x = document.getElementById("userPwd");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }

    

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
    <li class="nav-item ">
            <a class="nav-link" href="javascript:lastPage('homeurl');" onclick ="getURL('settings')">Home</a>
   
            </li>
        
            <li class="nav-item">
            <a class="nav-link" href="myprofile.php" onclick="getURL('settings')">My Profile</a>
   
            </li>
            <li class="nav-item active" <?php echo $hideattr ?>>
          <a class="nav-link" href="javascript:window.location.reload(false);">Settings</a>
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
        <a class="nav-link" href="useraccounts.php">
          <i class="fas fa-users-cog"></i>
          <span>User Accounts</span>
        </a>
      </li>
      
      <li class="nav-item active">
        <a class="nav-link" href="#">
          <i class="fas fa-comments-dollar"></i>
          <span>Staff Info & Rates</span></a>
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
          Staff Rates
          </div>
          <div class="card-body">

            <div class="table-responsive">
            <table  id="tbl_users" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Staff Type</th>
                <th>Ordinary Pay Rate</th>
                <th>Overtime Pay Rate</th>
                <th <?php echo $hiddenattr ?>></th>
                <form action="updateRates.php" method="post" >
              </tr>
              </thead>
              <tbody>
              <?php while($row=mysqli_fetch_array($result))
              {
                $staff=$row["staff_type"];
                echo '
                <tr>
                
                <td >'.$row["staff_type"].'</td>
                <td >'.$row["pay_rate"].'</td>
                <td>'.$row["ot_rate"].'</td>
                <td '.$hiddenattr.'  ><a href="staff.php?staffedit='.$staff.'" class="btn btn-info" ">Edit</a></td>
               
                </tr>
              ';
        
              }
               ?>

                  
               </tbody>
              </table>
              <div <?php echo $updatePanel ?>>
             <div align="left>">
                <label>Staff Type</label> 
            <div>
                 <input readonly type="text" name="stafftype" value="<?php echo $row5['staff_type']; ?>" > </div>
            </div>
                 <div align="left>">
               <label>Ordinary Pay Rate</label>
                 </div>
                <div>
                 <input <?php echo $idattr; ?> type="text" name="wrate" value="<?php echo $row5['pay_rate']; ?>" > 
            </div>
            <div align ="left">
                 <label>Overtime Pay Rate</label>
            </div>
            <div>
                 <input <?php echo $idattr; ?> type="text" name="orate" value="<?php echo $row5['ot_rate']; ?>" > 
            </div>
            <div align="left" style="padding-top:20px">
              <input type ="submit" value="Update Rates" id="btnadd" class="btn btn-info"></td>
            </form>
            <input type ="submit" value="Cancel" id="btnadd" class="btn btn-info" onclick="clear();window.history.go(-1); return false;"></td>
            </div>
            </div>
           
            <br>
            <br>
            
            
            </div>
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
