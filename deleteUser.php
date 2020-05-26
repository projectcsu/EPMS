<?php
//Get DB Connection
require'mysql.php';
//check if checkbox is checked
if(isset($_POST['deleteKey'])){
        $chkarr=$_POST['deleteKey'];
        $count=count($chkarr);
        //Loop through array to get user id
        foreach ($chkarr as $id){
            //delete query to delete selected row
            $sql="Delete from tbl_User where userId=".$id;
            echo "<script> 
            alert('Succesfully Deleted $count user account(s)');
            window.location.replace(\"useraccounts.php\");
            </script>";
        mysqli_query($conn,$sql);
        }
}
else{
        echo "<script>         
        alert('Please select an user account to delete');
        window.history.back();
        </script>";
}
?>