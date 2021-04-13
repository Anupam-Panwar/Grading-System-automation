<!DOCTYPE html>
<html>
<head>
    <?php
    require 'head_info.php';
    ?>
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
                        <img src="images/logo0.png" class="img-fluid" style="width:35%; height:35%;" alt="NIT UK Logo">
                        
                            <p class="text-muted"> Please enter your Email and Password !</p>
                        <?php if (isset($_GET["error"])) {
                       
                             if(($_GET["error"])!='Logged out')
                             {
                                 ?>
                            <div class="alert">
                                <strong>Error!!</strong> <?php echo $_GET['error']; ?>
                                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                            </div>
                            <?php }
                            else
                            {
                                ?>
                                <div class="alert logout">
                                <?php echo $_GET['error']; ?>
                                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                            </div>

                        <?php }} ?>
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