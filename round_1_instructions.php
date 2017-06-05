<!DOCTYPE html>
<html>
<?php include("templates/header.php");
include("includes/connection.php");
session_start();
include("templates/bootstrap_head.php");
echo_head("Part 1 Instructions");

include_once("includes/Authenticator.php");
authenticator::authenticate_access("round_1_instructions.php", "round_0_results.php");
?>
<body>
<div class="container-fluid">
    <p>
        You will now play Part 1. The rules are the same as the practice game, but you will be playing with real people.<br>
        Remember:
    </p>
    <ul class="list-group">
        <li class="list-group-item">There are three rounds in this part</li>
        <li class="list-group-item">You start with 20 ECUs in the first round and what you carry over to the next two rounds depends on your decisions</li>
        <li class="list-group-item">You can contribute ECUs to the common good or keep them for yourself</li>
        <li class="list-group-item">Common good doubles all the contributions and sheres them equally amongst all four players.</li>
        <li class="list-group-item">Your ECUs are the sum of the ECUs you decided to keep for yourself and your share of the ECU from the common good.</li>
    </ul>

    <form action='' method='post'>
        <button name='submit' class="btn btn-default">Continue</button>
    </form>
</div>
</body>
<?php
if (isset($_POST['submit'])) {
    echo("<script>window.open('round_1a.php', '_self')</script>");
}
?>
<?php include("templates/footer.php") ?>
</html>
