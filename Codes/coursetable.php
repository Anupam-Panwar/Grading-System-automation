<?php
session_start();
if(isset($_SESSION['id']))
{
    ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Course-name</title>



    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <?php
    require_once __DIR__ . '\connection\connect.php';
    if (isset($_GET['course']))
    {
        $cd = $_GET['course'];
    }
    else
    {
        header('Location: dashboard.php?error=ERROR OCCURRED');
        exit();
    }
    ?>
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
                    $id=$_SESSION['id'];
                    $uname=$_SESSION['name'];
                    ?>
                    <h3><?php echo $uname; ?></h3>
                </div>
                <p class="h4">Courses</p>
                <?php
                $sql = "SELECT course_name, course_code FROM courses WHERE id=$id";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                ?>
                    <li>
                        <a href="coursetable.php?course=<?php echo $row['course_code'];?>"><?php echo $row['course_name']; ?></a>
                    </li>
                <?php } ?>

            </ul>
        </nav>

        <!-- Page Content Holder -->
        <div id="content">

        <?php
        $sql="SELECT course_name, semester FROM courses WHERE course_code='$cd'";
        $result = $conn->query($sql);
        $row=$result->fetch_assoc();
        $cn=$row['course_name'];
        ?>

            <main class="col-md-auto ms-sm-3 col-lg-auto px-md-auto" id="printableTable">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                    <h4 class="h4"><?php echo "Course: ".$cn ?></h4>

                    <div class="d-grid gap-2 d-md-block" role="group" aria-label="First group">
                        <a type="button" class="btn btn-outline-secondary" href="edit.php?course=<?php echo $cd ?>">Edit</a>
                        <a type="button" class="btn btn-outline-secondary" target="_blank" href="print.php?course=<?php echo $cd ?>">Print</a>
                    </div>
                </div>
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
                                $sql="SELECT * FROM controlsheet WHERE course_code='$cd'";
                                $result = $conn->query($sql);
                                if($row=$result->fetch_assoc()) {
                                ?>
                                <th>Maximum Marks🠖</th>
                                <th><?php echo $row['class_test_1']; ?></th>
                                <th><?php echo $row['class_test_2']; ?></th>
                                <th><?php echo $row['class_test_3']; ?></th>
                                <th><?php echo $row['class_test_4']; ?></th>
                                <th><?php echo $row['mid_term_1']; ?></th>
                                <th><?php echo $row['mid_term_2']; ?></th>
                                <th><?php echo $row['total_assesment']; ?></th>
                                <th><?php echo $row['end_term']; ?></th>
                                <th><?php echo $row['total_marks']; ?></th>
                                <th><?php echo $row['grade']; ?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1;
                        while($row=$result->fetch_assoc()){ ?>
                        <tr>
                        <td><?php echo $i++;?></td>
                        <td><?php echo $row['roll_no'];?></td>
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['class_test_1']; ?></td>
                        <td><?php echo $row['class_test_2']; ?></td>
                        <td><?php echo $row['class_test_3']; ?></td>
                        <td><?php echo $row['class_test_4']; ?></td>
                        <td><?php echo $row['mid_term_1']; ?></td>
                        <td><?php echo $row['mid_term_2']; ?></td>
                        <td><?php echo $row['total_assesment']; ?></td>
                        <td><?php echo $row['end_term']; ?></td>
                        <td><?php echo $row['total_marks']; ?></td>
                        <td></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>

                <br>
                <hr>
                <br>
                <div class="table-responsive grade" >
                <div class="sameline grades">
                <div class="text-start h5">Grade Point Cutoff</div>
                    <a class="btn btn-outline-secondary mb-2">Generate Grades</a>
                </div>
                <table class="table table-bordered border-primary grades">
                        <thead>
                        <tr>
                            <td><strong>Grade</strong></td>
                            <?php
                            $a=0;
                            $g;
                            $sql="SELECT grade FROM gradewindow WHERE course_code='$cd'";
                            $result = $conn->query($sql);
                            while($row=$result->fetch_assoc()) {
                            ?>
                            <td><?php echo $row['grade']; $g[$a++]=$row['grade']; } ?></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td scope="row"><strong>Cutoff</strong></td>
                            <?php
                            $b=0;
                            while($b < $a) {
                            $sql="SELECT cut_off FROM gradewindow WHERE course_code='$cd' AND grade='$g[$b]'";
                            $result = $conn->query($sql);
                            if($row=$result->fetch_assoc()) {
                            ?>
                            <td scope="row"><?php  echo $row['cut_off']; ?></td>
                            <?php
                            } else { ?>
                            <td scope="row"><?php echo "-"; } $b++; } ?></td>
                        </tr>
                        <tr>
                            <td><strong>Total Students</strong></td>
                            <?php
                            $b=0;
                            while($b < $a) {
                            $sql="SELECT no_of_students FROM gradewindow WHERE course_code='$cd' AND grade='$g[$b]'";
                            $result = $conn->query($sql);
                            if($row=$result->fetch_assoc()) {
                            ?>
                            <td scope="row"><?php  echo $row['no_of_students']; ?></td>
                            <?php
                            } else { ?>
                            <td scope="row"><?php echo "-"; } $b++; } ?></td>
                        </tr>
                        </tbody>
                </table>
                </div>
            </main>
        </div>
    </div>

    <!-- iframe -->
    <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });

        });
    </script>
    <?php 
}
else
{
    header('Location: index.php?error=INVALID REQUEST');
    exit();
}
?>
</body>

</html>