<!DOCTYPE html>
<html>
<?php include("templates/header.php");
include("includes/connection.php");
session_start();
?>
<head>
    <title>Game 2: Round 1 Results</title>
    <link rel="stylesheet" href="styles/default.css" media="all"/>
</head>

<body>

<?php
get_previous_round_contributions($_SESSION["user_id"]);
display_round_2a_results($round_2a_player_contribution, $round_2a_AI_1_contribution, $round_2a_AI_2_contribution, $round_2a_AI_3_contribution);

$player_count = 4;
echo("<script>var player_starting_ECU = (20 - $round_2a_player_contribution) + 0.4*($round_2a_player_contribution + $round_2a_AI_1_contribution + $round_2a_AI_2_contribution + $round_2a_AI_3_contribution)</script>");

echo("<script>var player_count = $player_count;</script>");

function get_previous_round_contributions($user_ID) {
    global $con;
    $sql_query = "select * from users where user_ID = '$user_ID'";
    $run_query = mysqli_query($con, $sql_query);
    $check_query = mysqli_num_rows($run_query);

    if ($check_query == 1) {
        while ($row = mysqli_fetch_array($run_query)) {
            global $round_2a_player_contribution;
            $round_2a_player_contribution = $row["round_2a_player_contribution"];
            global $round_2a_AI_1_contribution;
            $round_2a_AI_1_contribution = $row["round_2a_AI_1_contribution"];
            global $round_2a_AI_2_contribution;
            $round_2a_AI_2_contribution = $row["round_2a_AI_2_contribution"];
            global $round_2a_AI_3_contribution;
            $round_2a_AI_3_contribution = $row["round_2a_AI_3_contribution"];
            global $round_2a_total_contribution;
            $round_2a_total_contribution = $round_2a_player_contribution + $round_2a_AI_1_contribution + $round_2a_AI_2_contribution + $round_2a_AI_3_contribution;
        }
    }
    else {
        throw new Exception("Could not fetch data");
    }
}

function display_round_2a_results($round_2a_player_contribution, $round_2a_AI_1_contribution, $round_2a_AI_2_contribution, $round_2a_AI_3_contribution) {
    echo("
    <body>
    <h1>Round 1 results:</h1>
    
    <h3>Initial State:</h3>
    <ul>
        <li>You entered the round with 20 ECUs</li>
        <li>Player 2 entered the round with 20 ECUs</li>
        <li>Player 3 entered the round with 20 ECUs</li>
        <li>Player 4 entered the round with 20 ECUs</li>
    </ul>
    <br>
    
    <h3>Donations:</h3>
    <ul>
        <li>You donated $round_2a_player_contribution ECUs to the common pool</li>
        <li>Player 2 donated $round_2a_AI_1_contribution ECUs to the common pool</li>
        <li>Player 3 donated $round_2a_AI_2_contribution ECUs to the common pool</li>
        <li>Player 4 donated $round_2a_AI_3_contribution ECUs to the common pool</li>
    </ul>
    <br>
    
    <h3>Punishments:</h3>
    <ul>
        <li>You were rewarded X by AI 1, Y by AI 2 and Z by AI 3</li>
    </ul>
    <br>
    
    <h3>Final ECU</h3>
    <ul>
        <li>You donated $round_2a_player_contribution ECUs to the common pool</li>
        <li>Player 2 donated $round_2a_AI_1_contribution ECUs to the common pool</li>
        <li>Player 3 donated $round_2a_AI_2_contribution ECUs to the common pool</li>
        <li>Player 4 donated $round_2a_AI_3_contribution ECUs to the common pool</li>
    </ul>
    <br>
    ");
}
?>

</body>

<?php
if (isset($_POST['submit'])) {
    echo("<script>window.open('round_2b.php', '_self')</script>");
}
?>

<?php include("templates/footer.php") ?>
</html>