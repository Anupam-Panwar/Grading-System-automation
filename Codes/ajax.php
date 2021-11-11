<?php
require_once __DIR__ . '/connection/connect.php';
if (isset($_POST['ajax']) && isset($_POST['id'])) 
{
    if($_POST['ajax'] == '1')
    {
        $id = $_POST['id'];
       
        $sql = "SELECT username FROM users WHERE id=" . $id;
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $result = ["name" => $row['username']];
            echo json_encode($result);
        }
        exit;
    }
    else if($_POST['ajax'] == '2')
    {
        $id = $_POST['id'];
        $sql = "DELETE FROM users WHERE id=" . $id;
        if ($conn->query($sql) !== TRUE)
        {
            echo "nahi hua gaya guys";
            exit();
        } 
        else
        { 
            echo "hua gaya guys";
            exit();
        }
    }
    else if($_POST['ajax'] == '3')
    {
        $id = $_POST['id'];
        $sql = "SELECT username,password,email FROM users WHERE id=" . $id;
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $result = ["name" => $row['username'],"password" => $row['password'],"email" => $row['email']];
            echo json_encode($result);
        }
    }
    else if($_POST['ajax'] == '4')
    {
        $id = $_POST['id'];
        $username = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $sql = "UPDATE users SET username='" . $username . "',password='" . $password . "',email='" . $email . "' WHERE id=" . $id;
        if ($conn->query($sql) !== TRUE)
        {
            echo "nahi hua gaya guys";
            exit();
        } 
        else
        { 
            echo "hua gaya guys";
            exit();
        }
    }
}
require_once __DIR__ . '/connection/disconnect.php';