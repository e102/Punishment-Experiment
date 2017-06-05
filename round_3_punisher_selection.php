<!DOCTYPE html>
<html>
<?php include("templates/header.php");
include("templates/bootstrap_head.php");
echo_head("Part 3 Punisher Selection");

session_start();
include_once("includes/Authenticator.php");
authenticator::authenticate_access("round_3_punisher_selection.php", "round_3_instructions.php");

echo("
<body>
<div class='container-fluid'>
")
?>
<h4>You have been selected to be the Third Party Punisher.</h4>
<ul class="list-group">
        <li class="list-group-item">You have 20 ECU every roud to be spent on either punishing or rewarding the players.</li>
        <li class="list-group-item">The remaining players play the game in the group of three.</li>
        <li class="list-group-item">Decisions of the other players in the game do not influence your payoff.
        </li>
    </ul>
<br>

<form action='' method='post'>
    <button name='submit' class="btn btn-default">Continue</button>
</form>
</div>
</body>
<?php
if (isset($_POST['submit'])) {
    echo("<script>window.open('round_3a.php', '_self')</script>");
}
include("templates/footer.php") ?>
</html>
