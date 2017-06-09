<!DOCTYPE html>
<html>
<?php
include("templates/header.php");
include("includes/connection.php");
session_start();

$round_name = "3a";
$game_number = substr($round_name, 0, 1);
$round_number = ord(substr($round_name, -1)) - 96;
include("templates/bootstrap_head.php");
echo_head("Part $game_number: Round $round_number");

include_once("includes/Authenticator.php");
authenticator::authenticate_access("round_" . $round_name . ".php", "round_3_punisher_selection.php");


echo("
<body>
<div class='container-fluid'>
<h1>Welcome to Part $game_number:Round $round_number</h1>
<div class = 'display_before_load'>
    <p id='intro_text'>Please wait for other players to make their contributions.</p>
</div>
");

include_once("includes/get_starting_ECU.php");
$player_starting_ECU = get_starting_ECU($round_name, 1, $_SESSION["user_id"]);
?>

<div class = "display_after_load" style="display:none">
    <p>All players have made their contributions</p>
    <br>
    <form action='' method='post'>
        <button name='submit' class="btn btn-default">Continue</button>
    </form>
</div>

<script>
    load_page(1, 25);
</script>
</div>
</body>

<?php
if (isset($_POST['submit'])) {
    submit_choices($round_name, $_SESSION["user_id"]);
}

function submit_choices($round_name, $user_ID) {
    include_once("includes/get_previous_round_name.php");
    include_once("includes/get_contribution.php");
    $avg_player_contribution_round_2 = (int)((get_contribution("2a", 1, $user_ID) + get_contribution("2b", 1, $user_ID) + get_contribution("2c", 1, $user_ID)) / 3);

    include_once("includes/get_starting_ECU.php");
    include_once "includes/calculate_AI_contribution.php";
    $current_round_AI_1_contribution = calculate_AI_contribution($avg_player_contribution_round_2, get_starting_ECU($round_name, 2, $user_ID), 2);
    $current_round_AI_2_contribution = calculate_AI_contribution($avg_player_contribution_round_2, get_starting_ECU($round_name, 3, $user_ID), 3);
    $current_round_AI_3_contribution = calculate_AI_contribution($avg_player_contribution_round_2, get_starting_ECU($round_name, 4, $user_ID), 4);

    $sql_2_field = "round_" . $round_name . "_AI_1_contribution";
    $sql2 = "UPDATE users SET $sql_2_field = $current_round_AI_1_contribution WHERE user_id =$user_ID";
    $sql_3_field = "round_" . $round_name . "_AI_2_contribution";
    $sql3 = "UPDATE users SET $sql_3_field = $current_round_AI_2_contribution WHERE user_id =$user_ID";
    $sql_4_field = "round_" . $round_name . "_AI_3_contribution";
    $sql4 = "UPDATE users SET $sql_4_field = $current_round_AI_3_contribution WHERE user_id =$user_ID";

    global $con;
    if (mysqli_query($con, $sql2) && mysqli_query($con, $sql3) && mysqli_query($con, $sql4)) {
        $destination = "round_" . $round_name . "_punishment.php";
        echo("<script>window.open('$destination', '_self')</script>");
    }
    else {
        echo("<script>alert('Could not connect to server')</script>");
        throw new Exception("Error: SQL did not execute");
    }
}

include("templates/footer.php") ?>
</html>
