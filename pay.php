<?php
//get DB connection
require 'mysql.php';
//check if checkboxes is selected
if(isset($_POST['deleteKey']))
{     
      //get checkbox assigned value (payment id
      $chkarr=$_POST['deleteKey'];
      $count=count($chkarr);
      //loop through deletekey array
      foreach ($chkarr as $id){ 
      //Do payment query
      $sql="update tbl_payhistory SET paystat='Paid' where pay_id=$id";
      //check query and run
      if(mysqli_query($conn,$sql)){
          //user javascript inside php to display messagebox and redirect page
          echo "<script>  
              alert('Succesfully paid - $id');
              window.location.replace(\"payhistory.php\");
              </script>";
        }
        else{
          //user javascript inside php to display messagebox and redirect page
          echo "<script>    
              alert('Error paying $id, Please check the connection.');
              window.location.replace(\"payhistory.php\");
              </script>";
        }
      }
}
else{
  //user javascript inside php to display messagebox and redirect page
      echo "<script>  
      alert('Please select payment record to process');
      window.history.back();
      </script>";
}
mysqli_close($conn);
?>