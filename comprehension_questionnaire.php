<!DOCTYPE html>
<html>
<?php
include("templates/header.php");
include("includes/connection.php");
session_start();

include("templates/bootstrap_head.php");
echo_head("Comprehension Questionnaire");
?>

<head>
<link rel = 'stylesheet' type = 'text/css' href = 'styles/likert_scale.css' >
</head>

<body>
<div class="container-fluid">
    <h4>Comprehension Questionnaire</h4>

    <form action="" method="post">
        <div class="form-group">
            <label for="opinion">What, in your opinion, was the goal of this experiment?</label>
            <textarea class="form-control" rows="5" id="opinion" maxlength="100000" required="required"></textarea>
        </div>

        <div class="form-group">
        <?php
        echo_likert_scale("I felt I knew a lot of the purpose of this study", "goal");
        echo_likert_scale("I could understand the instructions clearly", "understand_instructions");
        echo_likert_scale("I have put a lot of thought into every decision", "thought");
        echo_likert_scale("I felt that my decisions did not matter in the game", "felt_decisions_matter");
        echo_likert_scale("The other participants in the game have behaved in the way I expected them to behave", "others_behaved_as_expected");
        echo_likert_scale("I have felt cheated in the game", "felt_cheated");
        ?>
        </div>

        <div class="form-group">
            <label for="comment">Do you have any other comments?</label>
            <textarea class="form-control" rows="5" id="comment" maxlength="100000"></textarea>
        </div>

        <br><br>
        <button name="submit" class="btn btn-default">Submit</button>
    </form>
</div>
</body>
<?php
if (isset($_POST['submit'])) {
    $userID = $_SESSION["user_id"];

    $opinion = htmlspecialchars($_POST['opinion']);
    $goal = htmlspecialchars($_POST['goal']);
    $understand_instructions = htmlspecialchars($_POST['understand_instructions']);
    $thought = htmlspecialchars($_POST['thought']);
    $felt_decisions_matter = htmlspecialchars($_POST['felt_decisions_matter']);
    $others_behaved_as_expected = htmlspecialchars($_POST['others_behaved_as_expected']);
    $felt_cheated = htmlspecialchars($_POST['felt_cheated']);
    $comment = htmlspecialchars($_POST['opinion']);

    include_once("includes/generate_sql.php");

    $sql = generate_sql("user_opinion", $opinion, $userID);
    $sql .= generate_sql("user_goal", $goal, $userID);
    $sql .= generate_sql("user_understand_instructions", $understand_instructions, $userID);
    $sql .= generate_sql("user_thought", $thought, $userID);
    $sql .= generate_sql("user_felt_decisions_matter", $felt_decisions_matter, $userID);
    $sql .= generate_sql("user_others_behaved_as_expected", $others_behaved_as_expected, $userID);
    $sql .= generate_sql("user_felt_cheated", $felt_cheated, $userID);
    $sql .= generate_sql("user_comment", $comment, $userID);

    if (mysqli_multi_query ($con, $sql)) {
        echo("<script>window.open('raffle.php', '_self')</script>");
    }
    else {
        echo("<script>alert('Could not connect to server')</script>");
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}

function echo_likert_scale($question, $scale_name){
    echo("
    <label class='statement'>$question</label>
    <ul class='likert'>
      <li>
        <input type='radio' name='$scale_name' value='5' required='required'>
        <label>Strongly agree</label>
      </li>
      <li>
        <input type='radio' name='$scale_name' value='4'>
        <label>Agree</label>
      </li>
      <li>
        <input type='radio' name='$scale_name' value='3'>
        <label>Neutral</label>
      </li>
      <li>
        <input type='radio' name='$scale_name' value='2'>
        <label>Disagree</label>
      </li>
      <li>
        <input type='radio' name='$scale_name' value='1'>
        <label>Strongly disagree</label>
      </li>
    </ul>
    ");
}

include("templates/footer.php") ?>
</html>
