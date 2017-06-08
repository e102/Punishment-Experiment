<?php
function display_final_ECU($round_name, $user_ID) {
    echo "
    <div class='display_after_load' style='display: none'>
        <h3>Final ECU totals:</h3>
        <ul class='list-group'>";

    include_once "get_player_colour.php";
    include_once "get_final_ECU.php";
    include_once "get_game_number.php";
    for ($i = 1; $i <= 4; $i++) {
        $player_colour = get_player_colour($i, get_game_number($round_name));
        $player_ECU = get_final_ECU($round_name, $i, $user_ID);
        echo "<li class='list-group-item'><span style='color: $player_colour'>$player_colour</span>: $player_ECU</li>";
    }

    echo "</ul>
        <br>
    </div>
    ";
}