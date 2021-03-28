<?php
session_start();
if (isset($_SESSION['id'])) {
    require_once __DIR__ . '\connection\connect.php';
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <title>dashboard</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css" />

        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="css/custom.css" />

        <!-- Font Awesome JS -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    </head>

    <body>

        <nav class="navbar navbar-light bg-dark">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="navbar-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <span class="text-white h3">Courses</span>
                <form class="d-flex">
                    <a href="logout.php">
                        <button class="btn btn-outline-success" type="button">Log Out</button>
                    </a>
                </form>
            </div>
        </nav>

        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <ul class="list-unstyled components">
                    <div class="sidebar-header">
                        <h3><?php echo "$name"; ?></h3>
                    </div>
                    <p class="h4">Courses</p>
                    <?php
                    $sql = "SELECT course_name,course_code FROM courses WHERE id=" . $_SESSION['id'];
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <li>
                            <a href="coursetable.php?course=<?php echo $row['course_code']; ?>"><?php echo $row['course_name']; ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>

            <!-- Page Content Holder -->

            <div id="content">
                <?php
                if (isset($_GET['error'])) {
                ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Error Occurred</strong>
                        <span class="btn-close closebtn" onclick="this.parentElement.style.display='none';" aria-label="Close"></span>
                    </div>
                <?php } ?>
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <?php
                    $sql = "SELECT course_name,course_code,batch FROM courses WHERE id=$id ORDER BY batch DESC";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <a href="coursetable.php?course=<?php echo $row['course_code']; ?>">
                            <div class="col">
                                <div class="card h-100">
                                    <img src="images/nituk2.jpg" class="card-img-top" alt="img">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row['course_name'] ?></h5>
                                        <p class="card-text"><?php echo $row['course_code'] ?><br><?php echo $row['batch'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php  } ?>
                </div>
            </div>
        </div>
    <?php
} else {
    header('Location: index.php?error=INVALID USER');
    exit();
}
    ?>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#sidebarCollapse").on("click", function() {
                $("#sidebar").toggleClass("active");
                $(this).toggleClass("active");
            });
        });
    </script>

    </body>

    </html>