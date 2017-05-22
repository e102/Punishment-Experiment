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
    <ul>
        <li>There are three rounds in this part</li>
        <li>You start with 20 ECUs</li>
        <li>You can contribute ECUs to the common pool</li>
        <li>Your ECU's are the sum of your leftover ECUs and the total donated to the common pool times 0.5</li>
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