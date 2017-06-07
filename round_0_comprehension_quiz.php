<!DOCTYPE html>
<html>
<?php
include("templates/header.php");
include("includes/connection.php");
session_start();
include("templates/bootstrap_head.php");
echo_head("Comprehension Quiz");

include_once("includes/Authenticator.php");
authenticator::authenticate_access("round_0_comprehension_quiz.php", "hypothetical_scenarios.php");
?>

<body>
<div class="container-fluid">
    <h1>Instructions</h1>
    <p>You are now entering a game which you will play with other people with fake currency, Experiment Currency Units
        (ECUs) also referred to as tokens. There are three parts to the game, each part has three rounds, making it a
        total of 9 rounds.
        <?php
        include_once "includes/echo_if_pay_is_dependent_on_ECU.php";
        $userID = $_SESSION["user_id"];
        echo_if_pay_dependent_on_ECU($userID, "It is important that you read these instructions carefully as the decisions that you make in
        the experiment will affect your chances of winning the prize.")
        ?>
    <p>You play with three other participants and will play in the same group for the whole game. They have been given
        the same instructions that you are reading now and play by exactly the same rules. You and all the other
        participants start the game with 20 ECU. You can do two things with those ECU - you can keep them or you can
        invest them into a Social Good. What the Public Good does is it takes all the money that has been put into it
        and multiplies them by two. Then it takes that money and shares them equally between all the participants. For
        example, if everyone contributes 1 ECU to the Public Good, that means that 4 ECU have been contributed in total.
        The Social Good makes it into 8 ECU and then shares them equally between all participants. In the end, every
        player (including you) receives 8/4 = 2 ECU. You keep the ECU received from the Public Good as well as the ECU
        you have decided not to contribute.</p>

    <p>That means that:</p>
    <ul class="list-group">
        <li class="list-group-item">If all players contribute to the Social Good, everybody gets more money in the
            end because the Public Good doubles all contributions.
        </li>
        <li class="list-group-item">If nobody contributes, everybody only keeps their starting money.</li>
        <li class="list-group-item">Everyone gets the same amount of ECU from the Public Good, it does not matter who
            contributed and who did not. Therefore, you will always earn more money if you contribute less than others.
        </li>
    </ul>

    <p>The number of the part as well as the round appear in the top left corner of the screen. The amount of time for you to make the decision is limited to 60 seconds. If you fail to make a decision by thet time, the computer will automatically contribute 0 to the Social Good. You start with 20 ECU in the beginning of every part, and then for next rounds the number
        depends on how much money you have had in the previous round.
        After all players have made their decision, you will reach a results page in which all the contributions
        (including yours) will be shown. It shows you how many ECUs you have earned at the first stage. The income for
        the other players will be calculated in the same way as yours.

        Your income for the round will consist of:</p>
    <ul class="list-group">
        <li class="list-group-item">The tokens which you have kept for yourself (not invested into the Public Good)</li>
        <li class="list-group-item">The money you get from the Public Good (0.5 * how many tokens the 4 group members
            have contributed to the
            project).
        </li>
    </ul>
    <p>
        In sum:
        (20 - your contribution to the project) + 0.5*(total contributions to the project)</p><br>

    <h1>Comprehension Quiz</h1>
    <p>These questions are designed to check if you have understood the instructions. The programme will not allow you
        to continue to the start of the game unless each of the questions have been answered correctly.</p>

    <form action="" method="post">
        <p> In round one of the experiment you have contributed 20 ECUs to the Public Good. The other participants have
            contributed 0. How many ECU do you get for this round in the end?</p>
        <div class="radio">
            <label><input type="radio" name="question_1" value="5" required="required">5</label><br>
            <label><input type="radio" name="question_1" value="10">10</label><br>
            <label><input type="radio" name="question_1" value="20">20</label><br>
            <label><input type="radio" name="question_1" value="30">30</label><br>
        </div>

        <p>How much money do the other participants get for this round? </p>
        <div class="radio">
            <label><input type="radio" name="question_2" value="5" required="required">5</label><br>
            <label><input type="radio" name="question_2" value="10">10</label><br>
            <label><input type="radio" name="question_2" value="20">20</label><br>
            <label><input type="radio" name="question_2" value="30">30</label><br>
        </div>

        <p> Does everybody get the same amount of money from the Public Good no matter whether they have contributed or
            not?</p>
        <div class="radio">
            <label><input type="radio" name="question_3" value="true" required="required">yes</label><br>
            <label><input type="radio" name="question_3" value="false">no</label><br>
        </div>

        <p>If you had 20 ECU and are the only person who has contributed to the Social Good, how much money will you
            have in the end?</p>
        <div class="radio">
            <label><input type="radio" name="question_4" value="20+" required="required">More than 20</label><br>
            <label> <input type="radio" name="question_4" value="20">Exactly 20</label><br>
            <label> <input type="radio" name="question_4" value="20-">Less than 20</label><br>
        </div>


        <button name="submit" class="btn btn-default">Submit</button>
    </form>
</div>
</body>
<?php
if (isset($_POST['submit'])) {
    if (validate_answers() == true) {
        $userID = $_SESSION["user_id"];
        $sql = "UPDATE users SET passed_comprehension_quiz = 1 WHERE user_id =$userID";
        if (mysqli_query($con, $sql)) {
            echo("<script>window.open('round_0.php', '_self')</script>");
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
    $question_3_answer = htmlspecialchars($_POST['question_3']);
    $question_4_answer = htmlspecialchars($_POST['question_4']);

    return (($question_1_answer == 10) && ($question_2_answer == 30) && ($question_3_answer == "true") && ($question_4_answer == "20-"));
}

include("templates/footer.php") ?>
</html>
