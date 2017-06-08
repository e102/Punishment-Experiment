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
    
    <h3>Initial ECUs:</h3>
    <ul class='list-group'>
        <li class='list-group-item'>You: $player_1_initial_ECU</li>
        <li class='list-group-item'><span style='color: $player_2_colour'>$player_2_colour</span>: $player_2_initial_ECU</li>
        <li class='list-group-item'><span style='color: $player_3_colour'>$player_3_colour</span>: $player_3_initial_ECU</li>
        <li class='list-group-item'><span style='color: $player_4_colour'>$player_4_colour</span>: $player_4_initial_ECU</li>
    </ul>
    <br>
    ");
}