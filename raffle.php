<!DOCTYPE html>
<html>
<?php
include("templates/header.php");
include("includes/connection.php");
session_start();

include("templates/bootstrap_head.php");
echo_head("Raffle");

include_once("includes/Authenticator.php");
authenticator::authenticate_access("raffle.php", "comprehension_questionnaire.php");
?>

<body>
<div class="container-fluid">
    <h4>Raffle</h4>

    <form action="" method="post">
        <div class="form-group">
            <label for="email">Enter your email below if you want to be entered into the prize draw</label>
            <input type="email" name="user_email"/>
        </div>
        <br><br>
        <button name="submit" class="btn btn-default">Submit</button>
    </form>
</div>
</body>
<?php
if (isset($_POST['submit'])) {
    $user_email = htmlspecialchars($_POST['user_email']);

    include_once("includes/generate_sql.php");
    $sql = generate_sql("user_email", $user_email, $_SESSION["user_id"]);

    if (mysqli_query($con, $sql)) {
        echo("<script>window.open('final_page.php','_self')</script>");
    }
    else {
        echo("<script>alert('Could not connect to server')</script>");
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}

include("templates/footer.php") ?>
</html>
