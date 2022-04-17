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
        <title>Dashboard</title>

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
                        <img src="uploads/<?php echo $_SESSION['image_url'] ?>" class="rounded-circle" width="100px" height="100px">
                        <div style="display: flex; justify-content: space-between; align-items:center; margin:16px 0px">
                            <h3 style="margin:0;"><?php echo $name; ?></h3>
                            <i class="fas fa-edit" data-bs-toggle="modal" data-bs-target="#edit_profile" data-bs-whatever="<?php echo $id ?>"></i>
                        </div>
                    </div>
                    <a href="dashboard.php">
                        <p class="h4">Courses</p>
                    </a>
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
                        <strong><?php echo $_GET['error']; ?></strong>
                        <span class="btn-close closebtn" onclick="this.parentElement.style.display='none';" aria-label="Close"></span>
                    </div>
                <?php } ?>
                <div class="row row-cols-1 row-cols-md-5 g-4">
                    <?php
                    $sql = "SELECT course_name,course_code,batch,type FROM courses WHERE id=$id ORDER BY batch DESC";
                    $result = $conn->query($sql);
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <div class="col">
                            <a href="coursetable.php?course=<?php echo $row['course_code']; ?>">
                                <div class="card h-100">
                                    <img src="images/img<?php echo $i ?>.jpg" class="card-img-top" alt="Course Image">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row['course_name'] ?></h5>
                                        <p class="card-text">Type: <?php echo $row['type'] ?><br><?php echo $row['course_code'] ?><br><?php echo $row['batch'] ?></p>
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
                                <input type="text" class="form-control" id="editName" name="name" aria-describedby="emailHelp" required readonly value="<?php echo $name; ?>">
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