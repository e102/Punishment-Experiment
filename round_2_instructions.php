<!DOCTYPE html>
<html>
<?php
session_start();
include("templates/header.php");
include("templates/bootstrap_head.php");
echo_head("Game 2 Instructions");

include_once("includes/Authenticator.php");
authenticator::authenticate_access("round_2_instructions.php", "round_1_results.php");
?>
<body>
<div class="container-fluid">
<h1>Game 2 Instructions</h1>
<p>You will now play game 2. The rules are the same as game 1 with one addition. You can now punish or reward other
    participants. Punishing a player removes their ECU's. Rewarding them gives them ECU's. It costs you 0.5 ECU's to
    punish/reward a player 1 ECU</p>

<h3>IMPORTANT: Player names have been changed. You are still playing with the same people, but their names have been reassigned.</h3>
<ul>
    <li>There are three rounds in the game</li>
    <li>You start with 20 ECUs</li>
    <li>You can contribute ECUs to the common pool</li>
    <li>You can punish or reward other participants.</li>
    <li>Your ECU's are the sum of your leftover ECUs, the total donated to the common pool times 0.4 and any reward/punishment you receive.</li>
</ul>

<form action='' method='post'>
    <button name='submit' class="btn btn-default">Continue</button>
</form>
</div>
</body>
<?php
if (isset($_POST['submit'])) {
    echo("<script>window.open('round_2_comprehension_quiz.php', '_self')</script>");
}
?>
<?php include("templates/footer.php") ?>
</html>