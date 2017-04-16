<!DOCTYPE html>
<html>
<?php include("templates/header.php");
include("includes/connection.php");
session_start();
?>
<head>
    <title>Game 1: Round 2</title>
    <link rel="stylesheet" href="styles/default.css" media="all"/>
</head>

<body>
<h1>Welcome to the round 2</h1>
<div id="display_before_load">
    <p id="intro_text">Please wait for other players to connect. This should not take more than 60 seconds.</p>
    <p>The previous round's results are displayed below:</p>
</div>

<?php
$userID = $_SESSION["user_id"];
display_round_1a_results($userID);

function display_round_1a_results($user_ID) {
    global $con;
    $sql_query = "select * from users where user_ID = '$user_ID'";
    $run_query = mysqli_query($con, $sql_query);
    $check_query = mysqli_num_rows($run_query);

    if ($check_query == 1) {
        while ($row = mysqli_fetch_array($run_query)) {
            $round_1a_player_contribution = $row["round_1a_player_contribution"];
            $round_1a_AI_1_contribution = $row["round_1a_AI_1_contribution"];
            $round_1a_AI_2_contribution = $row["round_1a_AI_2_contribution"];
            $round_1a_AI_3_contribution = $row["round_1a_AI_3_contribution"];

            $round_1a_player_ECU_at_end = $row["round_1a_player_ECU_at_end"];
            $round_1a_AI_1_ECU_at_end = $row["round_1a_AI_1_ECU_at_end"];
            $round_1a_AI_2_ECU_at_end = $row["round_1a_AI_2_ECU_at_end"];
            $round_1a_AI_3_ECU_at_end = $row["round_1a_AI_3_ECU_at_end"];
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
    <head>
        <title>Round 1a Results</title>
        <link rel='stylesheet' href='styles/default.css' media='all'/>
    </head>
    
    <body>
    <h1>The results:</h1>
    
    <h3>Initial State:</h3>
    <ul>
        <li>You entered the round with 0 ECUs</li>
        <li>Player 2 entered the round with 0 ECUs</li>
        <li>Player 3 entered the round with 0 ECUs</li>
        <li>Player 4 entered the round with 0 ECUs</li>
    </ul>
    
    <h3>Donations:</h3>
    <ul>
        <li>You donated $round_1a_player_contribution ECUs to the common pool</li>
        <li>Player 2 donated $round_1a_AI_1_contribution ECUs to the common pool</li>
        <li>Player 3 donated $round_1a_AI_2_contribution ECUs to the common pool</li>
        <li>Player 4 donated $round_1a_AI_3_contribution ECUs to the common pool</li>
    </ul>
    
    <br>
    <h3>Final ECU totals:</h3>
    <ul>
        <li>You have $round_1a_player_ECU_at_end ECU's</li>
        <li>Player 2 has $round_1a_AI_1_ECU_at_end ECU's</li>
        <li>Player 3 hsa $round_1a_AI_2_ECU_at_end ECU's</li>
        <li>Player 4 has $round_1a_AI_3_ECU_at_end ECU's</li>
    </ul>
    <br>
    ");
    echo("<script>var player_starting_ECU = $round_1a_player_ECU_at_end</script>");
}

?>

<div id="display_after_load" style="display:none">
    <p>All players have connected. Please enter your contribution below</p>
    <br>
    <p id="starting_ECUs"></p>
    <p id='ECUs_kept'>ECUs remaining after your contribution</p>
    <form action='' method='post'>
        <p>Contribution to common pool:</p>
        <select id='r1b_contribution' name='r1b_contribution' onchange='update_ECU_Count()'>
            <option value='0' selected='selected'>0</option>
            <script>
                var contribution_dropdown = document.getElementById("r1b_contribution");
                for (var i=1;i<=player_starting_ECU;i++) {
                    var option = document.createElement("option");
                    option.text = i;
                    option.value = i;
                    contribution_dropdown.add(option);
                }
            </script>
        </select>
        <br><br>
        <button name='submit'>Submit</button>
    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $round_1b_player_contribution = (int)htmlspecialchars($_POST["r1b_contribution"]);
    $round_1b_AI_1_contribution = rand(5, 15);
    $round_1b_AI_2_contribution = rand(5, 15);
    $round_1b_AI_3_contribution = rand(5, 15);

    $total_contribution = $round_1b_player_contribution + $round_1b_AI_1_contribution + $round_1b_AI_2_contribution + $round_1b_AI_3_contribution;
    $round_1b_player_ECU_at_end = (20 - $round_1b_player_contribution) + (0.4 * $total_contribution);
    $round_1b_AI_1_ECU_at_end = (20 - $round_1b_AI_1_contribution) + (0.4 * $total_contribution);
    $round_1b_AI_2_ECU_at_end = (20 - $round_1b_AI_2_contribution) + (0.4 * $total_contribution);
    $round_1b_AI_3_ECU_at_end = (20 - $round_1b_AI_3_contribution) + (0.4 * $total_contribution);

    $userID = $_SESSION["user_id"];
    $sql1 = "UPDATE users SET round_1b_player_contribution = $round_1b_player_contribution, round_1b_player_ECU_at_end = $round_1b_player_ECU_at_end WHERE user_id =$userID";
    $sql2 = "UPDATE users SET round_1b_AI_1_contribution = $round_1b_AI_1_contribution, round_1b_AI_1_ECU_at_end = $round_1b_AI_1_ECU_at_end WHERE user_id =$userID";
    $sql3 = "UPDATE users SET round_1b_AI_2_contribution = $round_1b_AI_2_contribution, round_1b_AI_2_ECU_at_end = $round_1b_AI_2_ECU_at_end WHERE user_id =$userID";
    $sql4 = "UPDATE users SET round_1b_AI_3_contribution = $round_1b_AI_3_contribution, round_1b_AI_3_ECU_at_end = $round_1b_AI_3_ECU_at_end WHERE user_id =$userID";

    if (!(mysqli_query($con, $sql1) && mysqli_query($con, $sql2) && mysqli_query($con, $sql3) && mysqli_query($con, $sql4))) {
        echo("<script>alert('Could not connect to server')</script>");
        echo "Error: " . $sql4 . "<br>" . mysqli_error($con);
    }
    else {
        echo("<script>window.open('round_1b.php', '_self')</script>");
    }
}
?>

<script>
    function load_page() {
        document.getElementById("display_before_load").style.display = "none";
        document.getElementById("display_after_load").style.display = "inline";
        document.getElementById("starting_ECUs").innerHTML = "ECUs this round:" + player_starting_ECU;
        document.getElementById("ECUs_kept").innerHTML = "ECUs remaining after your contribution:" + player_starting_ECU;
    }

    var random_time = Math.floor((Math.random() * 60) + 5)
    setTimeout(load_page, random_time * 1000);

    function update_ECU_Count() {
        var contribution = document.getElementById("r1b_contribution");
        var x = contribution.options[contribution.selectedIndex].value;
        document.getElementById("ECUs_kept").innerHTML = "ECUs remaining after your contribution:" + (20 - x).toString();
    }
</script>
</body>
<?php include("templates/footer.php") ?>
</html>
