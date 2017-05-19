<!DOCTYPE html>
<html>
<?php
include("templates/header.php");
include("includes/connection.php");
session_start();
include("templates/bootstrap_head.php");
echo_head("Comprehension Quiz");
?>

<body>
<div class="container-fluid">
    <h1>Comprehension Quiz</h1>
    <p>These questions are designed to check if you have understood the instructions. The programme will not allow you
        to continue to the start of the game unless each of the questions have been answered correctly.</p>

    <form action="" method="post">
        <p> In round one of the experiment you have contributed 20 ECUs to the Public Good. The other participants have
            contributed 0. How many ECU do you get for this round in the end?</p>
        <input type="radio" name="question_1" value="5" required="required"><label for="5">5</label><br>
        <input type="radio" name="question_1" value="10"><label for="10">10</label><br>
        <input type="radio" name="question_1" value="20"><label for="20">20</label><br>
        <input type="radio" name="question_1" value="30"><label for="30">30</label><br>

        <p>How much money do the other participants get for this round? </p>
        <input type="radio" name="question_2" value="5" required="required"><label for="5">5</label><br>
        <input type="radio" name="question_2" value="10"><label for="10">10</label><br>
        <input type="radio" name="question_2" value="20"><label for="20">20</label><br>
        <input type="radio" name="question_2" value="30"><label for="30">30</label><br>

        <p> Does everybody get the same amount of money from the Public Good no matter whether they have contributed or
            not?</p>
        <input type="radio" name="question_3" value="true" required="required"><label for="yes">yes</label><br>
        <input type="radio" name="question_3" value="false"><label for="no">no</label><br>

        <p>If you had 20 ECU and are the only person who has contributed to the Social Good, how much money will you
            have in the end?</p>
        <input type="radio" name="question_4" value="20+" required="required"><label for="More than 20">More than 20</label><br>
        <input type="radio" name="question_4" value="20"><label for="More than 20">Exactly 20</label><br>
        <input type="radio" name="question_4" value="20-"><label for="More than 20">Less than 20</label><br>



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

    return (($question_1_answer == 10) && ($question_2_answer == 30) && ($question_3_answer == "true") && ($question_4_answer == "20-"));
}

include("templates/footer.php") ?>
</html>
