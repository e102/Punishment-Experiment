<!DOCTYPE html>
<html>
<?php
include("templates/header.php");
include("includes/connection.php");
session_start();

include("templates/bootstrap_head.php");
echo_head("Instructions");

include_once("includes/Authenticator.php");
authenticator::authenticate_access("instructions.php", "environment_questionnaire.php");
?>

<body>
<div class="container-fluid">
    <h1>Instructions</h1>
    <p>You are now entering a game which you will play with other people with fake currency, Experiment Currency Units
        (ECU’s) also referred to as tokens. There are three parts to the game, each part has three rounds, making it a
        total of 9 rounds. It is important that you read these instructions carefully as the decisions that you make in
        the experiment will affect your chances of winning the prize. They may appear to be hard to understand, however,
        are much easier once the actual game is played.</p>
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
    <ul>
        <li>If all players contribute to the Social Good, everybody is getting more money in the end because the Public
            Good doubles all contributions.
        </li>
        <li>If nobody contributes, everybody only has their starting money and will not earn more from the Public
            Good.
        </li>
        <li>Everyone gets the same amount of ECU from the Public Good, it does not matter who contributed and who did
            not. Therefore, you will always earn more money if you contribute less than others.
        </li>
    </ul>
    <p>The number of the part as well as the round appear in the top left corner of the screen. In the top right corner
        you can see how many more seconds remain for you to decide on the distribution of your tokens. Your decision
        must be made before the time displayed is 0 seconds, otherwise the programme will automatically contribute 0 to
        the Social Good. You start with 20 ECU in the beginning of every part, and then for next rounds the number
        depends on how much money you have had in the previous round.
        After all players have made their decision, you will reach a results page in which all the contributions
        (including yours) will be shown. It shows you how many ECUs you have earned at the first stage. The income for
        the other players will be calculated in the same way as yours.

        Your income for the round will consist of:</p>
    <ul>
        <li>The tokens which you have kept for yourself (not invested into the Public Good)</li>
        <li>The money you get from the Public Good (0.5 * how many tokens the 4 group members have contributed to the
            project).
        </li>
    </ul>
    <p>
        In sum:
        (20 - your contribution to the project) + 0.5*(total contributions to the project)</p>

    <form action="" method="post">
        <button name="submit" class="btn btn-default">Continue</button>
    </form>
</div>
</body>
<?php
if (isset($_POST['submit'])) {
    echo("<script>window.open('round_0_comprehension_quiz.php', '_self')</script>");
}
include("templates/footer.php") ?>
</html>
