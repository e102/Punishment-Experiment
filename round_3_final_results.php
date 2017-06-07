<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<?php include("templates/header.php");
include("includes/connection.php");
session_start();

$player_count = 4;
echo("<script>var player_count = $player_count;</script>");
$round_name = "3c";
include_once "includes/get_game_number.php";
$game_number = get_game_number($round_name);

include("templates/bootstrap_head.php");
echo_head("Part " . $game_number . " Final Results");

include_once("includes/Authenticator.php");
authenticator::authenticate_access("round_" . $game_number . "_final_results.php", "round_" . $round_name . "_results.php");

echo("
<body>
<div class='container-fluid'>
");

include_once ("includes/get_final_ECU.php");
include_once "includes/get_player_colour.php";
$player_final_ECU = get_final_ECU($round_name, 1, $_SESSION["user_id"]);
$player_colour = get_player_colour(1, $game_number);
$AI_1_final_ECU = get_final_ECU($round_name, 2, $_SESSION["user_id"]);
$AI_1_colour = get_player_colour(2, $game_number);
$AI_2_final_ECU = get_final_ECU($round_name, 3, $_SESSION["user_id"]);
$AI_2_colour = get_player_colour(3, $game_number);
$AI_3_final_ECU = get_final_ECU($round_name, 4, $_SESSION["user_id"]);
$AI_3_colour = get_player_colour(4, $game_number);
echo("
    <h3>Final ECU totals:</h3>
    <ul>
        <li><span style='color: $player_colour'>You</span> finish the part with $player_final_ECU ECUs</li>
        <li><span style='color: $AI_1_colour'>$AI_1_colour</span> finished the part with $AI_1_final_ECU ECUs</li>
        <li><span style='color: $AI_2_colour'>$AI_2_colour</span> finished the part with $AI_2_final_ECU ECUs</li>
        <li><span style='color: $AI_3_colour'>$AI_3_colour</span> finished the part with $AI_3_final_ECU ECUs</li>
    </ul>
    <br>
    ");

include_once "includes/echo_if_pay_is_dependent_on_ECU.php";
$userID = $_SESSION["user_id"];
echo_if_pay_dependent_on_ECU($userID, "These ECU's have been added to your bank. The more ECU's in your bank after all three rounds, the greater your chance of winning the prize.")
?>

<form action="" method="post">
    <button name='submit' class="btn btn-default">Continue</button>
</form>
</div>
</body>

<?php
if (isset($_POST['submit'])) {
    include_once("includes/get_next_round_name.php");
    echo("<script>window.open('final_results.php', '_self')</script>");
}

include("templates/footer.php") ?>
</html>