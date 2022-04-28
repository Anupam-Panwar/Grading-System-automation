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
        <link rel="stylesheet" href="css/edit.css">

        <!-- Font Awesome JS -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

        <!-- new additon jQuer -->
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

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
                <div>
                    <a href="dashboard_admin.php">
                        <div class="initials text-white text-center fs-3"><?php echo substr($uname, 0, 1); ?></div>
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
                    <form action="insert_student.php?course=<?php echo $cd; ?>" method="post">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                            <?php
                            $sql = "SELECT course_name, semester, batch FROM courses WHERE course_code='$cd'";
                            $result = $conn->query($sql);
                            if ($row = $result->fetch_assoc()) {
                            ?>
                                <h4 class="h4">Course: <?php echo $row['course_name']; ?></h4>
                                <?php $cn = $row['course_name']; ?>

                                <div class="d-grid gap-2 d-md-block" role="group" aria-label="First group">
                                    <input type="submit" value="Save" class="btn btn-outline-secondary d-print-none" id ="save"/>
                                    <a href="coursetable.php?course=<?php echo $cd; ?>"><input type="button" value="Cancel" class="btn btn-outline-secondary d-print-none" /></a>
                                </div>
                        </div>

                        <h5>Batch: <?php echo $row['batch'];
                                    ?> </h5>

                        <h5>Session: <?php echo $row['semester'];
                                    } ?> </h5>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm tablecustom tbl_code_with_mark">
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
                                        <?php if ($_SESSION['name'] == 'Admin') { ?>
                                            <th></th>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th>S. No.</th>
                                        <th>Roll No.</th>
                                        <th>Maximum Marks 🠖</th>
                                        <?php
                                        $sql = "SELECT * FROM courses WHERE course_code='$cd'";
                                        $result = $conn->query($sql);
                                        if ($row = $result->fetch_assoc()) { ?>
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
                                            <?php if ($_SESSION['name'] == 'Admin') { ?>
                                            <th></th>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM controlsheet WHERE course_code='$cd'";
                                    $result = $conn->query($sql);
                                    $i = 1;
                                    while ($row = $result->fetch_assoc()) { ?>
                                        <tr>
                                            <td class='sno' style="font-weight:bold"><?php echo $i++; ?></td>
                                            <td><input class="rollno" name="roll[]" value="<?php echo $row['roll_no']; ?>" style="font-weight:bold" readonly></input></td>
                                            <td><input class="name" name="name[]" value="<?php echo $row['name']; ?>"></input></td>
                                            <td style=<?php if($row['class_test_1']=='Ab') echo "color:red;"?>><?php echo $row['class_test_1']; ?></td>
                                            <td style=<?php if($row['class_test_2']=='Ab') echo "color:red;"?>><?php echo $row['class_test_2']; ?></td>
                                            <td style=<?php if($row['class_test_3']=='Ab') echo "color:red;"?>><?php echo $row['class_test_3']; ?></td>
                                            <td style=<?php if($row['class_test_4']=='Ab') echo "color:red;"?>><?php echo $row['class_test_4']; ?></td>
                                            <td style=<?php if($row['mid_term_1']=='Ab') echo "color:red;"?>><?php echo $row['mid_term_1']; ?></td>
                                            <td style=<?php if($row['mid_term_2']=='Ab') echo "color:red;"?>><?php echo $row['mid_term_2']; ?></td>
                                            <td><?php echo $row['total_assessment']; ?></td>
                                            <td style=<?php if($row['end_term']=='Ab') echo "color:red;"?>><?php echo $row['end_term']; ?></td>
                                            <td><?php echo $row['total_marks']; ?></td>
                                            <td style="padding-left:0px; padding-right:0px; padding-bottom:0px;">
                                                <select style="padding-left:4px; padding-top:2px; padding-bottom:2px; padding-right:8px;" class="form-select marks" aria-label="Default select example" name="grade[]" value="<?php echo $row['grade']; ?>">
                                                    <option selected><?php echo $row['grade']; ?></option>
                                                    <?php if($row['grade']=='XX') { ?>
                                                        <option value=""></option>
                                                    <?php } else { ?>
                                                        <option value="XX">XX</option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td style="display:flex; flex-direction: row;   ">
                                                <!-- new addition <span style="width:8rem;"class="btn btn-sm btn-success btn_row_below_new">Add-New</span> | -->
                                                <span style="width:2rem;" class="btn btn-sm btn-danger btn_row_delete" id="<?php echo $row['roll_no']; ?>"><i class="fas fa-trash"></i></span>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="text-center"><span class="btn btn-sm btn-success btn_row_add_below_end">Add Student</span></div>
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
                                            <td><?php echo $row['grade']; ?>
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
                                                <?php echo $row['upper_cutoff']; ?>
                                                -
                                                <?php echo $row['lower_cutoff']; ?>
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
        require __DIR__ . '/utility/foot_info.php';
        ?>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#sidebarCollapse').on('click', function() {
                    $('#sidebar').toggleClass('active');
                    $(this).toggleClass('active');
                });

            });
        </script>

        <!-- NEW -->
        <script>
            var toDelete = [];
            $(document).ready(function($) {
                //--->add student
                $(document).on('click', ".btn_row_add_below_end", function(e) {
                    $(".tbl_code_with_mark tbody").append('<tr><td class="sno" style="font-weight:bold">1</td><td><input class="rollno" name="roll[]" value="" style="font-weight:bold"></input></td><td><input class="name" name="name[]" value=""></input></td><!-- <td><strong>""</strong></td> --><td><input class="classtest" name="ct1[]" value="0"></input></td><td><input class="classtest" name="ct2[]" value="0"></input></td><td><input class="classtest" name="ct3[]" value="0"></input></td><td><input class="classtest" name="ct4[]" value="0"></input></td><td><input class="marks" name="mt1[]" value="0"></input></td><td><input class="marks" name="mt2[]" value="0"></input></td><td></td><td><input class="marks" name="endterm[]" value="0"></input></td><td></td><td></td><td style="display:flex; flex-direction: row;   "><span style="width:2rem;"class="btn btn-sm btn-danger btn_row_delete"><i class="fas fa-trash"></i></span></td></tr>');
                    let rowCount = $('.tbl_code_with_mark tbody tr').length;
                    $(".tbl_code_with_mark tbody tr:last td:first").text(rowCount)

                });

                $(document).on('click', '#save', (e)=>{
                    console.log(toDelete);
                    if(toDelete.length!=0){
                        toDelete.map((x)=>{
                            $.ajax({
                                type: 'post',
                                url: 'ajax.php',
                                data: {
                                    ajax: 9,
                                    id: x,
                                    cd: "<?php echo $cd ?>"
                                },
                                success: (response) => {
                                    console.log(response);
                                }
                            });
                        })
                    }
                })

                $(document).on('click', ".btn_row_delete", function(e) {
                    let rowCount = $('.tbl_code_with_mark tbody tr').length;
                    var r = $(this).closest('tr').remove();
                    for (var i = 1; i <= rowCount; i++) {
                        $(".tbl_code_with_mark tbody tr:nth-child(" + i + ") td:first").text(i)
                    }
                    var rno = this.id;
                    toDelete.push(rno);
                });
                //--->current row > delete > end

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