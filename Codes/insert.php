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
        }
        else  
        {
            header('Location: dashboard?error=ERROR OCCURRED : Not a valid course code ');
            exit();
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if (!(is_numeric($_POST['mct1'])&&is_numeric($_POST['mct2'])&&is_numeric($_POST['mct3'])&&is_numeric($_POST['mct4'])&&is_numeric($_POST['mmt1'])&&is_numeric($_POST['mmt2'])))
            {
                header('Location: edit.php?course='.$cd.'&error=ERROR OCCURRED : Enter valid information in Maximum mark field ');
                exit();
            }
            //Updating maximum marks
            $mta=($_POST['mct1']+$_POST['mct2']+$_POST['mct3']+$_POST['mct4']+$_POST['mmt1']+$_POST['mmt2']);
            $met=100-$mta;
            if (!(is_numeric($_POST['met'])))
            {
                header('Location: edit.php?course='.$cd.'&error=ERROR OCCURRED : Enter valid information in Maximum mark field ');
                exit();
            }
            if($mta<=100 && $met==$_POST['met'])
            {
                $sql="UPDATE courses SET mct1=".$_POST['mct1'].", mct2=".$_POST['mct2'].", mct3=".$_POST['mct3'].", mct4=".$_POST['mct4'].", 
                mmt1=".$_POST['mmt1'].", mmt2=".$_POST['mmt2'].", mta=".$mta.", met=".$met." WHERE course_code='$cd'";
                if($conn->query($sql) !== TRUE)
                {
                    header('Location: edit.php?course='.$cd.'&error=ERROR UPDATING RECORD');
                    exit();
                }
            }
            else
            {
                //Total assessment marks >100 OR endterm marks + total assessment marks != 100!!
                header('Location: edit.php?course='.$cd.'&error=ERROR OCCURRED : End term marks + total assessment marks not equal to 100');
                exit();
            }

            //Updating marks of each student
            $c=count($_POST['roll']);
            $i=1;
            function validMarks($formData, $cd) {
                if(is_numeric($formData)) {
                    $ct1=$formData;
                } else if($formData=="Ab") {
                    $ct1=0;
                } else {
                    header('Location: edit.php?course='.$cd.'&error=ERROR OCCURRED : Enter valid information in marks field ');
                    exit();
                }
                return $ct1;
            }
            for($i=0;$i<$c;$i++)
            {
                $r=$_POST['roll'][$i];
                $ct1=validMarks($_POST['ct1'][$i], $cd);
                $ct2=validMarks($_POST['ct2'][$i], $cd);
                $ct3=validMarks($_POST['ct3'][$i], $cd);
                $ct4=validMarks($_POST['ct4'][$i], $cd);
                $mt1=validMarks($_POST['mt1'][$i], $cd);
                $mt2=validMarks($_POST['mt2'][$i], $cd);
                $endterm=validMarks($_POST['endterm'][$i], $cd);
                $ta=($ct1+$ct2+$ct3+$ct4+$mt1+$mt2);
                $tm=$ta+$endterm;
                if($ct1<=$_POST['mct1'] && $ct2<=$_POST['mct2'] && $ct3<=$_POST['mct3'] && $ct4<=$_POST['mct4'] && $mt1<=$_POST['mmt1']  && $mt2<=$_POST['mmt2'] && $endterm<=$met)
                {
                    $sql="UPDATE controlsheet SET class_test_1='".$_POST['ct1'][$i]."', class_test_2='".$_POST['ct2'][$i]."', class_test_3='".$_POST['ct3'][$i]."', class_test_4='".$_POST['ct4'][$i]."', mid_term_1='".$_POST['mt1'][$i]."', 
                    mid_term_2='".$_POST['mt2'][$i]."', total_assessment=".$ta.", end_term='".$_POST['endterm'][$i]."', total_marks=".$tm." WHERE course_code='$cd' AND roll_no='$r'";

                    if ($conn->query($sql) !== TRUE)
                    {
                        header('Location: edit.php?course='.$cd.'&error=ERROR UPDATING RECORD');
                        exit();
                    }
                }
                else
                {
                    //Marks exceeding maximum marks!!
                    header('Location: edit.php?course='.$cd.'&error=ERROR OCCURRED : Marks exceed Maximum Marks');
                    exit();
                }
            }

            //Updating grade window

            //checking changes in gradewindow
            $c=count($_POST['grade']);
            for($i=0;$i<$c;$i++) {
                $r=$_POST['grade'][$i];
                $sql = "SELECT lower_cutoff, upper_cutoff FROM gradewindow WHERE course_code='$cd' AND grade='$r'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                if($row['lower_cutoff'] != $_POST['lb'][$i] || $row['upper_cutoff'] != $_POST['ub'][$i]) {
                    $sql1 = "UPDATE courses SET flag=1 WHERE course_code='$cd'";
                    if ($conn->query($sql1) !== TRUE) {
                        echo "error updating flag value";
                        exit();
                    }
                }
            }
            $sql = "SELECT flag FROM courses WHERE course_code='$cd'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $flag = $row['flag'];
            if($flag) {
                $c=count($_POST['grade']);
                for($i=0;$i<$c;$i++)
                {
                    $r=$_POST['grade'][$i];
                    if (!(is_numeric($_POST['lb'][$i])&&is_numeric($_POST['ub'][$i])))
                    {
                        header('Location: edit.php?course='.$cd.'&error=ERROR OCCURRED : Enter valid information in Grade Window field ');
                        exit();
                    }
                    if(!(($i==0 && $_POST['lb'][$i]<=$_POST['ub'][$i] && $_POST['ub'][$i]==100) || ($i==$c-1 && $_POST['lb'][$i]<=$_POST['ub'][$i] && $_POST['lb'][$i]==0 && ($_POST['lb'][$i-1]-$_POST['ub'][$i])==1) || ($i!=0 && $i!=$c-1 && ($_POST['lb'][$i]<=$_POST['ub'][$i]) && ($_POST['lb'][$i-1]-$_POST['ub'][$i])==1)))
                    {
                        //First cutoff upper bound != 100 or lowerbound(previous cutoff)-upperbound(this cutoff)!=1 or upperbound smaller than lower bound or last cutoff lower bound != 0!!
                        header('Location: edit.php?course='.$cd.'&error=ERROR OCCURRED : Invalid cutoff range');
                        exit();
                    }
                }
                for($i=0;$i<$c;$i++)
                {
                    $r=$_POST['grade'][$i];
                    $sql="UPDATE gradewindow SET lower_cutoff=".$_POST['lb'][$i].", upper_cutoff=".$_POST['ub'][$i]." WHERE course_code='$cd' AND grade='$r'";
                    if ($conn->query($sql) !== TRUE)
                    {
                        header('Location: edit.php?course='.$cd.'&error=ERROR UPDATING GRADE CUT OFF');
                        exit();
                    }
                }
            } else {
                //for default gradewindow
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
    
                function setGrade($cd, $gn, $ub, $lb, $conn)
                {
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
            }

            header('Location: coursetable.php?course='.$cd);
            exit();
        }
        else
        {
            header('Location: coursetable.php?error=ERROR OCCURRED');
            exit();
        }
        require_once __DIR__ . '/connection/disconnect.php';
    }
    else
    {
        header('Location: index.php?error=INVALID REQUEST');
        exit();
    }
?>