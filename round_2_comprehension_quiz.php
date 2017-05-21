<!DOCTYPE html>
<html>
<?php
include("templates/header.php");
include("includes/connection.php");
session_start();
include("templates/bootstrap_head.php");
echo_head("Game 2 Comprehension Quiz");

include_once("includes/Authenticator.php");
authenticator::authenticate_access("round_2_comprehension_quiz.php", "round_1_results.php");
?>

<body>
<div class="container-fluid">
    <h1>Game 2 Instructions</h1>
    <p>You will now play game 2. The rules are the same as game 1 with one addition. You can now punish or reward other
        participants. Punishing a player removes their ECU's. Rewarding them gives them ECU's. It costs you 0.5 ECU's to
        punish/reward a player 1 ECU</p>

    <h3>IMPORTANT: Player names have been changed. You are still playing with the same people, but their names have been
        reassigned.</h3>
    <ul>
        <li>There are three rounds in the game</li>
        <li>You start with 20 ECUs</li>
        <li>You can contribute ECUs to the common pool</li>
        <li>You can punish or reward other participants.</li>
        <li>Your ECU's are the sum of your leftover ECUs, the total donated to the common pool times 0.4 and any
            reward/punishment you receive.
        </li>
    </ul>
    <br>


    <h1>Game 2 Comprehension Quiz</h1>
    <p>Welcome to part two of the game! You will play with the same people you have played with before, however, they
        have different colours now. Your incomes have been cleared and every participant starts with 20 ECU regardless
        of their results in the previous game. The general rules of the game remain the same with one addition. In this
        game all participants gain a possibility to punish or reward any member of the group after every round.</p>
    <p>
        You punish by taking somebody’s ECU away and reward by giving somebody ECU. There is no limit, but there is a
        price for you. For every two ECU that you decide to reward or punish the other participants for, you lose one.
        So for every amount you wish you either reward or punish the other players you have to pay half of that sum. You
        cannot, however, go below zero.</p>

    <form action="" method="post">
        <p> In round one of the second part of the experiment you have contributed 20 ECUs to the Social Good. Can you
            still reward or punish the other participants? (answer: no).</p>
        <input type="radio" name="question_1" value="yes" required="required"><label for="yes">yes</label><br>
        <input type="radio" name="question_1" value="no"><label for="no">no</label><br>


        <p>In round one of the second part of the experiment you have contributed 4 ECUs to the Public Good. You have
            also decided to reward player Blue with 4 ECU and punish player Green by 2 ECU. How many ECUs will you be
            spending in this round?</p>
        <input type="text" name="question_2" required="required"><br>

        <button name="submit" class="btn btn-default">Submit</button>
    </form>
</div>
</body>
<?php
if (isset($_POST['submit'])) {
    if (validate_answers() == true) {
        $userID = $_SESSION["user_id"];
        $sql = "UPDATE users SET passed_comprehension_quiz_round_2 = 1 WHERE user_id =$userID";
        if (mysqli_query($con, $sql)) {
            echo("<script>alert('You have passed the quiz')</script>");
            echo("<script>window.open('round_2a.php', '_self')</script>");
        }
        else {
            echo("<script>alert('Could not connect to server')</script>");
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }
    else {
        echo("<script>alert('Answers incorrect. Please try again')</script>");
    }
}

function validate_answers() {
    $question_1_answer = htmlspecialchars($_POST['question_1']);
    $question_2_answer = htmlspecialchars($_POST['question_2']);

    return (($question_1_answer == "no") && ($question_2_answer == 7));
}

include("templates/footer.php") ?>
</html>
