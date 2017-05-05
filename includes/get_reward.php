<?php
function get_reward($round_name, $rewarding_player, $rewarded_player, $user_ID) {
    if ($rewarded_player == $rewarding_player) {
        throw new Exception("Players cannot reward themselves!");
    }

    $contribution_field_1 = "round_" . $round_name;

    if ($rewarding_player == 1) {
        $contribution_field_2 = "_player_reward_";
    }
    else {
        $contribution_field_2 = "_AI_" . ($rewarding_player - 1) . "_reward_";
    }

    if ($rewarded_player == 1) {
        $contribution_field_3 = "player";
    }
    else {
        $contribution_field_3 = "AI_" . ($rewarded_player - 1);
    }

    $contribution_field = $contribution_field_1 . $contribution_field_2 . $contribution_field_3;

    echo $contribution_field;
    echo("<br>");

    global $con;
    $sql_query = "select $contribution_field from users where user_ID = '$user_ID'";
    $run_query = mysqli_query($con, $sql_query);

    while ($row = mysqli_fetch_array($run_query)) {
        return $row[$contribution_field];
    }

    throw new Exception("get_reward player " . $rewarding_player . " reward not found. SQL query = " . $contribution_field);
}