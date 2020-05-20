<?php

require'mysql.php';

    
if(isset($_POST['deleteKey']))
    {
        
        $chkarr=$_POST['deleteKey'];
        $count=count($chkarr);
        foreach ($chkarr as $id)
        {   
            
         
           
            $sql="select emp_id,pay_id,start_date,end_date,work_hours,ot_hours,salary from tbl_payhistory where pay_id=$id";
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_array($result))
            {
            $empid=(int)$row['emp_id'];
            $payid=(int)$row['pay_id'];
            $sdate=$row['start_date'];
            $edate=$row['end_date'];
            $wh=(double)$row['work_hours'];
            $ot=(double)$row['ot_hours'];
            $sal=(double)$row['salary'];
            $paystat="Amend";

           
            $sql2="insert into tbl_payments values ($payid,$empid,'$sdate','$edate',$wh,$ot,$sal,'$paystat');";
            mysqli_query($conn,$sql2);

            $sql3="delete from tbl_payhistory where pay_id=$id";
            mysqli_query($conn,$sql3);
            }
            
        echo "<script> 
     
        
        alert('Succesfully sent to revise $count Payment record(s)');
        window.location.replace(\"payhistory.php\");
        
        </script>";

   
        }
    }
else{

    echo "<script> 
     
        
        alert('Select a payment record to amend!');
        window.history.back();
        
        </script>";

}


?>