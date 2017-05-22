<!DOCTYPE html>
<html>
<?php include("templates/header.php");
include("includes/connection.php");
session_start();
include("templates/bootstrap_head.php");
echo_head("Part 1 Final Results");

include_once("includes/Authenticator.php");
authenticator::authenticate_access("round_1_results.php", "round_1c.php");
?>
<body>
<div class="container-fluid">
<?php
$userID = $_SESSION["user_id"];
display_round_1c_results($userID);
display_game_1_final_results($userID);

function display_round_1c_results($user_ID) {
    global $con;
    $sql_query = "select * from users where user_ID = '$user_ID'";
    $run_query = mysqli_query($con, $sql_query);
    $check_query = mysqli_num_rows($run_query);

    if ($check_query == 1) {
        while ($row = mysqli_fetch_array($run_query)) {
            $round_1c_player_contribution = $row["round_1c_player_contribution"];
            $round_1c_AI_1_contribution = $row["round_1c_AI_1_contribution"];
            $round_1c_AI_2_contribution = $row["round_1c_AI_2_contribution"];
            $round_1c_AI_3_contribution = $row["round_1c_AI_3_contribution"];

            $round_1c_player_ECU_at_end = $row["round_1c_player_ECU_at_end"];
            $round_1c_AI_1_ECU_at_end = $row["round_1c_AI_1_ECU_at_end"];
            $round_1c_AI_2_ECU_at_end = $row["round_1c_AI_2_ECU_at_end"];
            $round_1c_AI_3_ECU_at_end = $row["round_1c_AI_3_ECU_at_end"];

            $round_1b_player_ECU_at_end = $row["round_1b_player_ECU_at_end"];
            $round_1b_AI_1_ECU_at_end = $row["round_1b_AI_1_ECU_at_end"];
            $round_1b_AI_2_ECU_at_end = $row["round_1b_AI_2_ECU_at_end"];
            $round_1b_AI_3_ECU_at_end = $row["round_1b_AI_3_ECU_at_end"];
        }
    }
    elseif ($check_query == 0) {
        throw new Exception("No user found with this id");
    }
    elseif ($check_query > 1) {
        throw new Exception("Multiple users found with this id");
    }
    else {
        throw new Exception("Unexpected error");
    }

    echo("
    <body>
    <h1>Round 3 results:</h1>
    
    <h3>Initial State:</h3>
    <ul>
        <li>You entered the round with $round_1b_player_ECU_at_end ECUs</li>
        <li><span style='color: green'>Green</span> entered the round with $round_1b_AI_1_ECU_at_end ECUs</li>
        <li><span style='color: blue'>Blue</span> entered the round with $round_1b_AI_2_ECU_at_end ECUs</li>
        <li><span style='color: red'>Red</span> entered the round with $round_1b_AI_3_ECU_at_end ECUs</li>
    </ul>
    
    <h3>Donations:</h3>
    <ul>
        <li>You donated $round_1c_player_contribution ECUs to the common pool</li>
        <li><span style='color: green'>Green</span> donated $round_1c_AI_1_contribution ECUs to the common pool</li>
        <li><span style='color: blue'>Blue</span> donated $round_1c_AI_2_contribution ECUs to the common pool</li>
        <li><span style='color: red'>Red</span> donated $round_1c_AI_3_contribution ECUs to the common pool</li>
    </ul>
    
    <br>
    <h3>Final ECU totals:</h3>
    <ul>
        <li>You have $round_1c_player_ECU_at_end ECU's</li>
        <li><span style='color: green'>Green</span> has $round_1c_AI_1_ECU_at_end ECU's</li>
        <li><span style='color: blue'>Blue</span> has $round_1c_AI_2_ECU_at_end ECU's</li>
        <li><span style='color: red'>Red</span> has $round_1c_AI_3_ECU_at_end ECU's</li>
    </ul>
    <br>
    ");
}

function display_game_1_final_results($userID) {
    global $con;
    $sql_query = "select * from users where user_ID = '$userID'";
    $run_query = mysqli_query($con, $sql_query);
    $check_query = mysqli_num_rows($run_query);

    if ($check_query == 1) {
        while ($row = mysqli_fetch_array($run_query)) {
            $round_1c_player_ECU_at_end = $row["round_1c_player_ECU_at_end"];
        }
    }
    elseif ($check_query == 0) {
        throw new Exception("No user found with this id");
    }
    elseif ($check_query > 1) {
        throw new Exception("Multiple users found with this id");
    }
    else {
        throw new Exception("Unexpected error");
    }

    echo("
<h1>Final results for Part 1:</h1>

<p> These ECU's have been added to your bank. After you have finished all 3 stages, the ECU in your bank will determine your reward</p>
");
}

?>

<form action='' method='post'>
    <button name='submit' class="btn btn-default">Continue to Part 2</button>
</form>
</div>
</body>

<?php
if (isset($_POST['submit'])) {
    echo("<script>window.open('round_2_comprehension_quiz.php', '_self')</script>");
}
?>

<?php include("templates/footer.php") ?>
</html>
