<?php
    
    $mysqli = new mysqli('localhost', 'root', 'slpappndb', 'example');

    if(!$mysqli)
    {
        die("Unable to connect to MySQL: " . mysqli_error($mysqli));
    }
    
?>
