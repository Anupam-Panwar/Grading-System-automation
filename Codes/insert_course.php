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
    function setGrade($cd, $gn, $ub, $lb, $conn, $id)
    {
        $sql = "INSERT INTO gradewindow (course_code, grade, lower_cutoff, upper_cutoff, no_of_students) VALUES ('$cd', '$gn', $lb, $ub, 0)";
        if ($conn->query($sql) !== TRUE) {
            header('Location:teacher_courses_admin.php?error=Unexpected Input&id=' . $id);
        }
    }
    $course_name = validate($_POST['course_name']);
    $code = validate($_POST['code']);
    $year = validate($_POST['year']);
    $teacher_id = validate($_GET['id']);
    $semester = validate($_POST['semester']);
    $department = validate($_POST['department']);
    $type = validate($_POST['type']);
    if (empty($course_name)) {
        header('Location: teacher_courses_admin.php?error=Course Name required&id=' . $teacher_id);
        exit();
    } else if (empty($code)) {
        header('Location: teacher_courses_admin.php?error=Course Code Required&id=' . $teacher_id);
        exit();
    } else if (empty($year)) {
        header('Location: teacher_courses_admin.php?error=Year value required&id=' . $teacher_id);
        exit();
    } else if (empty($semester)) {
        header('Location: teacher_courses_admin.php?error=Semester value required!&id=' . $teacher_id);
        exit();
    } else if (empty($teacher_id)) {
        header('Location: teacher_courses_admin.php?error=There was an error!&id=' . $teacher_id);
        exit();
    } else if (empty($department)) {
        header('Location: teacher_courses_admin.php?error=There was an error-department!&id=' . $teacher_id);
        exit();
    } else if (empty($type)) {
        header('Location: teacher_courses_admin.php?error=There was an error-type!&id=' . $teacher_id);
        exit();
    } else {
        $sql = "INSERT INTO courses (id, course_name, course_code, batch, semester,mct1,mct2,mct3,mct4,mmt1,mmt2,mta,met,mt, flag, type, department) VALUES ('$teacher_id', '$course_name', '$code', '$year', '$semester',10,10,0,0,20,20,60,40,100, 0, '$type', '$department')";
        if ($conn->query($sql) === TRUE) {
            setGrade($code, "AA", 100, 86, $conn,$teacher_id);
            setGrade($code, "AB", 85, 75, $conn,$teacher_id);
            setGrade($code, "BB", 74, 66, $conn,$teacher_id);
            setGrade($code, "BC", 65, 56, $conn,$teacher_id);
            setGrade($code, "CC", 55, 46, $conn,$teacher_id);
            setGrade($code, "DD", 45, 36, $conn,$teacher_id);
            setGrade($code, "FF", 35, 0, $conn,$teacher_id);
            header('Location:teacher_courses_admin.php?error=Successfully added Course&id=' . $teacher_id);
            exit();
        } else {
            header('Location:teacher_courses_admin.php?error=Unexpected Course&id=' . $teacher_id);
            exit();
        } 
    }
} else {

    header('Location:teacher_courses_admin.php?error=Enter data&id=' . $teacher_id);
    exit();
}
require_once __DIR__ . '/connection/disconnect.php';
