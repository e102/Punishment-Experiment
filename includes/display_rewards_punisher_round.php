<?php
/**
 * Displays all rewards given to a player by other players. Rewards must be in given order of ascending player number.
 * @param $target_player
 * @param $reward
 * @param $reward_2
 * @param $reward_3
 */
function display_rewards_punisher_round($target_player, $reward, $game_number) {
    include_once "get_player_colour.php";

    $player_colour = get_player_colour($target_player, $game_number);

    if ($reward >= 0) {
        echo("<li class='list-group-item'><span style='color: $player_colour'>$player_colour</span> was rewarded for $reward ECU's</li>");
    }
    else {
        $reward = abs($reward);
        echo("<li class='list-group-item'><span style='color: $player_colour'>$player_colour</span> was punished for $reward ECU's</li>");
    }
}