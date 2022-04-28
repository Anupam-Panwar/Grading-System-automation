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
                    <div class="card" style="margin:2rem;">
                        <h5 class="card-header">Computer Science & Engineering Department</h5>
                        <div class="card-body" style="height: 200px; background:#212529;">
                            <div class="card bg-dark text-white">
                                <div class="card-img-overlay">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    <p class="card-text">Last updated 3 mins ago</p>
                                </div>
                                
                            </div>
                        </div>
                    </div>


                <?php } ?>
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