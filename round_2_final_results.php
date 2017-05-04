<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<?php include("templates/header.php");
include("includes/connection.php");
session_start();

$player_count = 4;
echo("<script>var player_count = $player_count;</script>");
$round_name = "2c";
$game_number = substr($round_name, 0, 1);
echo("
<head>
    <title>Game $game_number: Final Results</title>
    <link rel='stylesheet' href='styles/default.css' media='all'/>
</head>

<body>
");

include_once ("includes/get_final_ECU.php");
$player_final_ECU = get_final_ECU($round_name, 1, $_SESSION["user_id"]);
$AI_1_final_ECU = get_final_ECU($round_name, 2, $_SESSION["user_id"]);
$AI_2_final_ECU = get_final_ECU($round_name, 3, $_SESSION["user_id"]);
$AI_3_final_ECU = get_final_ECU($round_name, 4, $_SESSION["user_id"]);
echo("
    <h3>Final ECU totals:</h3>
    <ul>
        <li>You finish the game with $player_final_ECU ECUs</li>
        <li>Player 2 finished the game with $AI_1_final_ECU ECUs</li>
        <li>Player 3 finished the game with $AI_2_final_ECU ECUs</li>
        <li>Player 4 finished the game with $AI_3_final_ECU ECUs</li>
    </ul>
    <br>
    ");
?>

<form action="" method="post">
    <button name='submit'>Continue</button>
</form>

</body>

<?php
if (isset($_POST['submit'])) {
    include_once ("includes/get_next_round_name.php");
    echo("<script>window.open('round_3_instructions.php', '_self')</script>");
}

include("templates/footer.php") ?>
</html>