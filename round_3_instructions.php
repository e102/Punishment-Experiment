<!DOCTYPE html>
<html>
<?php include("templates/header.php");
include("templates/bootstrap_head.php");
echo_head("Game 3 Instructions");

include_once("includes/Authenticator.php");
authenticator::authenticate_access("round_3_instructions.php", "round_2_final_results.php");

echo("
<body>
<div class='container-fluid'>
")
?>
<h1>Game 3 Instructions</h1>
<p>In this game you will be playing the same game you have been playing before, however, the ability to punish or reward
    other participants will be removed. Instead, one participants at random will be allocated a role of a third party
    punisher (TPP). The other three participants play the game. None of the decisions in the game influence the payoff
    of the TPP, however, TPP may choose to reward and punish any other player in the game in the same way they could in
    the previous game.</p>

<h3>IMPORTANT: Player names have been changed. You are still playing with the same people, but their names have been
    reassigned.</h3>
<ul>
    <li>There are three rounds in the game</li>
    <li>You start with 20 ECUs</li>
    <li>Normal players can contribute ECUs to the common pool</li>
    <li>The punisher can punish or reward other participants.</li>
    <li>Normal Players start with 20 ECU's. Their ECU's are the sum of their leftover ECUs, the total donated to the
        common pool times 0.4 and any reward/punishment they receive.
    </li>
    <li>The punisher starts with 10 ECU's and gains 10 per round.</li>
</ul>

<form action='' method='post'>
    <button name='submit'>Continue</button>
</form>
</div>
</body>
<?php
if (isset($_POST['submit'])) {
    echo("<script>window.open('round_3a.php', '_self')</script>");
}
include("templates/footer.php") ?>
</html>