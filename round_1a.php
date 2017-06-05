<!DOCTYPE html>
<html>
<?php include("templates/header.php");
include("includes/connection.php");
session_start();
include("templates/bootstrap_head.php");
echo_head("Part 1: Round 1");

include_once("includes/Authenticator.php");
authenticator::authenticate_access("round_1a.php", "round_1_instructions.php");
?>

<body>
<div class="container-fluid">
    <h1>Welcome to round 1</h1>
    <p class="bg-info">You start with 20 ECU's</p>
    <form action='' method='post'>
        <p>How much would you like to give to the public good?</p>
        <select id='r1a_contribution' name='r1a_contribution' onchange='update_ECU_Count()' class="form-control">
            <?php
            for ($i = 0; $i <= 20; $i++) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select>
        <p id='ECUs_kept' class="bg-info">ECUs remaining after your contribution:20</p>
        <button name='submit' class="btn btn-default">Submit</button>
    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $round_1a_player_contribution = (int)htmlspecialchars($_POST["r1a_contribution"]);
    $round_1a_AI_1_contribution = rand(14, 15);
    $round_1a_AI_2_contribution = rand(8, 12);
    $round_1a_AI_3_contribution = rand(0, 3);

    $total_contribution = $round_1a_player_contribution + $round_1a_AI_1_contribution + $round_1a_AI_2_contribution + $round_1a_AI_3_contribution;

    $round_1a_player_ECU_at_end = (20 - $round_1a_player_contribution) + (0.5 * $total_contribution);
    $round_1a_AI_1_ECU_at_end = (20 - $round_1a_AI_1_contribution) + (0.5 * $total_contribution);
    $round_1a_AI_2_ECU_at_end = (20 - $round_1a_AI_2_contribution) + (0.5 * $total_contribution);
    $round_1a_AI_3_ECU_at_end = (20 - $round_1a_AI_3_contribution) + (0.5 * $total_contribution);

    $userID = $_SESSION["user_id"];
    $sql1 = "UPDATE users SET round_1a_player_contribution = $round_1a_player_contribution, round_1a_player_ECU_at_end = $round_1a_player_ECU_at_end WHERE user_id =$userID";
    $sql2 = "UPDATE users SET round_1a_AI_1_contribution = $round_1a_AI_1_contribution, round_1a_AI_1_ECU_at_end = $round_1a_AI_1_ECU_at_end WHERE user_id =$userID";
    $sql3 = "UPDATE users SET round_1a_AI_2_contribution = $round_1a_AI_2_contribution, round_1a_AI_2_ECU_at_end = $round_1a_AI_2_ECU_at_end WHERE user_id =$userID";
    $sql4 = "UPDATE users SET round_1a_AI_3_contribution = $round_1a_AI_3_contribution, round_1a_AI_3_ECU_at_end = $round_1a_AI_3_ECU_at_end WHERE user_id =$userID";

    if (!(mysqli_query($con, $sql1) && mysqli_query($con, $sql2) && mysqli_query($con, $sql3) && mysqli_query($con, $sql4))) {
        echo("<script>alert('Could not connect to server')</script>");
        echo "Error: " . $sql4 . "<br>" . mysqli_error($con);
    }
    else {
        echo("<script>window.open('round_1b.php', '_self')</script>");
    }
}
?>

<script>
    function update_ECU_Count() {
        var contribution = document.getElementById("r1a_contribution");
        var x = contribution.options[contribution.selectedIndex].value;
        document.getElementById("ECUs_kept").innerHTML = "ECUs remaining after your contribution:" + (20 - x).toString();
    }
</script>
</body>
<?php include("templates/footer.php") ?>
</html>

