<?php
//include db connection
require'mysql.php';
//Fetch data from textboxes
$pid=(int)$_POST["userId"];
$pname=$_POST["username"];
$ppwd=md5($_POST["userPwd"]);
    //check if user updated only name
    if(isset($_POST['username']) && "" == trim($_POST['userPwd']))
    {   
        //query to update only username
        mysqli_query($conn,"update tbl_User SET user_name='$pname' where userid=$pid");
        //alertbox to confirm logout upon update of details
        echo "<script>
        alert('Succesfully Updated Account Name');
              if (confirm('Do you want to logout to make changes?') == true) {
                window.location.replace(\"logout.php\");
              } 
              else{
                window.location.replace(\"myprofile.php\");
              }
        </script>";
    }
    //check if user leave name area empty
    else if(isset($_POST['userPwd']) && "" == trim($_POST['username'])){
        echo "<script> 
              alert('Account name Cannot be empty');
              window.history.back();
        </script>";
    }
    //check if all textboxes are empty
    else if( "" == trim($_POST['userPwd']) || "" == trim($_POST['username'])){
      echo "<script> 
          alert('Error updating Account details, Please ensure all the fields are correctly entered.');
          window.history.back();
      </script>";
    }
    //check if all textboxes filled
    else if(isset($_POST['username']) && isset($_POST['userPwd'])){
      //update query to set all fields
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