<?php
function get_previous_round_name($current_round) {
    $round_letter = substr($current_round, -1);

    if ($round_letter == "a") {
        return chr((ord(substr($current_round, 0, -1))-1)) . 'c';
    }
    else {
        return substr($current_round, 0, -1) . chr(ord($round_letter) - 1);
    }
}