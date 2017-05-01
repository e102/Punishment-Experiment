<?php
function get_contribution($round_name, $player, $run_query) {
    if ($player == 1) {
        $row_name = "round_" . $round_name . "_player_contribution";
    }
    else {
        $row_name = "round_" . $round_name . "_AI_" . ($player - 1) . "_contribution";
    }

    mysqli_data_seek($run_query, 0);
    while ($row = mysqli_fetch_array($run_query)) {
        return $row[$row_name];
    }

    throw new Exception("get_contribution player " . $player . " contribution not found");
}