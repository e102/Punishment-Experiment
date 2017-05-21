<?php
function display_initial_ECU($round_name, $player_1_initial_ECU, $player_2_initial_ECU, $player_3_initial_ECU, $player_4_initial_ECU) {
    $round_number = ord(substr($round_name, -1)) - 96;
    echo("
    <body>
    <h1>Round $round_number results:</h1>
    
    <h3>Initial State:</h3>
    <ul>
        <li>You entered the round with $player_1_initial_ECU ECUs</li>
        <li><span style='color: green'>Green</span> entered the round with $player_2_initial_ECU ECUs</li>
        <li><span style='color: blue'>Blue</span> entered the round with $player_3_initial_ECU ECUs</li>
        <li><span style='color: red'>Red</span> entered the round with $player_4_initial_ECU ECUs</li>
    </ul>
    <br>
    ");
}