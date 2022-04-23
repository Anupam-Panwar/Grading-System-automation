<?php
    session_start();
    if(isset($_SESSION['id'])) {
        require_once __DIR__ . '/connection/connect.php';

        if (isset($_GET['course'])) {
            $cd = $_GET['course'];
            $sql = "SELECT id FROM courses WHERE course_code='$cd'";
            $result = $conn->query($sql);
            if ($result->num_rows==1) {
                $row=$result->fetch_assoc();
                if($_SESSION['id']!=$row['id'] && $_SESSION['name'] != 'Admin') {
                    header('Location: dashboard_admin.php?error=COURSE NOT FOUND');
                    exit();
                }
            } else {
                header('Location: dashboard_admin.php?error=COURSE NOT FOUND');
                exit();
            }
        } else {
            header('Location: dashboard_admin?error=ERROR OCCURRED : Not a valid course code ');
            exit();
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $c = count($_POST['roll']);
            $x = 0;
            for($i = 0; $i < $c; $i++) {
                $r = $_POST['roll'][$i];
                $sql = "SELECT roll_no FROM controlsheet WHERE course_code='$cd' AND roll_no='$r'";
                $result = $conn->query($sql);
                if ($result->num_rows) {
                    //Updation
                    $sql1 = "UPDATE controlsheet SET name='" . $_POST['name'][$i] . "', grade='".$_POST['grade'][$i]."' WHERE course_code='$cd' AND roll_no='$r'";
                    if ($conn->query($sql1) !== TRUE) {
                        header('Location: edit_admin.php?course='.$cd.'&error=ERROR UPDATING RECORD');
                        exit();
                    }
                } else {
                    //New Student
                    $ta = ($_POST['ct1'][$x]+$_POST['ct2'][$x]+$_POST['ct3'][$x]+$_POST['ct4'][$x]+$_POST['mt1'][$x]+$_POST['mt2'][$x]);
                    $tm = $ta+$_POST['endterm'][$x];
                    $sql1 = "INSERT INTO controlsheet (course_code,roll_no,name,class_test_1,class_test_2,class_test_3,class_test_4,mid_term_1,mid_term_2,total_assessment,end_term,total_marks) VALUES ('$cd','$r','".$_POST['name'][$i]."',".$_POST['ct1'][$x].",".$_POST['ct2'][$x].",".$_POST['ct3'][$x].",".$_POST['ct4'][$x].",".$_POST['mt1'][$x].",".$_POST['mt2'][$x].",".$ta.",".$_POST['endterm'][$x].",".$tm.")";
                    if ($conn->query($sql1) !== TRUE) {
                        header('Location: edit_admin.php?course='.$cd.'&error=ERROR UPDATING RECORD');
                        exit();
                    }
                    $x++;
                }
            }
            header('Location: coursetable.php?course='.$cd);
            exit();
        } else {
            header('Location: coursetable.php?error=ERROR OCCURRED');
            exit();
        }
        require_once __DIR__ . '/connection/disconnect.php';
    } else {
        header('Location: index.php?error=INVALID REQUEST');
        exit();
    }
?>