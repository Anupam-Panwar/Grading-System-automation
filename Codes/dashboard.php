<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <title>dashboard</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/custom.css" />

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>

<body>

    <?php
    $name="Surendra Singh";
    $x = 6;
    $CN = array("Computer Organization","Computer Network", "Design and Analysis of Algorithm", "Theory of Computation", "Software Engineering ","Sports");
    $CC = array("CSL 256", "CSL 255","CSL 254", "CSl 259", "CSL 256", "SSP 151");
    ?>
    <nav class="navbar navbar-light bg-dark">
        <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="navbar-btn">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <span class="text-white h3">Courses</span>
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
                    <h3><?php echo "$name"; ?></h3>
                </div>
                <p class="h4">Courses</p>
                <?php
                for ($i = 0; $i < $x; $i++) { ?>
                    <li>
                        <a href="#"><?php echo "$CN[$i]"; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
       
        <!-- Page Content Holder -->
        <div id="content">
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php
                for ($i = 0; $i < $x; $i++) {
                ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="images/nituk2.jpg" class="card-img-top" alt="img">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo "$CN[$i]" ?></h5>
                                <p class="card-text"><?php echo "$CC[$i]" ?><br>BT19-Batch</p>
                            </div>
                        </div>
                    </div>
                <?php } ?>

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
        $(document).ready(function() {
            $("#sidebarCollapse").on("click", function() {
                $("#sidebar").toggleClass("active");
                $(this).toggleClass("active");
            });
        });
    </script>
</body>

</html>