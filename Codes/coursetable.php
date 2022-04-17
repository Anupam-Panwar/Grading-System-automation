<?php
session_start();
if (isset($_SESSION['id'])) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <?php
        require __DIR__ . '/utility/head_info.php';
        ?>

        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="css/custom.css">

        <!-- Font Awesome JS -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

        <?php
        require_once __DIR__ . '/connection/connect.php';
        $id = $_SESSION['id'];
        $uname = $_SESSION['name'];
        if (isset($_GET['course'])) {
            $cd = $_GET['course'];
            $sql = "SELECT id FROM courses WHERE course_code='$cd'";
            $result = $conn->query($sql);
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                if ($_SESSION['id'] != $row['id'] && $_SESSION['name'] != 'Admin') {
                    header('Location: dashboard.php?error=COURSE NOT FOUND');
                    exit();
                }
            } else {
                header('Location: dashboard.php?error=COURSE NOT FOUND');
                exit();
            }
        } else {
            header('Location: dashboard.php?error=ERROR OCCURRED');
            exit();
        }
        ?>

        <title><?php echo $cd; ?></title>
    </head>

    <body>


        <!-- navbar -->
        <nav class="navbar navbar-light bg-dark">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="navbar-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <span class="text-white h3">Control Sheet</span>
                <form class="d-flex">
                    <a href="logout.php">
                        <button class="btn btn-outline-success" type="button">Log Out</button>
                    </a>
                </form>
            </div>
        </nav>

        <div class="wrapper">
            <!-- Sidebar Holder -->
            <?php if ($_SESSION['name'] != 'Admin') { ?>
                <nav id="sidebar">
                    <ul class="list-unstyled components">
                        <div class="sidebar-header">
                            <img src="uploads/<?php echo $_SESSION['image_url'] ?>" class="rounded-circle" width="100px" height="100px">
                            <div style="display: flex; justify-content: space-between; align-items:center; margin:16px 0px">
                                <h3 style="margin:0;"><?php echo $uname; ?></h3>
                                <i class="fas fa-edit" data-bs-toggle="modal" data-bs-target="#edit_profile" data-bs-whatever="<?php echo $id ?>"></i>
                            </div>
                        </div>
                        <a href="dashboard.php">
                            <p class="h4">Courses</p>
                        </a>
                        <?php
                        $sql = "SELECT course_name, course_code FROM courses WHERE id=$id";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <li>
                                <a href="coursetable.php?course=<?php echo $row['course_code']; ?>"><?php echo $row['course_name']; ?></a>
                            </li>
                        <?php } ?>

                    </ul>
                </nav>
            <?php } else { ?>
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
            <?php } ?>



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
                <?php
                $sql = "SELECT course_name, semester, batch,type FROM courses WHERE course_code='$cd'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $cn = $row['course_name'];
                ?>

                <main class="col-md-auto ms-sm-3 col-lg-auto px-md-auto" id="printableTable">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                        <h4 class="h4"><?php echo "Course: " . $cn ?></h4>

                        <div class="d-grid gap-2 d-flex" role="group" aria-label="First group">
                            <input type="search" class="form-control" id="datatable-search-input" placeholder="Search Student" onkeyup="filterTable()">
                            <a type="button" class="btn btn-outline-secondary" href=<?php
                                                                                    if ($_SESSION['name'] == 'Admin') {
                                                                                        echo "edit_admin.php?course=" . $cd;
                                                                                    } else {
                                                                                        echo "edit.php?course=" . $cd;
                                                                                    } ?>>Edit</a>
                            <a type="button" class="btn btn-outline-secondary" target="_blank" href="print.php?course=<?php echo $cd ?>">Print</a>
                        </div>
                    </div>
                    <h5>Type: <?php echo $row['type']; ?></h5>
                    <h5>Batch: <?php echo $row['batch']; ?></h5>
                    <h5>Session: <?php echo $row['semester']; ?></h5>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm" id="table">
                            <thead>
                                <tr>
                                    <th>S. No.</th>
                                    <th>Roll No.</th>
                                    <th>Name ↓</th>
                                    <th>Class Test-1</th>
                                    <th>Class Test-2</th>
                                    <th>Class Test-3</th>
                                    <th>Class Test-4</th>
                                    <th>Mid Term Exam-I</th>
                                    <th>Mid Term Exam-II</th>
                                    <th>Total Assmt.</th>
                                    <th>End Term Exam</th>
                                    <th>Total</th>
                                    <th>Grade</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <?php
                                    $sql = "SELECT * FROM courses WHERE course_code='$cd'";
                                    $result = $conn->query($sql);
                                    if ($row = $result->fetch_assoc()) {
                                    ?>
                                        <th>Maximum Marks🠖</th>
                                        <th><?php echo $row['mct1']; ?></th>
                                        <th><?php echo $row['mct2']; ?></th>
                                        <th><?php echo $row['mct3']; ?></th>
                                        <th><?php echo $row['mct4']; ?></th>
                                        <th><?php echo $row['mmt1']; ?></th>
                                        <th><?php echo $row['mmt2']; ?></th>
                                        <th><?php echo $row['mta']; ?></th>
                                        <th><?php echo $row['met']; ?></th>
                                        <th><?php echo $row['mt']; ?></th>
                                        <th></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM controlsheet WHERE course_code='$cd'";
                                $result = $conn->query($sql);
                                $i = 1;
                                while ($row = $result->fetch_assoc()) { ?>
                                    <tr>
                                        <td><strong><?php echo $i++; ?></strong></td>
                                        <td><strong><?php echo $row['roll_no']; ?></strong></td>
                                        <td><strong><?php echo $row['name']; ?></strong></td>
                                        <td><?php echo $row['class_test_1']; ?></td>
                                        <td><?php echo $row['class_test_2']; ?></td>
                                        <td><?php echo $row['class_test_3']; ?></td>
                                        <td><?php echo $row['class_test_4']; ?></td>
                                        <td><?php echo $row['mid_term_1']; ?></td>
                                        <td><?php echo $row['mid_term_2']; ?></td>
                                        <td><?php echo $row['total_assessment']; ?></td>
                                        <td><?php echo $row['end_term']; ?></td>
                                        <td><?php echo $row['total_marks']; ?></td>
                                        <td><?php echo $row['grade']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <br>
                    <hr>
                    <br>
                    <div class="table-responsive grade">
                        <?php if ($_SESSION['name'] == 'Admin') { ?>
                            <div class="text-start h5">Grade Point Cutoff</div>
                        <?php } else { ?>
                            <div class="sameline grades">
                                <div class="text-start h5">Grade Point Cutoff</div>
                                <div>
                                    <a class="btn btn-outline-secondary mb-2" href="default.php?course=<?php echo $cd ?>">Set Default Grades</a>
                                    <a class="btn btn-outline-secondary mb-2" style="padding-right: 1.63rem; padding-left:1.63rem" href="clear.php?course=<?php echo $cd ?>">Clear Grades</a>
                                    <a class="btn btn-outline-secondary mb-2" href="generate.php?course=<?php echo $cd ?>">Generate Grades</a>
                                </div>
                            </div>
                        <?php } ?>
                        <table class="table table-bordered border-primary grades">
                            <thead>
                                <tr>
                                    <td><strong>Grade</strong></td>
                                    <?php
                                    $sql = "SELECT grade FROM gradewindow WHERE course_code='$cd' ORDER BY grade";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                    ?>

                                        <td><strong><?php echo $row['grade'];
                                                } ?></strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row"><strong>Cutoff</strong></td>
                                    <?php
                                    $sql = "SELECT grade,lower_cutoff,upper_cutoff FROM gradewindow WHERE course_code='$cd' ORDER BY grade";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                    ?>
                                        <td scope="row"><?php echo $row['upper_cutoff']; ?> - <?php echo $row['lower_cutoff']; ?></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <td><strong>Total Students</strong></td>
                                    <?php
                                    $sql = "SELECT grade,no_of_students FROM gradewindow WHERE course_code='$cd' ORDER BY grade";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                    ?>
                                        <td scope="row"><?php echo $row['no_of_students']; ?></td>
                                    <?php } ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>

        <div class="modal fade" id="edit_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="updateProfilePicture.php" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex justify-content-center align-items-center flex-column" style="position:relative;">
                                <img id="picture" src="uploads/<?php echo $_SESSION['image_url'] ?>" class="rounded-circle" width="200px" height="200px" alt="Profile Picture">
                                <div class="mb-2" style="align-self:center; position:absolute; bottom:-18%">
                                    <input class="form-control" name="my_image" type="file" id="editPicture" onchange="preview()">
                                    <label for="editPicture" class=""></label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="editName" name="name" aria-describedby="emailHelp" required readonly value="<?php echo $uname; ?>">
                            </div>

                            <div class="d-flex justify-content-end"><button type="button" class="btn btn-dark" data-bs-target="#changePassword" data-bs-toggle="modal" data-bs-dismiss="modal">Change Password</button></div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.reload();clearImage();">Discard</button>
                            <input type="submit" name="submit" value="Upload" class="btn btn-primary">
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




        <?php
        require_once __DIR__ . '/connection/disconnect.php';
        require __DIR__ . '/utility/foot_info.php';
        ?>


    <?php
} else {
    header('Location: index.php?error=INVALID REQUEST');
    exit();
}
    ?>

    <!-- Sidebar script -->
    <script type="text/javascript">


        $(document).ready(function() {
            $("#sidebarCollapse").on("click", function() {
                $("#sidebar").toggleClass("active");
                $(this).toggleClass("active");
            });
        });


        function filterTable() {
            let input, filter, table, tr, td_roll, td_name, i, txtValue1, txtValue2;
            input = document.getElementById("datatable-search-input");
            filter = input.value.toUpperCase();
            table = document.getElementById("table");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td_roll = tr[i].getElementsByTagName("td")[1];
                td_name = tr[i].getElementsByTagName("td")[2];
                if (td_name||td_roll) {
                    txtValue1 = td_roll.textContent || td_roll.innerText;
                    txtValue2 = td_name.textContent || td_name.innerText;
                    if (txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }

        }



        $("#changePassword #checkbox").change(function() {
            $(this).prop("checked") ? $("#changePassword #editCurrentPassword").prop("type", "text") : $("#changePassword #editCurrentPassword").prop("type", "password");
            $(this).prop("checked") ? $("#changePassword #editNewPassword").prop("type", "text") : $("#changePassword #editNewPassword").prop("type", "password");
            $(this).prop("checked") ? $("#changePassword #editConfirmNewPassword").prop("type", "text") : $("#changePassword #editConfirmNewPassword").prop("type", "password");
        });

        function preview() {
            picture.src = URL.createObjectURL(event.target.files[0]);
        }

        function clearImage() {
            document.getElementById('editPicture').value = null;
        }

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

        var edit_profile = document.getElementById('edit_profile')
        edit_profile.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            var button = event.relatedTarget
            // Extract info from data-bs-* attributes
            var recipient = button.getAttribute('data-bs-whatever');
        })
    </script>
    </body>

    </html>