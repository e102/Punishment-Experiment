<?php
include_once "connection.php";

function echo_if_pay_dependent_on_ECU($user_ID, $message){
    if (is_paid_based_on_ECU($user_ID)) {
        echo "<p>$message</p>";
    }
}

function is_paid_based_on_ECU($user_ID){
    global $con;
    echo "<script>console.log('user ID = ' + $user_ID)</script>";
    $sql_query = "SELECT paid_based_on_ECU FROM users WHERE user_ID = '$user_ID'";
    $run_query = mysqli_query($con, $sql_query);
    while ($row = mysqli_fetch_array($run_query)) {
        $value = $row['paid_based_on_ECU'];
        if ($value == 0) {
            return false;
        }
        else{
            return true;
        }
    }
}