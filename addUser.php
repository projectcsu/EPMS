<?php

require 'mysql.php';
//get values from textboxes
  $userid=(int)$_POST["userId"];
  $username=$_POST["userName"];
  $userPwd=$_POST["userPwd"];
  $pass=md5($userPwd);
  $atype=$_POST["atype"];
//check if textboxes are filled
  if((!empty($userid) && !empty($username) && !empty($userPwd) && !empty($atype))){
      //check if employee id is unique - * validated in db
      if(mysqli_query($conn,"insert into tbl_User VALUES ($userid,'$username','$pass','$atype')")){
        echo "<script> 
            alert('Succesfully Added User $username');
            window.location.replace(\"useraccounts.php\");
            </script>";
        }
        else{
          //js to display messageboxsc
          echo "<script> 
            alert('Duplicate User ID, try new ID');
            window.history.back();
            </script>";
        }
  }
  else{
    echo "<script> 
        alert('Error adding User, Please ensure all the fields are correctly entered.');
        window.history.back();   
        </script>";
  }
mysqli_close($conn);
?>