<?php

require'mysql.php';

$empid=(int)$_POST["emp_Id"];
$pay_id=(int)$_POST["payid"];
$sdate=$_POST["start_date"];
$edate=$_POST["end_date"];
$wh=(double)$_POST["work_hours"];
$rph=(double)$_POST["rph"];
$ot=(double)$_POST["ot_hours"];
$rphOT=(double)$_POST["rph_ot"];
$sal= ($wh*$rph)+($ot*$rphOT);

$sql="update tbl_payments SET start_date='$sdate',end_date='$edate',work_hours=$wh,ot_hours=$ot,salary=$sal where emp_id=$empid AND pay_id=$pay_id";
if($_POST['paystat']=="Amend" || $_POST['paystat']=="Amended")
{
mysqli_query($conn,"update tbl_payments SET paystat='Amended' where emp_id=$empid AND pay_id=$pay_id");

}
if(mysqli_query($conn,$sql)){
    
    echo "<script> 
     
        
        alert('Succesfully Updated Payment for Employee -  $empid');
        window.location.replace(\"payments.php\");
        
        </script>";
    
  }
  
  else
  {
    echo "<script> 
     
        
        alert('Error updating Employee, Please ensure all the fields are correctly entered for $empid.');
        window.history.back();
        
        </script>";
 
  }



mysqli_close($conn);
