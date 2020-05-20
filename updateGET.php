<?php 


if (isset($_GET['empid'])){
    $inte = $_GET["empid"];
    $sql2= "select tbl_employees.emp_name,tbl_employees.staff_type,tbl_payrates.pay_rate,tbl_payrates.ot_rate from tbl_employees,tbl_payrates WHERE tbl_employees.staff_type=tbl_payrates.staff_type AND emp_Id=$inte";
    $result2=mysqli_query($conn,$sql2);
    $row3=mysqli_fetch_array($result2);

    
}

if(isset($_GET['payedit'])){

    $colpay="Update";
    $filepay="updatePay.php";

    $inte = $_GET["payedit"];
    $payid= $_GET["payid"];
    $sql3= "select tbl_employees.emp_name,tbl_employees.staff_type,tbl_payrates.pay_rate,tbl_payrates.ot_rate,tbl_payments.start_date,tbl_payments.end_date,tbl_payments.work_hours,tbl_payments.ot_hours,tbl_payments.paystat from tbl_employees,tbl_payrates,tbl_payments WHERE tbl_employees.staff_type=tbl_payrates.staff_type AND tbl_payments.emp_id=$inte AND tbl_employees.emp_Id=$inte AND tbl_payments.pay_id=$payid";
    $result3=mysqli_query($conn,$sql3);
    $row3=mysqli_fetch_array($result3);

    $hideemp="hidden";
    }
  
    else{
    $colpay="Add";
    $filepay="addPay.php";
}

if(isset($_GET['edit'])){
 
  $empid= $_GET['edit'];
  $sql1="select * from tbl_employees where emp_Id=$empid";
  $result1=mysqli_query($conn,$sql1);
  $row=mysqli_fetch_array($result1);

  $hideemp="hidden";
  $colemp="Update";
  $idattr="readonly";
  $fileemp="updateEmp.php";
  $canbtn="";
  
  }
  else{
    $colemp="Add";
    $fileemp="addEmp.php";
    $canbtn="hidden";
    

  }

  if(isset($_GET['useredit'])){
 
    $accid= $_GET['useredit'];
    $result4=mysqli_query($conn,"select * from tbl_User where userId=$accid");
    $row=mysqli_fetch_array($result4);
  
    $hiddenattr="hidden";
    $hidechk="hidden";
    $coluser="Update";
    $idattr="readonly";
    $fileuser="updateUser.php";
    $cancelUser="";
     
    $pwd=$row['userPwd'];
    $pwd1=md5($pwd);
    
    }
    else{
      $coluser="Add";
      $cancelUser="hidden";
      $fileuser="addUser.php";
      
  
    }

    if(isset($_GET['staffedit'])){
 
      $staff= $_GET['staffedit'];
      $result=mysqli_query($conn,"select * from tbl_payrates where staff_type='$staff'");
      $row5=mysqli_fetch_array($result);
    
      $updatePanel='';
      $hiddenattr="hidden";
      
      
      }
      else{
        $updatePanel="hidden";
      
      }
?>