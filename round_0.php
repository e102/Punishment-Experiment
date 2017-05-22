<!DOCTYPE html>
<html>
<?php include("templates/header.php");
include("includes/connection.php");
session_start();
include("templates/bootstrap_head.php");
echo_head("Practice Round");

include_once("includes/Authenticator.php");
authenticator::authenticate_access("round_0.php", "round_0_comprehension_quiz.php");
?>

<body>
<div class="container-fluid">
    <h1>Welcome to the practice round</h1>
    <p>You are now entering the practice round. Any ECU's earned will not carry over to the real game.</p>

    <p>Remember</p>
    <ul>
        <li>You start with 20 ECUs</li>
        <li>You can donate any number of these ECUs to the common pool</li>
        <li>Your final income is the sum of any ECUs you keep + 0.5 x the
            total contribution of all 4 group members to the common pool.
        </li>
    </ul>
    <br>
    <p>In total: payout = (20 - your contribution to the project) + 0.5*(total contributions to the project)</p>
    <br>

    <p>Your starting ECU's: 20</p>
    <p id="tokens_kept">ECU's kept: 20</p>

    <form action="" method="post">
        <p>Contribution to common pool:</p>
        <select id="r0_contribution" name="r0_contribution" onchange="update_ECU_Count()">
            <script>
                var contribution_dropdown = document.getElementById("r0_contribution");
                for (var i = 0; i <= 20; i++) {
                    var option = document.createElement("option");
                    if (i == 0) {
                        option.selected = 'selected';
                    }
                    option.text = i;
                    option.value = i;
                    contribution_dropdown.add(option);
                }
            </script>
        </select>
        <br><br>
        <button name="submit" class="btn btn-default">Submit</button>
    </form>
    <?php
    if (isset($_POST['submit'])) {
        $userID = $_SESSION["user_id"];
        $test_round_player_contribution = htmlspecialchars($_POST["r0_contribution"]);
        $_SESSION["test_round_player_contribution"] = $test_round_player_contribution;
        $sql = "UPDATE users SET test_round_player_contribution = $test_round_player_contribution WHERE user_id =$userID";
        if (mysqli_query($con, $sql)) {
            echo("<script>window.open('round_0_results.php', '_self')</script>");
        }
        else {
            echo("<script>alert('Could not connect to server')</script>");
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }
    ?>

    <script>
        function update_ECU_Count() {
            var contribution = document.getElementById("r0_contribution");
            var x = contribution.options[contribution.selectedIndex].value;
            document.getElementById("tokens_kept").innerHTML = "ECUs kept: " + (20 - x).toString();
        }
    </script>
</div>
</body>
<?php include("templates/footer.php") ?>
</html>
