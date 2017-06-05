<!DOCTYPE html>
<html>
<?php
include("templates/header.php");
include("includes/connection.php");
session_start();

include("templates/bootstrap_head.php");
echo_head("Interviews");

include_once("includes/Authenticator.php");
authenticator::authenticate_access("interviews.php", "comprehension_questionnaire.php");
?>

<body>
<div class="container-fluid">
    <h4>Interview</h4><br>
    <p>This is a pilot study for a new method of studying human behaviour, which means that every input would be highly appreciated. if you feel that you would be willing to help the research by answering a few questions about your experiences while playing this game, please enter your email below. The researcher will have no access to your results or answers to the questionnaires.</p>

    <form action="" method="post">
        <div class="form-group">
            <label for="opinion">Enter your email below if you would like to be invited for an interview</label><br>
            <input type="text" required="required" id="user_email"/>
        </div>
        <br><br>
        <button name="submit" class="btn btn-default">Submit</button>
    </form>
</div>
</body>
<?php
if (isset($_POST['submit'])) {
    $userID = $_SESSION["user_id"];

    $user_email = htmlspecialchars($_POST['user_email']);

    include_once("includes/generate_sql.php");
    $sql = generate_sql("user_email", $user_email, $userID);

    if (mysqli_query($con, $sql)) {
        echo("<script>window.open('final_page.php', '_self')</script>");
    }
    else {
        echo("<script>alert('Could not connect to server')</script>");
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}

include("templates/footer.php") ?>
</html>
