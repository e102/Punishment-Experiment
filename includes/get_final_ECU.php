<?php
function get_final_ECU($round_name, $player, $user_ID) {
    if ($player == 1) {
        $contribution_field = "round_" . $round_name . "_player_ECU_at_end";
    }
    else {
        $contribution_field = "round_" . $round_name . "_AI_" . ($player - 1) . "_ECU_at_end";
    }

    global $con;
    $sql_query = "select $contribution_field from users where user_ID = '$user_ID'";
    $run_query = mysqli_query($con, $sql_query);


    while ($row = mysqli_fetch_array($run_query)) {
        return $row[$contribution_field];
    }
}