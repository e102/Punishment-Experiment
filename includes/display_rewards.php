<?php
/**
 * Displays all rewards given to a player by other players. Rewards must be in given order of ascending player number.
 * @param $target_player
 * @param $reward_1
 * @param $reward_2
 * @param $reward_3
 */
function display_rewards($target_player, $reward_1, $reward_2, $reward_3) {
    if ($target_player == 1) {
        echo("
        <h3>Your rewards:</h3>
        <ul>");
    }
    else {
        echo("
        <h3>Player $target_player rewards:</h3>
        <ul>");
    }

    $players_array = array(1, 2, 3, 4);
    unset($players_array[$target_player - 1]);
    $players_array = array_values($players_array);


    $args_array = func_get_args();
    for ($i = 1; $i <= count($players_array); $i++) {
        $current_reward = $args_array[$i];
        $rewarding_player = $players_array[$i - 1];
        if ($current_reward >= 0) {
            echo("<li>Player $rewarding_player rewarded player $target_player for $current_reward ECU's</li>");
        }
        elseif ($current_reward < 0) {
            $current_reward = abs($current_reward);
            echo("<li>Player $rewarding_player punished player $target_player for $current_reward ECU's</li>");
        }
    }
    echo("
    </ul>
    <br>
    ");
}