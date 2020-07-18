<?php  

    include 'Connection.php';

    $Name=  $_REQUEST["Name"];
    $Mobile=  $_REQUEST["Mobile"];
    
    $result=$con->query("select * from register where name='$Name' and mobile='$Mobile'");

    $rowcount= $result->num_rows;
    
    if($rowcount==1)
    {
        $row =$result->fetch_object();
        
        echo json_encode($row);
        
    }
    else
    {
        echo "invalid username or password";
    }
            
