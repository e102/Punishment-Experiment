<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<?php include("templates/header.php");
include("includes/connection.php");
session_start();

$player_count = 4;
echo("<script>var player_count = $player_count;</script>");
$round_name = "2a";
$game_number = substr($round_name, 0, 1);
$round_number = ord(substr($round_name, -1)) - 96;
include("templates/bootstrap_head.php");
echo_head("Game " . $game_number . ": Round " . $round_number);
echo("
<body>
<div class='container-fluid'>
");

include_once("includes/get_starting_ECU.php");
include_once("includes/display_initial_ECU.php");
$player_initial_ECU = get_starting_ECU($round_name, 1, $_SESSION["user_id"]);
$AI_1_initial_ECU = get_starting_ECU($round_name, 2, $_SESSION["user_id"]);
$AI_2_initial_ECU = get_starting_ECU($round_name, 3, $_SESSION["user_id"]);
$AI_3_initial_ECU = get_starting_ECU($round_name, 4, $_SESSION["user_id"]);
display_initial_ECU($round_name, $player_initial_ECU, $AI_1_initial_ECU, $AI_2_initial_ECU, $AI_3_initial_ECU);

include_once("includes/get_contribution.php");
include_once("includes/display_contributions.php");
$player_contribution = get_contribution($round_name, 1, $_SESSION["user_id"]);
$AI_1_contribution = get_contribution($round_name, 2, $_SESSION["user_id"]);
$AI_2_contribution = get_contribution($round_name, 3, $_SESSION["user_id"]);
$AI_3_contribution = get_contribution($round_name, 4, $_SESSION["user_id"]);
display_contributions($player_contribution, $AI_1_contribution, $AI_2_contribution, $AI_3_contribution);

include_once("includes/get_reward.php");
include_once("includes/display_rewards.php");
for ($rewarded_player = 1; $rewarded_player <= $player_count; $rewarded_player++) {
    $players_array = array(1, 2, 3, 4);
    unset($players_array[$rewarded_player - 1]);
    $players_array = array_values($players_array);

    $reward_1 = get_reward($round_name, $players_array[0], $rewarded_player, $_SESSION["user_id"]);
    $reward_2 = get_reward($round_name, $players_array[1], $rewarded_player, $_SESSION["user_id"]);
    $reward_3 = get_reward($round_name, $players_array[2], $rewarded_player, $_SESSION["user_id"]);

    display_rewards($rewarded_player, $reward_1, $reward_2, $reward_3);
}

include_once ("includes/get_final_ECU.php");
include_once ("includes/display_final_ECU.php");
$player_final_ECU = get_final_ECU($round_name, 1, $_SESSION["user_id"]);
$AI_1_final_ECU = get_final_ECU($round_name, 2, $_SESSION["user_id"]);
$AI_2_final_ECU = get_final_ECU($round_name, 3, $_SESSION["user_id"]);
$AI_3_final_ECU = get_final_ECU($round_name, 4, $_SESSION["user_id"]);
display_final_ECU($player_final_ECU,$AI_1_final_ECU,$AI_2_final_ECU, $AI_3_final_ECU);
?>

<form action="" method="post">
    <button name='submit' class="btn btn-default">Continue</button>
</form>
</div>
</body>

<?php
if (isset($_POST['submit'])) {
    include_once ("includes/get_next_round_name.php");
    $next_round_address = "round_" . get_next_round_name($round_name) . ".php";
    echo("<script>window.open('$next_round_address', '_self')</script>");
}
?>

<?php include("templates/footer.php") ?>
</html>