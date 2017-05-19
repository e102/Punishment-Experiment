<?php
include("connection.php");
function update_total_ECU_punisher_round($player_count, $user_ID, $round_name) {

    include_once("get_previous_round_name.php");

    include_once("get_starting_ECU.php");

    function get_total_rewards_given($round_name, $rewarding_player, $user_ID, $player_count) {
        $player_rewards_given = 0;

        include_once("get_reward.php");
        for ($rewarded_player = 1; $rewarded_player <= $player_count; $rewarded_player++) {
            if ($rewarded_player == $rewarding_player) {
                continue;
            }
            $player_rewards_given += abs(get_reward($round_name, $rewarding_player, $rewarded_player, $user_ID));
        }

        return $player_rewards_given;
    }

    function get_total_reward_received($round_name, $rewarded_player, $user_ID) {
        include_once("get_reward.php");
        $player_rewards_received = get_reward($round_name, 1, $rewarded_player, $user_ID);

        return $player_rewards_received;
    }

    include_once("get_contribution.php");

    function calculate_total_ECU($round_name, $player, $user_ID, $player_count) {
        if ($player == 1) {
            $player_starting_ECU = get_starting_ECU($round_name, $player, $user_ID);
            $player_rewards_given = get_total_rewards_given($round_name, $player, $user_ID, $player_count);

            return $player_starting_ECU - ($player_rewards_given / 2);
        }
        else {
            $player_starting_ECU = get_starting_ECU($round_name, $player, $user_ID);
            $player_contribution = get_contribution($round_name, $player, $user_ID);
            $player_rewards_received = get_total_reward_received($round_name, $player, $user_ID);


            $total_contribution = 0;
            for ($i = 2; $i <= $player_count; $i++) {
                $total_contribution += get_contribution($round_name, $i, $user_ID);
            }

            return max(0, $player_starting_ECU + ($total_contribution * 0.5) - $player_contribution + $player_rewards_received);
        }
    }

    function upload_total_ECU($total_ECU, $player, $round_name, $user_ID) {
        include_once("connection.php");
        global $con;

        if ($player == 1) {
            $sql = "UPDATE users SET round_" . $round_name . "_player_ECU_at_end = $total_ECU WHERE user_id =$user_ID";
        }
        else {
            $sql = "UPDATE users SET round_" . $round_name . "_AI_" . ($player - 1) . "_ECU_at_end = $total_ECU WHERE user_id =$user_ID";
        }
        if (!mysqli_query($con, $sql)) {
            echo("<script>alert('Could not connect to server')</script>");
            throw new Exception("Error:" . mysqli_error($con));
        }
    }
    for ($current_player = 1; $current_player <= $player_count; $current_player++) {
        $total_ECU = calculate_total_ECU($round_name, $current_player, $user_ID, $player_count);
        upload_total_ECU($total_ECU,$current_player,$round_name,$user_ID);
    }

}