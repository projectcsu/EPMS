<?php

require'mysql.php';

$stafftype=$_POST["stafftype"];
$wrate=$_POST["wrate"];
$orate=$_POST["orate"];


$sql="update tbl_payrates SET pay_rate='$wrate',ot_rate='$orate' where staff_type='$stafftype'";
if(mysqli_query($conn,$sql))
  {
    
    echo "<script> 
     
        
        alert('Succesfully Updated Payrates for $stafftype Staff');
        window.location.replace(\"staff.php\");
        
        </script>";
    
  }
  
  else
  {
    echo "<script> 
     
        
        alert('Error updating rate, Please ensure all the fields are correctly entered');
        window.history.back();
        
        </script>";
 
  }
mysqli_close($conn);

?>