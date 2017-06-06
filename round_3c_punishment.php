<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<?php include("templates/header.php");
include("includes/connection.php");
session_start();

$player_count = 4;
echo("<script>var player_count = $player_count;</script>");
$round_name = "3c";
$game_number = substr($round_name, 0, 1);
$round_number = ord(substr($round_name, -1)) - 96;
include("templates/bootstrap_head.php");
echo_head("Part " . $game_number . ": Round " . $round_number);

include_once("includes/Authenticator.php");
authenticator::authenticate_access("round_" . $round_name . "_punishment.php", "round_" . $round_name . ".php");

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
$AI_1_contribution = get_contribution($round_name, 2, $_SESSION["user_id"]);
$AI_2_contribution = get_contribution($round_name, 3, $_SESSION["user_id"]);
$AI_3_contribution = get_contribution($round_name, 4, $_SESSION["user_id"]);
display_contributions("N/A", $AI_1_contribution, $AI_2_contribution, $AI_3_contribution);

$player_starting_ECU = get_starting_ECU($round_name, 1, $_SESSION["user_id"]);

echo("<script>var player_starting_ECU = $player_starting_ECU</script>");
?>

<h1>Punish/Reward</h1>
<?php echo "<p id='starting_ECUs' class='bg-info'>You have $player_starting_ECU ECU's</p>" ?>


<br>
<form id="punish_reward_form" action='' method='post'
      onsubmit="return check_ECU_use(player_count, player_starting_ECU)">
    <p>Would you like to want to punish or reward another player?</p>
    <script>generate_reward_dropdowns(document.getElementById("punish_reward_form"), 4)</script>
    <br>
    <p id='ECUs_kept' class="bg-info">ECUs remaining after your punishments</p><br>
    <button name='submit' class="btn btn-default">Submit</button>
</form>

<script>
    load_page(0, 0);

    function update_ECU_Count(player_count, player_starting_ECU) {
        var ECU_used = 0.00;

        for (var i = 2; i <= player_count; i++) {
            var amount_dropdown = document.getElementById("amount_dropdown_player_" + i);
            ECU_used += parseInt(amount_dropdown.options[amount_dropdown.selectedIndex].value / 2);
        }

        document.getElementById("ECUs_kept").innerHTML = "ECUs remaining after your punishments/rewards:" + (player_starting_ECU - ECU_used).toString();
    }

    function check_ECU_use(player_count, player_starting_ECU) {
        var ECU_used = 0;
        for (var i = 2; i <= player_count; i++) {
            var amount_dropdown = document.getElementById("amount_dropdown_player_" + i);
            ECU_used += parseInt(amount_dropdown.options[amount_dropdown.selectedIndex].value) / 2;
        }

        if (ECU_used > player_starting_ECU) {
            alert("You're choices cost " + ECU_used + " ECUs but you only have " + player_starting_ECU + " ECUs. Reduce your punishments/rewards to continue.");
            return false;
        }
        else {
            return true;
        }
    }
</script>
</div>
</body>

<?php
include("includes/upload_player_rewards.php");
include("includes/update_total_ECU_punisher_round.php");
if (isset($_POST['submit'])) {
    $userID = $_SESSION["user_id"];
    upload_player_rewards($player_count, $userID, $round_name);
    update_total_ECU_punisher_round($player_count, $userID, $round_name);

    $next_round_address = "round_" . $round_name . "_results.php";
    echo("<script>window.open('$next_round_address', '_self')</script>");
}
include("templates/footer.php") ?>
</html>