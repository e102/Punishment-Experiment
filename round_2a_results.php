<!DOCTYPE html>
<html>
<?php include("templates/header.php");
include("includes/connection.php");
session_start();
?>
<head>
    <title>Game 2: Round 1 Results</title>
    <link rel="stylesheet" href="styles/default.css" media="all"/>
</head>

<body>

<?php
get_previous_round_contributions($_SESSION["user_id"]);
display_round_2a_results($round_2a_player_contribution, $round_2a_AI_1_contribution, $round_2a_AI_2_contribution, $round_2a_AI_3_contribution);

echo("<script>var player_starting_ECU = 20 - $round_2a_player_contribution</script>");

function get_previous_round_contributions($user_ID) {
    global $con;
    $sql_query = "select * from users where user_ID = '$user_ID'";
    $run_query = mysqli_query($con, $sql_query);
    $check_query = mysqli_num_rows($run_query);

    if ($check_query == 1) {
        while ($row = mysqli_fetch_array($run_query)) {
            global $round_2a_player_contribution;
            $round_2a_player_contribution = $row["round_2a_player_contribution"];
            global $round_2a_AI_1_contribution;
            $round_2a_AI_1_contribution = $row["round_2a_AI_1_contribution"];
            global $round_2a_AI_2_contribution;
            $round_2a_AI_2_contribution = $row["round_2a_AI_2_contribution"];
            global $round_2a_AI_3_contribution;
            $round_2a_AI_3_contribution = $row["round_2a_AI_3_contribution"];
        }
    }
    else {
        throw new Exception("Could not fetch data");
    }
}

