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
        <link rel="stylesheet" href="css/print.css">
        <link rel="stylesheet" href="css/printmedia.css" media="print">

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
            if ($result->num_rows==1) 
            {
                $row=$result->fetch_assoc();
                if($_SESSION['id']!=$row['id'])
                {
                    header('Location: dashboard.php?error=COURSE NOT FOUND');
                    exit();
                }
            }
            else
            {
                header('Location: dashboard.php?error=COURSE NOT FOUND');
                exit();
            }
        } else {
            header('Location: coursetable.php?error=ERROR OCCURRED');
            exit();
        }
        ?>
        <title>Print : <?php echo $cd; ?></title>
    </head>

    <body>


        <!-- navbar -->


        <div class="wrapper">
            <!-- Page Content Holder -->
            <div id="content">


                <main class="col-md-auto ms-sm-3 col-lg-auto px-md-auto">

                    <button class="btn btn-info float-end" onclick="window.print()" id="printbutton">Download</button>
                    <div class="h3 text-center" id="nit">National Institute of Technology, Uttarakhand</div>

                    <?php
                    $sql = "SELECT course_name, semester, batch FROM courses WHERE course_code='$cd'";
                    $result = $conn->query($sql);
                    if ($row = $result->fetch_assoc()) {
                    ?>

                        <div class="text-center h4">Control Sheet</div>
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                            <h4 class="h5">Course: <?php echo $cd . " " . $row['course_name']; ?></h4>
                            <span class="ctno text-end">Control Sheet No.:__/__/_______ <br>CC/HOD/F/CF</span>
                        </div>

                        <div class="fs-5 sameline">
                            <span class="text-start">Session: <?php echo $row['semester'];
                                                            } ?></span>
                            <span class="text-end">Faculty: <?php echo $uname; ?></span>
                        </div>
                        <br>

                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
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
                                    <?php
                                    $sql = "SELECT * FROM controlsheet WHERE course_code='$cd'";
                                    $result = $conn->query($sql);
                                    if ($row = $result->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <th>S. No.</th>
                                            <th>Roll No.</th>
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
                                        </tr>
                                    <?php } ?>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $tct1 = 0;
                                    $tct2 = 0;
                                    $tct3 = 0;
                                    $tct4 = 0;
                                    $tmt1 = 0;
                                    $tmt2 = 0;
                                    $tass = 0;
                                    $tet = 0;
                                    $tt = 0;
                                    while ($row = $result->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo $i++ ?></td>
                                            <td><?php echo $row['roll_no']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['class_test_1'];
                                                $tct1 += $row['class_test_1']; ?></td>
                                            <td><?php echo $row['class_test_2'];
                                                $tct2 += $row['class_test_2']; ?></td>
                                            <td><?php echo $row['class_test_3'];
                                                $tct3 += $row['class_test_3']; ?></td>
                                            <td><?php echo $row['class_test_4'];
                                                $tct4 += $row['class_test_4']; ?></td>
                                            <td><?php echo $row['mid_term_1'];
                                                $tmt1 += $row['mid_term_1']; ?></td>
                                            <td><?php echo $row['mid_term_2'];
                                                $tmt2 += $row['mid_term_2']; ?></td>
                                            <td><?php echo $row['total_assessment'];
                                                $tass += $row['total_assessment']; ?></td>
                                            <td><?php echo $row['end_term'];
                                                $tet += $row['end_term']; ?></td>
                                            <td><?php echo $row['total_marks'];
                                                $tt += $row['total_marks']; ?></td>
                                            <td><?php echo $row['grade']; ?></td>
                                        </tr>
                                    <?php } ?>

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td><strong>Total</strong></td>
                                        <td><?php echo $tct1; ?></td>
                                        <td><?php echo $tct2; ?></td>
                                        <td><?php echo $tct3; ?></td>
                                        <td><?php echo $tct4; ?></td>
                                        <td><?php echo $tmt1; ?></td>
                                        <td><?php echo $tmt2; ?></td>
                                        <td><?php echo $tass; ?></td>
                                        <td><?php echo $tet; ?></td>
                                        <td><?php echo $tt; ?></td>
                                        <td></td>
                                    </tr>

                                </tbody>
                            </table>
                            <div class="text-end">No. of students on Roll: <?php echo ($i - 1); ?></div>
                        </div>

                        <br>
                        <hr>
                        <br>

                        <div class="table-responsive" id="printmedia">
                            <div class="text-start h5">Grade Point Cutoff</div>
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
                                        <td><strong>Cutoff</strong></td>
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
                <br>
                <br>
                <br>
                <div class="fs-6 sameline">
                    <div>Name & Signature of Examiner <br>Date:</div>
                    <div>Name & Sign of HOD/Dept. Coordinator with Seal <br>Date:</div>
                </div>

            </div>
        </div>

        <?php
        require_once __DIR__ . '/connection/disconnect.php';
        require __DIR__ .'/utility/foot_info.php';
        ?>
    <?php
} else {
    header('Location: index.php?error=INVALID REQUEST');
    exit();
}
    ?>
    </body>

    </html>