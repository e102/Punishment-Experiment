<!DOCTYPE html>
<html>
<?php
include("templates/header.php");
include("includes/connection.php");
session_start();
include("templates/bootstrap_head.php");
echo_head("Environment Questionnaire");

include_once("includes/Authenticator.php");
authenticator::authenticate_access("environment_questionnaire.php","demographic_questionnaire.php");
?>

<head>
    <link rel='stylesheet' type='text/css' href='styles/likert_scale.css'>
</head>

<body>
<div class="container-fluid">
    <p>All the information with which you could be identified will be kept in strict confidentiality. These answers do
        not influence your chances to win the prize and will not be communicated to other participants. </p>

    <form action="" method="post">
        <div class="form-group">
            <?php
            include_once("includes/echo_likert_scale.php");
            echo_likert_scale("I feel I invest more in relationship with people then I receive in return", "invest_more_in_relationship");
            echo_likert_scale("I feel I lay out myself too much in view of what I achieve", "I_lay_out_myself_too_much");
            echo_likert_scale("I feel I give people a lot of time and attention, but meet with little appreciation", "meet_with_little_appreciation");
            echo_likert_scale("I feel that I can count on people to distract me from worries when I am under stress", "people_to_distract_me_from_worries");
            echo_likert_scale("I feel that I can count on people to help me feel more relaxed when I am under pressure or tense", "people_help_me_feel_relaxed");
            echo_likert_scale("I feel that people around me accept me totally including my best points and my worst points", "accept_me_totally");
            echo_likert_scale("I feel that I can count on people to care about me, regardless of what is happening to me", "people_care_about_me_regardless");
            echo_likert_scale("I feel that I can count on people to help me feel better when I am feeling generally unhappy", "people_help_me_feel_better");
            echo_likert_scale("I feel that I can count on people to console me when I am very upset", "people_console_me");
            echo_likert_scale("I feel that I have someone that I can turn to", "someone_I_can_turn_to");
            echo_likert_scale("I feel that I have people that stand by me", "people_stand_by_me");
            echo_likert_scale("I feel that I can talk openly about my problems", "I_can_talk_openly");
            echo_likert_scale("I feel that it is safe for me to show my weaknesses", "safe_to_show_weaknesses");
            echo_likert_scale("I am satisfied with the balance of the things I give to the society and the ones I get in return", "balance_of_things_society");
            ?>
        </div>
        <button name="submit" class="btn btn-default">Submit</button>
    </form>
</div>
</body>
<?php
if (isset($_POST['submit'])) {
    $userID = $_SESSION["user_id"];

    $invest_more_in_relationship = htmlspecialchars($_POST['invest_more_in_relationship']);
    $I_lay_out_myself_too_much = htmlspecialchars($_POST['I_lay_out_myself_too_much']);
    $meet_with_little_appreciation = htmlspecialchars($_POST['meet_with_little_appreciation']);
    $people_to_distract_me_from_worries = htmlspecialchars($_POST['people_to_distract_me_from_worries']);
    $people_help_me_feel_relaxed = htmlspecialchars($_POST['people_help_me_feel_relaxed']);
    $accept_me_totally = htmlspecialchars($_POST['accept_me_totally']);
    $people_care_about_me_regardless = htmlspecialchars($_POST['people_care_about_me_regardless']);
    $people_help_me_feel_better = htmlspecialchars($_POST['people_help_me_feel_better']);
    $people_console_me = htmlspecialchars($_POST['people_console_me']);
    $someone_I_can_turn_to = htmlspecialchars($_POST['someone_I_can_turn_to']);
    $people_stand_by_me = htmlspecialchars($_POST['people_stand_by_me']);
    $I_can_talk_openly = htmlspecialchars($_POST['I_can_talk_openly']);
    $safe_to_show_weaknesses = htmlspecialchars($_POST['safe_to_show_weaknesses']);
    $balance_of_things_society = htmlspecialchars($_POST['balance_of_things_society']);

    include_once("includes/generate_sql.php");

    $sql = generate_sql("invest_more_in_relationship", $invest_more_in_relationship, $userID);
    $sql .= generate_sql("I_lay_out_myself_too_much", $I_lay_out_myself_too_much, $userID);
    $sql .= generate_sql("meet_with_little_appreciation", $meet_with_little_appreciation, $userID);
    $sql .= generate_sql("people_to_distract_me_from_worries", $people_to_distract_me_from_worries, $userID);
    $sql .= generate_sql("people_help_me_feel_relaxed", $people_help_me_feel_relaxed, $userID);
    $sql .= generate_sql("accept_me_totally", $accept_me_totally, $userID);
    $sql .= generate_sql("people_care_about_me_regardless", $people_care_about_me_regardless, $userID);
    $sql .= generate_sql("people_help_me_feel_better", $people_help_me_feel_better, $userID);
    $sql .= generate_sql("people_console_me", $people_console_me, $userID);
    $sql .= generate_sql("someone_I_can_turn_to", $someone_I_can_turn_to, $userID);
    $sql .= generate_sql("people_stand_by_me", $people_stand_by_me, $userID);
    $sql .= generate_sql("I_can_talk_openly", $I_can_talk_openly, $userID);
    $sql .= generate_sql("safe_to_show_weaknesses", $safe_to_show_weaknesses, $userID);
    $sql .= generate_sql("balance_of_things_society", $balance_of_things_society, $userID);

    if (mysqli_multi_query($con, $sql)) {
        echo("<script>window.open('hypothetical_scenarios.php', '_self')</script>");
    }
    else {
        echo("<script>alert('Could not connect to server')</script>");
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}
include("templates/footer.php") ?>
</html>
