<?php

    session_start();
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
        $sql="SELECT id FROM courses WHERE course_code='$cd'";
        $result=$conn->query($sql);
        $id;
        if($result->num_rows>0)
        {
          $row=$result->fetch_assoc();
          $id=$row['id'];
        }
        else
        {
          header('Location: index.php');
          exit();
        }
        $sql="SELECT username FROM users WHERE id=$id";
        $result=$conn->query($sql);
        $uname;
        if($result->num_rows==1)
        {
          $row=$result->fetch_assoc();
          $uname=$row['username'];
        }
        $user=substr($uname,0,1);
        ?>
        <span class="text-white text-center fs-3 initial"><?php echo $user; ?></span>
      </div>
      <span class="text-white h3">Control Sheet</span>
      
      <form class="d-flex">
        <button class="btn btn-outline-success" type="txt">Log Out</button>
      </form>
    </div>
  </nav>

  <div class="wrapper">
  

      <!-- Page Content Holder -->
      <div id="content">

          
        <main class="col-md-auto ms-sm-3 col-lg-auto px-md-auto">
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
                  <a type="button" class="btn btn-outline-secondary d-print-none" href="coursetable.php?course=<?php echo $cd; ?>">Save</a>
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
                      <th><input placeholder="M.M." class="classtest"></input></th>
                      <th><input placeholder="M.M." class="classtest"></input></th>
                      <th><input placeholder="M.M." class="classtest"></input></th>
                      <th><input placeholder="M.M." class="classtest"></input></th>
                      <th><input placeholder="M.M." class="marks"></input></th>
                      <th><input placeholder="M.M." class="marks"></input></th>
                      <th>MM</th>
                      <th><input placeholder="M.M." class="marks"></input></th>
                      <th>100</th>
                      <th>AA</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $sql="SELECT * FROM controlsheet WHERE course_code='$cd'";
                    $result = $conn->query($sql);
                    $row=$result->fetch_assoc();
                    $i=1;
                    while($row=$result->fetch_assoc()){?>
                    <tr>
                      <td><?php echo $i++?></td>
                      <td><?php echo $row['roll_no'];?></td>
                      <td><?php echo $row['name'];?></td>
                      <td><input class="classtest"></input></td>
                      <td><input class="classtest"></input></td>
                      <td><input class="classtest"></input></td>
                      <td><input class="classtest"></input></td>
                      <td><input class="marks"></input></td>
                      <td><input class="marks"></input></td>
                      <td>MT1+MT2+CT</td>
                      <td><input class="marks"></input></td>
                      <td>100</td>
                      <td>AA</td>
                    </tr>
                    <?php }?>
                  </tbody>
                </table>
              </div>
            
            <br>
            <hr>
            <br>

            <div class="table-responsive" >
            <div class="text-start h5">Grade Point Cutoff</div>
            <table class="table table-bordered border-primary">
                    <thead>
                      <tr>
                          <td><strong>Grade</strong></td>
                          <td>AA</td>
                          <td>AB</td>
                          <td>BB</td>
                          <td>BC</td>
                          <td>CC</td>
                          <td>DD</td>
                          <td>FF</td>
                          <td>GG</td>
                          <td>UU</td>
                          <td>PP</td>
                          <td>YY</td>
                          <td>SS</td>
                          <td>ZZ</td>
                          <td>XX</td>
                          <td>JJ</td>
                        </tr>
                    </thead>
                    <tbody>
                          <tr>
                            <td><strong>Cutoff</strong></td>
                            <td><input class="gradewin"></input></td>
                            <td><input class="gradewin"></input></td>
                            <td><input class="gradewin"></input></td>
                            <td><input class="gradewin"></input></td>
                            <td><input class="gradewin"></input></td>
                            <td><input class="gradewin"></input></td>
                            <td><input class="gradewin"></input></td>
                            <td><input class="gradewin"></input></td>
                            <td><input class="gradewin"></input></td>
                            <td><input class="gradewin"></input></td>
                            <td><input class="gradewin"></input></td>
                            <td><input class="gradewin"></input></td>
                            <td><input class="gradewin"></input></td>
                            <td><input class="gradewin"></input></td>
                            <td><input class="gradewin"></input></td>                       
                          </tr>
                          <tr>
                            <td><strong>Total Students</strong></td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                          </tr>
                    </tbody>
            </table>
            </div>
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
</body>

</html>
