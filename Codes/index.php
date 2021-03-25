<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Our Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/indexcss.css">

    <title>Login Page</title>
    
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <form class="box" action="validate.php" method="POST">
                        <img src="images/logo0.png" class="img-fluid" style="width:35%; height:35%;" alt="...">
                        <?php if (isset($_GET["error"])) {
                        ?>
                            <p class="text-muted"> Please enter your Email and Password !</p>
                            <div class="alert">
                                <strong>Error!!</strong> <?php echo $_GET['error']; ?>
                                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                            </div>
                        <?php } ?>
                        <input type="text" name="email" placeholder="Email">
                        <input type="password" name="password" placeholder="Password">
                        <span class="text-muted">Forgot password? Contact Admin</span>
                        <input type="submit" value="Login">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>