<?php
    session_start();
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
                    <form class="box" action="validate.php" method="POST">
                        <h1>Login</h1>
                        <p class="text-muted"> Please enter your Username and Password !</p>
                         <input type="text" name="username" placeholder="Username"> 
                         <input type="password" name="password" placeholder="Password"> 
                         <?php
                         if(isset($_SESSION["error"]))
                         {
                            $error = $_SESSION["error"];
                            echo "<span>$error</span>";
                            echo "<br><br>";
                         }
                         ?>
                         <a class="forgot text-muted" href="#">Forgot password?</a> 
                         <input type="submit" name="" value="Login" href="#">  
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
    session_unset();
?>