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
    <p>You are now entering the practice round. Please use it as an opportunity to get familiar with the interface of the game. Any ECUs earned will not carry over to the real game.</p>

    <p>Remember</p>
    <ul class="list-group">
        <li class="list-group-item">You start with 20 ECUs</li>
        <li class="list-group-item">You can donate any number of these ECUs to the common pool</li>
        <li class="list-group-item">The common good doubles all contributions and then shares them equally amongst all four players</li>
        <li class="list-group-item">Your final income is the sum of any ECUs you keep + your share of the money produced by the common good
        </li>
    </ul>
    <br>
    <p>In total: payout = (20 - your contribution to the project) + 0.5*(total contributions to the project)</p>
    <br>

    <p class="bg-info">You have 20 ECUs</p>

    <form action="" method="post">
        <div class="form-group">
        <label for="r0_contribution">How much would you like to give to the public good?</label>
        <select id="r0_contribution" name="r0_contribution" onchange="update_ECU_Count()" class="form-control">
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
        </div>

        <p id="tokens_kept" class="bg-info">ECUs remaining after contribution: 20</p>

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
            document.getElementById("tokens_kept").innerHTML = "ECUs remaining after contribution: " + (20 - x).toString();
        }
    </script>
</div>
</body>
<?php include("templates/footer.php") ?>
</html>
