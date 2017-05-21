<?php
function display_final_ECU($player_1_final_ECU, $player_2_final_ECU, $player_3_final_ECU, $player_4_final_ECU) {
    echo("
    <h3>Final ECU totals:</h3>
    <ul>
        <li>You finish the round with $player_1_final_ECU ECUs</li>
        <li><span style='color: green'>Green</span> finished the round with $player_2_final_ECU ECUs</li>
        <li><span style='color: blue'>Blue</span> finished the round with $player_3_final_ECU ECUs</li>
        <li><span style='color: red'>Red</span> finished the round with $player_4_final_ECU ECUs</li>
    </ul>
    <br>
    ");
}