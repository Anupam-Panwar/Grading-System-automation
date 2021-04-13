<?php
session_start();
if (isset($_SESSION['id'])) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <?php
            require 'head_info.php';
        ?>

        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="css/custom.css">

        <!-- Font Awesome JS -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

        <?php
        require_once __DIR__ . '\connection\connect.php';
        if (isset($_GET['course'])) {
            $cd = $_GET['course'];
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
            <nav id="sidebar">
                <ul class="list-unstyled components">
                    <div class="sidebar-header">
                        <?php
                        $id = $_SESSION['id'];
                        $uname = $_SESSION['name'];
                        ?>
                        <h3><?php echo $uname; ?></h3>
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
                $sql = "SELECT course_name, semester, batch FROM courses WHERE course_code='$cd'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $cn = $row['course_name'];
                ?>

                <main class="col-md-auto ms-sm-3 col-lg-auto px-md-auto" id="printableTable">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                        <h4 class="h4"><?php echo "Course: " . $cn ?></h4>

                        <div class="d-grid gap-2 d-md-block" role="group" aria-label="First group">
                            <a type="button" class="btn btn-outline-secondary" href="edit.php?course=<?php echo $cd ?>">Edit</a>
                            <a type="button" class="btn btn-outline-secondary" target="_blank" href="print.php?course=<?php echo $cd ?>">Print</a>
                        </div>
                    </div>
                    <h5>Batch: <?php echo $row['batch']; ?></h5>
                    <h5>Session: <?php echo $row['semester']; ?></h5>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
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
                                    $sql = "SELECT * FROM controlsheet WHERE course_code='$cd'";
                                    $result = $conn->query($sql);
                                    if ($row = $result->fetch_assoc()) {
                                    ?>
                                        <th>Maximum Marks🠖</th>
                                        <th><?php echo $row['class_test_1']; ?></th>
                                        <th><?php echo $row['class_test_2']; ?></th>
                                        <th><?php echo $row['class_test_3']; ?></th>
                                        <th><?php echo $row['class_test_4']; ?></th>
                                        <th><?php echo $row['mid_term_1']; ?></th>
                                        <th><?php echo $row['mid_term_2']; ?></th>
                                        <th><?php echo $row['total_assessment']; ?></th>
                                        <th><?php echo $row['end_term']; ?></th>
                                        <th><?php echo $row['total_marks']; ?></th>
                                        <th><?php echo $row['grade']; ?></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
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
                        <div class="sameline grades">
                            <div class="text-start h5">Grade Point Cutoff</div>
                            <a class="btn btn-outline-secondary mb-2" href="generate.php?course=<?php echo $cd ?>">Generate Grades</a>
                        </div>
                        <table class="table table-bordered border-primary grades">
                            <thead>
                                <tr>
                                    <td><strong>Grade</strong></td>
                                    <?php
                                    $sql = "SELECT grade FROM gradewindow WHERE course_code='$cd' ORDER BY grade";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                    ?>

                                        <td><?php echo $row['grade'];
                                        } ?></td>
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


        <?php
        require 'foot_info.php';
        ?>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#sidebarCollapse').on('click', function() {
                    $('#sidebar').toggleClass('active');
                    $(this).toggleClass('active');
                });

            });
        </script>
    <?php
} else {
    header('Location: index.php?error=INVALID REQUEST');
    exit();
}
    ?>
    </body>

    </html>