function display_round_2a_results($round_2a_player_contribution, $round_2a_AI_1_contribution, $round_2a_AI_2_contribution, $round_2a_AI_3_contribution) {
    echo("
    <body>
    <h1>Round 1 results:</h1>
    
    <h3>Initial State:</h3>
    <ul>
        <li>You entered the round with 20 ECUs</li>
        <li>Player 2 entered the round with 20 ECUs</li>
        <li>Player 3 entered the round with 20 ECUs</li>
        <li>Player 4 entered the round with 20 ECUs</li>
    </ul>
    
    <h3>Donations:</h3>
    <ul>
        <li>You donated $round_2a_player_contribution ECUs to the common pool</li>
        <li>Player 2 donated $round_2a_AI_1_contribution ECUs to the common pool</li>
        <li>Player 3 donated $round_2a_AI_2_contribution ECUs to the common pool</li>
        <li>Player 4 donated $round_2a_AI_3_contribution ECUs to the common pool</li>
    </ul>
    <br>
    ");
}

?>

<h1>Punish/Reward</h1>
<div id="display_before_load">
    <p id="intro_text">Please wait for other players to connect. This should not take more than 60 seconds.</p>
</div>

<div id="display_after_load" style="display:none">
    <p class="noEmptyLine">All players have connected. Please enter your rewards/punishments below</p>
    <br>
    <p id="starting_ECUs"></p>
    <p id='ECUs_kept'>ECUs remaining after your contribution</p>
    <br>
    <form id="punish_reward_form" action='' method='post' onsubmit="return check_ECU_use()">
        <p>Do you want to Punish or Reward someone?</p>
        <script>
            var player_count = 4;
            form = document.getElementById("punish_reward_form");
            for (var i = 2; i <= player_count; i++) {
                var player_name_text = document.createElement("p");
                player_name_text.innerHTML = "Player " + i;
                player_name_text.className = "noEmptyLine";
                form.appendChild(player_name_text);

                var punish_or_reward_dropdown = document.createElement("select")
                punish_or_reward_dropdown.id = "punish_or_reward_dropdown_player_" + i;
                form.appendChild(punish_or_reward_dropdown);

                var option_no = document.createElement("option");
                option_no.value = "no";
                option_no.innerHTML = "Do nothing";
                punish_or_reward_dropdown.appendChild(option_no);

                var option_reward = document.createElement("option");
                option_reward.value = "reward";
                option_reward.innerHTML = "Reward";
                punish_or_reward_dropdown.appendChild(option_reward);

                var option_punish = document.createElement("option");
                option_punish.value = "punish";
                option_punish.innerHTML = "Punish";
                punish_or_reward_dropdown.appendChild(option_punish);


                var punish_options_div = document.createElement("div");
                punish_options_div.id = "punish_options_player_" + i;
                form.appendChild(punish_options_div);

                var amount_dropdown = document.createElement("select")
                amount_dropdown.id = "amount_dropdown_player_" + i;
                form.appendChild(amount_dropdown);

                //for (var i = 0; i <= player_starting_ECU; i++) {
                //    var option = document.createElement("option");
                //    if (i == 0) {
                //        option.selected = 'selected';
                //    }
                //    option.text = i;
                //    option.value = i;
                //    amount_dropdown.add(option);
                //}

                var br = document.createElement("br");
                form.appendChild(br);
            }
        </script>
        <div id="punish_options" style="display:none">
            <br><br>
            <p>How much? Remember, a 1 ECU punishment/reward costs you 2 ECU</p>
            <select id="punishment_amount_dropdown">
                <script>
                    var punishment_dropdown = document.getElementById("punishment_amount_dropdown");
                    for (var i = 0; i <= player_starting_ECU; i++) {
                        var option = document.createElement("option");
                        if (i == 0) {
                            option.selected = 'selected';
                        }
                        option.text = i;
                        option.value = i;
                        punishment_dropdown.add(option);
                    }
                </script>
            </select>
        </div>
        <br><br>
        <button name='submit'>Submit</button>
    </form>
</div>

<script>
    var random_time = Math.floor((Math.random() * 60) + 5)
    setTimeout(load_page, random_time * 10);
    //setTimeout(load_page, random_time * 1000);

    function load_page() {
        document.getElementById("display_before_load").style.display = "none";
        document.getElementById("display_after_load").style.display = "inline";
        document.getElementById("starting_ECUs").innerHTML = "ECUs this round:" + player_starting_ECU;
        document.getElementById("ECUs_kept").innerHTML = "ECUs remaining after your contribution:" + player_starting_ECU;
    }

    //TODO: include all 3 rewards/punishments
    function update_ECU_Count() {
        var contribution = document.getElementById("r2a_contribution");
        var x = contribution.options[contribution.selectedIndex].value;
        document.getElementById("ECUs_kept").innerHTML = "ECUs remaining after your contribution:" + (player_starting_ECU - x).toString();
    }

    function show_punish_options() {
        var e = document.getElementById("punish_or_reward_dropdown");
        var selection = e.options[e.selectedIndex].value;
        if (selection == "punish" || selection == "reward") {
            document.getElementById("punish_options").style.display = "inline";
        }
        else {
            document.getElementById("punish_options").style.display = "none";
            var punishment_dropdown = document.getElementById("punishment_amount_dropdown");
            punishment_dropdown.selectedIndex = 0;
        }
    }

    function check_ECU_use() {
        var contribution_dropdown = document.getElementById("r2a_contribution");
        var contribution = parseInt(contribution_dropdown.options[contribution_dropdown.selectedIndex].value);

        var punishment_dropdown = document.getElementById("punishment_amount_dropdown");
        var punishment = parseInt(punishment_dropdown.options[punishment_dropdown.selectedIndex].value);
        console.log(contribution + punishment);
        if ((contribution + punishment) >= player_starting_ECU) {
            alert("You've used more ECU than you have. Reduce your punishment/reward or contribute less ECU.");
            return false;
        }
        else {
            return true;
        }
    }
</script>
</body>

<?php
if (isset($_POST['submit'])) {
    global $round_1b_player_ECU_at_end;
    $round_1c_player_ECU_at_end = ($round_1b_player_ECU_at_end - $round_1c_player_contribution) + (0.4 * $total_contribution);
    global $round_1b_AI_1_ECU_at_end;
    $round_1c_AI_1_ECU_at_end = ($round_1b_AI_1_ECU_at_end - $round_1c_AI_1_contribution) + (0.4 * $total_contribution);
    global $round_1b_AI_2_ECU_at_end;
    $round_1c_AI_2_ECU_at_end = ($round_1b_AI_2_ECU_at_end - $round_1c_AI_2_contribution) + (0.4 * $total_contribution);
    global $round_1b_AI_3_ECU_at_end;
    $round_1c_AI_3_ECU_at_end = ($round_1b_AI_3_ECU_at_end - $round_1c_AI_3_contribution) + (0.4 * $total_contribution);

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

<?php include("templates/footer.php") ?>
</html>