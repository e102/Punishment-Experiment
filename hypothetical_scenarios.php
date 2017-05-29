<!DOCTYPE html>
<html>
<?php
include("templates/header.php");
include("includes/connection.php");
session_start();

include("templates/bootstrap_head.php");
echo_head("Hypothetical Scenarios");

include_once("includes/Authenticator.php");
authenticator::authenticate_access("hypothetical_scenarios.php", "demographic_questionnaire.php");
?>

<body>
<div class="container-fluid">
    <h4>Hypothetical Scenarios</h4>
    <form action="" method="post">
        <?php
        generate_questionnaire();
        ?>
        <br><br>
        <button name="submit" class="btn btn-default">Submit</button>
    </form>
</div>
</body>
<?php
if (isset($_POST['submit'])) {
    $userID = $_SESSION["user_id"];
    $bus_stop_answer = htmlspecialchars($_POST['question_1']);
    $nightclub_queue_answer = htmlspecialchars($_POST['question_2']);
    $dropped_wallet_answer = htmlspecialchars($_POST['question_3']);

    include_once "includes/generate_sql.php";

    $sql = generate_sql("bus_stop_answer", $bus_stop_answer, $userID);
    $sql .= generate_sql("nightclub_queue_answer", $nightclub_queue_answer, $userID);
    $sql .= generate_sql("dropped_wallet_answer", $dropped_wallet_answer, $userID);

    if (mysqli_multi_query($con,$sql)) {
        echo("<script>window.open('environment_questionnaire.php', '_self')</script>");
    }
    else {
        echo("<script>alert('Could not connect to server')</script>");
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}

function generate_questionnaire() {
    $userID = $_SESSION["user_id"];
    $sql = "select user_gender from users where user_id = '$userID'";
    global $con;
    $run_sql = mysqli_query($con, $sql);
    $check_rows = mysqli_num_rows($run_sql);

    if ($check_rows == 1) {
        while ($row = mysqli_fetch_array($run_sql)) {
            $user_gender = $row['user_gender'];
        }
    }
    else{
        throw new Exception("Could not fetch user gender");
    }

    if ($user_gender == "male") {
        $question_text_1 = "Tony is waiting for the bus at a bus stop. He is listening to his iPod. Suddenly a young male walks by and pushes him. When Tony asks why he pushed him the young male just ignores him. There are no other people at the bus stop. If you were Tony, how likely do you think it is that you would hit or push the young male that pushed you?";
        $question_text_2 = "Ben is walking on a busy street past a queue for a nightclub on a Friday night. A young male walks up to Ben and accuses him of queue jumping, and pushes him so that he  falls over and hurts his arm. If you were Ben, how likely do you think it is that you would hit the young male?";
        $question_text_3 = "David is sitting in an empty room in a library when he sees that someone has dropped a wallet on the floor. He picks up the wallet and finds that it contains one hundred pounds. There is no one else around him, no one has seen David picking up the wallet. If you were David, how likely would you be take the money and keep it for yourself?";

    }
    elseif ($user_gender == "female") {
        $question_text_1 = "Lindsay is waiting for the bus at a bus stop. She is listening to his iPod. Suddenly a young female walks by and pushes her. When Lindsay asks why she pushed her the young female just ignores her. There are no other people at the bus stop. If you were Lindsay, how likely do you think it is that you would hit or push the young female that pushed you?";
        $question_text_2 = "Sarah is walking on a busy street past a queue for a nightclub on a Friday night. A young female walks up to Sarah and accuses her of queue jumping, and pushes her so that she falls over and hurts her arm. If you were Sarah, how likely do you think it is that you would hit the young female?";
        $question_text_3 = "Helen is sitting in an empty room in a library when she sees that someone has dropped a wallet on the floor. She picks up the wallet and finds that it contains one hundred pounds. There is no one else around him, no one has seen Helen picking up the wallet. If you were Helen, how likely would you be take the money and keep it for yourself?";

    }
    else {
        throw new Exception("User gender not recognized");
    }

    echo_question($question_text_1, "question_1");
    echo_question($question_text_2, "question_2");
    echo_question($question_text_3, "question_3");
}

function echo_question($question_text, $question_name) {
    echo("
    <label>$question_text<br>
    <select name='$question_name', required = 'required'>
        <option disabled selected value>Please select an option</option>
        <option value='Very likely'>Very likely</option>
        <option value='Very likely'>Likely</option>
        <option value='Very likely'>Unikely</option>
        <option value='Very likely'>Very Unikely</option>
    </select></label>
    <br><br>
    ");
}

include("templates/footer.php") ?>
</html>