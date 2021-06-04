<?php
    session_start();
    if(isset($_SESSION['id']))
    {
        require_once __DIR__ . '/connection/connect.php';
        if (isset($_GET['course']))
        {
            $cd = $_GET['course'];
            $sql = "SELECT id FROM courses WHERE course_code='$cd'";
            $result = $conn->query($sql);
            if ($result->num_rows==1) 
            {
                $row=$result->fetch_assoc();
                if($_SESSION['id']!=$row['id'])
                {
                    header('Location: dashboard.php?error=COURSE NOT FOUND');
                    exit();
                }
            }
            else
            {
                header('Location: dashboard.php?error=COURSE NOT FOUND');
                exit();
            }
            $sql="UPDATE controlsheet SET grade='' WHERE course_code='$cd'";
            if ($conn->query($sql) !== TRUE)
            {
                header('Location: coursetable.php?course='.$cd.'&error='.$conn->error);
                exit();
            } 
            require_once __DIR__ . '/connection/disconnect.php';
            header('Location: coursetable.php?course='.$cd);
            exit();
        }
        else  
        {
            header('Location: edit.php?error=ERROR OCCURRED : Not a valid course code ');
            exit();
        }
    }  
    else
    {
        header('Location: index.php?error=INVALID REQUEST');
        exit();
    }
?>