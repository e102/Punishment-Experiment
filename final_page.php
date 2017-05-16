<!DOCTYPE html>
<html>
<?php
include("templates/header.php");
include("includes/connection.php");
session_start();

include("templates/bootstrap_head.php");
echo_head("Thank You");
?>

<body>
<div class="container-fluid">
    <h4>Thank You</h4>
    <p>The experiment is over. The raffle results will be announced within 6 months. Thank you for taking part and best of luck in the future</p>
    <p>You can now close this window</p>
</div>
</body>
<?php
include("templates/footer.php") ?>
</html>
