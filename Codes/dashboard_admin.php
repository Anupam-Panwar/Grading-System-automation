<?php
session_start();
if (isset($_SESSION['id'])) {
    require_once __DIR__ . '/connection/connect.php';
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
?>
    <!DOCTYPE html>
    <html>

    <head>
        <?php
        require __DIR__ .'/utility/head_info.php';
        ?>
        <title>Dashboard_admin</title>

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
                <span class="text-white h3">Teachers</span>
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
                        <h3><?php echo "Admin"; ?></h3>
                    </div>
                    <a href="dashboard.php">
                        <p class="h4">Teachers</p>
                    </a>
                    <?php
                    $sql = "SELECT id,username FROM users";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        if($row['username'] == "Admin")
                        {
                            continue;
                        }
                    ?>
                        <li>
                        <a class="dropdown-btn"><?php echo $row['username']; ?></a>
                        <ul class="dropdown-container">
                            <?php
                            $sql1 = "SELECT course_name, course_code FROM courses WHERE id=" . $row['id'];
                            $result1 = $conn->query($sql1);
                            while ($row1 = $result1->fetch_assoc()) {
                            ?>
                            <li>
                                <a href="coursetable.php?course=<?php echo $row1['course_code']; ?>">
                                <?php echo $row1['course_name']; ?>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
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
                        <strong><?php echo $_GET['error']; ?></strong>
                        <span class="btn-close closebtn" onclick="this.parentElement.style.display='none';" aria-label="Close"></span>
                    </div>
                <?php } ?>
                <div class="row row-cols-1 row-cols-md-5 g-4">
                    <?php
                    $sql = "SELECT id,username FROM users";
                    $result = $conn->query($sql);
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        if($row['username'] == "Admin")
                        {
                            continue;
                        }
                    ?>
                        <div class="col">
                            <a href="dashboard.php?id=<?php echo $row['id']; ?>">
                                <div class="card h-100">
                                    <img src="images/img<?php echo $i ?>.jpg" class="card-img-top" alt="Course Image">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row['username'] ?></h5>
                                        <?php
                                        $sql1 = "SELECT course_code FROM courses WHERE id=" . $row['id'];
                                        $result1 = $conn->query($sql1);
                                        $courseno = $result1->num_rows;
                                        ?>
                                        <p class="card-text">Courses: <?php echo $courseno ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php
                        if ($i == 11) {
                            $i = 0;
                        }
                        $i++;
                    } ?>
                </div>
            </div>
        </div>
    <?php
} else {
    header('Location: index.php?error=INVALID USER');
    exit();
}
    ?>
    <?php
    require_once __DIR__ . '/connection/disconnect.php';
    require __DIR__ .'/utility/foot_info.php';
    ?>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#sidebarCollapse").on("click", function() {
                $("#sidebar").toggleClass("active");
                $(this).toggleClass("active");
            });
        });
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;
        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
                } else {
                dropdownContent.style.display = "block";
                }
            });
        }
    </script>

    </body>

    </html>