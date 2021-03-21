<?php
    
    require_once 'login.php';

    session_start();

    $user=$_POST["username"];
    $pass=$_POST["password"];

    $mysqli = new mysqli($db_hostname, $db_username, $db_password);
    if(!$mysqli)
    {
        die("Unable to connect to MySQL: " . mysqli_error($mysqli));
    }

    $mysqli->select_db("$db_database");

    $query = "SELECT `password` FROM `data` WHERE `username`='$user'";
    $result = $mysqli->query($query);

    if ($mysqli->error) {
        die($mysqli->error);
    }

    $row = $result->fetch_assoc();
    
    if($pass==$row["password"])
    {
        $_SESSION["username"]=$user;
        header('Location:dashboard.php');
        //header('Location:dashboard.php?username='.$user);
    }
    else
    {
        //echo "<script language='javascript'>";
        //echo "alert('Wrong Password!')";
        //echo "</script>";
        //die();
        $_SESSION["error"] = "Wrong password!";
        header('Location:index.php');
    }
    mysqli_close($mysqli);
    
?>