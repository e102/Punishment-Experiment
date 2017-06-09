<?php
function upload_AI_rewards($player_count, $user_ID, $round_name) {
    include("connection.php");
    function get_player_contribution($player_number) {
        if ($player_number == 1) {
            global $round_2a_player_contribution;
            return $round_2a_player_contribution;
        }
        if ($player_number == 2) {
            global $round_2a_AI_1_contribution;
            return $round_2a_AI_1_contribution;
        }
        elseif ($player_number == 3) {
            global $round_2a_AI_2_contribution;
            return $round_2a_AI_2_contribution;
        }
        elseif ($player_number == 4) {
            global $round_2a_AI_3_contribution;
            return $round_2a_AI_3_contribution;
        }
        else {
            throw new Exception("Player number not recognized");
        }
    }

    function calculate_reward($AI_type, $AI_contribution, $target_contribution, $ECU_available) {
        //lazy AI (for the purposes of this research lazy == generous)
        elseif ($AI_type == "lazy") {
            $reward = 0;
             if (($target_contribution - $AI_contribution) <= -6) {
                $reward = rand(-8, -14);
            }
            elseif (($target_contribution - $AI_contribution) <= -3) {
                $reward = rand(-2, -6);
            }
            elseif (($target_contribution - $AI_contribution) <= 3 && ($target_contribution - $AI_contribution) >= -3) {
                $reward = 0;
            }
            elseif (($target_contribution - $AI_contribution) >= 3) {
                $reward = rand(6, 10);
            }
            elseif (($target_contribution - $AI_contribution) >= 6) {
                $reward = rand(12, 16);
            }
        }
        //normal AI. Rewards and Punishes
        elseif ($AI_type == "normal") {
            if (($target_contribution - $AI_contribution) <= -6) {
                $reward = rand(-6, -8);
            }
            elseif (($target_contribution - $AI_contribution) <= -3) {
                $reward = rand(-2, -4);
            }
            elseif (($target_contribution - $AI_contribution) <= 3 && ($target_contribution - $AI_contribution) >= -3) {
                $reward = 0;
            }
            elseif (($target_contribution - $AI_contribution) >= 3) {
                $reward = rand(2, 4);
            }
            elseif (($target_contribution - $AI_contribution) >= 6) {
                $reward = rand(4, 10);
            }
        }
        //mean AI. Only punishes
        elseif ($AI_type == "mean") {
            if (($target_contribution - $AI_contribution) <= -6) {
                $reward = rand(-8, -14);
            }
            elseif (($target_contribution - $AI_contribution) <= -3) {
                $reward = rand(-2, -6);
            }
            elseif (($target_contribution - $AI_contribution) > -3) {
                $reward = 0;
            }
        }
        else {
            throw new Exception("AI Type not recognized/contributions are wrong");
        }

        if ($reward > $ECU_available) {
            return $ECU_available;
        }
        else{
            return $reward;
        }
    }

    function get_AI_ECU_available($AI_number) {
        global $round_2a_total_contribution;
        if ($AI_number == 1) {
            global $round_2a_AI_1_contribution;
            return 20 - $round_2a_AI_1_contribution +($round_2a_total_contribution * 0.5);
        }
        if ($AI_number == 2) {
            global $round_2a_AI_2_contribution;
            return 20 - $round_2a_AI_2_contribution +($round_2a_total_contribution * 0.5);
        }
        if ($AI_number == 3) {
            global $round_2a_AI_3_contribution;
            return 20 - $round_2a_AI_3_contribution +($round_2a_total_contribution * 0.5);
        }
        else{
            throw new Exception("AI ECU Available not found");
        }
    }

    global $con;
    $sql_query = "select * from users where user_ID = '$user_ID'";
    $run_query = mysqli_query($con, $sql_query);
    $check_query = mysqli_num_rows($run_query);
    if ($check_query != 1) {
        throw new Exception("Could not fetch data");
    }

    try {
        for ($current_AI = 2; $current_AI <= $player_count; $current_AI++) {
            include_once("get_contribution.php");
            $current_AI_contribution = get_contribution($round_name, $current_AI, $user_ID);
            for ($target_player = 1; $target_player <= $player_count; $target_player++) {
                if ($target_player == $current_AI) {
                    continue;
                }

                $target_player_contribution = get_contribution($round_name, $target_player, $user_ID);

                include_once "determine_AI_type.php";
                $AI_type = determine_AI_type($current_AI);
                $reward = calculate_reward($AI_type, $current_AI_contribution, $target_player_contribution, get_AI_ECU_available($current_AI - 1));

                if ($target_player == 1) {
                    $sql = "UPDATE users SET round_" . $round_name . "_AI_" . ($current_AI - 1) . "_reward_player = $reward WHERE user_id =$user_ID";
                }
                else {
                    $sql = "UPDATE users SET round_" . $round_name . "_AI_" . ($current_AI - 1) . "_reward_AI_" . ($target_player - 1) . " = $reward WHERE user_id =$user_ID";
                }

                if (!mysqli_query($con, $sql)) {
                    echo("<script>alert('Could not connect to server')</script>");
                    throw new Exception("Error: " . $sql . "<br>" . mysqli_error($con));
                }
            }
        }
    } catch (Exception $e) {
        echo ($e . "<br>");
    }
}
