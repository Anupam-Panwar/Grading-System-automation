<?php
    
    require_once 'connect.php';

    session_start();

    $user=$_POST["username"];
    $pass=$_POST["password"];


    $query = "SELECT `password` FROM `data` WHERE `username`='$user'";
    $result = $mysqli->query($query);


    $row = $result->fetch_assoc();
    
    if($pass==$row["password"])
    {
        $_SESSION["username"]=$user;
        header('Location:dashboard.php');
    }
    else
    {
        $_SESSION["error"] = "Wrong password!";
        header('Location:index.php');
    }
    require_once 'diconnect.php';
    
?>