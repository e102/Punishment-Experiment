<?php
function get_starting_ECU($round_name, $player, $user_ID) {
    if (substr($round_name, -1) == "a") {
        return 20;
    }

    include_once("get_previous_round_name.php");
    if ($player == 1) {
        $contribution_field = "round_" . get_previous_round_name($round_name) . "_player_ECU_at_end";
    }
    else {
        $contribution_field = "round_" . get_previous_round_name($round_name) . "_AI_" . ($player - 1) . "_ECU_at_end";
    }

    global $con;
    $sql_query = "select $contribution_field from users where user_ID = '$user_ID'";
    $run_query = mysqli_query($con, $sql_query);


    while ($row = mysqli_fetch_array($run_query)) {
        return $row[$contribution_field];
    }
}