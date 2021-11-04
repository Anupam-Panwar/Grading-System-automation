<?php
session_start();
if (isset($_SESSION['id'])) {
    require_once __DIR__ . '/connection/connect.php';
    $id = $_GET['id'];
    $name = $_SESSION['name'];
?>
    <!DOCTYPE html>
    <html>

    <head>
        <?php
        require __DIR__ .'/utility/head_info.php';
        ?>
        <title>Teacher Courses Admin</title>

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
                            <h3><?php echo "Admin"; ?></h3>
                        </div>
                        <a href="dashboard_admin.php">
                            <p class="h4">Teachers</p>
                        </a>
                        <?php
                        $sql = "SELECT id,username FROM users";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            if ($row['username'] == "Admin") {
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
                <button type="button" id="addIcon" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa fa-plus"></i>
                </button>
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
                    $sql = "SELECT course_name,course_code,batch FROM courses WHERE id=$id ORDER BY batch DESC";
                    $result = $conn->query($sql);
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <div class="col">
                                <div class="card h-100">
                                    <a href="coursetable.php?course=<?php echo $row['course_code']; ?>">
                                        <img src="images/img<?php echo $i ?>.jpg" class="card-img-top" alt="Course Image">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $row['course_name'] ?></h5>
                                            <p class="card-text"><?php echo $row['course_code'] ?><?php echo " | ".$row['batch'] ?></p>
                                        </div>
                                    </a>
                                    <div class="button mt-2 d-flex flex-row align-items-center p-2"> 
                                        <button class="btn btn-sm btn-outline-primary w-100">Edit</button> 
                                        <button class="btn btn-sm btn-primary w-100 ml-2" type="button" data-bs-toggle="modal" data-bs-target="#delete">Delete</button> 
                                    </div>
                                </div>
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
        <!-- Modal for plus button -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Course</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
                            <button type="button" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal for delete -->
            <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
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
    </script>

    </body>

    </html>