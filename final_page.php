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
    <p>The experiment is now over. The lottery results will be announced by August and will be contacted to you via e-mail.</p>
    <?php
    include_once "includes/echo_if_pay_is_dependent_on_ECU.php";
    $userID = $_SESSION["user_id"];
    echo_if_pay_dependent_on_ECU($userID, "Your total amount of ECUs in the bank over three rounds will determine your chances of winning the raffle")
    ?>
    <p>Thank you for taking part in this experiment. Please do not hesitate to contact the researcher with any questions or concerns.</p>
    <p>You can now close this window</p>
</div>
</body>
<?php
include("templates/footer.php") ?>
</html>
