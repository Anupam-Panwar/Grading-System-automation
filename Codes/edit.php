<?php

session_start();
if (isset($_SESSION['id'])) {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <?php
        require __DIR__ .'/utility/head_info.php';
        ?>

        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="css/edit.css">

        <!-- Font Awesome JS -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

        <?php
        require_once __DIR__ . '/connection/connect.php';
        if (isset($_GET['course'])) {
            $cd = $_GET['course'];
        } else {
            header('Location: coursetable.php?error=ERROR OCCURRED');
            exit();
        }
        ?>

        <title>Edit : <?php echo $cd; ?></title>
    </head>

    <body>


        <!-- navbar -->
        <nav class="navbar navbar-light bg-dark">
            <div class="container-fluid sameline">
                <div class="initials">
                    <?php
                    $id = $_SESSION['id'];
                    $uname = $_SESSION['name'];
                    ?>
                    <a href="dashboard.php">
                    <span class="text-white text-center fs-3 initial"><?php echo substr($uname, 0, 1); ?></span>
                    </a>
                </div>
                <span class="text-white h3">Control Sheet</span>

                <form class="d-flex">
                    <a href="logout.php">
                        <button class="btn btn-outline-success" type="button">Log Out</button>
                    </a>
                </form>
            </div>
        </nav>

        <div class="wrapper">


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
                <main class="col-md-auto ms-sm-3 col-lg-auto px-md-auto">
                    <form action="insert.php?course=<?php echo $cd; ?>" method="post">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                            <?php
                            $sql = "SELECT course_name, semester, batch FROM courses WHERE course_code='$cd'";
                            $result = $conn->query($sql);
                            if ($row = $result->fetch_assoc()) {
                            ?>
                                <h4 class="h4">Course: <?php echo $row['course_name']; ?></h4>
                                <?php $cn = $row['course_name']; ?>

                                <div class="d-grid gap-2 d-md-block" role="group" aria-label="First group">
                                    <input type="submit" value="Save" class="btn btn-outline-secondary d-print-none" />
                                    <a href="coursetable.php?course=<?php echo $cd; ?>"><input type="button" value="Cancel" class="btn btn-outline-secondary d-print-none" /></a>
                                </div>
                        </div>

                        <h5>Batch: <?php echo $row['batch'];
                                 ?> </h5>

                        <h5>Session: <?php echo $row['semester'];
                                    } ?> </h5>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm tablecustom">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
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
                                        <th>S. No.</th>
                                        <th>Roll No.</th>
                                        <th>Maximum Marks 🠖</th>
                                        <?php
                                        $sql = "SELECT * FROM controlsheet WHERE course_code='$cd'";
                                        $result = $conn->query($sql);
                                        if ($row = $result->fetch_assoc()) { ?>
                                            <th><input class="classtest" name="mct1" value="<?php echo $row['class_test_1']; ?>"></input></th>
                                            <th><input class="classtest" name="mct2" value="<?php echo $row['class_test_2']; ?>"></input></th>
                                            <th><input class="classtest" name="mct3" value="<?php echo $row['class_test_3']; ?>"></input></th>
                                            <th><input class="classtest" name="mct4" value="<?php echo $row['class_test_4']; ?>"></input></th>
                                            <th><input class="marks" name="mmt1" value="<?php echo $row['mid_term_1']; ?>"></input></th>
                                            <th><input class="marks" name="mmt2" value="<?php echo $row['mid_term_2']; ?>"></input></th>
                                            <th><?php echo $row['total_assessment']; ?></th>
                                            <th><input class="marks" name="met" value="<?php echo $row['end_term']; ?>"></input></th>
                                            <th><?php echo $row['total_marks']; ?></th>
                                            <th><?php echo $row['grade']; ?></th>
                                    </tr>
                                <?php } ?>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = $result->fetch_assoc()) { ?>
                                        <tr>
                                            <td><strong><?php echo $i++; ?></strong></td>
                                            <td><input class="rollno" name="roll[]" value="<?php echo $row['roll_no']; ?>" style="font-weight:bold" readonly></input></td>
                                            <td><strong><?php echo $row['name']; ?></strong></td>
                                            <td><input class="classtest" name="ct1[]" value="<?php echo $row['class_test_1']; ?>"></input></td>
                                            <td><input class="classtest" name="ct2[]" value="<?php echo $row['class_test_2']; ?>"></input></td>
                                            <td><input class="classtest" name="ct3[]" value="<?php echo $row['class_test_3']; ?>"></input></td>
                                            <td><input class="classtest" name="ct4[]" value="<?php echo $row['class_test_4']; ?>"></input></td>
                                            <td><input class="marks" name="mt1[]" value="<?php echo $row['mid_term_1']; ?>"></input></td>
                                            <td><input class="marks" name="mt2[]" value="<?php echo $row['mid_term_2']; ?>"></input></td>
                                            <td><?php echo $row['total_assessment']; ?></td>
                                            <td><input class="marks" name="endterm[]" value="<?php echo $row['end_term']; ?>"></input></td>
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

                        <div class="table-responsive grades">
                            <div class="text-start h5">Grade Point Cutoff</div>
                            <table class="table table-bordered border-primary">
                                <thead>
                                    <tr>
                                        <td><strong>Grade</strong></td>
                                        <?php
                                        $sql = "SELECT grade FROM gradewindow WHERE course_code='$cd' ORDER BY grade";
                                        $result = $conn->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                        ?>
                                            <td><input  class="gradebutton" name="grade[]" value="<?php echo $row['grade']; ?>" style="font-weight:bold" readonly></input>
                                           <?php } ?></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Cutoff</strong></td>
                                        <?php
                                        $sql = "SELECT grade,lower_cutoff,upper_cutoff FROM gradewindow WHERE course_code='$cd' ORDER BY grade";
                                        $result = $conn->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                        ?>
                                             <td>
                                                    <input class="gradewin" name="ub[]" value="<?php echo $row['upper_cutoff']; ?>"></input>
                                                    -
                                                    <input class="gradewin" name="lb[]" value="<?php echo $row['lower_cutoff']; ?>"></input>
                                                </td>
                                                <?php } ?> 
                                    </tr>
                                    <tr>
                                        <td><strong>Total Students</strong></td>
                                        <?php
                                        $sql = "SELECT grade,no_of_students FROM gradewindow WHERE course_code='$cd' ORDER BY grade";
                                        $result = $conn->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                        ?>
                                             <td>
                                                    <?php echo $row['no_of_students']; ?>
                                                </td>
                                                <?php } ?> 
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </main>
            </div>
        </div>


        <?php
        require_once __DIR__ . '/connection/disconnect.php';
        require __DIR__ .'/utility/foot_info.php';
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