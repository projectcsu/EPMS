<?php

require'mysql.php';

$empid=(int)$_POST["empId"];
$empname=$_POST["empName"];
$empAd=$_POST["empAd"];
$empno=(int)$_POST["empNo"];
$staff=$_POST["stype"];


if((!empty($empname) && !empty($empAd) && !empty($empno) && !empty($staff))){
  
$sql="update tbl_employees SET emp_name='$empname',emp_address='$empAd',emp_no=$empno,staff_type='$staff' where emp_Id=$empid";
mysqli_query($conn,$sql);
  
    echo "<script> 
     
        
        alert('Succesfully Updated Employee $empid');
        window.location.replace(\"employees.php\");
        
        </script>";
  

}
else{

  echo "<script> 
     
        
  alert('Error updating Employee, Please ensure all the fields are correctly entered $empid.');
  window.history.back();
  
  </script>";



}
mysqli_close($conn);

?>