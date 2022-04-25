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
            echo "Error deleting user";
            exit();
        } 
        else
        { 
            echo "Successfully Deleted User";
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
            echo "Error updating user";
            exit();
        } 
        else
        { 
            echo "Successfully Updated User";
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
            echo "Error deleting course";
            exit();
        } 
        else
        { 
            echo "Successfully Deleted Course";
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
            echo "Successfully Updated Course";
            exit();
        } 
        else
        { 
            echo "Error updating course details";
            exit();
        }
    }
    else if($_POST['ajax'] == '9')
    {
        $rn = $_POST['id'];
        $cd = $_POST['cd'];
        if($rn)
        {
            $sql1 = "DELETE FROM controlsheet WHERE course_code='$cd' AND roll_no='$rn'";
            if ($conn->query($sql1) !== TRUE)
            {
                echo $conn->error;
                exit();
            }
            else
            { 
                echo "Student deleted";
                exit();
            }
        }
        else
        {
            echo "done";
        }
    }
    else if($_POST['ajax'] == '10')
    {
        $id = $_POST['id'];
        $sql = "SELECT mt1 FROM flag WHERE user_id =".$id;
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $res = intval($row['mt1']);
        $set = 1-$res;
        $sql = "UPDATE flag SET mt1=" . $set . " WHERE user_id =" . $id;
        if ($conn->query($sql) === TRUE)
        {
            if($set==0) {
                echo "Successfully Unfreezed MT1 Marks";
            } else {
                echo "Successfully Freezed MT1 Marks";
            }
            exit();
        } 
        else
        { 
            echo "Error updating flag";
            exit();
        }
    }
    else if($_POST['ajax'] == '11')
    {
        $id = $_POST['id'];
        $sql = "SELECT mt2 FROM flag WHERE user_id =".$id;
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $res = intval($row['mt2']);
        $set = 1-$res;
        $sql = "UPDATE flag SET mt2=" . $set . " WHERE user_id =" . $id;
        if ($conn->query($sql) === TRUE)
        {
            if($set==0) {
                echo "Successfully Unfreezed MT2 Marks";
            } else {
                echo "Successfully Freezed MT2 Marks";
            }
            exit();
        } 
        else
        { 
            echo "Error updating flag";
            exit();
        }
    }
    else if($_POST['ajax'] == '12')
    {
        $id = $_POST['id'];
        $sql = "SELECT ct FROM flag WHERE user_id =".$id;
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $res = intval($row['ct']);
        $set = 1-$res;
        $sql = "UPDATE flag SET ct=" . $set . " WHERE user_id =" . $id;
        if ($conn->query($sql) === TRUE)
        {
            if($set==0) {
                echo "Successfully Unfreezed CT Marks";
            } else {
                echo "Successfully Freezed CT Marks";
            }
            exit();
        } 
        else
        { 
            echo "Error updating flag";
            exit();
        }
    }
    else if($_POST['ajax'] == '13')
    {
        $id = $_POST['id'];
        $sql = "SELECT et FROM flag WHERE user_id =".$id;
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $res = intval($row['et']);
        $set = 1-$res;
        $sql = "UPDATE flag SET et=" . $set . " WHERE user_id =" . $id;
        if ($conn->query($sql) === TRUE)
        {
            if($set==0) {
                echo "Successfully Unfreezed ET Marks";
            } else {
                echo "Successfully Freezed ET Marks";
            }
            exit();
        } 
        else
        { 
            echo "Error updating flag";
            exit();
        }
    }
}
require_once __DIR__ . '/connection/disconnect.php';