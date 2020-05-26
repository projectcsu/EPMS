<?php

require'mysql.php';

//Check whether checkbox is selected    
if(isset($_POST['deleteKey'])){
        //Get checkbox assigned value
        $chkarr=$_POST['deleteKey'];
        $count=count($chkarr);
        foreach ($chkarr as $id){   
            //Get today system date
            $tdate=date("Y-m-d");
            //select relevant record
            $sql="select tbl_payments.*,tbl_employees.emp_name from tbl_payments,tbl_employees 
            where tbl_payments.emp_id=tbl_employees.emp_Id AND tbl_payments.pay_id=".$id;
            $result=mysqli_query($conn,$sql);

            while($row=mysqli_fetch_array($result)){
            
            //Fetch values for selected row
            $empid=(int)$row['emp_id'];
            $payid=(int)$row['pay_id'];
            $sdate=$row['start_date'];
            $edate=$row['end_date'];
            $wh=(double)$row['work_hours'];
            $ot=(double)$row['ot_hours'];
            //Calculate total houra
            $tot=$wh+$ot;
            $sal=(double)$row['salary'];
            $empname=$row['emp_name'];
            $paystat="Not-Paid";

           //insert relevant selected row to payments history table - * Payments admin panel
            $sql2="insert into tbl_payhistory values($empid,$payid,'$empname','$sdate','$edate',$wh,$ot,$tot,$sal,'$tdate','$paystat');";
            mysqli_query($conn,$sql2);
            
            //Delete row from current table
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