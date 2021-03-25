<?php
    $server_name="localhost";
    $host_name="root";
    $password="";
    $database="gradingautomation";
    $conn = new mysqli($server_name,$host_name,$password,$database);

    if(!$conn)
    {
        die("Unable to connect to MySQL: " . mysqli_error($conn));
    }
    
?>
