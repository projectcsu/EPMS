<?php

require'mysql.php';

    
if(isset($_POST['deleteKey']))
    {
        $chkarr=$_POST['deleteKey'];
        $count=count($chkarr);
        foreach ($chkarr as $id)
        {
           
            $result=mysqli_query($conn,"select emp_id from tbl_payments where emp_id=$id");
                $row=mysqli_fetch_array($result);

                    if($row["emp_id"] =="")
                    {   
                    $sql="Delete from tbl_employees where emp_Id=".$id;
                    mysqli_query($conn,$sql);
                    echo "<script> 
                 
                    
                    alert('Succesfully Deleted $count record(s)');
                    window.location.replace(\"employees.php\");
                    
                    </script>";
            
                    
                    }
                    else{
                    echo "<script> 
                 
                    
                    alert('Please do ongoing payment before deleting Employee');
                    window.location.replace(\"employees.php\");
                    
                    </script>";

                    }
                
            
            
        }
    }

else{
    echo "<script> 
                 
                    
    alert('Please select an employee to process delete');
    window.history.back();
    
    </script>";


}

?>