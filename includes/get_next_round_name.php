<?php
function get_next_round_name($current_game) {
    $round_letter = substr($current_game, -1);

    if ($round_letter == "c") {
        return chr(ord(substr($current_game, 0, -1))+1) . 'a';
    }
    else {
        return substr($current_game, 0, -1) . chr(ord($round_letter) + 1);
    }
}