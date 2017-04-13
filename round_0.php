<!DOCTYPE html>
<html>
<?php include("templates/header.php");
include ("includes/connection.php");
session_start();
?>
<head>
    <title>Practice Round</title>
    <link rel="stylesheet" href="styles/default.css" media="all"/>
</head>

<body>
<h1>Welcome to the practice round</h1>
<p>You are now entering the practice round. In this round, you will be playing against a computer rather than real
    people and any ECU's earned will not carry over to the real game.</p>

<p>Remember</p>
<ul>
    <li>You start with 20 ECUs</li>
    <li>You can donate any number of these ECUs to the common pool</li>
    <li>Your final income is the sum of any ECUs you keep + 0.4 x the
        total contribution of all 4 group members to the common pool.
    </li>
</ul>
<br>
<p>In total: payout = (20 - your contribution to the project) + 0.4*(total contributions to the project)</p>
<br>

<p id="tokens_kept">Your ECUs:20</p>

<form action="" method="post">
    <p>Contribution to common pool:</p>
    <select id="r0_contribution" name="r0_contribution" onchange="update_ECU_Count()">
        <option value="0" selected="selected">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
    </select>
    <br><br>
    <button name="submit">Submit</button>
</form>
<?php
if (isset($_POST['submit'])) {
    $userID = $_SESSION["user_id"];
    $test_round_player_contribution = htmlspecialchars($_POST["r0_contribution"]);
    $_SESSION["test_round_player_contribution"] = $test_round_player_contribution;
    $sql = "UPDATE users SET test_round_player_contribution = $test_round_player_contribution WHERE user_id =$userID";
    if (mysqli_query($con, $sql)) {
        echo("<script>window.open('round_0_results.php', '_self')</script>");
    }
    else {
        echo("<script>alert('Could not connect to server')</script>");
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}
?>

<script>
    function update_ECU_Count() {
        var contribution = document.getElementById("r0_contribution");
        var x = contribution.options[contribution.selectedIndex].value;
        document.getElementById("tokens_kept").innerHTML = "Your ECUs:" + (20 - x).toString();
    }
</script>
</body>
<?php include("templates/footer.php") ?>
</html>
