<?php
 
 require 'mysql.php';


 $dataPoints2 = array();

 
     $query = "
     select t1.rows as payhis, t2.rows  as payments
         from (
                select count(*) as `rows`
                from tbl_payhistory where paystat='Not-Paid'
              ) as t1
         cross join (
                 select count(*) as `rows`
                 from tbl_payments
                    ) as t2 
      ";
     $result = mysqli_query($conn, $query);

     $row = mysqli_fetch_array($result);
              
      
            $point = array("y" =>  $row['payhis'] ,"label" =>  "Payments to be approved");
            $point2 = array("y" =>  $row['payments'] ,"label" =>  "Ongoing payments");
            array_push($dataPoints2, $point);
            array_push($dataPoints2, $point2);

    
?>