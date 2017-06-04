<!DOCTYPE html>
<html>
<?php
include("templates/header.php");
include("includes/connection.php");
session_start();

include("templates/bootstrap_head.php");
echo_head("Thank You");

include_once("includes/Authenticator.php");
authenticator::authenticate_access("final_page.php", "raffle.php");
?>

<body>
<div class="container-fluid">
    <h4>Thank You</h4>
    <p>The experiment is over. The raffle results will be announced within 6 months.</p>
    <?php
    include_once "includes/echo_if_pay_is_dependent_on_ECU.php";
    $userID = $_SESSION["user_id"];
    echo_if_pay_dependent_on_ECU($userID, "You're total ECU's in the bank will determine your chance of winning the raffle")
    ?>
    <p>Thank you for taking part and best of luck in the future</p>
    <p>You can now close this window</p>
</div>
</body>
<?php
include("templates/footer.php") ?>
</html>
