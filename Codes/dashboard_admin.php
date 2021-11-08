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
            require __DIR__ . '/utility/head_info.php';
            ?>
            <title>Dashboard_admin</title>

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="css/bootstrap.min.css" />

            <!-- CSS for Icon -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
                                <a class="dropdown-btn"><?php echo $row['username']; ?>
                                    <i class="fa fa-caret-down"></i>
                                </a>
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
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xxl-3 g-4">
                        <?php
                        $sql = "SELECT id, username, email FROM users";
                        $result = $conn->query($sql);
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            if ($row['username'] == "Admin") {
                                continue;
                            }
                            $sql1 = "SELECT course_code FROM courses WHERE id=" . $row['id'];
                            $result1 = $conn->query($sql1);
                            $course_count = $result1->num_rows;
                        ?>
                            <div class="col">
                                <span>
                                    <div class="container mt-4 d-flex justify-content-center card h-100 ps-3">
                                        <div class="d-flex align-items-center">
                                            <img src="images/generic_image.png" class="rounded" width="35%"alt="Teacher Image" onclick="javascript:location.href='teacher_courses_admin.php?id=<?php echo $row['id']; ?>'" style="cursor:pointer">
                                            <div class="ms-3 w-auto">
                                                <h4 class="mb-0 mt-0 text-break" onclick="javascript:location.href='teacher_courses_admin.php?id=<?php echo $row['id']; ?>'" style="cursor:pointer"><?php echo $row['username']?></h4> <span onclick="javascript:location.href='teacher_courses_admin.php?id=<?php echo $row['id']; ?>'" style="cursor:pointer"><?php echo $row['email'] ?></span><br>
                                                <span onclick="javascript:location.href='teacher_courses_admin.php?id=<?php echo $row['id']; ?>'" style="cursor:pointer">Courses: <?php echo $course_count ?></span>
                                                </span>
                                                <div class="button mt-2 d-flex flex-row align-items-center">
                                                    <a class="btn btn-sm btn-outline-primary w-auto px-3" data-bs-toggle="modal" data-bs-target="#edit">Edit</a>
                                                    <a class="btn btn-sm btn-primary ms-1 w-auto px-3"  data-bs-toggle="modal" data-bs-target="#delete">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New teacher</h5>
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
            <!-- Modal for Edit -->
            <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <button type="button" id="addIcon" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa fa-plus"></i>
            </button>
        <?php
    } else {
        header('Location: index.php?error=INVALID USER');
        exit();
    }
        ?>
        <?php
        require_once __DIR__ . '/connection/disconnect.php';
        require __DIR__ . '/utility/foot_info.php';
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