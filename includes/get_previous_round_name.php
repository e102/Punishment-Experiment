<?php
function get_previous_round_name($current_round) {
    $round_letter = substr($current_round, -1);

    if ($round_letter == "a") {
        throw new Exception("This is the first round in this game. Cannot fetch previous round");
    }
    else {
        return substr($current_round, 0, -1) . chr(ord($round_letter) - 1);
    }
}