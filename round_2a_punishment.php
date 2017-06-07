<!DOCTYPE html>
<html>
<?php include("templates/header.php");
include("includes/connection.php");
session_start();

$player_count = 4;
echo("<script>var player_count = $player_count;</script>");

$round_name = "2a";
include_once "includes/get_game_number.php";
$game_number = get_game_number($round_name);
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
$player_1_contribution = get_contribution($round_name, 1, $_SESSION["user_id"]);
$AI_1_contribution = get_contribution($round_name, 2, $_SESSION["user_id"]);
$AI_2_contribution = get_contribution($round_name, 3, $_SESSION["user_id"]);
$AI_3_contribution = get_contribution($round_name, 4, $_SESSION["user_id"]);
display_contributions($player_1_contribution, $AI_1_contribution, $AI_2_contribution, $AI_3_contribution, $game_number);

$player_starting_ECU = intval((get_starting_ECU($round_name, 1, $_SESSION["user_id"]) - $player_1_contribution) + 0.5 * ($player_1_contribution + $AI_1_contribution + $AI_2_contribution + $AI_3_contribution));

echo("<script>var player_starting_ECU = $player_starting_ECU</script>");
?>

<div class="display_after_load" style="display:none">
    <p class="noEmptyLine">All players have connected. Please enter your rewards/punishments below</p>
    <br>
    <h1>Punishments/Rewards</h1>
    <p id="starting_ECUs" class="bg-info"></p>
    <br>
    <form id="punish_reward_form" action='' method='post'
          onsubmit="return check_ECU_use(player_count, player_starting_ECU)">

        <?php echo "<script>var game_number = $game_number;</script>"; ?>
        <script>generate_reward_dropdowns(document.getElementById('punish_reward_form'), player_count, game_number);</script>

        <br>
        <p id='ECUs_kept' class="bg-info">ECUs remaining after your contribution</p>
        <br>
        <button name='submit' class="btn btn-default">Submit</button>
    </form>
</div>
</div>
</body>

<script>
    load_page(1, 25);

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

<?php
include("includes/upload_player_rewards.php");
include("includes/upload_AI_rewards.php");
include("includes/update_total_ECU.php");
if (isset($_POST['submit'])) {
    $userID = $_SESSION["user_id"];
    upload_player_rewards($player_count, $userID, $round_name);
    upload_AI_rewards($player_count, $userID, $round_name);
    update_total_ECU($player_count, $userID, $round_name);

    $next_round_address = "round_" . $round_name . "_results.php";
    echo("<script>window.open('$next_round_address', '_self')</script>");
}
?>

<?php include("templates/footer.php") ?>
</html>