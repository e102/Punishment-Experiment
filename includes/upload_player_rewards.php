<?php
include("connection.php");

function upload_player_rewards($player_count, $userID, $round_name) {
    global $con;
    for ($i = 2; $i <= $player_count; $i++) {
        if ($_POST['punish_or_reward_dropdown_player_' . $i] == "reward") {
            $player_reward = $_POST['amount_dropdown_player_' . $i];
        }
        elseif ($_POST['punish_or_reward_dropdown_player_' . $i] == "punish") {
            $player_reward = -$_POST['amount_dropdown_player_' . $i];
        }
        elseif ($_POST['punish_or_reward_dropdown_player_' . $i] == "no") {
            $player_reward = -$_POST['amount_dropdown_player_' . $i];
        }
        else {
            throw new Exception("!= punish||reward||no");
        }

        $sql = "UPDATE users SET round_" . $round_name . "_player_reward_AI_" . ($i - 1) . " = $player_reward WHERE user_id =$userID";

        if (mysqli_query($con, $sql)) {
            echo("<script>console.log('User reward for AI ' + ($i-1) + ' uploaded successfully.')</script>");
        }
        else {
            echo("<script>alert('Could not connect to server')</script>");
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }
}

?>