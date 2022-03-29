<?php
session_start();
if (isset($_POST['submit']) && isset($_POST['currentPassword']) && isset($_POST['newPassword']) && isset($_POST['confirmNewPassword'])) {
    require_once __DIR__ . '/connection/connect.php';
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $currentPassword = validate($_POST['currentPassword']);
    $newPassword = validate($_POST['newPassword']);
    $confirmPassword = validate($_POST['confirmNewPassword']);
    $id = $_SESSION['id'];

    $sql = "SELECT password FROM users WHERE id='$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $dbPassword = $row['password'];
        if ($currentPassword === $dbPassword) {
            if ($newPassword === $confirmPassword) {
                $sql = "UPDATE users SET password='$newPassword' WHERE id='$id'";
                if ($conn->query($sql) === TRUE) {
                    header('Location:dashboard.php?error=Successfully changed password');
                    exit();
                } else {
                    header('Location:dashboard.php?error=Unexpected Error');
                    exit();
                }
            } else {
                $em = "New password and confirm password do not match!";
                header("Location: dashboard.php?error=$em");
            }
        } else {
            $em = "Current password is incorrect!";
            header("Location: dashboard.php?error=$em");
        }
    } else {
        $em = "Unexpected User";
        header("Location: dashboard.php?error=$em");
    }
} else {
    $em = "Enter corresponding data in all the fields!";
    header("Location: dashboard.php?error=$em");
}
