<?php
//get db connection
require'mysql.php';
//check whether checkbox is selected
if(isset($_POST['deleteKey'])){
        //get checkbox assigned value
        $chkarr=$_POST['deleteKey'];
        $count=count($chkarr);
        //loop through array deletekey
        foreach ($chkarr as $id){   
            //select selected row from db
            $sql="select emp_id,pay_id,start_date,end_date,work_hours,ot_hours,salary from tbl_payhistory where pay_id=$id";
            $result=mysqli_query($conn,$sql);
            //get values from db
            while($row=mysqli_fetch_array($result)){
            $empid=(int)$row['emp_id'];
            $payid=(int)$row['pay_id'];
            $sdate=$row['start_date'];
            $edate=$row['end_date'];
            $wh=(double)$row['work_hours'];
            $ot=(double)$row['ot_hours'];
            $sal=(double)$row['salary'];
            $paystat="Amend";

            //insert selected row(s) to payments table
            $sql2="insert into tbl_payments values ($payid,$empid,'$sdate','$edate',$wh,$ot,$sal,'$paystat');";
            mysqli_query($conn,$sql2);
            //delete paymetn record from payments admin panel
            $sql3="delete from tbl_payhistory where pay_id=$id";
            mysqli_query($conn,$sql3);
            }  
        echo "<script>  
        alert('Succesfully sent to revise $count Payment record(s)');
        window.location.replace(\"payhistory.php\"); 
        </script>";
        }
    }
//if checkbox not selected display message
else{
        echo "<script> 
        alert('Select a payment record to amend!');
        window.history.back();
        </script>";
}
?>