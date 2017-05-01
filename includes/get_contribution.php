<?php
function get_contribution($round_name, $player, $user_ID) {

    if ($player == 1) {
        $contribution_field = "round_" . $round_name . "_player_contribution";
    }
    else {
        $contribution_field = "round_" . $round_name . "_AI_" . ($player - 1) . "_contribution";
    }

    global $con;
    $sql_query = "select $contribution_field from users where user_ID = '$user_ID'";
    $run_query = mysqli_query($con, $sql_query);

    while ($row = mysqli_fetch_array($run_query)) {
        return $row[$contribution_field];
    }

    throw new Exception("get_contribution player " . $player . " contribution not found");
}