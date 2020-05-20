<?php

require'mysql.php';


  $userid=(int)$_POST["userId"];
  $username=$_POST["userName"];
  $userPwd=$_POST["userPwd"];
  $pass=md5($userPwd);
  $atype=$_POST["atype"];

 if("" == trim($_POST['userName']) && isset($_POST['userPwd']))
{
   
    echo "<script> 
     
        
        alert('User Name Cannot be Empty');
        window.history.back();
        
        </script>";
}
else if("" == trim($_POST['userPwd']) && isset($_POST['userName']))
{
    $sql="update tbl_User SET user_name='$username',userType='$atype' where userId=$userid";
    mysqli_query($conn,$sql);
    
    echo "<script> 
     
        
        alert('Succesfully Updated User $username');
        window.location.replace(\"useraccounts.php\");
        
        </script>";
}

else if(isset($_POST['userPwd'])){
$sql="update tbl_User SET userPwd='$pass',userType='$atype' where userId=$userid";
mysqli_query($conn,$sql);
    
    echo "<script> 
     
        
        alert('Succesfully Updated User $username');
        window.location.replace(\"useraccounts.php\");
        
        </script>";
}

mysqli_close($conn);

?>