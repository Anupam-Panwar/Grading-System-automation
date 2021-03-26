<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Print</title>

  

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/print.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>


<!-- navbar -->
  

  <div class="wrapper">
      <!-- Page Content Holder -->
      <div id="content">

          
        <main class="col-md-auto ms-sm-3 col-lg-auto px-md-auto" id="printableTable">
              <div class="text-center h3">National Institute of Technology, Uttarakhand</div>
              <div class="text-center h3">Control Sheet</div>
              <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                <h4 class="h4">Course: XXX-YYY ZZZZZZZZZ</h4>
                <span class="ctno text-end">Control Sheet No.:__/__/_______ <br>CC/HOD/F/CF</span>
              </div>

              <div class="fs-5 sameline">
                <span class="text-start">Session: Odd Semester-2021</span>
                <span class="text-end">Faculty: Faculty name</span>
              </div>
              <br>

              <div class="table-responsive" >
                <table class="table table-striped table-sm">
                  <thead>
                  <tr>
                      <th></th>
                      <th></th>
                      <th>Name ↓</th>
                      <th>Teachers Assmt.</th>
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
                      <th>Maximum Marks🠖</th>
                      <th>20</th>
                      <th>20</th>
                      <th>20</th>
                      <th>60</th>
                      <th>40</th>
                      <th>100</th>
                      <th>AA</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php for($i=1; $i<=20; $i++){?>
                    <tr>
                      <td><?php echo "$i"?></td>
                      <td>data</td>
                      <td>S Name <?php echo"$i"?></td>
                      <td>int</td>
                      <td>int</td>
                      <td>int</td>
                      <td>int</td>
                      <td>int</td>
                      <td>int</td>
                      <td>text</td>
                    </tr>
                    <?php }?>
                    
                    <tr>
                      <td></td>
                      <td></td>
                      <td><strong>Total</strong></td>
                      <td>total ct</td>
                      <td>total mt1</td>
                      <td>total mt2</td>
                      <td>total ass</td>
                      <td>total et</td>
                      <td>total total</td>
                      <td></td>
                    </tr>

                  </tbody>
                </table>
                    <div class="text-end">No. of students on Roll: 20</div>
              </div>
            
            <br>
            <hr>
            <br>
            <div class="table-responsive grade" >
            <table class="table table-bordered border-primary grades">
                    <thead>
                      <tr>
                          <strong>Grade Point Cutoff</strong>
                      </tr>
                    </thead>
                    <tbody>
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
                      <tr>
                        <td scope="row"><strong>Cutoff</strong></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row">-</td>
                        <td scope="row">-</td>
                        <td scope="row">-</td>
                        <td scope="row">-</td>
                        <td scope="row">-</td>
                        <td scope="row">-</td>
                        <td scope="row">-</td>
                        <td scope="row">-</td>                      
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
                <div class="text-end grades h5">FF Cutoff: 34</div>
            </div>
          </main>
          <br>
          <br>
          <br>
          <div class="fs-5 sameline">
              <div>Name & Signature of Examiner <br>Date:</div>
              <div>Name & Sign of HOD/Dept. Coordinator with Seal <br>Date:</div>
          </div>

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
