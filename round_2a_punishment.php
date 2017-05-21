<!DOCTYPE html>
<html>
<?php include("templates/header.php");
include("includes/connection.php");
session_start();

$player_count = 4;
echo("<script>var player_count = $player_count;</script>");
$round_name = "2a";
$game_number = substr($round_name, 0, 1);
$round_number = ord(substr($round_name, -1)) - 96;
include("templates/bootstrap_head.php");
echo_head("Game " . $game_number . ": Round " . $round_number);

include_once("includes/Authenticator.php");
authenticator::authenticate_access("round_" . $round_name . "_punishment.php", "round_" . $round_name . ".php");

echo("
<body>
<div class='container-fluid'>
");

include_once("includes/get_starting_ECU.php");
include_once("includes/display_initial_ECU.php");
$player_initial_ECU = get_starting_ECU($round_name, 1, $_SESSION["user_id"]);
$AI_1_initial_ECU = get_starting_ECU($round_name, 2, $_SESSION["user_id"]);
$AI_2_initial_ECU = get_starting_ECU($round_name, 3, $_SESSION["user_id"]);
$AI_3_initial_ECU = get_starting_ECU($round_name, 4, $_SESSION["user_id"]);
display_initial_ECU($round_name, $player_initial_ECU, $AI_1_initial_ECU, $AI_2_initial_ECU, $AI_3_initial_ECU);

include_once("includes/get_contribution.php");
include_once("includes/display_contributions.php");
$player_1_contribution = get_contribution($round_name, 1, $_SESSION["user_id"]);
$AI_1_contribution = get_contribution($round_name, 2, $_SESSION["user_id"]);
$AI_2_contribution = get_contribution($round_name, 3, $_SESSION["user_id"]);
$AI_3_contribution = get_contribution($round_name, 4, $_SESSION["user_id"]);
display_contributions($player_1_contribution, $AI_1_contribution, $AI_2_contribution, $AI_3_contribution);

$player_starting_ECU = intval((get_starting_ECU($round_name, 1, $_SESSION["user_id"]) - $player_1_contribution) + 0.5 * ($player_1_contribution + $AI_1_contribution + $AI_2_contribution + $AI_3_contribution));

echo("<script>var player_starting_ECU = $player_starting_ECU</script>");
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

                var punish_or_reward_dropdown = document.createElement("select");
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

                var amount_dropdown = document.createElement("select");
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
        <button name='submit' class="btn btn-default">Submit</button>
    </form>
</div>
</div>
</body>

<script>
    var random_time = Math.floor((Math.random() * 60) + 5);
    setTimeout(load_page, random_time * 1000);

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

<?php
include("includes/upload_player_rewards.php");
include("includes/upload_AI_rewards.php");
include("includes/update_total_ECU.php");
if (isset($_POST['submit'])) {
    $userID = $_SESSION["user_id"];
    upload_player_rewards($player_count, $userID, $round_name);
    upload_AI_rewards($player_count, $userID, $round_name);
    update_total_ECU($player_count, $userID, $round_name);

    $next_round_address = "round_" . $round_name . "_results.php";
    echo("<script>window.open('$next_round_address', '_self')</script>");
}
?>

<?php include("templates/footer.php") ?>
</html>