<?php

require'mysql.php';

if(isset($_POST['deleteKey']))
{
$chkarr=$_POST['deleteKey'];
$count=count($chkarr);
foreach ($chkarr as $id){ 
$sql="update tbl_payhistory SET paystat='Paid' where pay_id=$id";

if(mysqli_query($conn,$sql))
  {
    
    echo "<script> 
     
        
        alert('Succesfully paid - $id');
        window.location.replace(\"payhistory.php\");

        </script>";
    
  }
  
  else
  {
    echo "<script> 
     
        
        alert('Error paying $id, Please check the connection.');
        window.location.replace(\"payhistory.php\");
        
        </script>";
 
  }

}
}
else{

  echo "<script> 
     
        
  alert('Please select payment record to process');
  window.history.back();
  
  </script>";




}
mysqli_close($conn);







?>