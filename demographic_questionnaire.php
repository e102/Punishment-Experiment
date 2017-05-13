<!DOCTYPE html>
<html>
<?php
include("templates/header.php");
include ("includes/connection.php");
session_start();
?>
<head>
    <title>Demographic Questionnaire</title>
    <link rel="stylesheet" href="styles/default.css" media="all"/>
</head>

<body>
<form action="" method="post">
    <h4>Round 1</h4>
    <p> In round 1, you contribute 20 ECU’s to the Social Good. The other participants contribute 0.</p>
    <p> What is your total payoff for round 1?</p>
    <input type="radio" name="question_1" value="1" checked="checked"><label for="1">1</label><br>
    <input type="radio" name="question_1" value="5"><label for="5">5</label><br>
    <input type="radio" id="question_1_correct_answer" name="question_1" value="8"><label for="8">8</label><br>
    <input type="radio" name="question_1" value="14"><label for="14">12</label><br>
    <input type="radio" name="question_1" value="20"><label for="20">20</label><br>

    <p>What is the <b>other participants</b> total payoff for round 1?</p>
    <input type="radio" name="question_2" value="0" checked="checked"><label for="0">0</label><br>
    <input type="radio" name="question_2" value="14"><label for="14">14</label><br>
    <input type="radio" name="question_2" value="20"><label for="20">20</label><br>
    <input type="radio" id="question_2_correct_answer" name="question_2" value="28"><label for="28">28</label><br>
    <input type="radio" name="question_2" value="32"><label for="32">32</label><br>

    <h4>Round 2</h4>
    <p> In round 2, you contribute 20 ECU’s to the Social Good. The other 3 players also contribute
        20 ECU’s. What is <b>your</b> total payoff for round 2?</p>
    <input type="radio" name="question_3" value="1" checked="checked"><label for=">1">1</label><br>
    <input type="radio" name="question_3" value="11"><label for="11">11</label><br>
    <input type="radio" id="question_3_correct_answer" name="question_3" value="32"><label for="32">32</label><br>
    <input type="radio" name="question_2" value="38"><label for="38">38</label><br>
    <input type="radio" name="question_3" value="40"><label for="40">40</label><br>

    <h4>Round 3</h4>
    <p>In round 3, you contribute 4 ECU’s to the Social Good, player Green contributes 0,
        player Red contributes 8 and player Blue contributes 20.</p>

    <p>What is <b>your</b> total payoff for round 3?.</p>
    <input type="text" name="question_4" required="required"><label>ECU's</label>
    <p><br>What is Blue's total payoff for round 3?</p>
    <input type="text" name="question_5" required="required"><label>ECU's</label>
    <p><br>What is Red's total payoff for round 3?</p>
    <input type="text" name="question_6" required="required"><label>ECU's</label>
    <p><br>What is the total payoff of Green for this round? (answer: 28).</p>
    <input type="text" name="question_7" required="required"><label>ECU's</label>
    <br>
    <button name="submit">Submit (Dev testing. Will always work.)</button>
</form>
<?php
if (isset($_POST['submit'])) {
    if (validate_answers() == true) {
        $userID = $_SESSION["user_id"];
        $sql = "UPDATE users SET passed_comprehension_quiz = 1 WHERE user_id =$userID";
        if (mysqli_query($con, $sql)) {
            echo("<script>alert('You have passed the quiz')</script>");
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
    $question_5_answer = htmlspecialchars($_POST['question_5']);
    $question_6_answer = htmlspecialchars($_POST['question_6']);
    $question_7_answer = htmlspecialchars($_POST['question_7']);

    //IMPORTANT: Answer to question 4 is wrong.
    return (($question_1_answer == 8) && ($question_2_answer == 28) && ($question_3_answer == 32) && ($question_4_answer == 24) && ($question_5_answer == 8) && ($question_6_answer == 20) && ($question_7_answer == 28));
}

?>
</body>
<?php include("templates/footer.php") ?>
</html>
