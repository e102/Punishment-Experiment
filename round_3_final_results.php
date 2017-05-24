<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<?php include("templates/header.php");
include("includes/connection.php");
session_start();

$player_count = 4;
echo("<script>var player_count = $player_count;</script>");
$round_name = "3c";
$game_number = substr($round_name, 0, 1);
include("templates/bootstrap_head.php");
echo_head("Part " . $game_number . " Final Results");

include_once("includes/Authenticator.php");
authenticator::authenticate_access("round_".$game_number."_final_results.php", "round_" . $round_name . "_results.php");

echo("
<body>
<div class='container-fluid'>
");

include_once ("includes/get_final_ECU.php");
$player_final_ECU = get_final_ECU($round_name, 1, $_SESSION["user_id"]);
$AI_1_final_ECU = get_final_ECU($round_name, 2, $_SESSION["user_id"]);
$AI_2_final_ECU = get_final_ECU($round_name, 3, $_SESSION["user_id"]);
$AI_3_final_ECU = get_final_ECU($round_name, 4, $_SESSION["user_id"]);
echo("
    <h3>Round 3 Final ECU totals:</h3>
    <ul>
        <li>You finish the part with $player_final_ECU ECUs</li>
        <li><span style='color: green'>Green</span> finished the part with $AI_1_final_ECU ECUs</li>
        <li><span style='color: blue'>Blue</span> finished the part with $AI_2_final_ECU ECUs</li>
        <li><span style='color: red'>Red</span> finished the part with $AI_3_final_ECU ECUs</li>
    </ul>
    <br>
    
    <p> These ECU's have been added to your bank.</p>
    ");
?>

<form action="" method="post">
    <button name='submit' class="btn btn-default">Continue</button>
</form>
</div>
</body>

<?php
if (isset($_POST['submit'])) {
    include_once ("includes/get_next_round_name.php");
    echo("<script>window.open('final_results.php', '_self')</script>");
}

include("templates/footer.php") ?>
</html>