<?php

require'mysql.php';

$pid=(int)$_POST["userId"];
$pname=$_POST["username"];
$ppwd=md5($_POST["userPwd"]);



   
    if(isset($_POST['username']) && "" == trim($_POST['userPwd']))
    {
    
        mysqli_query($conn,"update tbl_User SET user_name='$pname' where userid=$pid");
    
        echo "<script> 
     
        
        alert('Succesfully Updated Account Name');


        if (confirm('Do you want to logout to make changes?') == true) {
          window.location.replace(\"logout.php\");
        } else {
          window.location.replace(\"myprofile.php\");
        }
    
      
        
        </script>";
        
        
    }
    else if(isset($_POST['userPwd']) && "" == trim($_POST['username'])){
    
    
        echo "<script> 
     
        
        alert('Account name Cannot be empty');

        window.history.back();

        </script>";
        
    }
    else if( "" == trim($_POST['userPwd']) || "" == trim($_POST['username']))
    {
      echo "<script> 
      
          
          alert('Error updating Account details, Please ensure all the fields are correctly entered.');
          window.history.back();
          
          </script>";

    }
      else if(isset($_POST['username']) && isset($_POST['userPwd'])){
      $sql="update tbl_User SET user_name='$pname',userPwd='$ppwd' where userid=$pid";
      
      mysqli_query($conn,$sql);
      
      echo "<script> 
       
          
          alert('Succesfully Updated Account $pid');
  
  
          if (confirm('Do you want to logout to make changes?') == true) {
            window.location.replace(\"logout.php\");
          } else {
            window.location.replace(\"myprofile.php\");
          }
      
        
          
          </script>";
      }


mysqli_close($conn);

?>