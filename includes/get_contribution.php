<?php
function get_contribution($round_name, $player) {

    $user_ID = $_SESSION['user_id'];

    include("connection.php");
    global $con;
    $sql_query = "select * from users where user_ID = '$user_ID'";
    $run_query = mysqli_query($con, $sql_query);
    $check_query = mysqli_num_rows($run_query);
    if ($check_query != 1) {
        throw new Exception("Could not fetch data");
    }

    if ($player == 1) {
        $row_name = "round_" . $round_name . "_player_contribution";
    }
    else {
        $row_name = "round_" . $round_name . "_AI_" . ($player - 1) . "_contribution";
    }
    while ($row = mysqli_fetch_array($run_query)) {
        return $row[$row_name];
    }
    throw new Exception("get_contribution player " . $player . " contribution not found");
}