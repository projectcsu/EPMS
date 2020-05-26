<?php
require 'mysql.php';
session_start(); 

if (isset($_POST['submit'])) {
    //Check whether username and password is empty
    if (empty($_POST['username']) || empty($_POST['password'])) {
        //store error message in a global variable 'error' - used to display error message in login page
        $_SESSION['error'] = "Username or Password is invalid";
        //redirect to login page
        header("Location: index.php");
    }
    else{
        //Fetch values from textboxes
        $userid = $_POST['username'];
        $password = $_POST['password'];
        //Encrypt password with MD5
        $password1=md5($password);
        // Declare User type variable
        $userType ='';
        //Store userid in global variable
        $_SESSION['userid']=$userid;
        //mysql query and function to fetch query information
        $query = "SELECT user_name , userPwd, userType from tbl_User where userId=? AND userPwd=?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $userid, $password1);
        $stmt->execute();
        $stmt->bind_result($username, $password1,$userType);
        $stmt->store_result();
            //on sql success redirect to home page
            if($stmt->fetch()) {
                $_SESSION['login_user'] = $username; 
                $_SESSION['userType'] = $userType;
                header("location: home.php"); 
            }
            //on failure redirect to login page
            else{

                $_SESSION['error']= "Invalid Password";
                header("location: index.php");
            }
    }
mysqli_close($conn);
}
?>