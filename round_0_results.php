<!DOCTYPE html>
<html>
<?php include("templates/header.php");
include("includes/connection.php");
session_start();
include("templates/bootstrap_head.php");
echo_head("Practice Round Results");

include_once("includes/Authenticator.php");
authenticator::authenticate_access("round_0_results.php", "round_0.php");

$test_round_player_contribution = $_SESSION["test_round_player_contribution"];
$test_round_AI_1_contribution = rand(0, 10);
$test_round_AI_2_contribution = rand(0, 10);
$test_round_AI_3_contribution = rand(0, 10);

$total_contribution = $test_round_player_contribution + $test_round_AI_1_contribution + $test_round_AI_2_contribution + $test_round_AI_3_contribution;

$test_round_player_payoff = intval((20 - $test_round_player_contribution) + (0.5 * $total_contribution));
$test_round_AI_1_payoff = intval((20 - $test_round_AI_1_contribution) + (0.5 * $total_contribution));
$test_round_AI_2_payoff = intval((20 - $test_round_AI_2_contribution) + (0.5 * $total_contribution));
$test_round_AI_3_payoff = intval((20 - $test_round_AI_3_contribution) + (0.5 * $total_contribution));

$userID = $_SESSION["user_id"];
$sql1 = "UPDATE users SET test_round_AI_1_contribution = $test_round_AI_1_contribution WHERE user_id =$userID";
$sql2 = "UPDATE users SET test_round_AI_2_contribution = $test_round_AI_2_contribution WHERE user_id =$userID";
$sql3 = "UPDATE users SET test_round_AI_3_contribution = $test_round_AI_3_contribution WHERE user_id =$userID";
if (!(mysqli_query($con, $sql1) && mysqli_query($con, $sql2) && mysqli_query($con, $sql3))) {
    echo("<script>alert('Could not connect to server')</script>");
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

echo("
    <body>
    <div class='container-fluid'>
    <h1>The results:</h1>
    
    <h3>Donations:</h3>
    <ul>
        <li>You donated $test_round_player_contribution ECUs to the common pool</li>
        <li>Player 2 donated $test_round_AI_1_contribution ECUs to the common pool</li>
        <li>Player 3 donated $test_round_AI_2_contribution ECUs to the common pool</li>
        <li>Player 4 donated $test_round_AI_3_contribution ECUs to the common pool</li>
    </ul>
    
    <br>
    <h1>The results:</h1>
    <ul>
        <li>You receive $test_round_player_payoff ECU's</li>
        <li>Player 2 receives $test_round_AI_1_payoff ECU's</li>
        <li>Player 3 receives $test_round_AI_2_payoff ECU's</li>
        <li>Player 4 receives $test_round_AI_3_payoff ECU's</li>
    </ul>
    <br>
    
    <p>
    Remember: As this was a practice round, you were playing with a computer and no ECU's will carry over to the next round.
    In future rounds, you will be playing against real people.
    </p>
    
    <form action='' method='post'>
        <button name='submit' class='btn btn-default'>Continue</button>
    </form>
");

if (isset($_POST['submit'])) {
    echo("<script>window.open('round_1_instructions.php', '_self')</script>");
}
?>
</div>
</body>
<?php include("templates/footer.php") ?>
</html>
