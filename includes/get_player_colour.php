<?php
function get_player_colour($player_number){
    if ($player_number == 1){
        return "you";
    }
    elseif ($player_number == 2) {
        return"green";
    }
    elseif ($player_number == 3) {
        return "blue";
    }
    elseif ($player_number == 4) {
        return "red";
    }
    else{
        throw new Exception("Player number not recognized");
    }
}