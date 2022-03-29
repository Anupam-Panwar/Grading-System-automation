<?php
session_start();
if (isset($_POST['submit']) && isset($_FILES['my_image'])) 
{
    require_once __DIR__ . '/connection/connect.php';
    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];

    if ($error === 0) 
    {
        if ($img_size > 12500000) 
        {
            $em = "Sorry, your file is too large.";
            header("Location: dashboard.php?error=$em");
        } 
        else 
        {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) 
            {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = 'uploads/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);
                $id = $_SESSION['id'];

                $sql = "UPDATE users SET image_url='$new_img_name' WHERE id='$id'";
                if ($conn->query($sql) === TRUE) 
                {
                    $_SESSION['image_url'] = $new_img_name;
                    header('Location:dashboard.php?error=Successfully updated user');
                    exit();
                } 
                else 
                {
                    header('Location:dashboard.php?error=Unexpected User');
                    exit();
                }
            } 
            else 
            {
                $em = "You can't upload files of this type";
                header("Location: dashboard.php?error=$em");
            }
        }
    } 
    else 
    {
        $em = "Picture not selected!";
        header("Location: dashboard.php?error=$em");
    }
} 
else
{
    $em = "unknown error occurred!";
    header("Location: dashboard.php?error=$em");
}
