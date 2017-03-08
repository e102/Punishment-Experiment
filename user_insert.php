<?php
include("includes/connection.php");
if (isset($_POST['sign_up'])) {
    $name = mysqli_real_escape_string($con, $_POST['user_name']);
    $password = mysqli_real_escape_string($con, $_POST['user_password']);
    $email = mysqli_real_escape_string($con, $_POST['user_email']);
    $country = mysqli_real_escape_string($con, $_POST['user_country']);
    $gender = mysqli_real_escape_string($con, $_POST['user_gender']);
    $register_date = date("d-m-y");
    $status = "unverified";
    $posts = 0;

    $get_email = "select * from users where user_email = '$email'";
    $run_email = mysqli_query($con, $get_email);
    $check_email = mysqli_num_rows($run_email);

    if ($check_email >= 1) {
        echo "<script>alert('Email already registered.')</script>";
        exit();
    }

    if (strlen($password) < 8) {
        echo "<script>alert('Password must be at least 8 characters.')</script>";
        exit();
    } else {
        $insert = "insert into users(user_name,user_password,user_email,user_country,user_gender,register_date,last_login,status) values('$name','$password','$email','$country','$gender','$register_date','$register_date','$status')";

        $run_insert = mysqli_query($con, $insert);

        if ($run_insert) {
            $_SESSION["user_name"] = $name;
            echo "<script>alert('Registration successful!')</script>";
            echo "<script>window.open('home.php','_self')</script>";
        }
    }
}
?>