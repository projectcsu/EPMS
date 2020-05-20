<?php

require 'mysql.php';

  $empid=(int)$_POST["emp_Id"];
  $empname=$_POST["emp_name"];
  $sdate=$_POST["start_date"];
  $edate=$_POST["end_date"];
  $startDate=dateFormat($sdate);
  $endDate=dateFormat($edate);
  $wh=(double)$_POST["work_hours"];
  $rph=(double)$_POST["rph"];
  $ot=(double)$_POST["ot_hours"];
  $rphOT=(double)$_POST["rph_ot"];
  $sal= ($wh*$rph)+($ot*$rphOT);
  $paystat="Waiting for Approval";

if(!empty($sdate) && !empty($edate) && !empty($wh))
{
  $sql2 = "insert into tbl_payments (emp_id,start_date,end_date,work_hours,ot_hours,salary,paystat) VALUES ($empid,'$startDate','$endDate',$wh,$ot,$sal,'$paystat')";
  
    mysqli_query($conn,$sql2);
    echo "<script> 
     
      
        alert('Succesfully Added Payment Details');
        window.location.replace(\"payments.php\");
        
        </script>";

}

else{

    echo "<script> 
            
    alert('Please fill all fields before submitting!');
    
    window.history.back();

    </script>";
    
    mysqli_close($conn);
}


function dateFormat($val){

  return date("Y-m-d",strtotime($val));

}
?>
