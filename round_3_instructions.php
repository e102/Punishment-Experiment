<!DOCTYPE html>
<html>
<?php include("templates/header.php");
include("templates/bootstrap_head.php");
echo_head("Game 3 Instructions");

session_start();
include_once("includes/Authenticator.php");
authenticator::authenticate_access("round_3_instructions.php", "round_2_final_results.php");

echo("
<body>
<div class='container-fluid'>
")
?>
<h1>Part 3 Instructions</h1>
<p>In this game you will be playing the same game you have been playing before, however, the ability to punish or reward
    other participants will be removed. Instead, one participants at random will be allocated a role of a third party
    punisher (TPP). The other three participants play the game. None of the decisions in the game influence the payoff
    of the TPP, however, TPP may choose to reward and punish any other player in the game in the same way they could in
    the previous game.</p>

<p>As in the previous part, you are playing with the same participants, although all colours have been changed again.
    Your incomes have been cleared and every participant starts with 20 tokens regardless of their income in the
    previous game.</p>

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