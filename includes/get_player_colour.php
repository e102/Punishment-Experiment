<?php
function get_player_colour($player_number){
    if ($player_number == 1){
        return "you";
    }
    elseif ($player_number == 2) {
        return"Green";
    }
    elseif ($player_number == 3) {
        return "Blue";
    }
    elseif ($player_number == 4) {
        return "Red";
    }
    else{
        throw new Exception("Player number not recognized");
    }
}