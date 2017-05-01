<?php
include("connection.php");
function update_total_ECU($player_count, $userID, $round_name, $total_contribution) {

    function get_previous_round_name($current_round) {
        $round_letter = substr($current_round, -1);

        if ($round_letter == "a") {
            throw new Exception("This is the first round in this game. Cannot fetch previous round");
        }
        else {
            return substr($current_round, 0, -1) . chr(ord($round_letter) - 1);
        }
    }

    function get_starting_ECU($round_name, $current_player, $sql_query) {
        if (substr($round_name, -1) == "a") {
            return 20;
        }
        else {
            while ($row = mysqli_fetch_array($sql_query)) {
                if ($current_player == 1) {
                    return $row["round_" . get_previous_round_name($round_name) . "_player_ECU_at_end"];
                }
                else {
                    return $row["round_" . get_previous_round_name($round_name) . "_AI_" . $current_player . "_ECU_at_end"];
                }

            }

        }
    }

    function get_total_rewards_given($round_name, $current_player, $run_query, $player_count) {
        $player_rewards_given = 0;
        mysqli_data_seek($run_query, 0);
        while ($row = mysqli_fetch_array($run_query)) {
            if ($current_player == 1) {
                for ($target_player = 2; $target_player <= $player_count; $target_player++) {
                    $player_rewards_given += abs($row["round_" . $round_name . "_player_reward_AI_" . ($target_player - 1)]);
                }
            }
            else {
                for ($target_player = 1; $target_player <= $player_count; $target_player++) {
                    if ($target_player == $current_player) {
                        continue;
                    }
                    elseif ($target_player == 1) {
                        $player_rewards_given += abs($row["round_" . $round_name . "_AI_" . ($current_player - 1) . "_reward_player"]);
                    }
                    else {
                        $player_rewards_given += abs($row["round_" . $round_name . "_AI_" . ($current_player - 1) . "_reward_AI_" . ($target_player - 1)]);
                    }
                }
            }
        }
        return $player_rewards_given;
    }

    function get_total_reward_received($round_name, $current_player, $run_query, $player_count) {
        $player_rewards_received = 0;
        echo("<h2>Running get rewards for player " . $current_player . "</h2>");
        mysqli_data_seek($run_query, 0);
        while ($row = mysqli_fetch_array($run_query)) {
            if ($current_player == 1) {
                echo("Rewards received player branch running<br>");
                for ($target_player = 2; $target_player <= $player_count; $target_player++) {
                    $player_rewards_received += $row["round_" . $round_name . "_AI_" . ($target_player - 1) . "_reward_player"];
                }
            }
            else {
                echo("Rewards received AI branch running<br>");
                for ($target_player = 1; $target_player <= $player_count; $target_player++) {
                    if ($target_player == $current_player) {
                        continue;
                    }
                    elseif ($target_player == 1) {
                        $player_rewards_received += $row["round_" . $round_name . "_player_reward_AI_" . ($current_player - 1)];
                    }
                    else {
                        $player_rewards_received += $row["round_" . $round_name . "_AI_" . ($target_player - 1) . "_reward_AI_" . ($current_player - 1)];
                    }
                }
            }
        }

        echo("Rewards received = " . $player_rewards_received);
        echo("<br><br>");

        return $player_rewards_received;
    }

    include_once("get_contribution.php");


    global $con;
    $sql_query = "select * from users where user_ID = '$userID'";
    $run_query = mysqli_query($con, $sql_query);
    $check_query = mysqli_num_rows($run_query);
    if ($check_query != 1) {
        throw new Exception("Could not fetch data");
    }

    echo("<script>console.log('update_total_ECU running')</script>");

    for ($current_player = 1; $current_player <= $player_count; $current_player++) {
        try {
            $player_starting_ECU = get_starting_ECU($round_name, $current_player, $run_query);
            $player_contribution = get_contribution($round_name, $current_player, $run_query);
            $player_rewards_given = get_total_rewards_given($round_name, $current_player, $run_query, $player_count);
            $player_rewards_received = get_total_reward_received($round_name, $current_player, $run_query, $player_count);  //TODO: fix bug
            $total_ECU = $player_starting_ECU + ($total_contribution * 0.4) - $player_contribution - ($player_rewards_given / 2) + $player_rewards_received;

            echo("<h2>player " . $current_player . "</h2>");
            echo("player starting ECU = " . $player_starting_ECU);
            echo("<br>");
            echo("total_contribution = " . $total_contribution);
            echo("<br>");
            echo("player_contribution = " . $player_contribution);
            echo("<br>");
            echo("player_rewards_given = " . $player_rewards_given);
            echo("<br>");
            echo("player_rewards_received = " . $player_rewards_received);
            echo("<br>");
            echo("player total ECU = " . $total_ECU);
            echo("<br><br>");
        } catch (Exception $e) {
            echo($e . "<br>");
        }

        if ($current_player == 1) {
            $sql = "UPDATE users SET round_" . $round_name . "_player_ECU_at_end = $total_ECU WHERE user_id =$userID";
        }
        else {
            $sql = "UPDATE users SET round_" . $round_name . "_AI_" . ($current_player - 1) . "_ECU_at_end = $total_ECU WHERE user_id =$userID";
        }
        if (mysqli_query($con, $sql)) {
            echo("<script>console.log('Final ECU count for player ' + $current_player + ' uploaded successfully.')</script>");
        }
        else {
            echo("<script>alert('Could not connect to server')</script>");
            throw new Exception("Error:" . mysqli_error($con));
        }
    }
}