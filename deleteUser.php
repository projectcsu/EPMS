<?php

require'mysql.php';

    
if(isset($_POST['deleteKey']))
    {
        $chkarr=$_POST['deleteKey'];
        $count=count($chkarr);
        foreach ($chkarr as $id)
        {
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