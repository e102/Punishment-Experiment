<!DOCTYPE html>
<html>
<?php include("templates/header.php");
include("templates/bootstrap_head.php");
echo_head("Part 3 Punisher Selection");

session_start();
include_once("includes/Authenticator.php");
authenticator::authenticate_access("round_3_punisher_selection.php", "terms_and_conditions#.php");

echo("
<body>
<div class='container-fluid'>
")
?>
<h1>You are the punisher.</h1>
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