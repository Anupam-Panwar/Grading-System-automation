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

    <title>Edit Course-name</title>

  

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/edit.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <?php
    require_once __DIR__ .'\connection\connect.php';
    if (isset($_GET['course']))
    {
        $cd = $_GET['course'];
    }
    else
    {
        header('Location: coursetable.php?error=ERROR OCCURRED');
        exit();
    }
    ?>

</head>

<body>


<!-- navbar -->
  <nav class="navbar navbar-light bg-dark">
    <div class="container-fluid sameline">
      <div class="initials">
        <?php
        $id=$_SESSION['id'];
        $uname=$_SESSION['name'];
        ?>
        <span class="text-white text-center fs-3 initial"><?php echo substr($uname,0,1); ?></span>
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
          
        <main class="col-md-auto ms-sm-3 col-lg-auto px-md-auto">
        <form action="insert.php?course=<?php echo $cd; ?>" method="post">
              <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                <?php
                $sql="SELECT course_name, semester FROM courses WHERE course_code='$cd'";
                $result = $conn->query($sql);
                if($row=$result->fetch_assoc())
                {        
                 ?>
                <h4 class="h4">Course: <?php echo $row['course_name']; ?></h4>
                <?php $cn=$row['course_name']; ?>

                <div class="d-grid gap-2 d-md-block" role="group" aria-label="First group">
                  <input type="submit" value="Save" class="btn btn-outline-secondary d-print-none" />
                </div>
              </div>
        
              <h5>Session: <?php echo $row['semester']; } ?> </h5>
              <br>
              <div class="table-responsive" >
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
                      $sql="SELECT * FROM controlsheet WHERE course_code='$cd'";
                      $result = $conn->query($sql);
                      if($row=$result->fetch_assoc()) { ?>
                      <th><input class="classtest" name="mct1" value="<?php echo $row['class_test_1'];?>"></input></th>
                      <th><input class="classtest" name="mct2" value="<?php echo $row['class_test_2'];?>"></input></th>
                      <th><input class="classtest" name="mct3" value="<?php echo $row['class_test_3'];?>"></input></th>
                      <th><input class="classtest" name="mct4" value="<?php echo $row['class_test_4'];?>"></input></th>
                      <th><input class="marks" name="mmt1" value="<?php echo $row['mid_term_1'];?>"></input></th>
                      <th><input class="marks" name="mmt2" value="<?php echo $row['mid_term_2'];?>"></input></th>
                      <th><?php echo $row['total_assesment']; ?></th>
                      <th><input class="marks" name="met" value="<?php echo $row['end_term'];?>"></input></th>
                      <th><?php echo $row['total_marks']; ?></th>
                      <th><?php echo $row['grade']; ?></th>
                    </tr>
                    <?php } ?>
                  </thead>
                  <tbody>
                    <?php
                    $i=1;
                    while($row=$result->fetch_assoc()) { ?>
                    <tr>
                      <td><?php echo $i++; ?></td>
                      <td><input class="rollno" name="roll[]" value="<?php echo $row['roll_no'];?>" readonly></input></td>
                      <td><?php echo $row['name'];?></td>
                      <td><input class="classtest" name ="ct1[]" value="<?php echo $row['class_test_1'];?>"></input></td>
                      <td><input class="classtest" name ="ct2[]" value="<?php echo $row['class_test_2'];?>"></input></td>
                      <td><input class="classtest" name ="ct3[]" value="<?php echo $row['class_test_3'];?>"></input></td>
                      <td><input class="classtest" name ="ct4[]" value="<?php echo $row['class_test_4'];?>"></input></td>
                      <td><input class="marks" name ="mt1[]" value="<?php echo $row['mid_term_1'];?>"></input></td>
                      <td><input class="marks" name ="mt2[]" value="<?php echo $row['mid_term_2'];?>"></input></td>
                      <td><?php echo $row['total_assesment']; ?></td>
                      <td><input class="marks" name="endterm[]" value="<?php echo $row['end_term'];?>"></input></td>
                      <td><?php echo $row['total_marks']; ?></td>
                      <td><?php echo $row['grade']; ?></td>
                    </tr>
                    <?php }?>
                  </tbody>
                </table>
              </div>
            
            <br>
            <hr>
            <br>

            <div class="table-responsive grades" >
            <div class="text-start h5">Grade Point Cutoff</div>
            <table class="table table-bordered border-primary">
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
                        <td><strong>Cutoff</strong></td>
                        <?php
                        $b=0;
                        while($b < $a) {
                        $sql="SELECT cut_off FROM gradewindow WHERE course_code='$cd' AND grade='$g[$b]'";
                        $result = $conn->query($sql);
                        if($row=$result->fetch_assoc()) {
                        ?>
                        <td>
                          <input class="gradewin" value="<?php  echo $row['cut_off']; ?>"></input>
                          -
                          <input class="gradewin" value="<?php  echo $row['cut_off']; ?>"></input>
                        </td>
                        <?php
                        } else { ?>
                        <td><input class="gradewin" value="<?php echo "-"; ?>"></input></td>
                        <?php } $b++; } ?>
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
                        <td><?php  echo $row['no_of_students']; ?></td>
                        <?php
                        } else { ?>
                        <td><?php echo "-"; } $b++; } ?></td>
                      </tr>
                    </tbody>
            </table>
            </div>
            </form>
          </main>
      </div>
  </div>


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
