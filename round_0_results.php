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
$test_ECU_payoff = intval(0.5 * $total_contribution);

$test_round_player_payoff = 20 - $test_round_player_contribution + $test_ECU_payoff;
$test_round_AI_1_payoff = 20 - $test_round_AI_1_contribution + $test_ECU_payoff;
$test_round_AI_2_payoff = 20 - $test_round_AI_2_contribution + $test_ECU_payoff;
$test_round_AI_3_payoff = 20 - $test_round_AI_3_contribution + $test_ECU_payoff;

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
        <li>You: $test_round_player_contribution</li>
        <li><span style='color: green'>Green</span>: $test_round_AI_1_contribution</li>
        <li><span style='color: blue'>Blue</span>: $test_round_AI_2_contribution</li>
        <li><span style='color: red'>Red</span>: $test_round_AI_3_contribution</li>
    </ul>
    
    <br>
    <h3>ECU Totals:</h3>
    <ul>
        <li>You: $test_round_player_payoff ECU's</li>
        <li><span style='color: green'>Green</span>: $test_round_AI_1_payoff</li>
        <li><span style='color: blue'>Blue</span>: $test_round_AI_2_payoff</li>
        <li><span style='color: red'>Red</span>: $test_round_AI_3_payoff</li>
    </ul>
    <br>
    
    <p>Remember: This was a practice round and no ECU's will carry over to the next round.</p>
    
    <form action='' method='post'>
        <button name='submit' class='btn btn-default'>Continue to Part 1</button>
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
