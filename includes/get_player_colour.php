<?php
function get_player_colour($player_number, $game_number) {
    if ($game_number == 1) {
        if ($player_number == 1) {
            return "you";
        }
        elseif ($player_number == 2) {
            return "Green";
        }
        elseif ($player_number == 3) {
            return "Blue";
        }
        elseif ($player_number == 4) {
            return "Red";
        }
        else {
            throw new Exception("Player number not recognized");
        }
    }

    elseif ($game_number == 2) {
        if ($player_number == 1) {
            return "you";
        }
        elseif ($player_number == 2) {
            return "Orange";
        }
        elseif ($player_number == 3) {
            return "Black";
        }
        elseif ($player_number == 4) {
            return "Purple";
        }
        else {
            throw new Exception("Player number not recognized");
        }
    }

    elseif ($game_number == 3) {
        if ($player_number == 1) {
            return "you";
        }
        elseif ($player_number == 2) {
            return "Brown";
        }
        elseif ($player_number == 3) {
            return "Grey";
        }
        elseif ($player_number == 4) {
            return "Pink";
        }
        else {
            throw new Exception("Player number not recognized");
        }
    }

    else {
        throw new Exception("Round number not recognized");
    }
}