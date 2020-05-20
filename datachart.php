<?php
 
 require 'mysql.php';


 $dataPoints = array();

 
     $query = "SELECT COUNT(DISTINCT emp_Id) total,
               COUNT(DISTINCT CASE WHEN staff_type = 'Academic'   THEN emp_Id END) Academic,
               COUNT(DISTINCT CASE WHEN staff_type = 'Non-Academic' THEN emp_Id END) NAcademic
               FROM tbl_employees";
     $result = mysqli_query($conn, $query);

     $row = mysqli_fetch_array($result);
              
      
            $point = array("y" =>  $row['Academic'] ,"label" =>  "Academic");
            $point2 = array("y" =>  $row['NAcademic'] ,"label" =>  "Non-Academic");
            array_push($dataPoints, $point);
            array_push($dataPoints, $point2);

    
?>