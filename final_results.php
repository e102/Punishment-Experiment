<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<?php include("templates/header.php");
include("includes/connection.php");
session_start();

include("templates/bootstrap_head.php");
echo_head("Final Results");

include_once("includes/Authenticator.php");
authenticator::authenticate_access("final_results.php", "round_3_final_results.php");

echo("
<body>
<div class='container-fluid'>
");

include_once("includes/get_final_ECU.php");
$part_1_ECU_earned = get_final_ECU("1c", 1, $_SESSION['user_id']);
$part_2_ECU_earned = get_final_ECU("2c", 1, $_SESSION['user_id']);
$part_3_ECU_earned = get_final_ECU("3c", 1, $_SESSION['user_id']);
$total_ECU_earned = $part_1_ECU_earned + $part_2_ECU_earned + $part_3_ECU_earned;
echo "<h2>You have finished the experiment with <u>$total_ECU_earned</u> ECU's</h2>";
include_once "includes/echo_if_pay_is_dependent_on_ECU.php";
echo_if_pay_dependent_on_ECU($_SESSION['user_id'], "This means you will be entered into the lottery " . $total_ECU_earned . "times");
echo "<p>Thank you for taking your time to take part in the experiment, at the end of the experiment you will be asked to give your email with which you can enter the lottery to win the £50 Amazon voucher.<br>
     There are still some questions about yourself that we would ask you to answer.</p>";
?>

<form action="" method="post">
    <button name='submit'>Continue to Questionnaire</button>
</form>
</div>
</body>

<script>
    load_page(0, 0);
</script>
<?php
if (isset($_POST['submit'])) {
    include_once("includes/get_next_round_name.php");
    echo("<script>window.open('self_reported_criminality_questionnaire.php', '_self')</script>");
}

include("templates/footer.php") ?>
</html>