<!DOCTYPE html>
<html>
<?php include("templates/header.php");
include("includes/connection.php");
session_start();
?>
<head>
    <title>Round 1: Instructions</title>
    <link rel='stylesheet' href='styles/default.css' media='all'/>
</head>

<p>
    You will now play game 1. The rules are the same as the practice game, but you will be playing with real people.<br>
    Remember:
</p>
<ul>
    <li>There are three rounds in the game</li>
    <li>You start with 20 tokens</li>
    <li>You can contribute tokens to the common pool</li>
    <li>Your ECU's are the sum of your leftover tokens and the total donated to the common pool timex 0.4</li>
</ul>

<form action='' method='post'>
    <button name='submit'>Continue</button>
</form>
<?php
if (isset($_POST['submit'])) {
    echo("<script>window.open('round_1a.php', '_self')</script>");
}
?>
<?php include("templates/footer.php") ?>
</html>