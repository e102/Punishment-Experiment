<?php
function display_contributions($player_1_contribution, $player_2_contribution, $player_3_contribution, $player_4_contribution, $game_number) {
    include_once "get_player_colour.php";
    $player_2_colour = get_player_colour(2,$game_number);
    $player_3_colour = get_player_colour(3,$game_number);
    $player_4_colour = get_player_colour(4,$game_number);

    echo("
    <div class = 'display_before_load'>
        <p>Please wait for other players to make their choices</p>
    </div>
    
    <div class='display_after_load' style='display:none'>
    <h3>Donations:</h3>
    <ul class='list-group'>
        <li class='list-group-item'>You: $player_1_contribution</li>
        <li class='list-group-item'><span style='color: $player_2_colour'>$player_2_colour</span>: $player_2_contribution</li>
        <li class='list-group-item'><span style='color: $player_3_colour'>$player_3_colour</span>: $player_3_contribution</li>
        <li class='list-group-item'><span style='color: $player_4_colour'>$player_4_colour</span>: $player_4_contribution</li>
    </ul>
    <br>
    </div>
    ");
}