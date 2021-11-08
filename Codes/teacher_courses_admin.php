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
        require __DIR__ . '/utility/head_info.php';
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
                <button type="button" id="addIcon" data-bs-toggle="modal" data-bs-target="#new_course">
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
                            <div class="card h-100 d-flex">
                                <a href="coursetable.php?course=<?php echo $row['course_code']; ?>">
                                    <img src="images/img<?php echo $i ?>.jpg" class="card-img-top" alt="Course Image">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row['course_name'] ?></h5>
                                        <p class="card-text"><?php echo $row['course_code'] ?><?php echo " | " . $row['batch'] ?></p>
                                    </div>
                                </a>
                                <div class="button mt-2 d-flex flex-row align-items-center p-2">
                                    <button class="btn btn-sm btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#edit_course" data-bs-whatever="<?php echo $row['course_code'] ?>">Edit</button>
                                    <button class="btn btn-sm btn-primary w-100 ml-2" data-bs-toggle="modal" data-bs-target="#delete" data-bs-whatever="<?php echo $row['course_name'] ?>">Delete</button>
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
        <!-- Modal for Adding new course-->
        <div class="modal fade" id="new_course" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Course</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Course Name</label>
                                <input type="text" class="form-control" id="name" aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                                <label for="code" class="form-label">Course Code</label>
                                <input type="text" class="form-control" id="code" required>
                            </div>
                            <div class="mb-3">
                                <label for="year" class="form-label">Year</label>
                                <input type="number" class="form-control" id="year" required>
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
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn btn-danger">Yes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Edit -->
        <div class="modal fade" id="edit_course" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <form>
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Course</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Course Name</label>
                                <input type="text" class="form-control" id="name" aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                                <label for="code" class="form-label">Course Code</label>
                                <input type="text" class="form-control" id="code" required>
                            </div>
                            <div class="mb-3">
                                <label for="year" class="form-label">Year</label>
                                <input type="number" class="form-control" id="year" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
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
    require __DIR__ . '/utility/foot_info.php';
    ?>


    <!-- Sidebar script -->
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

        var delete_course = document.getElementById('delete')
        delete_course.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            var button = event.relatedTarget
            // Extract info from data-bs-* attributes
            var recipient = button.getAttribute('data-bs-whatever')
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            var modalTitle = delete_course.querySelector('.modal-title')
            modalTitle.textContent = 'Do you really want to delete ' + recipient
        })

        var edit_course = document.getElementById('edit_course')
        edit_course.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            var button = event.relatedTarget
            // Extract info from data-bs-* attributes
            var recipient = button.getAttribute('data-bs-whatever')
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            var modalBodyInput = edit_course.querySelector('#code')
            modalBodyInput.value = recipient
        })
    </script>

    </body>

    </html>