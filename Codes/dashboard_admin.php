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
                        <img src="uploads/<?php echo $_SESSION['image_url'] ?>" class="rounded-circle" width="100px" height="100px">
                        <div style="display: flex; justify-content: space-between; align-items:center; margin:16px 0px">
                            <h3 style="margin:0;"><?php echo $name; ?></h3>
                            <i class="fas fa-edit" data-bs-toggle="modal" data-bs-target="#edit_profile" data-bs-whatever="<?php echo $id ?>"></i>
                        </div>
                    </div>
                    <a href="dashboard_admin.php">
                        <p class="h4">Session</p>
                    </a>
                    <li>
                        <a>Odd Semester 2022</a>
                        <a>Even Semester 2022</a>
                        <a>Odd Semester 2021</a>
                        <a>Even Semester 2021</a>
                    </li>
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
                <div class="card m-2 mb-4">
                    <h4 class="card-header">Computer Science & Engineering</h4>
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-lg-2 row-cols-xxl-3 g-4 w-75">
                            <div class="col">
                                <div class="card bg-dark" data-bs-toggle="modal" data-bs-target="#student" style="cursor: pointer;">
                                    <img src="./images/student.png" class="card-img" alt="...">
                                    <div class="card-img-overlay">
                                        <h5 class="card-title">Students</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <a href="dashboard_admin1.php">
                                    <div class="card bg-dark">
                                        <img src="./images/teacher.png" class="card-img" alt="...">
                                        <div class="card-img-overlay">
                                            <h5 class="card-title">Faculty</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <div class="card bg-dark" data-bs-toggle="modal" data-bs-target="#course" style="cursor: pointer;">
                                    <img src="./images/img2.jpg" class="card-img" alt="...">
                                    <div class="card-img-overlay">
                                        <h5 class="card-title">Courses</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card m-2 mb-4">
                    <h4 class="card-header">Electronics & Communication Engineering</h4>
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-lg-2 row-cols-xxl-3 g-4 w-75">
                        <div class="col">
                                <div class="card bg-dark" data-bs-toggle="modal" data-bs-target="#student" style="cursor: pointer;">
                                    <img src="./images/student.png" class="card-img" alt="...">
                                    <div class="card-img-overlay">
                                        <h5 class="card-title">Students</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <a href="dashboard_admin1.php">
                                    <div class="card bg-dark">
                                        <img src="./images/teacher.png" class="card-img" alt="...">
                                        <div class="card-img-overlay">
                                            <h5 class="card-title">Faculty</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <div class="card bg-dark" data-bs-toggle="modal" data-bs-target="#course" style="cursor: pointer;">
                                    <img src="./images/img2.jpg" class="card-img" alt="...">
                                    <div class="card-img-overlay">
                                        <h5 class="card-title">Courses</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card m-2 mb-4">
                    <h4 class="card-header">Electrical & Electronic Engineering</h4>
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-lg-2 row-cols-xxl-3 g-4 w-75">
                        <div class="col">
                                <div class="card bg-dark" data-bs-toggle="modal" data-bs-target="#student" style="cursor: pointer;">
                                    <img src="./images/student.png" class="card-img" alt="...">
                                    <div class="card-img-overlay">
                                        <h5 class="card-title">Students</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <a href="dashboard_admin1.php">
                                    <div class="card bg-dark">
                                        <img src="./images/teacher.png" class="card-img" alt="...">
                                        <div class="card-img-overlay">
                                            <h5 class="card-title">Faculty</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <div class="card bg-dark" data-bs-toggle="modal" data-bs-target="#course" style="cursor: pointer;">
                                    <img src="./images/img2.jpg" class="card-img" alt="...">
                                    <div class="card-img-overlay">
                                        <h5 class="card-title">Courses</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card m-2 mb-4">
                    <h4 class="card-header">Mechanical Engineering</h4>
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-lg-2 row-cols-xxl-3 g-4 w-75">
                        <div class="col">
                                <div class="card bg-dark" data-bs-toggle="modal" data-bs-target="#student" style="cursor: pointer;">
                                    <img src="./images/student.png" class="card-img" alt="...">
                                    <div class="card-img-overlay">
                                        <h5 class="card-title">Students</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <a href="dashboard_admin1.php">
                                    <div class="card bg-dark">
                                        <img src="./images/teacher.png" class="card-img" alt="...">
                                        <div class="card-img-overlay">
                                            <h5 class="card-title">Faculty</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <div class="card bg-dark" data-bs-toggle="modal" data-bs-target="#course" style="cursor: pointer;">
                                    <img src="./images/img2.jpg" class="card-img" alt="...">
                                    <div class="card-img-overlay">
                                        <h5 class="card-title">Courses</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card m-2 mb-4">
                    <h4 class="card-header">Civil Engineering</h4>
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-lg-2 row-cols-xxl-3 g-4 w-75">
                        <div class="col">
                                <div class="card bg-dark" data-bs-toggle="modal" data-bs-target="#student" style="cursor: pointer;">
                                    <img src="./images/student.png" class="card-img" alt="...">
                                    <div class="card-img-overlay">
                                        <h5 class="card-title">Students</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <a href="dashboard_admin1.php">
                                    <div class="card bg-dark">
                                        <img src="./images/teacher.png" class="card-img" alt="...">
                                        <div class="card-img-overlay">
                                            <h5 class="card-title">Faculty</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <div class="card bg-dark" data-bs-toggle="modal" data-bs-target="#course" style="cursor: pointer;">
                                    <img src="./images/img2.jpg" class="card-img" alt="...">
                                    <div class="card-img-overlay">
                                        <h5 class="card-title">Courses</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
        </div>
        </div>

        <!-- Modal for Adding new Department-->
        <div class="modal fade" id="new_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="insert_user.php" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Department</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name of Department</label>
                                <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email id of HOD</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password for HOD's email ID</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="checkbox">
                                <label class="form-check-label" for="checkbox">Show Password</label>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>

        <!-- Modal for Students -->
        <div class="modal fade" id="student" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form onsubmit="return false">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Students</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">SNo.</th>
                                        <th scope="col">Student Name</th>
                                        <th scope="col">Year</th>
                                        <th scope="col">Courses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Anupam Panwar</td>
                                        <td>3rd</td>
                                        <td>
                                            <div class="dropend">
                                                <button type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Courses
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li class="dropdown-item">FACB</li>
                                                    <li class="dropdown-item">AI</li>
                                                    <li class="dropdown-item">M&I</li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Neha Dhyani</td>
                                        <td>3rd</td>
                                        <td>
                                            <div class="dropend">
                                                <button type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Courses
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li class="dropdown-item">FACB</li>
                                                    <li class="dropdown-item">AI</li>
                                                    <li class="dropdown-item">M&I</li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Purvi Goyal</td>
                                        <td>3rd</td>
                                        <td>
                                            <div class="dropend">
                                                <button type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Courses
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li class="dropdown-item">FACB</li>
                                                    <li class="dropdown-item">AI</li>
                                                    <li class="dropdown-item">M&I</li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>Priyanshu</td>
                                        <td>3rd</td>
                                        <td>
                                            <div class="dropend">
                                                <button type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Courses
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li class="dropdown-item">FACB</li>
                                                    <li class="dropdown-item">AI</li>
                                                    <li class="dropdown-item">M&I</li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal for Courses -->
        <div class="modal fade" id="course" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form onsubmit="return false">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Courses</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">SNo.</th>
                                        <th scope="col">Course Name</th>
                                        <th scope="col">Course Coordinator</th>
                                        <th scope="col">No. of Students</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Computer Networks</td>
                                        <td>Dr.Surendra Singh</td>
                                        <td>35</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Computer Organization</td>
                                        <td>Dr.Surendra Singh</td>
                                        <td>35</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Database Management System</td>
                                        <td>Dr. Kamal Kumar</td>
                                        <td>35</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>Linux</td>
                                        <td>Dr. Kamal Kumar</td>
                                        <td>35</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="edit_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width:35rem;">
                    <form action="updateProfilePicture.php" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex justify-content-center align-items-center flex-column" style="position:relative;">
                                <img id="picture" src="uploads/<?php echo $_SESSION['image_url'] ?>" class="rounded-circle" width="200px" height="200px" alt="Profile Picture">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="editName" name="name" aria-describedby="emailHelp" required readonly value="<?php echo $name; ?>">
                            </div>

                            <div class="d-flex justify-content-end"><button type="button" class="btn btn-dark" data-bs-target="#changePassword" data-bs-toggle="modal" data-bs-dismiss="modal">Change Password</button></div>

                            <div class="d-flex justify-content-between" style="margin-top: 1rem;">
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary" data-bs-target="#freezeMt1" data-bs-toggle="modal" data-bs-dismiss="modal">
                                        <?php
                                        $sql = "SELECT * FROM flag";
                                        $res = $conn->query($sql);
                                        $row1 = $res->fetch_assoc();
                                        $flag_mt1 = $row1['mt1'];
                                        $flag_mt2 = $row1['mt2'];
                                        $flag_ct = $row1['ct'];
                                        $flag_et = $row1['et'];
                                        if ($flag_mt1 == 0)
                                            echo "Freeze MT1";
                                        else
                                            echo "Unfreeze MT1";
                                        ?>
                                    </button>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary" data-bs-target="#freezeMt2" data-bs-toggle="modal" data-bs-dismiss="modal">
                                        <?php
                                        if ($flag_mt2 == 0)
                                            echo "Freeze MT2";
                                        else
                                            echo "Unfreeze MT2";
                                        ?>
                                    </button>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary" data-bs-target="#freezeCT" data-bs-toggle="modal" data-bs-dismiss="modal">
                                        <?php
                                        if ($flag_ct == 0)
                                            echo "Freeze CT";
                                        else
                                            echo "Unfreeze CT";
                                        ?>
                                    </button>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary" data-bs-target="#freezeET" data-bs-toggle="modal" data-bs-dismiss="modal">
                                        <?php
                                        if ($flag_et == 0)
                                            echo "Freeze ET";
                                        else
                                            echo "Unfreeze ET";
                                        ?>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.reload();clearImage();">Discard</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="changePassword.php" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" data-bs-target="#edit_profile" data-bs-toggle="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="password" class="form-label">Current Password</label>
                                <input type="password" class="form-control" id="editCurrentPassword" name="currentPassword" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="editNewPassword" name="newPassword" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="editConfirmNewPassword" name="confirmNewPassword" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="checkbox">
                                <label class="form-check-label" for="exampleCheck1">Show Password</label>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#edit_profile" data-bs-toggle="modal" onclick="">Discard</button>
                            <input type="submit" name="submit" value="Save Changes" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="freezeMt1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <?php
                            if ($flag_mt1 == 0)
                                echo "Freeze MT1 Marks?";
                            else
                                echo "Unfreeze MT1 Marks?";
                            ?>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" data-bs-target="#edit_profile" data-bs-toggle="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#edit_profile" data-bs-toggle="modal" onclick="">No</button>
                        <button type="submit" class="btn btn-primary" onclick="mt1()">Yes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="freezeMt2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <?php
                            if ($flag_mt2 == 0)
                                echo "Freeze MT2 Marks?";
                            else
                                echo "Unfreeze MT2 Marks?";
                            ?>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" data-bs-target="#edit_profile" data-bs-toggle="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#edit_profile" data-bs-toggle="modal" onclick="">No</button>
                        <button type="submit" class="btn btn-primary" onclick="mt2()">Yes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="freezeCT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <?php
                            if ($flag_ct == 0)
                                echo "Freeze CT Marks?";
                            else
                                echo "Unfreeze CT Marks?";
                            ?>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" data-bs-target="#edit_profile" data-bs-toggle="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#edit_profile" data-bs-toggle="modal" onclick="">No</button>
                        <button type="submit" class="btn btn-primary" onclick="ct()">Yes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="freezeET" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <?php
                            if ($flag_et == 0)
                                echo "Freeze ET Marks?";
                            else
                                echo "Unfreeze ET Marks?";
                            ?>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" data-bs-target="#edit_profile" data-bs-toggle="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#edit_profile" data-bs-toggle="modal" onclick="">No</button>
                        <button type="submit" class="btn btn-primary" onclick="et()">Yes</button>
                    </div>
                </div>
            </div>
        </div>


        <button type="button" id="addIcon" data-bs-toggle="modal" data-bs-target="#new_user">
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

            $("#changePassword #checkbox").change(function() {
                $(this).prop("checked") ? $("#changePassword #editCurrentPassword").prop("type", "text") : $("#changePassword #editCurrentPassword").prop("type", "password");
                $(this).prop("checked") ? $("#changePassword #editNewPassword").prop("type", "text") : $("#changePassword #editNewPassword").prop("type", "password");
                $(this).prop("checked") ? $("#changePassword #editConfirmNewPassword").prop("type", "text") : $("#changePassword #editConfirmNewPassword").prop("type", "password");
            });

            var edit_profile = document.getElementById('edit_profile')
            edit_profile.addEventListener('show.bs.modal', function(event) {
                // Button that triggered the modal
                var button = event.relatedTarget
                // Extract info from data-bs-* attributes
                var recipient = button.getAttribute('data-bs-whatever');
            })

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
            $("#edit_user #checkbox").change(function() {
                $(this).prop("checked") ? $("#edit_user #editPassword").prop("type", "text") : $("#edit_user #editPassword").prop("type", "password");
            });
            $("#new_user #checkbox").change(function() {
                $(this).prop("checked") ? $("#new_user #password").prop("type", "text") : $("#new_user #password").prop("type", "password");
            });
            var delete_user = document.getElementById('delete')
            delete_user.addEventListener('show.bs.modal', function(event) {
                // Button that triggered the modal
                var button = event.relatedTarget
                // Extract info from data-bs-* attributes
                var recipient = button.getAttribute('data-bs-whatever')
                $.ajax({
                    type: 'post',
                    url: 'ajax.php',
                    data: {
                        ajax: 1,
                        id: recipient
                    },
                    success: (response) => {
                        let result = JSON.parse(response);
                        $('#modalTitleDelete').text('Do you really want to delete User : ' + result["name"]);
                    }
                });
                deleteUser = () => {
                    $.ajax({
                        type: 'post',
                        url: 'ajax.php',
                        data: {
                            ajax: 2,
                            id: recipient
                        },
                        success: (response) => {
                            window.location.href = "dashboard_admin.php?error=" + response;
                        }
                    });
                }

            })

            var edit_user = document.getElementById('edit_user')
            edit_user.addEventListener('show.bs.modal', function(event) {
                // Button that triggered the modal
                var button = event.relatedTarget
                // Extract info from data-bs-* attributes
                var recipient = button.getAttribute('data-bs-whatever')
                $.ajax({
                    type: 'post',
                    url: 'ajax.php',
                    data: {
                        ajax: 3,
                        id: recipient
                    },
                    success: (response) => {
                        let result = JSON.parse(response);
                        $('#edit_user #editName').val(result["name"]);
                        $('#edit_user #editEmail').val(result["email"]);
                        $('#edit_user #editPassword').val(result["password"]);
                    }
                });
                updateUser = () => {
                    let name = $('#edit_user #editName').val();
                    let email = $('#edit_user #editEmail').val();
                    let password = $('#edit_user #editPassword').val();
                    $.ajax({
                        type: 'post',
                        url: 'ajax.php',
                        data: {
                            ajax: 4,
                            id: recipient,
                            name: name,
                            email: email,
                            password: password
                        },
                        success: (response) => {
                            window.location.href = "dashboard_admin.php?error=" + response;
                        }
                    });
                }
            })
            mt1 = () => {
                $.ajax({
                    type: 'post',
                    url: 'ajax.php',
                    data: {
                        ajax: 10,
                        id: <?php echo ($_SESSION['id']) ?>
                    },
                    success: (response) => {
                        window.location.href = "dashboard_admin.php?error=" + response;
                    }
                });
            }
            mt2 = () => {
                $.ajax({
                    type: 'post',
                    url: 'ajax.php',
                    data: {
                        ajax: 11,
                        id: <?php echo ($_SESSION['id']) ?>
                    },
                    success: (response) => {
                        window.location.href = "dashboard_admin.php?error=" + response;
                    }
                });
            }
            ct = () => {
                $.ajax({
                    type: 'post',
                    url: 'ajax.php',
                    data: {
                        ajax: 12,
                        id: <?php echo ($_SESSION['id']) ?>
                    },
                    success: (response) => {
                        window.location.href = "dashboard_admin.php?error=" + response;
                    }
                });
            }
            et = () => {
                $.ajax({
                    type: 'post',
                    url: 'ajax.php',
                    data: {
                        ajax: 13,
                        id: <?php echo ($_SESSION['id']) ?>
                    },
                    success: (response) => {
                        window.location.href = "dashboard_admin.php?error=" + response;
                    }
                });
            }
        });
    </script>



    </body>

    </html>