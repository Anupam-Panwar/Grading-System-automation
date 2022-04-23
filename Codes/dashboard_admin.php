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
                            <p class="h4">Teachers</p>
                        </a>
                        <?php
                        $sql = "SELECT id,username,level FROM users";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            if ($row['level'] != 3) {
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
                        $sql = "SELECT id, username, email, level FROM users";
                        $result = $conn->query($sql);
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            if ($row['level'] != 3) {
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
                                            <img src="images/generic_image.png" class="rounded" width="35%" alt="Teacher Image" onclick="javascript:location.href='teacher_courses.php?id=<?php echo $row['id']; ?>'" style="cursor:pointer">
                                            <div class="ms-3 w-auto">
                                                <h4 class="mb-0 mt-0 text-break" onclick="javascript:location.href='teacher_courses.php?id=<?php echo $row['id']; ?>'" style="cursor:pointer"><?php echo $row['username'] ?></h4> <span onclick="javascript:location.href='teacher_courses.php?id=<?php echo $row['id']; ?>'" style="cursor:pointer"><?php echo $row['email'] ?></span><br>
                                                <span onclick="javascript:location.href='teacher_courses.php?id=<?php echo $row['id']; ?>'" style="cursor:pointer">Courses: <?php echo $course_count ?></span>
                                </span>
                                <div class="button mt-2 d-flex flex-row align-items-center">
                                    <a class="btn btn-sm btn-outline-primary w-auto px-3" data-bs-toggle="modal" data-bs-target="#edit_user" data-bs-whatever="<?php echo $row['id'] ?>">Edit</a>
                                    <a class="btn btn-sm btn-primary ms-1 w-auto px-3" data-bs-toggle="modal" data-bs-target="#delete" data-bs-whatever="<?php echo $row['id'] ?>">Delete</a>
                                </div>
                            </div>
                    </div>
                </div>

            </div>
        <?php } ?>
        </div>
        </div>
        </div>
        <!-- Modal for Adding new user-->
        <div class="modal fade" id="new_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="insert_user.php" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New teacher</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email id</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="department" class="form-label">Department</label>
                                <input type="department" class="form-control" id="department" name="department" required>
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

        <!-- Modal for delete -->
        <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleDelete"></h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn btn-danger" onclick="deleteUser()">Yes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Edit -->
        <div class="modal fade" id="edit_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form onsubmit="return false">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="editName" name="name" aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email id</label>
                                <input type="email" class="form-control" id="editEmail" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="editPassword" name="password" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="checkbox">
                                <label class="form-check-label" for="exampleCheck1">Show Password</label>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
                            <button type="submit" class="btn btn-primary" onclick="updateUser()">Update</button>
                        </div>
                    </form>
                </div>
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
                                <!-- <div class="mb-2" style="align-self:center; position:absolute; bottom:-18%">
                                    <input class="form-control" name="my_image" type="file" id="editPicture" onchange="preview()">
                                    <label for="editPicture" class=""></label>
                                </div> -->
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
                            <!-- <input type="submit" name="submit" value="Upload" class="btn btn-primary"> -->
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
                            window.location.href = "dashboard_admin.php?error="+response;
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
                            window.location.href = "dashboard_admin.php?error="+response;
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
                        window.location.href = "dashboard_admin.php?error="+response;
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
                        window.location.href = "dashboard_admin.php?error="+response;
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
                        window.location.href = "dashboard_admin.php?error="+response;
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
                        window.location.href = "dashboard_admin.php?error="+response;
                    }
                });
            }
        });
    </script>



        </body>

        </html>