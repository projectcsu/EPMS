<?php
//get db connection
require'mysql.php';
//check if checkboxes are selected
if(isset($_POST['deleteKey'])){
        $chkarr=$_POST['deleteKey'];
        $count=count($chkarr);
        //loop through deleteKey array
        foreach ($chkarr as $id){
                //fetch selected row from payments table 
                //* user's not allowed to delete employee when there is a an ongoing payment for the selected employee
                $result=mysqli_query($conn,"select emp_id from tbl_payments where emp_id=$id");
                $row=mysqli_fetch_array($result);
                    //check if there is an ongoing payment
                    if($row["emp_id"] ==""){   
                    //delete employee if no ongoing payment
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