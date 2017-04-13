<!DOCTYPE html>
<html>
<?php include("templates/header.php");
include("includes/connection.php");
session_start();
?>
<head>
    <title>Game 1: Round 1</title>
    <link rel="stylesheet" href="styles/default.css" media="all"/>
</head>

<body>
<div id="display_before_load">
    <h1>Welcome to the round 1</h1>
    <p id="intro_text">Please wait for other players to connect. This should not take more than 60 seconds.</p>
</div>

<div id="display_after_load" style="display:none">
    <p>All players have connected. Please enter your contribution below</p>
    <br>
    <p id='ECUs_kept'>Your ECUs:20</p>
    <form action='' method='post'>
        <p>Contribution to common pool:</p>
        <select id='r1a_contribution' name='r1a_contribution' onchange='update_ECU_Count()'>
            <option value='0' selected='selected'>0</option>
            <option value='1'>1</option>
            <option value='2'>2</option>
            <option value='3'>3</option>
            <option value='4'>4</option>
            <option value='5'>5</option>
            <option value='6'>6</option>
            <option value='7'>7</option>
            <option value='8'>8</option>
            <option value='9'>9</option>
            <option value='10'>10</option>
            <option value='11'>11</option>
            <option value='12'>12</option>
            <option value='13'>13</option>
            <option value='14'>14</option>
            <option value='15'>15</option>
            <option value='16'>16</option>
            <option value='17'>17</option>
            <option value='18'>18</option>
            <option value='19'>19</option>
            <option value='20'>20</option>
        </select>
        <br><br>
        <button name='submit'>Submit</button>
    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $round_1a_player_contribution = (int)htmlspecialchars($_POST["r1a_contribution"]);
    $round_1a_AI_1_contribution = rand(5, 15);
    $round_1a_AI_2_contribution = rand(5, 15);
    $round_1a_AI_3_contribution = rand(5, 15);

    $total_contribution = $round_1a_player_contribution + $round_1a_AI_1_contribution + $round_1a_AI_2_contribution + $round_1a_AI_3_contribution;

    $round_1a_player_ECU_at_end = (20 - $round_1a_player_contribution) + (0.4 * $total_contribution);
    $round_1a_AI_1_ECU_at_end = (20 - $round_1a_AI_1_contribution) + (0.4 * $total_contribution);
    $round_1a_AI_2_ECU_at_end = (20 - $round_1a_AI_2_contribution) + (0.4 * $total_contribution);
    $round_1a_AI_3_ECU_at_end = (20 - $round_1a_AI_3_contribution) + (0.4 * $total_contribution);

    $userID = $_SESSION["user_id"];
    $sql1 = "UPDATE users SET round_1a_player_contribution = $round_1a_player_contribution, round_1a_player_ECU_at_end = $round_1a_player_ECU_at_end WHERE user_id =$userID";
    $sql2 = "UPDATE users SET round_1a_AI_1_contribution = $round_1a_AI_1_contribution, round_1a_AI_1_ECU_at_end = $round_1a_AI_1_ECU_at_end WHERE user_id =$userID";
    $sql3 = "UPDATE users SET round_1a_AI_2_contribution = $round_1a_AI_2_contribution, round_1a_AI_2_ECU_at_end = $round_1a_AI_2_ECU_at_end WHERE user_id =$userID";
    $sql4 = "UPDATE users SET round_1a_AI_3_contribution = $round_1a_AI_3_contribution, round_1a_AI_3_ECU_at_end = $round_1a_AI_3_ECU_at_end WHERE user_id =$userID";

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
    }

    var random_time = Math.floor((Math.random() * 60) + 5)
    setTimeout(load_page, random_time * 1000);

    function update_ECU_Count() {
        var contribution = document.getElementById("r1a_contribution");
        var x = contribution.options[contribution.selectedIndex].value;
        document.getElementById("ECUs_kept").innerHTML = "Your ECUs:" + (20 - x).toString();
    }
</script>
</body>
<?php include("templates/footer.php") ?>
</html>

