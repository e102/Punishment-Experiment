<?php
function display_contributions($player_1_contribution, $player_2_contribution, $player_3_contribution, $player_4_contribution) {
    echo("
    <h3>Donations:</h3>
    <ul>
        <li>You donated $player_1_contribution ECUs to the common pool</li>
        <li>Player 2 donated $player_2_contribution ECUs to the common pool</li>
        <li>Player 3 donated $player_3_contribution ECUs to the common pool</li>
        <li>Player 4 donated $player_4_contribution ECUs to the common pool</li>
    </ul>
    <br>
    ");
}