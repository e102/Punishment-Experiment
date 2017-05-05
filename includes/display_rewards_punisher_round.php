<?php
/**
 * Displays all rewards given to a player by other players. Rewards must be in given order of ascending player number.
 * @param $target_player
 * @param $reward
 * @param $reward_2
 * @param $reward_3
 */
function display_rewards_punisher_round($target_player, $reward) {
    if ($reward >= 0) {
        echo("<li>Player $target_player was rewarded for $reward ECU's</li>");
    }
    else {
        $reward = abs($reward);
        echo("<li>Player $target_player was punished for $reward ECU's</li>");
    }
}