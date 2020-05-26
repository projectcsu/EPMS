<?php 


if (isset($_GET['empid'])){
    $inte = $_GET["empid"];
    $sql2= "select tbl_employees.emp_name,tbl_employees.staff_type,tbl_payrates.pay_rate,tbl_payrates.ot_rate from tbl_employees,tbl_payrates WHERE tbl_employees.staff_type=tbl_payrates.staff_type AND emp_Id=$inte";
    $result2=mysqli_query($conn,$sql2);
    $row3=mysqli_fetch_array($result2);

    
}
//Check if GET (payedit) is called
if(isset($_GET['payedit'])){
    //Define button value and button click function redirect file
    $colpay="Update";
    $filepay="updatePay.php";
    //GET selected row pay id and employee id from payments html page
    $inte = $_GET["payedit"];
    $payid= $_GET["payid"];
    //sql to select required values from multiple tables
    $sql3= "select tbl_employees.emp_name,tbl_employees.staff_type,tbl_payrates.pay_rate,
    tbl_payrates.ot_rate,tbl_payments.start_date,tbl_payments.end_date,tbl_payments.work_hours,
    tbl_payments.ot_hours,tbl_payments.paystat from tbl_employees,tbl_payrates,tbl_payments 
    WHERE tbl_employees.staff_type=tbl_payrates.staff_type AND tbl_payments.emp_id=$inte AND 
    tbl_employees.emp_Id=$inte AND tbl_payments.pay_id=$payid";
    $result3=mysqli_query($conn,$sql3);
    $row3=mysqli_fetch_array($result3);
    //hide some elementss
    $hideemp="hidden";
    }
    else{
    //Define button value and button click function redirect file
    $colpay="Add";
    $filepay="addPay.php";
}

//check if get -edit is called
if(isset($_GET['edit'])){
  //get passed value from get method
  $empid= $_GET['edit'];
  //query to load values
  $sql1="select * from tbl_employees where emp_Id=$empid";
  $result1=mysqli_query($conn,$sql1);
  $row=mysqli_fetch_array($result1);
  //hide some values
  $hideemp="hidden";
  //define button value
  $colemp="Update";
  //define readonly  properties
  $idattr="readonly";
  //define button redirect file
  $fileemp="updateEmp.php";
  //define button hidden property
  $canbtn="";
  
  }
  else{
    //define button value
    $colemp="Add";
    //define button click redirect file
    $fileemp="addEmp.php";
    //define button hidden property
    $canbtn="hidden";
  }

  //check if get -user edit is called
  if(isset($_GET['useredit'])){
    //get passed value from get method
    $accid= $_GET['useredit'];
    $result4=mysqli_query($conn,"select * from tbl_User where userId=$accid");
    $row=mysqli_fetch_array($result4);
    //define page hidden properties
    $hiddenattr="hidden";
    //define page hidden properties
    $hidechk="hidden";
    //Define submit button value
    $coluser="Update";
    //DEfine readonly properties
    $idattr="readonly";
    //Define submit buttin redirect file
    $fileuser="updateUser.php";
    //Define cancel button value
    $cancelUser="";
    }
    else{
      //Define cancel button value
      $coluser="Add";
      //Define hidden attribute
      $cancelUser="hidden";
      //Define submit button redirect value
      $fileuser="addUser.php";
    }

      //check if get -staff edit is called
      if(isset($_GET['staffedit'])){
      //get staff type from get method
      $staff= $_GET['staffedit'];
      $result=mysqli_query($conn,"select * from tbl_payrates where staff_type='$staff'");
      $row5=mysqli_fetch_array($result);
      //define hidden attributes for table
      $updatePanel='';
      //define hidden attributes
      $hiddenattr="hidden";
      }
      else{
        //define table hidden attribute
        $updatePanel="hidden";
      }
?>