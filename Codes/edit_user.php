<?php
require_once __DIR__ . '/connection/connect.php';
if (isset($_POST['name']) && isset($_POST['password']) && isset($_POST['email'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $mail = validate($_POST['email']);
    $pass = validate($_POST['password']);
    $name = validate($_POST['name']);

    if (empty($mail)) {
        header('Location: dashboard_admin.php?error=Email required');
        exit();
    } else if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        header('Location: dashboard_admin.php?error=Invalid Email');
        exit();
    } else if (empty($pass)) {
        header('Location: dashboard_admin.php?error=Password required');
        exit();
    } else {
        $sql = "UPDATE users (username, email, password) VALUES ('$name', '$mail', '$pass')";
        if ($conn->query($sql) === TRUE) {
            header('Location:dashboard_admin.php?error=Successfully added user');
            exit();
        } else {
            header('Location:dashboard_admin.php?error=Unexpected User');
            exit();
        }
    }
} else {

    header('Location:dashboard_admin.php?error=Enter data');
    exit();
}
require_once __DIR__ . '/connection/disconnect.php';
