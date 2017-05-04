<!DOCTYPE html>
<html>
<?php
include("templates/header.php");
include("includes/connection.php");
session_start();

$round_name = "2c";
$game_number = substr($round_name, 0, 1);
$round_number = ord(substr($round_name, -1)) - 96;
echo("
<head>
    <title>Game $game_number: Round $round_number</title>
    <link rel='stylesheet' href='styles/default.css' media='all'/>
</head>

<body>
<h1>Welcome to Round $round_number</h1>
<div id='display_before_load'>
    <p id='intro_text'>Please wait for other players to connect. This should not take more than 60 seconds.</p>
</div>
");

include_once("includes/get_starting_ECU.php");
$player_starting_ECU = get_starting_ECU($round_name, 1, $_SESSION["user_id"]);
echo("<script>var player_starting_ECU = $player_starting_ECU</script>");
?>

<div id="display_after_load" style="display:none">
    <p>All players have connected. Please enter your contribution below</p>
    <br>
    <p id="starting_ECUs"></p>
    <p id='ECUs_kept'>ECUs remaining after your contribution</p>
    <form action='' method='post'>
        <p>Contribution to common pool:</p>
        <select id='contribution_dropdown' name='contribution_dropdown' onchange='update_ECU_Count()'>
            <script>
                var contribution_dropdown = document.getElementById("contribution_dropdown");
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
    var random_time = Math.floor((Math.random() * 60) + 5);
    setTimeout(load_page, random_time * 10);
    //setTimeout(load_page, random_time * 1000); //TODO Change

    function load_page() {
        document.getElementById("display_before_load").style.display = "none";
        document.getElementById("display_after_load").style.display = "inline";
        document.getElementById("starting_ECUs").innerHTML = "ECUs this round:" + player_starting_ECU;
        document.getElementById("ECUs_kept").innerHTML = "ECUs remaining after your contribution:" + player_starting_ECU;
    }

    function update_ECU_Count() {
        var contribution = document.getElementById("contribution_dropdown");
        var x = contribution.options[contribution.selectedIndex].value;
        document.getElementById("ECUs_kept").innerHTML = "ECUs remaining after your contribution:" + (player_starting_ECU - x).toString();
    }
</script>

<?php
if (isset($_POST['submit'])) {
    submit_choices($round_name, $_SESSION["user_id"]);
}

function submit_choices($round_name, $user_ID) {
    $current_round_player_contribution = (int)htmlspecialchars($_POST["contribution_dropdown"]);

    include_once("includes/get_previous_round_name.php");
    include_once("includes/get_contribution.php");
    $previous_round_player_contribution = get_contribution(get_previous_round_name($round_name), 1, $user_ID);

    include_once("includes/get_starting_ECU.php");
    $current_round_AI_1_contribution = calculate_AI_contribution($previous_round_player_contribution, get_starting_ECU($round_name, 2, $user_ID));
    $current_round_AI_2_contribution = calculate_AI_contribution($previous_round_player_contribution, get_starting_ECU($round_name, 3, $user_ID));
    $current_round_AI_3_contribution = calculate_AI_contribution($previous_round_player_contribution, get_starting_ECU($round_name, 4, $user_ID));

    $sql_1_field = "round_" . $round_name . "_player_contribution";
    $sql1 = "UPDATE users SET $sql_1_field= $current_round_player_contribution WHERE user_id =$user_ID";
    $sql_2_field = "round_" . $round_name . "_AI_1_contribution";
    $sql2 = "UPDATE users SET $sql_2_field = $current_round_AI_1_contribution WHERE user_id =$user_ID";
    $sql_3_field = "round_" . $round_name . "_AI_2_contribution";
    $sql3 = "UPDATE users SET $sql_3_field = $current_round_AI_2_contribution WHERE user_id =$user_ID";
    $sql_4_field = "round_" . $round_name . "_AI_3_contribution";
    $sql4 = "UPDATE users SET $sql_4_field = $current_round_AI_3_contribution WHERE user_id =$user_ID";

    global $con;
    if (mysqli_query($con, $sql1) && mysqli_query($con, $sql2) && mysqli_query($con, $sql3) && mysqli_query($con, $sql4)) {
        $destination = "round_" . $round_name . "_punishment.php";
        echo("<script>window.open('$destination', '_self')</script>");
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