<?php
include 'login.php';
require 'mysql.php';
require 'updateGET.php';

if(!isset($_SESSION['login_user'])){
  header("location: index.php");
  }


  if($_SESSION['userType']=="Accountant")
  {
 
    $hideattr="hidden";
  }
 
  $tblsql= "select * from tbl_payments";

  $tblres=mysqli_query($conn,$tblsql);

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

 
  <script src="vendor/jquery/jquery.min.js"></script>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="customstyle.css" rel="stylesheet" type="text/css">

  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <link rel="stylesheet" href="/jquery-ui.css">
  <script src="jquery-1.12.4.js"></script>
  <script src="jquery-ui.js"></script>

  <link href="css/sb-admin.css" rel="stylesheet">

  <script type="text/javascript" src="sysTime.js"> </script>
  <script type="text/javascript" src="formulas.js"> </script>
  <script type="text/javascript">

function search(){

var input, filter, table, tr, td, i, txtValue;
input = document.getElementById("searchemp");
filter = input.value.toUpperCase();
table = document.getElementById("dataTable");
tr = table.getElementsByTagName("tr");

for (i = 0; i < tr.length; i++){

  td = tr[i].getElementsByTagName("td")[1];
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
  function submitForm(action){
          
            document.getElementById('payform').action = action;
            document.getElementById('payform').submit();   
        }
  </script>
</head>

<body id="page-top" onload="startTime();datepicker()" >
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
            <a class="nav-link" href="payments.php">Home</a>
   
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
    <li class="nav-item "  >
        <a class="nav-link" href="home.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>DashBoard</span>
        </a>
      </li>
      
      <li class="nav-item active" >
        <a class="nav-link" href="#">
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
        
       
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            <?php echo $colpay; ?> Payment</div>
          <div class="card-body">
            <div class="table-responsive">
              <div style="padding-top:20px">
                <form method="post" id="payform">
                  <table >
               <tr >
                
               <td><label>Employee ID  -  </label></td>
               <td ><select name="emp_Id" id="empid" onchange="loadEmp(this)">
               
                <?php    
                if(isset($_GET["empid"]) || isset($_GET["payedit"]) )
                {
                $sqll= "select emp_Id from tbl_employees where=$inte;";
                $result4=mysqli_query($conn,$sqll);
                $row5=mysqli_fetch_array($result4);
                $hidedet="";
                echo '
                <option readonly="readonly" selected="selected">'.$inte.'</option>
                ';
                }
                else{
                $sql1= "select emp_Id from tbl_employees;";
                $result=mysqli_query($conn,$sql1);
                $hidedet="hidden";
                echo '<option>Select ID</option> ';
                while($row=mysqli_fetch_array($result)){
                echo '
                <option >'.$row["emp_Id"].'</option>';
                }
                }
                ?>
                  
               </select>
               </td>
               
                <td style="padding-left:50px"><label <?php echo $hidedet ?>>Employee Name  - </p></label></td>
                <td style="padding-left:50px"><input type="textbox" id="e_name" <?php echo $hidedet ?> readonly name="emp_name" value="<?php echo $row3['emp_name']; ?>"></td>
                <td><input type="textbox" hidden name="payid" value="<?php echo $payid ?>"></input></td>
                <td><input type="textbox" hidden name="paystat" value="<?php echo $row3['paystat'];?>"></input></td>
                </tr>
                <tr>
                <td><label <?php echo $hidedet ?>>Start Date</label></td>
                <td><input type="text" <?php echo $hidedet ?> readonly id="s_date" placeholder="MM-DD-YYYY" name="start_date" value="<?php echo $row3['start_date']; ?>"></td>
                
                <td style="padding-left:50px"><label <?php echo $hidedet ?>>End Date</label></td>
                <td style="padding-left:50px"> <input type="text" <?php echo $hidedet ?> readonly placeholder="MM-DD-YYYY" id="e_date" name="end_date" onchange="checkDate()" value="<?php echo $row3['end_date']; ?>"></td>
                
                </tr>
                <tr>
                <td><label <?php echo $hidedet ?>>Work Hours</label></td>
                <td><input type="text" placeholder="ex :- 20/30/40" <?php echo $hidedet ?> name="work_hours" onfocusout="checkEnter('work/hours','Working Hours')" maxlength="4" id="work/hours" value="<?php echo $row3['work_hours']; ?>"></td>
                <td style="padding-left:50px"><label <?php echo $hidedet ?>>Staff Type</label></td>
                
                <td style="padding-left:50px"><input type="text" <?php echo $hidedet ?> readonly name="stype"  id="sType"  value="<?php echo $row3['staff_type']; ?>"></td>
                
                </tr>
                <tr>
                <td><label <?php echo $hidedet ?>>O/T hours</label></td>
                <td><input type="textbox" name="ot_hours" <?php echo $hidedet ?> placeholder="ex :- 20/30/40" onfocusout="checkEnter('o/t_hours','Over Time Hours')"  maxlength="4" id="o/t_hours" value="<?php echo $row3['ot_hours']; ?>"></td>
                <td style="padding-left:50px"><label <?php echo $hidedet ?>>Pay Rate ($)</label></td>
                <td style="padding-left:50px"><input type="text" <?php echo $hidedet ?> readonly name="rph"  id="rph"  value="<?php echo $row3['pay_rate']; ?>"></td>
                <td style="padding-left:50px"><label <?php echo $hidedet ?>>Pay Rate (O/T) ($)</label></td>
                <td style="padding-left:50px"><input type="text" <?php echo $hidedet ?> readonly name="rph_ot" id="rph_ot"  value="<?php echo $row3['ot_rate'];?>"></td>
                </tr>
                
                <tr>
                <td><input type ="submit" <?php echo $hidedet ?> value="<?php echo $colpay; ?> Payment" class="btn btn-info" onclick="submitForm('<?php echo $filepay ?>')"></td>
                <td><input type="button" <?php echo $hidedet ?> value="Reset" onclick="loadCombo()" class="btn btn-info"></td>
              
                </tr>
                </form>
                </table>
            
                
            
              </div>
            </div>
             
            </div>
          </div>
          
        
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
           Ongoing Payments</div>
          <div class="card-body">
          <div align="right">
            <label> <b> Search : </b> </label>
            <input type="text" id="searchemp" onkeyup="search()"></div>
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                <th>Payment ID</th>    
                <th>Employee ID</th>
                <th>Start date</th>
                <th>End date</th>
                <th>Work Hours</th>
                <th>O/T hours</th>  
                <th>Salary ($)</th>
                <th>Payment Status </th>
                <th <?php echo $hideemp?> ></th>
              
                <form action="deletePay.php" method="post" >
                <th <?php echo $hideemp?>><input  type="checkbox" class="checkbox" name="selectKey[]" onclick="selectAll()"></th>
                </tr>
                </thead>
                <tbody>
               <?php while($rowtbl=mysqli_fetch_array($tblres))
              {
                $pay_id=$rowtbl["pay_id"];
                echo '
                <tr>
                <td>'.$rowtbl["pay_id"].'</td>
                <td>'.$rowtbl["emp_id"].'</td>
                <td>'.$rowtbl["start_date"].'</td>
                <td>'.$rowtbl["end_date"].'</td>
                <td>'.$rowtbl["work_hours"].'</td>
                <td>'.$rowtbl["ot_hours"].'</td>
                <td>'.$rowtbl["salary"].'</td>
                <td>'.$rowtbl["paystat"].'</td>
                <td '.$hideemp.'><a href="payments.php?payedit='.$rowtbl["emp_id"].'&payid='.$pay_id.'" class="btn btn-info" ">Edit</a></td>
                <td '.$hideemp.'> <input type="checkbox" class="checkbox" name="deleteKey[]" value="'.$pay_id.'"></td>
               
                </tr>
              ';
        
              }
               ?>

                  
               </tbody>
              </table>
             
                <input name="btnDelete" type="submit" <?php echo $hideemp?> value ="Send for approval" class="btn btn-info">
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

  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>





</body>

</html>
