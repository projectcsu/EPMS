<?php

require 'mysql.php';


  $userid=(int)$_POST["userId"];
  $username=$_POST["userName"];
  $userPwd=$_POST["userPwd"];
  $pass=md5($userPwd);
  $atype=$_POST["atype"];

  if((!empty($userid) && !empty($username) && !empty($userPwd) && !empty($atype))){
      
    mysqli_query($conn,"insert into tbl_User VALUES ($userid,'$username','$pass','$atype')");
    
    echo "<script> 
     
        
        alert('Succesfully Added User $username');
        window.location.replace(\"useraccounts.php\");
        
        </script>";
    
  }
  
  else
  {
    echo "<script> 
     
        
        alert('Error adding User, Please ensure all the fields are correctly entered.');
        window.history.back();
        
        </script>";
 
  }
mysqli_close($conn);


?>