<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<?php include("templates/header.php");
include("includes/connection.php");
session_start();

$player_count = 4;
echo("<script>var player_count = $player_count;</script>");
$round_name = "3c";
include("templates/bootstrap_head.php");
echo_head("Final Results");

include_once("includes/Authenticator.php");
authenticator::authenticate_access("final_results.php", "round_3_final_results.php");

echo("
<body>
<div class='container-fluid'>
");

include_once("includes/get_final_ECU.php");
$player_final_ECU = get_final_ECU($round_name, 1, $_SESSION["user_id"]);
$AI_1_final_ECU = get_final_ECU($round_name, 2, $_SESSION["user_id"]);
$AI_2_final_ECU = get_final_ECU($round_name, 3, $_SESSION["user_id"]);
$AI_3_final_ECU = get_final_ECU($round_name, 4, $_SESSION["user_id"]);
echo("
    <p>Thank you for taking your time to take part in the experiment, at the end of the experiment you will be asked to give your email with which you can enter the lottery to win the £50 Amazon voucher.<br>
     There are still some questions about yourself that we would ask you to answer.</p>
    ");
?>

<form action="" method="post">
    <button name='submit'>Continue to Questionnaire</button>
</form>
</div>
</body>

<?php
if (isset($_POST['submit'])) {
    include_once("includes/get_next_round_name.php");
    echo("<script>window.open('comprehension_questionnaire.php', '_self')</script>");
}

include("templates/footer.php") ?>
</html>