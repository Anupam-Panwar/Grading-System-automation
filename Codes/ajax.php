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
    else if($_POST['ajax'] == '5')
    {
        $id = $_POST['id'];
       
        $sql = "SELECT course_name FROM courses WHERE course_code="."'". $id."'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $result = ["course_name" => $row['course_name']];
            echo json_encode($result);
        }
    }
    else if($_POST['ajax'] == '6')
    {
        $id = $_POST['id'];
        $sql = "DELETE FROM courses WHERE course_code="."'". $id."'";
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
    else if($_POST['ajax'] == '7')
    {
        $id = $_POST['id'];
        $sql = "SELECT course_name,course_code,batch,semester FROM courses WHERE course_code="."'". $id."'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $result = ["course_name" => $row['course_name'],"course_code" => $row['course_code'],"year" => $row['batch'],"semester" => $row['semester']];
            echo json_encode($result);
        }
        exit();
    }
    else if($_POST['ajax'] == '8')
    {
        $id = $_POST['id'];
        $course_name = $_POST['course_name'];
        $course_code = $_POST['course_code'];
        $year = $_POST['year'];
        $semester = $_POST['semester'];
        $sql = "UPDATE courses SET course_name='" . $course_name . "',course_code='" . $course_code . "',batch='" . $year . "',semester='" . $semester . "' WHERE course_code="."'". $id ."'";
        if ($conn->query($sql) === TRUE)
        {
            echo "hua gaya guys";
            exit();
        } 
        else
        { 
            echo "nahi hua gaya guys";
            exit();
        }
    }
}
require_once __DIR__ . '/connection/disconnect.php';