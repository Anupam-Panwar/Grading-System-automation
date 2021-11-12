<?php
require_once __DIR__ . '/connection/connect.php';
if (isset($_POST['course_name']) && isset($_POST['code']) && isset($_POST['year']) && isset($_POST['semester']) && isset($_GET['id'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $course_name = validate($_POST['course_name']);
    $code = validate($_POST['code']);
    $year = validate($_POST['year']);
    $teacher_id = validate($_GET['id']);
    $semester = validate($_POST['semester']);
    if (empty($course_name)) {
        header('Location: teacher_courses_admin.php?error=Course Name required&id='.$teacher_id);
        exit();
    } else if (empty($code)) {
        header('Location: teacher_courses_admin.php?error=Course Code Required&id='.$teacher_id);
        exit();
    } else if (empty($year)) {
        header('Location: teacher_courses_admin.php?error=Year value required&id='.$teacher_id);
        exit();
    }else if (empty($semester)) {
        header('Location: teacher_courses_admin.php?error=Semester value required!&id='.$teacher_id);
        exit();   
    }else if (empty($teacher_id)) {
        header('Location: teacher_courses_admin.php?error=There was an error!&id='.$teacher_id);
        exit();   
    }else {
        $sql = "INSERT INTO courses (id, course_name, course_code, batch, semester) VALUES ('$teacher_id', '$course_name', '$code', '$year', '$semester')";
        if ($conn->query($sql) === TRUE) {
            header('Location:teacher_courses_admin.php?error=Successfully added Course&id='.$teacher_id);
            exit();
        } else {
            header('Location:teacher_courses_admin.php?error=Unexpected Course&id='.$teacher_id);
            exit();
        }
    }
} else {

    header('Location:teacher_courses_admin.php?error=Enter data&id='.$teacher_id);
    exit();
}
require_once __DIR__ . '/connection/disconnect.php';
