<?php
include_once "determine_AI_type.php";

function calculate_AI_contribution($player_contribution, $AI_ECU_available, $player_number) {
    $AI_type = determine_AI_type($player_number);
    $AI_contribution = calculate_AI_contribution_based_on_type($player_contribution, $AI_type);
    $AI_contribution = max(0, $AI_contribution);
    $AI_contribution = min($AI_contribution, $AI_ECU_available);
    return $AI_contribution;
}


function calculate_AI_contribution_based_on_type($player_contribution, $AI_type) {
    if ($AI_type == "lazy") {
        return $player_contribution + rand(5, 15);
    }
    elseif ($AI_type == "normal") {
        return $player_contribution + rand(-2, 2);
    }
    elseif ($AI_type == "mean") {
        return $player_contribution + rand(-15, -5);
    }
    else{
        throw new Exception("AI type not recognized");
    }
}