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
            header('Location: edit.php?error=ERROR OCCURRED');
            exit();
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $c=count($_POST['roll']);
            $i=1;
            for($i=0;$i<$c;$i++)
            {
                $r=$_POST['roll'][$i];

                $sql="UPDATE controlsheet SET class_test_1=".$_POST['ct1'][$i].", class_test_2=".$_POST['ct2'][$i].",
                class_test_3=".$_POST['ct3'][$i].",class_test_4=".$_POST['ct4'][$i].",mid_term_1=".$_POST['mt1'][$i].",
                mid_term_2=".$_POST['mt2'][$i].",end_term=".$_POST['endterm'][$i]." WHERE course_code='$cd' AND roll_no='$r'";

                if ($conn->query($sql) !== TRUE)
                {
                    header('Location: edit.php?error=ERROR UPDATING RECORD');
                    exit();
                }
            }
            require_once __DIR__ . '\connection\disconnect.php';

            header('Location: coursetable.php?course='.$cd);
            exit();
        }
        else
        {
            header('Location: coursetable.php?error=ERROR OCCURRED');
            exit();
        }
    }
    else
    {
        header('Location: index.php?error=INVALID REQUEST');
        exit();
    }

?>