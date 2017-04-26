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
get_previous_round_rewards($_SESSION['user_id']);
display_round_2a_final_results($round_2a_player_contribution, $round_2a_AI_1_contribution, $round_2a_AI_2_contribution, $round_2a_AI_3_contribution);

$player_count = 4;
echo("<script>var player_starting_ECU = 20 - $round_2a_player_contribution</script>");

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

function get_previous_round_rewards($user_ID) {
    global $con;
    $sql_query = "select * from users where user_ID = '$user_ID'";
    $run_query = mysqli_query($con, $sql_query);
    $check_query = mysqli_num_rows($run_query);

    if ($check_query == 1) {
        while ($row = mysqli_fetch_array($run_query)) {
            global $round_2a_player_reward_AI_1;
            $round_2a_player_reward_AI_1 = $row["round_2a_player_reward_AI_1"];
            global $round_2a_player_reward_AI_2;
            $round_2a_player_reward_AI_2 = $row["round_2a_player_reward_AI_2"];
            global $round_2a_player_reward_AI_3;
            $round_2a_player_reward_AI_3 = $row["round_2a_player_reward_AI_3"];

            global $round_2a_AI_1_reward_player;
            $round_2a_AI_1_reward_player = $row["round_2a_AI_1_reward_player"];
            global $round_2a_AI_1_reward_AI_2;
            $round_2a_AI_1_reward_AI_2 = $row["round_2a_AI_1_reward_AI_2"];
            global $round_2a_AI_1_reward_AI_3;
            $round_2a_AI_1_reward_AI_3 = $row["round_2a_AI_1_reward_AI_3"];

            global $round_2a_AI_2_reward_player;
            $round_2a_AI_2_reward_player = $row["round_2a_AI_2_reward_player"];
            global $round_2a_AI_2_reward_AI_1;
            $round_2a_AI_2_reward_AI_1 = $row["round_2a_AI_2_reward_AI_1"];
            global $round_2a_AI_2_reward_AI_3;
            $round_2a_AI_2_reward_AI_3 = $row["round_2a_AI_2_reward_AI_3"];

            global $round_2a_AI_3_reward_player;
            $round_2a_AI_3_reward_player = $row["round_2a_AI_3_reward_player"];
            global $round_2a_AI_3_reward_AI_1;
            $round_2a_AI_3_reward_AI_1 = $row["round_2a_AI_3_reward_AI_1"];
            global $round_2a_AI_3_reward_AI_2;
            $round_2a_AI_3_reward_AI_2 = $row["round_2a_AI_3_reward_AI_2"];
        }
    }
    else {
        throw new Exception("Could not fetch data");
    }
}

function display_round_2a_final_results($round_2a_player_contribution, $round_2a_AI_1_contribution, $round_2a_AI_2_contribution, $round_2a_AI_3_contribution) {
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
    
    <h3>Rewards/Punishments:</h3>
    ");
}
?>

<script>
    var random_time = Math.floor((Math.random() * 60) + 5)
    setTimeout(load_page, random_time * 10);
    //setTimeout(load_page, random_time * 1000);

    function load_page() {
        document.getElementById("display_before_load").style.display = "none";
        document.getElementById("display_after_load").style.display = "inline";
        document.getElementById("starting_ECUs").innerHTML = "ECUs this round:" + player_starting_ECU;
        document.getElementById("ECUs_kept").innerHTML = "ECUs remaining after your punishments/rewards:" + player_starting_ECU;
    }
</script>
</body>

<?php
if (isset($_POST['continue'])) {
    echo("<script>window.open('round_2b.php', '_self')</script>");
}
?>

<?php include("templates/footer.php") ?>
</html>