<?php
function display_initial_ECU($round_name, $player_1_initial_ECU, $player_2_initial_ECU, $player_3_initial_ECU, $player_4_initial_ECU) {
    include_once "get_player_colour.php";
    include_once "get_game_number.php";
    $game_number = get_game_number($round_name);
    $player_2_colour = get_player_colour(2,$game_number);
    $player_3_colour = get_player_colour(3,$game_number);
    $player_4_colour = get_player_colour(4,$game_number);

    echo("
    <body>
    <h1>Round $round_name results:</h1>
    
    <h3>Initial State:</h3>
    <ul>
        <li>You entered the round with $player_1_initial_ECU ECUs</li>
        <li><span style='color: $player_2_colour'>$player_2_colour</span> entered the round with $player_2_initial_ECU ECUs</li>
        <li><span style='color: $player_3_colour'>$player_3_colour</span> entered the round with $player_3_initial_ECU ECUs</li>
        <li><span style='color: $player_4_colour'>$player_4_colour</span> entered the round with $player_4_initial_ECU ECUs</li>
    </ul>
    <br>
    ");
}