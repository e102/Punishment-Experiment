<?php
function display_contributions($player_1_contribution, $player_2_contribution, $player_3_contribution, $player_4_contribution) {
    echo("
    <h3>Donations:</h3>
    <ul>
        <li>You donated $player_1_contribution ECUs to the common pool</li>
        <li><span style='color: green'>Green</span> donated $player_2_contribution ECUs to the common pool</li>
        <li><span style='color: blue'>Blue</span> donated $player_3_contribution ECUs to the common pool</li>
        <li><span style='color: red'>Red</span> donated $player_4_contribution ECUs to the common pool</li>
    </ul>
    <br>
    ");
}