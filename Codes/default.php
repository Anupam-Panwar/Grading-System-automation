<?php
    session_start();
    if(isset($_SESSION['id']))
    {
        require_once __DIR__ . '/connection/connect.php';
        if (isset($_GET['course']))
        {
            $cd = $_GET['course'];
            $sql = "SELECT id FROM courses WHERE course_code='$cd'";
            $result = $conn->query($sql);
            if ($result->num_rows==1) 
            {
                $row=$result->fetch_assoc();
                if($_SESSION['id']!=$row['id']  && $_SESSION['name']!='Admin')
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

            //changing flag value
            $sql = "UPDATE courses SET flag=0 WHERE course_code='$cd'";
            if ($conn->query($sql) !== TRUE) {
                echo "error updating flag value";
                exit();
            }

            //setting default gradewindow
            function mean($total, $n) {
                $sum = 0;
                while($row = $total->fetch_assoc())
                    $sum += $row['total_marks'];
                return $sum/$n;
            }

            function standardDeviation($total, $n, $mean) {
                $sq = 0;
                while($row = $total->fetch_assoc())
                    $sq += ($row['total_marks']-$mean)*($row['total_marks']-$mean);
                return sqrt($sq/$n);
            }

            function setGrade($cd, $gn, $ub, $lb, $conn) {
                $sql="UPDATE gradewindow SET lower_cutoff=".$lb.", upper_cutoff=".$ub." WHERE course_code='$cd' AND grade='$gn'";
                if ($conn->query($sql) !== TRUE) {
                    header('Location: edit.php?course='.$cd.'&error=ERROR UPDATING GRADE CUT OFF');
                }
            }

            $sql = "SELECT total_marks FROM controlsheet WHERE course_code='$cd'";
            $result = $conn->query($sql);
            $n = $result->num_rows;
            $mean = mean($result, $n);
            $sql = "SELECT total_marks FROM controlsheet WHERE course_code='$cd'";
            $result = $conn->query($sql);
            $n = $result->num_rows;
            $sd = standardDeviation($result, $n, $mean);

            setGrade($cd, "AA", 100, round($mean+$sd), $conn);
            setGrade($cd, "AB", round($mean+$sd)-1, round($mean+($sd/2)), $conn);
            setGrade($cd, "BB", round($mean+($sd/2))-1, round($mean), $conn);
            setGrade($cd, "BC", round($mean)-1, round($mean-($sd/2)), $conn);
            setGrade($cd, "CC", round($mean-($sd/2))-1, round($mean-$sd), $conn);
            setGrade($cd, "DD", round($mean-$sd)-1, round($mean-(($sd*3)/2)), $conn);
            setGrade($cd, "FF", round($mean-(($sd*3)/2))-1, 0, $conn);
            
            require_once __DIR__ . '/connection/disconnect.php';
            header('Location: coursetable.php?course='.$cd);
            exit();
        }
        else  
        {
            header('Location: edit.php?error=ERROR OCCURRED : Not a valid course code ');
            exit();
        }
    }  
    else
    {
        header('Location: index.php?error=INVALID REQUEST');
        exit();
    }
?>