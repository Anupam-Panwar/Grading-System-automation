<?php
    session_start();
    if(isset($_SESSION['id']))
    {
        require_once __DIR__ . '\connection\connect.php';

        if (isset($_GET['course']))
        {
            $cd = $_GET['course'];
        }
        else  
        {
            header('Location: edit.php?error=ERROR OCCURRED : Not a valid course code ');
            exit();
        }
        class g
        {
            public $gn;
            public $lb;
            public $ub;
            function __construct($gn,$u,$l) 
            {
                $this->gn = $gn;
                $this->ub = $u;
                $this->lb = $l;
            }
        }
        $sql = "SELECT grade,upper_cutoff,lower_cutoff FROM gradewindow WHERE course_code='$cd' ORDER BY grade";
        $result = $conn->query($sql);
        $gr;
        $temp=0;
        while($row = $result->fetch_assoc())
        {
            $gr[$temp]=new g($row['grade'],$row['upper_cutoff'],$row['lower_cutoff']);
            $temp++;
        }
        // $i=0;
        // while($i<$temp)
        // {
        //     echo $gr[$i]->gn;
        //     echo $gr[$i]->lb;
        //     echo $gr[$i]->ub;
        //     $i++;
        //     echo "<br>";
        // }
        //exit();
        $sql = "SELECT * FROM controlsheet WHERE course_code='$cd'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc())
        {
            $marks=$row['total_marks'];
            $gra="";
            $t=0;
            while($t<$temp)
            {
                if($marks>=($gr[$t]->lb)&&$marks<=($gr[$t]->ub))
                {
                    $gra=$gr[$t]->gn;
                    break;
                }
                $t++;
            }
            //for the time being so that error do not occur
            if($t>=$temp)
            {
                header('Location: coursetable.php?error=GADBAD HO GAYA');
            }
            
            
            echo $row['roll_no'];
            echo " ";
            echo $gra;
            echo "<br>";
           
            // $sql="UPDATE controlsheet SET grade=".$gra." WHERE course_code=".$cd." AND roll_no=".$row['roll_no'];
            // if ($conn->query($sql) !== TRUE)
            // {
            //     header('Location: coursetable.php?course='.$cd.'&error=ERROR UPDATING GRADE CUT OFF');
            //     exit();
            // }
        }
        exit();








            require_once __DIR__ . '\connection\disconnect.php';

            header('Location: coursetable.php?course='.$cd);
            exit();
        
        // else
        // {
        //     header('Location: coursetable.php?error=ERROR OCCURRED');
        //     exit();
        // }
    }
    else
    {
        header('Location: index.php?error=INVALID REQUEST');
        exit();
    }
?>