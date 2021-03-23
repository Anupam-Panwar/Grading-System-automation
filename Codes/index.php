<?php

    require_once 'connect.php';
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $user=$_POST["username"];
        $pass=$_POST["password"];
        $query = "SELECT `password` FROM `users` WHERE `username`='$user'";
        $result = $mysqli->query($query);
        $row = $result->fetch_assoc();
        if($pass==$row["password"])
        {
            header('Location:dashboard.php?username='.$user);
        }
        else
        {
            //error code
        }
    }
    require_once 'disconnect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="css/indexcss.css">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <form class="box" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <img src="images/logo0.png" class="img-fluid" style ="width:35%; height:35%;"alt="...">
                        <p class="text-muted"> Please enter your Username and Password !</p>
                         <input type="text" name="username" placeholder="Username"> 
                         <input type="password" name="password" placeholder="Password"> 
                         <span class="text-muted">Forgot password? Contact Admin</span> 
                         <input type="submit" name="" value="Login" href="#"> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>