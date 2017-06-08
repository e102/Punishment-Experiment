<!DOCTYPE html>
<html>
<?php include("templates/header.php");
include("includes/connection.php");
session_start();
include("templates/bootstrap_head.php");
echo_head("Part 1: Round 3");

include_once("includes/Authenticator.php");
authenticator::authenticate_access("round_1c.php", "round_1b.php");
?>
<body>
<div class="container-fluid">
    <?php
    $userID = $_SESSION["user_id"];
    display_round_1b_results($userID);

    function display_round_1b_results($user_ID) {
        global $con;
        $sql_query = "select * from users where user_ID = '$user_ID'";
        $run_query = mysqli_query($con, $sql_query);
        $check_query = mysqli_num_rows($run_query);

        if ($check_query == 1) {
            while ($row = mysqli_fetch_array($run_query)) {
                global $round_1b_player_contribution;
                $round_1b_player_contribution = $row["round_1b_player_contribution"];
                $round_1b_AI_1_contribution = $row["round_1b_AI_1_contribution"];
                $round_1b_AI_2_contribution = $row["round_1b_AI_2_contribution"];
                $round_1b_AI_3_contribution = $row["round_1b_AI_3_contribution"];

                global $round_1b_player_ECU_at_end;
                $round_1b_player_ECU_at_end = $row["round_1b_player_ECU_at_end"];
                global $round_1b_AI_1_ECU_at_end;
                $round_1b_AI_1_ECU_at_end = $row["round_1b_AI_1_ECU_at_end"];
                global $round_1b_AI_2_ECU_at_end;
                $round_1b_AI_2_ECU_at_end = $row["round_1b_AI_2_ECU_at_end"];
                global $round_1b_AI_3_ECU_at_end;
                $round_1b_AI_3_ECU_at_end = $row["round_1b_AI_3_ECU_at_end"];

                $round_1a_player_ECU_at_end = $row["round_1a_player_ECU_at_end"];
                $round_1a_AI_1_ECU_at_end = $row["round_1a_AI_1_ECU_at_end"];
                $round_1a_AI_2_ECU_at_end = $row["round_1a_AI_2_ECU_at_end"];
                $round_1a_AI_3_ECU_at_end = $row["round_1a_AI_3_ECU_at_end"];
            }
        }
        elseif ($check_query == 0) {
            throw new Exception("No user found with this id");
        }
        elseif ($check_query > 1) {
            throw new Exception("Multiple users found with this id");
        }
        else {
            throw new Exception("Unexpected error");
        }

        echo("
    <body>
        <div class='display_before_load'>
        <p id='intro_text'>Please wait for other players to make their contributions</p>
    </div>
    
    <div class='display_after_load' style='display:none'>
    <h1>Round 2 results:</h1>
    
    <h3>Initial State:</h3>
    <ul>
        <li>You entered the round with $round_1a_player_ECU_at_end ECUs</li>
        <li><span style='color: green'>Green</span> entered the round with $round_1a_AI_1_ECU_at_end ECUs</li>
        <li><span style='color: blue'>Blue</span> entered the round with $round_1a_AI_2_ECU_at_end ECUs</li>
        <li><span style='color: red'>Red</span>  entered the round with $round_1a_AI_3_ECU_at_end ECUs</li>
    </ul>
    
    <h3>Donations:</h3>
    <ul>
        <li>You donated $round_1b_player_contribution ECUs to the common pool</li>
        <li><span style='color: green'>Green</span> donated $round_1b_AI_1_contribution ECUs to the common pool</li>
        <li><span style='color: blue'>Blue</span> donated $round_1b_AI_2_contribution ECUs to the common pool</li>
        <li><span style='color: red'>Red</span>  donated $round_1b_AI_3_contribution ECUs to the common pool</li>
    </ul>
    
    <br>
    <h3>Final ECU totals:</h3>
    <ul>
        <li>You have $round_1b_player_ECU_at_end ECU's</li>
        <li><span style='color: green'>Green</span> has $round_1b_AI_1_ECU_at_end ECU's</li>
        <li><span style='color: blue'>Blue</span> has $round_1b_AI_2_ECU_at_end ECU's</li>
        <li><span style='color: red'>Red</span>  has $round_1b_AI_3_ECU_at_end ECU's</li>
    </ul>
    <br>
    ");
        echo("<script>var player_starting_ECU = $round_1b_player_ECU_at_end</script>");
    }

    ?>
        <h1>Welcome to round 3</h1>
        <br>
        <p>All players have connected. Please enter your contribution below</p>
        <br>
        <p id="starting_ECUs" class="bg-info"></p>
        <form action='' method='post'>
            <p>How much would you like to give to the public good?</p>
            <select id='r1c_contribution' name='r1c_contribution' onchange='update_ECU_Count()' class="form-control">
                <script>
                    var contribution_dropdown = document.getElementById("r1c_contribution");
                    for (var i = 0; i <= player_starting_ECU; i++) {
                        var option = document.createElement("option");
                        if (i == 0) {
                            option.selected = "selected";
                        }
                        option.text = i;
                        option.value = i;
                        contribution_dropdown.add(option);
                    }
                </script>
            </select>
            <p id='ECUs_kept' class="bg-info">ECUs remaining after your contribution</p>
            <br>
            <button name='submit' class="btn btn-default">Submit</button>
        </form>
    </div>
</div>
</body>
<?php
if (isset($_POST['submit'])) {
    $round_1c_player_contribution = (int)htmlspecialchars($_POST["r1c_contribution"]);
    global $round_1b_player_contribution;
    global $round_1b_AI_1_ECU_at_end;
    include_once "includes/calculate_AI_contribution.php";
    $round_1c_AI_1_contribution = calculate_AI_contribution($round_1b_player_contribution, $round_1b_AI_1_ECU_at_end, 2);
    global $round_1b_AI_2_ECU_at_end;
    $round_1c_AI_2_contribution = calculate_AI_contribution($round_1b_player_contribution, $round_1b_AI_2_ECU_at_end, 3);
    global $round_1b_AI_2_ECU_at_end;
    $round_1c_AI_3_contribution = rand(0, 3);

    $total_contribution = $round_1c_player_contribution + $round_1c_AI_1_contribution + $round_1c_AI_2_contribution + $round_1c_AI_3_contribution;

    global $round_1b_player_ECU_at_end;
    $round_1c_player_ECU_at_end = ($round_1b_player_ECU_at_end - $round_1c_player_contribution) + (0.5 * $total_contribution);
    global $round_1b_AI_1_ECU_at_end;
    $round_1c_AI_1_ECU_at_end = ($round_1b_AI_1_ECU_at_end - $round_1c_AI_1_contribution) + (0.5 * $total_contribution);
    global $round_1b_AI_2_ECU_at_end;
    $round_1c_AI_2_ECU_at_end = ($round_1b_AI_2_ECU_at_end - $round_1c_AI_2_contribution) + (0.5 * $total_contribution);
    global $round_1b_AI_3_ECU_at_end;
    $round_1c_AI_3_ECU_at_end = ($round_1b_AI_3_ECU_at_end - $round_1c_AI_3_contribution) + (0.5 * $total_contribution);

    $userID = $_SESSION["user_id"];
    $sql1 = "UPDATE users SET round_1c_player_contribution = $round_1c_player_contribution, round_1c_player_ECU_at_end = $round_1c_player_ECU_at_end WHERE user_id =$userID";
    $sql2 = "UPDATE users SET round_1c_AI_1_contribution = $round_1c_AI_1_contribution, round_1c_AI_1_ECU_at_end = $round_1c_AI_1_ECU_at_end WHERE user_id =$userID";
    $sql3 = "UPDATE users SET round_1c_AI_2_contribution = $round_1c_AI_2_contribution, round_1c_AI_2_ECU_at_end = $round_1c_AI_2_ECU_at_end WHERE user_id =$userID";
    $sql4 = "UPDATE users SET round_1c_AI_3_contribution = $round_1c_AI_3_contribution, round_1c_AI_3_ECU_at_end = $round_1c_AI_3_ECU_at_end WHERE user_id =$userID";

    if (!(mysqli_query($con, $sql1) && mysqli_query($con, $sql2) && mysqli_query($con, $sql3) && mysqli_query($con, $sql4))) {
        echo("<script>alert('Could not connect to server')</script>");
        echo "Error: " . $sql4 . "<br>" . mysqli_error($con);
    }
    else {
        echo("<script>window.open('round_1_results.php', '_self')</script>");
    }
}
?>

<script>
    load_page(1, 25);

    function update_ECU_Count() {
        var contribution = document.getElementById("r1c_contribution");
        var x = contribution.options[contribution.selectedIndex].value;
        document.getElementById("ECUs_kept").innerHTML = "ECUs remaining after your contribution:" + (player_starting_ECU - x).toString();
    }
</script>
<?php include("templates/footer.php") ?>
</html>