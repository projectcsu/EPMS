
<?php
include 'login.php';
require 'mysql.php';
require 'updateGET.php';

  if($_SESSION['userType']=="Accountant"){
    $hideattr="hidden";
  }
    $sql= "select * from tbl_employees ";
    $result=mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">

  <title>EPMS</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="customstyle.css" rel="stylesheet" type="text/css">
  <link href="css/sb-admin.css" rel="stylesheet"> 
  <script type="text/javascript" src="sysTime.js"> </script>
  <script type="text/javascript" src="formulas.js"> </script>
  <script type="text/javascript">

  function clear(){
    document.getElementById("searchemp").value='';
  }

  function search(){

    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchemp");
    filter = input.value.toUpperCase();
    table = document.getElementById("editable_table");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++){
   
      td = tr[i].getElementsByTagName("td")[0];
      if (td){
        txtValue = td.textContent || td.innerText;
        if(txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } 
        else{
        tr[i].style.display = "none";
        }
      }
    } 
  }
  function submitForm(action,event){
    
      var val=document.getElementById("empId").value;
      var val2=document.getElementById("empno").value;
      if(val.length <4){
            alert("Employee ID must be four characters");
            event.preventDefault();
      }
      else{
        if(val2.length <10){
            alert("Mobile no must be 10 numbers");
            event.preventDefault();
        }
        else{
            document.getElementById('empform').action = action;
            document.getElementById('empform').submit();
        }
      }   
    }
  </script>
</head>
<body id="page-top" onload="startTime()">
<nav class="navbar navbar-expand -md navbar-dark bg-dark">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 ">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
            <a class="navbar-brand" href="">
          <img src="brandicon.png" width="150" height="60" >
          Employee Payroll Management System</a>
            </li>
        </ul>
    </div>
    <div class="mx-auto order-1">
        <a class="navbar-nav ml-auto" ></a>
      
            <span class="navbar-brand" id="time"></span>
</div>
    <div class="navbar-collapse collapse w-100 order-2">
    <ul class="navbar-nav ml-auto">
    <li class="nav-item active">
            <a class="nav-link" href="employees.php">Home</a>
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
      <li class="nav-item ">
        <a class="nav-link" href="payhistory.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Payments - Admin Panel</span></a>
      </li>
      <li class="nav-item active" style ="<?php echo $userCtrl?>">
        <a class="nav-link" href="#">
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
           <?php echo $colemp;?> Employee</div>
        <div class="card-body">
          <div class="table-responsive">
             <div  style="padding-top:20px">
              <form id="empform" method="post" >
  <table>
      <col width ="150">
        <col width ="100">
      <tr>
          <td><label>Employee ID</label></td>
          <td><input <?php echo $idattr; ?> type="text" size="4"  name="empId" maxlength= "4" id="empId" placeholder=" xxxx" onfocusout="checkEnter('empId',' Employee ID')" value="<?php echo $row['emp_Id']; ?>"  > </td>
      </tr>
      <tr>
          <td><label>Employee Name</label></td>
          <td><input type="text" size="30" placeholder="Bryan Steve"  name="empName" id="empName" onfocusout="checkName('empName','Employee Name')" value="<?php echo $row['emp_name']; ?>"></td>
      </tr>
      <tr>
          <td><label>Address</label></td>
          <td><input type="text" placeholder="12 Maple Avenue,Bundoora" size="30" name="empAd" id="empAd" value="<?php echo $row['emp_address']; ?>" > </td>
      </tr>
      <tr>
          <td><label>Mobile No</label></td>
          <td><input type="text" id="empno" maxlength="10" size="11"  placeholder="0412345679" onfocusout="checkEnter('empno','Mobile No')"  name="empNo"value="<?php echo $row['emp_no']; ?>" ></td>
      </tr>
      <tr>
          <td><label>Staff Type</label></td>
          <td><select name="stype">
             <?php 
                if(isset($_GET['edit'])){
                
                  if($row['staff_type']=="Academic"){
                  echo'
                  <option selected="selected" value="Academic">Academic</option>
                  <option value="Non-Academic">Non-Academic</option>
                  ';
                  }
                  else {
                    echo'
                    <option value="Academic">Academic</option>
                    <option selected="selected" value="Non-Academic">Non-Academic</option>
                  ';
                  }
                }
                else{
                echo'
                <option disabled selected="selected"> Select Staff Type </option>';
                $rpayrates=mysqli_query($conn,"select staff_type from tbl_payrates");
                  while($rowpays=mysqli_fetch_array($rpayrates)){
                 echo'
                   
                    <option value="'.$rowpays["staff_type"].'">'.$rowpays["staff_type"].'</option>
                    '; 
                  }
                }
                  ?>
              </select></td>    
      </tr>
      <tr>
          <td><input type ="submit" value="<?php echo $colemp ?> Employee" id="btnadd" class="btn btn-info" onclick="submitForm('<?php echo $fileemp ?>',event)"></td>
          <td><input type ="submit" <?php echo $canbtn; ?> id="clearbtn" value ="Cancel" class="btn btn-info" onclick="clear();window.history.go(-1); return false;" >
          </form></td>
      </tr>
    </table>
  </div>
</div>
</div>
</div>
      <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
           Employees
      </div>
      <div class="card-body">
        <div align="right">
            <label> <b> Search : </b> </label>
            <input type="text" id="searchemp" onkeyup="search()"></div>
            <div class="table-responsive">
            <table  id="editable_table" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>Address</th>
                <th>Mobile No</th>
                <th>Staff Type</th>
                <th <?php echo $hideemp ?> ></th>
                <form action="deleteEmp.php" method="post" >
                <th <?php echo $hideemp?> ><input type="checkbox" class="checkbox" name="selectKey[]" onclick="selectAll()"></th>
              </tr>
              </thead>
              <tbody>
              <?php while($row2=mysqli_fetch_array($result)){
                $id=$row2["emp_Id"];
                echo '
                <tr>
                <td >'.$row2["emp_Id"].'</td>
                <td >'.$row2["emp_name"].'</td>
                <td >'.$row2["emp_address"].'</td>
                <td>'.$row2["emp_no"].'</td>
                <td >'.$row2["staff_type"].'</td>
                <td '.$hideemp.'  ><a href="employees.php?edit='.$id.'" class="btn btn-info" ">Edit</a></td>
                <td '.$hideemp.'> <input type="checkbox" class="checkbox" name="deleteKey[]" value="'.$id.'"></td>
                </tr>';}?>     
               </tbody>
              </table>
            <input type="submit" <?php echo $hideemp; ?> id="deletebtn" name="btnDelete" value ="Delete Employee" <?php echo $hiddenattr ?> class="btn btn-info" > </form>
            <br>
            <br>
            </div>
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
