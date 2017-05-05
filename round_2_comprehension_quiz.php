<!DOCTYPE html>
<html>
<?php
include("templates/header.php");
include("includes/connection.php");
session_start();
?>
<head>
    <title>Game 2 Comprehension Quiz</title>
    <link rel="stylesheet" href="styles/default.css" media="all"/>
</head>

<body>
<h1>Game 2 Comprehension Quiz</h1>
<p>These questions are designed to check if you have understood the instructions. The programme will not allow you to
    continue to the start of the game unless each of the questions have been answered correctly.</p>
<p>Remember, this game's rules are identical to those of the previous game. The only difference is that you can punish
    or reward other participants.<br> By giving up 1 of your ECU's, you can give/remove 2 ECU's from another player.</p>

<form action="" method="post">
    <h4>Round 1</h4>
    <p> In round 1, you start all start with 60 ECU's. You contribute 50 ECU’s to the Social Good. The other
        participants
        contribute 0.<br>What is <b>your</b> total payoff for the round?</p>
    <input type="radio" name="question_1" value="60" checked="checked"><label for="60">60</label><br>
    <input type="radio" name="question_1" value="50"><label for="50">50</label><br>
    <input type="radio" id="question_1_correct_answer" name="question_1" value="30"><label for="30">30</label><br>
    <input type="radio" name="question_1" value="20"><label for="20">20</label><br>
    <input type="radio" name="question_1" value="10"><label for="10">10</label><br>

    <p>What is the <b>other participants</b> total payoff for round 1?</p>
    <input type="radio" name="question_2" value="0" checked="checked"><label for="0">0</label><br>
    <input type="radio" name="question_2" value="30"><label for="30">30</label><br>
    <input type="radio" name="question_2" value="60"><label for="60">60</label><br>
    <input type="radio" id="question_2_correct_answer" name="question_2" value="80"><label for="80">80</label><br>
    <input type="radio" name="question_2" value="90"><label for="90">90</label><br>

    <h4>Punishment</h4>
    <p> After round 1, you have the opportunity to reward or punish other players. You choose to punish player 2,
        removing 6 of their ECU's.<br>. How many ECU's does it cost you to do this?</p>
    <input type="radio" name="question_3" value="0" checked="checked"><label for="0">0</label><br>
    <input type="radio" id="question_3_correct_answer" name="question_3" value="3"><label for="3">3</label><br>
    <input type="radio" name="question_3" value="6"><label for="6">6</label><br>
    <input type="radio" name="question_2" value="12"><label for="12">12</label><br>

    <button name="submit">Submit (Dev testing. Will always work.)</button>
</form>
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
    $question_3_answer = htmlspecialchars($_POST['question_3']);

    //IMPORTANT: Answer to question 4 is wrong.
    return (($question_1_answer == 30) && ($question_2_answer == 80) && ($question_3_answer == 3));
}

?>
</body>
<?php include("templates/footer.php") ?>
</html>
