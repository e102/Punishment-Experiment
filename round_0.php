<!DOCTYPE html>
<html>
<?php include("templates/header.php"); ?>
<head>
    <title>Practice Round</title>
    <link rel="stylesheet" href="styles/default.css" media="all"/>
</head>

<body>
<h1>Welcome to the practice round</h1>
<p>You are now entering the practice round. In this round, you will be playing against a computer rather than real
    people and any ECU's earned will not carry over to the real game.</p>

<p>Remember, your income for the round will consist of:</p>
<ul>
    <li>the tokens which you have kept for yourself (“Income from ECU kept”);</li>
    <li>the “income from the project”. This income is calculated as follows: your income from the project = 0.4 x the
        total contribution of all 4 group members to the project.
    </li>
</ul>
<br>
<p>In total: payout = (20 - your contribution to the project) + 0.4*(total contributions to the project)</p>
<br>

<h1 id="time">Time Left: </h1>
<br>

<p>ECU's kept: some number</p>

<form action="">
    <input list="contribution" onkeydown="return false">
    <datalist id="contribution">
        <option value="1">
        <option value="2">
        <option value="3">
        <option value="4">
        <option value="5">
        <option value="6">
        <option value="7">
        <option value="8">
        <option value="9">
        <option value="10">
        <option value="11">
        <option value="12">
        <option value="13">
        <option value="14">
        <option value="15">
        <option value="16">
        <option value="17">
        <option value="18">
        <option value="19">
        <option value="20">
    </datalist>
</form>
<script>
    var time_left = 60;

    window.onload = function () {
        alert("Window.onload triggered")
        document.getElementById("time").innerHTML = "You have " time_left.toString() + " seconds left"
    };
</script>
</body>
<?php include("templates/footer.php") ?>
</html>
