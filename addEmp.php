<?php
//GET DB Connection
require 'mysql.php';
  //get values from textboxes
  $empid=(int)$_POST["empId"];
  $empname=$_POST["empName"];
  $empAd=$_POST["empAd"];
  $empno=(int)$_POST["empNo"];
  $staff=$_POST["stype"];

//Check if passed values are no empty
if((!empty($empid) && !empty($empname) && !empty($empAd) && !empty($empno) && !empty($staff)))
{
  //run query to insert values to db
  $sql= "insert into tbl_employees VALUES ($empid,'$empname','$empAd',$empno,'$staff')";
  //validate employee id as no other errors will be given from checking query status - * all other inputs outputs validated 
  if(mysqli_query($conn,$sql)){
        echo "<script> 
        alert('Succesfully Added Employee');
        window.location.replace(\"employees.php\");
        </script>";
  }
  else{
        echo "<script>  
        alert('Duplicate Employee ID, try new ID');
        window.history.back();
        </script>";
  }
}
else{
  echo "<script> 
  alert('Error adding Employee, Please ensure all the fields are correctly entered.');
  window.history.back();
  </script>";
mysqli_close($conn);
}

?>