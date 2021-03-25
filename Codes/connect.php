<?php
    
    $mysqli = new mysqli('localhost', 'root', '', 'gradingautomation');

    if(!$mysqli)
    {
        die("Unable to connect to MySQL: " . mysqli_error($mysqli));
    }
    
?>
