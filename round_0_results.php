<!DOCTYPE html>
<html>
<?php include("templates/header.php");
include("includes/connection.php");
session_start();

$test_round_player_contribution = $_SESSION["test_round_player_contribution"];
$test_round_AI_1_contribution = rand(0, 10);
$test_round_AI_2_contribution = rand(0, 10);
$test_round_AI_3_contribution = rand(0, 10);

$total_contribution = $test_round_player_contribution + $test_round_AI_1_contribution + $test_round_AI_2_contribution + $test_round_AI_3_contribution;

$test_round_player_payoff = (20 - $test_round_player_contribution) + (0.4 * $total_contribution);
$test_round_AI_1_payoff = (20 - $test_round_AI_1_contribution) + (0.4 * $total_contribution);
$test_round_AI_2_payoff = (20 - $test_round_AI_2_contribution) + (0.4 * $total_contribution);
$test_round_AI_3_payoff = (20 - $test_round_AI_3_contribution) + (0.4 * $total_contribution);

$userID = $_SESSION["user_id"];
$sql1 = "UPDATE users SET test_round_AI_1_contribution = $test_round_AI_1_contribution WHERE user_id =$userID";
$sql2 = "UPDATE users SET test_round_AI_2_contribution = $test_round_AI_2_contribution WHERE user_id =$userID";
$sql3 = "UPDATE users SET test_round_AI_3_contribution = $test_round_AI_3_contribution WHERE user_id =$userID";
if (!(mysqli_query($con, $sql1) && mysqli_query($con, $sql2) && mysqli_query($con, $sql3))) {
    echo("<script>alert('Could not connect to server')</script>");
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

echo("
    <head>
        <title>Practice Round Results</title>
        <link rel='stylesheet' href='styles/default.css' media='all'/>
    </head>
    
    <body>
    <h1>The results:</h1>
    
    <h3>Donations:</h3>
    <ul>
        <li>You donated $test_round_player_contribution tokens to the common pool</li>
        <li>Player 2 donated $test_round_AI_1_contribution tokens to the common pool</li>
        <li>Player 3 donated $test_round_AI_2_contribution tokens to the common pool</li>
        <li>Player 4 donated $test_round_AI_3_contribution tokens to the common pool</li>
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
        <button name='submit'>Continue</button>
    </form>
");

if (isset($_POST['submit'])) {
    echo("<script>window.open('round_1.php', '_self')</script>");
}
?>
</body>
<?php include("templates/footer.php") ?>
</html>
