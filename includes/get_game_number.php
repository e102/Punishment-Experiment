<?php
function get_game_number($round_name) {
    return substr($round_name, 0, 1);
}