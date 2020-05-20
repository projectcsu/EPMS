<?php

require'mysql.php';

    
if(isset($_POST['deleteKey']))
    {
        
        $chkarr=$_POST['deleteKey'];
        $count=count($chkarr);
        foreach ($chkarr as $id)
        {   
            
            $tdate=date("Y-m-d");
           
            $sql="select tbl_payments.*,tbl_employees.emp_name from tbl_payments,tbl_employees where tbl_payments.emp_id=tbl_employees.emp_Id AND tbl_payments.pay_id=".$id;
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_array($result))
            {
            $empid=(int)$row['emp_id'];
            $payid=(int)$row['pay_id'];
            $sdate=$row['start_date'];
            $edate=$row['end_date'];
            $wh=(double)$row['work_hours'];
            $ot=(double)$row['ot_hours'];
            $tot=$wh+$ot;
            $sal=(double)$row['salary'];
            $empname=$row['emp_name'];
            $paystat="Not-Paid";

           
            $sql2="insert into tbl_payhistory values($empid,$payid,'$empname','$sdate','$edate',$wh,$ot,$tot,$sal,'$tdate','$paystat');";
            mysqli_query($conn,$sql2);

            $sql3="delete from tbl_payments where emp_id=$empid AND pay_id=$id";
            mysqli_query($conn,$sql3);
            }
            
        echo "<script> 
     
        
        alert('Succesfully added $count Payment record(s) for approval');
        window.location.replace(\"payments.php\");
        
        </script>";

   
        }
    }
else{
    echo "<script> 
     
        
    alert('Please select a payment record to send for approval');
    window.history.back();
    </script>";

}


?>