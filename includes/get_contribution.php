<?php
function get_contribution($round_name, $target_player, $run_query) {
    while ($row = mysqli_fetch_array($run_query)) {
        if ($target_player == 1) {
            return $row["round_" . $round_name . "_player_contribution"];
        }
        else {
            return $row["round_" . $round_name . "_AI_" . ($target_player - 1) . "_contribution"];
        }
    }
}