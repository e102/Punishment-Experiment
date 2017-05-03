<?php
function get_next_round_name($current_game) {
    $round_letter = substr($current_game, -1);

    if ($round_letter == "z") {
        throw new Exception("This is the last round in this game. Cannot fetch next round");
    }
    else {
        return substr($current_game, 0, -1) . chr(ord($round_letter) + 1);
    }
}