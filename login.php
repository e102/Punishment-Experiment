<?php
include("includes/connection.php");
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['pass']);

    $get_user = "select * from users where user_email = '$email' AND user_password = '$password'";

    $run_user = mysqli_query($con, $get_user);
    $check_user = mysqli_num_rows($run_user);

    if ($check_user == 0) {
        echo "<script>alert('Incorrect password and/or email!')</script>";
        echo "<script>window.open('index.php','_self')</script>";
        exit();
    }
    elseif ($check_user == 1) {
        $_SESSION['user_email'] = $email;
        echo "<script>window.open('home.php','_self')</script>";
    }
}
?>