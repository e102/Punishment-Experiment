<!DOCTYPE html>
<html>
<?php include("templates/header.php");
include("includes/connection.php");
session_start();
?>
<head>
    <title>Game 2: Round 1</title>
    <link rel="stylesheet" href="styles/default.css" media="all"/>
</head>

<body>
<h1>Welcome to Round 1</h1>
<div id="display_before_load">
    <p id="intro_text">Please wait for other players to connect. This should not take more than 60 seconds.</p>
</div>

<?php
echo("<script>var player_starting_ECU = 20</script>");
?>

<div id="display_after_load" style="display:none">
    <p>All players have connected. Please enter your contribution below</p>
    <br>
    <p id="starting_ECUs"></p>
    <p id='ECUs_kept'>ECUs remaining after your contribution</p>
    <form action='' method='post'>
        <p>Contribution to common pool:</p>
        <select id='r2a_contribution' name='r2a_contribution' onchange='update_ECU_Count()'>
            <script>
                var contribution_dropdown = document.getElementById("r2a_contribution");
                for (var i = 0; i <= player_starting_ECU; i++) {
                    var option = document.createElement("option");
                    if (i == 0) {
                        option.selected = 'selected';
                    }
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

<script>
    var random_time = Math.floor((Math.random() * 60) + 5)
    setTimeout(load_page, random_time * 1000);

    function load_page() {
        document.getElementById("display_before_load").style.display = "none";
        document.getElementById("display_after_load").style.display = "inline";
        document.getElementById("starting_ECUs").innerHTML = "ECUs this round:" + player_starting_ECU;
        document.getElementById("ECUs_kept").innerHTML = "ECUs remaining after your contribution:" + player_starting_ECU;
    }

    function update_ECU_Count() {
        var contribution = document.getElementById("r2a_contribution");
        var x = contribution.options[contribution.selectedIndex].value;
        document.getElementById("ECUs_kept").innerHTML = "ECUs remaining after your contribution:" + (player_starting_ECU - x).toString();
    }
</script>

<?php


if (isset($_POST['submit'])) {
    get_last_round_behaviour($_SESSION["user_id"]);
    submit_choices($_SESSION["user_id"]);
}

function get_last_round_behaviour($userID) {
    global $con;

    $sql_query = "select * from users where user_ID = '$userID'";
    $run_query = mysqli_query($con, $sql_query);
    $check_query = mysqli_num_rows($run_query);

    if ($check_query == 1) {
        while ($row = mysqli_fetch_array($run_query)) {
            global $round_1c_player_contribution;
            $round_1c_player_contribution = $row["round_1c_player_contribution"];
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
}

function submit_choices($userID) {
    $round_2a_player_contribution = (int)htmlspecialchars($_POST["r2a_contribution"]);
    global $round_1c_player_contribution;
    $round_2a_AI_1_contribution = calculate_AI_contribution($round_1c_player_contribution, 20);
    $round_2a_AI_2_contribution = calculate_AI_contribution($round_1c_player_contribution, 20);
    $round_2a_AI_3_contribution = calculate_AI_contribution($round_1c_player_contribution, 20);

    $sql1 = "UPDATE users SET round_2a_player_contribution = $round_2a_player_contribution WHERE user_id =$userID";
    $sql2 = "UPDATE users SET round_2a_AI_1_contribution = $round_2a_AI_1_contribution WHERE user_id =$userID";
    $sql3 = "UPDATE users SET round_2a_AI_2_contribution = $round_2a_AI_2_contribution WHERE user_id =$userID";
    $sql4 = "UPDATE users SET round_2a_AI_3_contribution = $round_2a_AI_3_contribution WHERE user_id =$userID";

    global $con;
    if (mysqli_query($con, $sql1) && mysqli_query($con, $sql2) && mysqli_query($con, $sql3) && mysqli_query($con, $sql4)) {
        echo("<script>window.open('round_2a_results.php', '_self')</script>");
    }
    else {
        echo("<script>alert('Could not connect to server')</script>");
        throw new Exception("Error: SQL did not execute");
    }
}

function calculate_AI_contribution($player_contribution, $AI_ECU_available) {
    $AI_contribution = rand($player_contribution, $player_contribution + 10);
    if ($AI_contribution > $AI_ECU_available) {
        $AI_contribution = $AI_ECU_available;
    }
    return $AI_contribution;
}

?>
</body>
<?php include("templates/footer.php") ?>
</html>