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
            $gr=array();
            while($row = $result->fetch_assoc())
            {
                array_push($gr,new g($row['grade'],$row['upper_cutoff'],$row['lower_cutoff']));
            }
            $sql = "SELECT * FROM controlsheet WHERE course_code='$cd'";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc())
            {
                if($row['roll_no']==NULL)
                continue;
                $rn=$row['roll_no'];
                $marks=$row['total_marks'];
                $marks=round($marks);
                $gra=NULL;
                $t=count($gr);
                $t--;
                while($t>=0)
                {
                    if($marks>=($gr[$t]->lb)&&$marks<=($gr[$t]->ub))
                    {
                        $gra=$gr[$t]->gn;
                        break;
                    }
                    $t--;
                }
                $sql="UPDATE controlsheet SET grade='$gra' WHERE course_code='$cd' AND roll_no='$rn'";
                if ($conn->query($sql) !== TRUE)
                {
                    header('Location: coursetable.php?course='.$cd.'&error='.$conn->error);
                    exit();
                }
            }
            $t=count($gr);
            $t--;
            while($t>=0)
            {
                $sql = "SELECT grade,roll_no FROM controlsheet WHERE course_code='$cd'";
                $count=0;
                $grade_name=$gr[$t]->gn;
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc())
                {
                    if($row['roll_no']==NULL)
                    continue;
                    if($row['grade']==$grade_name)
                    $count++;
                } 
                $sql="UPDATE gradewindow SET no_of_students=$count WHERE course_code='$cd' AND grade='$grade_name'";
                if ($conn->query($sql) !== TRUE)
                {
                    header('Location: coursetable.php?course='.$cd.'&error='.$conn->error);
                    exit();
                } 
                $t--;
            }
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