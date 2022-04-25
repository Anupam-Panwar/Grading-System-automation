<?php
    require_once __DIR__ .'/connection/connect.php';
    session_start();
    if(isset($_SESSION['id']))
    {
        header('Location: index.php?error=Multiple Login is not allowed');
        exit();
    }
    if(isset($_POST['email']) && isset($_POST['password']))
    {
        function validate($data)
        {
            $data=trim($data);
            $data=stripslashes($data);
            $data=htmlspecialchars($data);
            return $data;
        }
        $mail=validate($_POST['email']);
        $pass=validate($_POST['password']);

        if(empty($mail))
        {
            header('Location: index.php?error=Email required');
            exit();
        }
        else if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) 
        {
            header('Location: index.php?error=Invalid Email');
            exit();
        }
        else if(empty($pass))
        {
            header('Location: index.php?error=Password required');
            exit();
        }
        else
        {
            $sql="SELECT * FROM users WHERE email='$mail' AND password='$pass'";
            $result = $conn->query($sql);
            if ($result->num_rows==1) 
            {
                $row=$result->fetch_assoc();
               
                if($row['email']===$mail&&$row['password']===$pass)
                {
                    
                    $_SESSION['id']=$row['id'];
                    $_SESSION['name']=$row['username'];
                    $_SESSION['image_url']=$row['image_url'];
                    $_SESSION['level']=$row['level'];
                    $_SESSION['dept'] = $row['department'];

                    if($_SESSION['level'] == 1)
                    {
                        header('Location: dashboard_admin.php');
                        exit();
                    }
                    else if($_SESSION['level'] == 2)
                    {
                        header('Location: dashboard_hod.php');
                        exit();
                    }
                    else
                    {
                        header('Location: dashboard.php');
                        exit();
                    }
                }
                else
                {
                    header('Location: index.php?error=Incorrect Email or Password');
                    exit();
                }
            }
            else
            {
                header('Location: index.php?error=Incorrect Email or Password');
                exit();
            }
        }
    }
    else
    {
       
        header('Location:index.php?error=Enter data');
    }
    require_once __DIR__.'/connection/disconnect.php';
?>