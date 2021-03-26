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

      
    <!-- print function -->
        <script>
        function printDiv() {
          window.frames["print_frame"].document.body.innerHTML = document.getElementById("printableTable").innerHTML;
          window.frames["print_frame"].window.focus();
          window.frames["print_frame"].window.print();
        }
        </script>
        <?php
        require_once __DIR__ .'\connection\connect.php';
        $cd="CSL-258";
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
      <span class="text-white h3">Grades</span>
      <form class="d-flex">
        <button class="btn btn-outline-success" type="txt">Log Out</button>
      </form>
    </div>
  </nav>

  <div class="wrapper">
      <!-- Sidebar Holder -->
      <nav id="sidebar">
        <ul class="list-unstyled components">
            <div class="sidebar-header">
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
            

            ?>
                <h3><?php echo $uname; ?></h3>
            </div>
          <p class="h4">Courses</p>
          <?php
                $sql="SELECT course_name FROM courses WHERE id=$id";
                $result = $conn->query($sql);
                while($row=$result->fetch_assoc())
                {        
                 ?>
                    <li>
                        <a href="#"><?php echo $row['course_name']; ?></a>
                    </li>
                <?php } ?>
          
        </ul>
      </nav>

      <!-- Page Content Holder -->
      <div id="content">

          
        <main class="col-md-auto ms-sm-3 col-lg-auto px-md-auto" id="printableTable">
              <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                <h3 class="h3">Current Course Name</h3>

                <div class="d-grid gap-2 d-md-block" role="group" aria-label="First group">
                  <a type="button" class="btn btn-outline-secondary d-print-none" href="edit.php">Edit</a>
                  <a type="button" class="btn btn-outline-secondary d-print-none" href="print.php" >Print</a>
                </div>
              </div>
        
              <h5>Batch 2019-2023 Sem-4</h5>
              <div class="table-responsive" >
                <table class="table table-striped table-sm">
                  <thead>
                    <tr>
                      <th>S.N.</th>
                      <th>Student Name</th>
                      <th>Roll No</th>
                      <th>CT-1</th>
                      <th>CT-2</th>
                      <th>MT-1</th>
                      <th>MT-2</th>
                      <th>END-TERM</th>
                      <th>Total</th>
                      <th>Grade</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql="SELECT name ,roll_no FROM controlsheet WHERE course_code='$cd'";
                    $result = $conn->query($sql);
                    $n=$result->num_rows;
                    $a=$n-1;
                    while($row=$result->fetch_assoc()){?>
                    <tr>
                      <td><?php echo $n-$a;?></td>
                      <td> <?php echo $row['name'];?></td>
                      <td><?php echo $row['roll_no'];?></td>
                      <td>placeholder</td>
                      <td>text</td>
                      <td>text</td>
                      <td>random</td>
                      <td>data</td>
                      <td>placeholder</td>
                      <td>text</td>
                    </tr>
                    
                    <?php $a--; }?>
                  </tbody>
                </table>
              </div>
            
            <br>
            <hr>
            <br>
            <div class="table-responsive grade" >
            <table class="table table-bordered border-primary grades">
                    <thead>
                      <tr>
                          <strong>Grade Window</strong>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">100-90</th>
                        <th scope="row">89-80</th>
                        <th scope="row">79-70</th>
                        <th scope="row">69-60</th>
                        <th scope="row">59-50</th>
                        <th scope="row"><50</th>                   
                      </tr>
                      <tr>
                        <td>AB</td>
                        <td>AB</td>
                        <td>BB</td>
                        <td>BC</td>
                        <td>CC</td>
                        <td>FF</td>
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
</body>

</html>
