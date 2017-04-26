<!DOCTYPE html>
<html>
<?php include("templates/header.php");
include("includes/connection.php");
session_start();
?>
<head>
    <title>Game 2: Round 1 Punishment</title>
    <link rel="stylesheet" href="styles/default.css" media="all"/>
</head>

<body>

<?php
get_previous_round_contributions($_SESSION["user_id"]);
display_round_2a_results($round_2a_player_contribution, $round_2a_AI_1_contribution, $round_2a_AI_2_contribution, $round_2a_AI_3_contribution);

$player_count = 4;
echo("<script>var player_starting_ECU = 20 - $round_2a_player_contribution</script>");

echo("<script>var player_count = $player_count;</script>");

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
            global $round_2a_total_contribution;
            $round_2a_total_contribution = $round_2a_player_contribution + $round_2a_AI_1_contribution + $round_2a_AI_2_contribution + $round_2a_AI_3_contribution;
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
    <br>
    
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
    <form id="punish_reward_form" action='' method='post'
          onsubmit="return check_ECU_use(player_count, player_starting_ECU)">
        <p>Would you like to want to punish or reward another player?</p>
        <script>
            form = document.getElementById("punish_reward_form");
            for (var i = 2; i <= player_count; i++) {
                var player_name_text = document.createElement("p");
                player_name_text.innerHTML = "Player " + i;
                player_name_text.className = "noEmptyLine";
                form.appendChild(player_name_text);

                var punish_or_reward_dropdown = document.createElement("select")
                punish_or_reward_dropdown.id = "punish_or_reward_dropdown_player_" + i;
                punish_or_reward_dropdown.name = "punish_or_reward_dropdown_player_" + i;
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

                var amount_dropdown = document.createElement("select")
                amount_dropdown.id = "amount_dropdown_player_" + i;
                amount_dropdown.name = "amount_dropdown_player_" + i;
                form.appendChild(amount_dropdown);

                for (var a = 0; a <= (player_starting_ECU * 2); a += 2) {
                    var option = document.createElement("option");
                    if (a == 0) {
                        option.selected = 'selected';
                    }
                    option.text = a;
                    option.value = a;
                    amount_dropdown.add(option);
                }

                show_punish_options(i);
                var x = (function (a) {
                    punish_or_reward_dropdown.onchange = function () {
                        show_punish_options(a);
                        update_ECU_Count(player_count, player_starting_ECU);
                    };
                })(i);

                var x = (function (a) {
                    amount_dropdown.onchange = function () {
                        update_ECU_Count(player_count, player_starting_ECU);
                    };
                })(i);

                var br = document.createElement("br");
                form.appendChild(br);
            }

            function show_punish_options(current_player) {
                var punish_or_reward_dropdown = document.getElementById("punish_or_reward_dropdown_player_" + current_player);
                var amount_dropdown = document.getElementById("amount_dropdown_player_" + current_player);

                var selection = punish_or_reward_dropdown.options[punish_or_reward_dropdown.selectedIndex].value;
                if (selection == "punish" || selection == "reward") {
                    amount_dropdown.style.display = "inline";
                }
                else {
                    amount_dropdown.style.display = "none";
                    amount_dropdown.selectedIndex = 0;
                }
            }
        </script>
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
        document.getElementById("ECUs_kept").innerHTML = "ECUs remaining after your punishments/rewards:" + player_starting_ECU;
    }

    function update_ECU_Count(player_count, player_starting_ECU) {
        var ECU_used = 0.00;

        for (var i = 2; i <= player_count; i++) {
            var amount_dropdown = document.getElementById("amount_dropdown_player_" + i);
            ECU_used += parseInt(amount_dropdown.options[amount_dropdown.selectedIndex].value / 2);
        }

        document.getElementById("ECUs_kept").innerHTML = "ECUs remaining after your punishments/rewards:" + (player_starting_ECU - ECU_used).toString();
    }

    function check_ECU_use(player_count, player_starting_ECU) {
        var ECU_used = 0;
        for (var i = 2; i <= player_count; i++) {
            var amount_dropdown = document.getElementById("amount_dropdown_player_" + i);
            ECU_used += parseInt(amount_dropdown.options[amount_dropdown.selectedIndex].value) / 2;
        }

        if (ECU_used > player_starting_ECU) {
            alert("You're choices cost " + ECU_used + " ECUs but you only have " + player_starting_ECU + " ECUs. Reduce your punishments/rewards to continue.");
            return false;
        }
        else {
            return true;
        }
    }
</script>
</body>

<?php
include("includes/upload_player_rewards.php");
include("includes/upload_AI_rewards.php");
include("includes/update_total_ECU.php");
if (isset($_POST['submit'])) {
    $userID = $_SESSION["user_id"];
    upload_player_rewards($player_count, $userID, "2a");
    upload_AI_rewards($player_count, $userID, "2a");
    global $round_2a_total_contribution;
    update_total_ECU($player_count, $userID, "2a", $round_2a_total_contribution);
    echo("<script>window.open('round_2a_results.php', '_self')</script>");
}
?>

<?php include("templates/footer.php") ?>
</html>