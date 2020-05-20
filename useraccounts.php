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

  $sql="select * from tbl_User";
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
  function submitForm(action){
    var val=document.getElementById("userId").value;
      if(val.length <4){
            alert("User ID must be four characters");    
      }
      else{
        document.getElementById('userform').action = action;
        document.getElementById('userform').submit();
      }
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
            <a class="nav-link" href="javascript:lastPage('homeurl');" onclick="getURL('settings')">Home</a>
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
    <li class="nav-item active" >
        <a class="nav-link" href="#" onclick="getURL('settings')">
          <i class="fas fa-users-cog"></i>
          <span>User Accounts</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="staff.php" onclick="getURL('settings')">
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
         User Accounts</div>
          <div class="card-body">
            <div class="table-responsive">
              <div  style="padding-top:20px">
                <form id="userform" method="post" >
                  <table>
                  <col width ="150">
                  <col width ="100">
          <tr>
              <td><label>User ID</label> </td>
              <td><input <?php echo $idattr; ?> type="text" name="userId" id="userId" onfocusout="checkEnter('userId','User ID')" maxlength="4" size="4" placeholder="xxxx" value="<?php echo $row['userId']; ?>" > </td>            
          </tr>
          <tr>
              <td><label>User Name</label> </td>
              <td><input type="text" name="userName" id="userName" placeholder="Steve James" onfocusout="checkName('userName','User Name')"  value="<?php echo $row['user_name']; ?>"  ></td>
                
          </tr>
          <tr>
              <td><label>Password</label></td>
              <td><input type="password" onClick="this.select();" placeholder="**********"  name="userPwd" id="userPwd" > </td>
                <td id="passfield" style="padding-left:10px" ><input type="checkbox" onclick="revealPass()" id="showPass" > Show Password</td>
          </tr>
          <tr>    
              <td><label>Account Type</label></td>
              <td><select name="atype">
                <?php
                if(isset($_GET['useredit'])){
                  if($row['userType']=="Admin")
                  {
                  echo'
                  <option selected="selected" value="Admin">Admin</option>
                  <option value="Accountant">Accountant</option>
                  ';
                  }
                  else 
                  {
                    echo'
                    <option value="Admin">Admin</option>
                    <option selected="selected" value="Accountant">Accountant</option>
                  ';
                  }
                }
                else
                {
                echo'
                <option disabled selected="selected"> Select Account Type </option>
                <option value="Admin">Admin</option>
                <option value="Accountant">Accountant</option>
               ';   
                }
               ?>
            </select></td>
          </tr>
          <tr>
              <td><input type ="submit" value="<?php echo $coluser ?> User" id="btnadd" class="btn btn-info" onclick="submitForm('<?php echo $fileuser ?>')"></td>
              <td><input type =submit <?php echo $cancelUser; ?> id="clearbtn" value ="Cancel" class="btn btn-info" onclick="clear();window.history.go(-1); return false;" ></form>
              </td>
          </tr>                       
      </table>
    </div>
  </div>
</div>
</div>
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
          Users
      </div>
      <div class="card-body">
          <div align="right">
            <label> <b> Search : </b> </label>
            <input type="text" id="searchuser" onkeyup="search('tbl_users','searchuser')"></div>
            <div class="table-responsive">
            <table  id="tbl_users" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>User ID</th>
                <th>User Name</th>
                <th>User Password</th>
                <th>Acccount Type</th>
                <th <?php echo $hiddenattr ?> ></th>
                <form action="deleteUser.php" method="post" >
                <th <?php echo $hiddenattr?> ><input type="checkbox" class="checkbox" name="selectKey[]" onclick="selectAll()"></th>
              </tr>
              </thead>
              <tbody>
              <?php while($row=mysqli_fetch_array($result))
              {
                $id=$row["userId"];
                echo '
                <tr>
                
                <td >'.$row["userId"].'</td>
                <td >'.$row["user_name"].'</td>
                <td value="'.$row["userPwd"].'">******</td>
                <td>'.$row["userType"].'</td>
                <td '.$hiddenattr.'  ><a href="useraccounts.php?useredit='.$id.'" class="btn btn-info" " onClick="disableChk()">Edit</a></td>
                <td '.$hiddenattr.'> <input type="checkbox" class="checkbox" name="deleteKey[]" value="'.$id.'"></td>
                </tr>';
              }
               ?>  
               </tbody>
              </table>
              <input type="submit" id="deletebtn" name="btnDelete" value ="Delete User" <?php echo $hiddenattr ?> class="btn btn-info" > </form>
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
