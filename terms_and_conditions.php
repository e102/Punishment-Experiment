<!DOCTYPE html>
<?php
session_start();
include "templates/header.php";
include "templates/bootstrap_head.php";
echo_head("Terms and Conditions");

include "includes/authentication/authenticate_access.php";
authenticate_access("terms_and_conditions.php", "index.php")
?>
<html>
<body>
<div class="container-fluid">
    <h3>Welcome </h3>
    <p>Thank you for agreeing to participate in today’s research project. You will be asked to answer some questions
        about yourself as well as well as play an interactive game involving virtual money. The study is designed to
        test how people’s views of the environment affect their behaviour. Therefore, the questions will ask for your
        views of the society as well as if you have been involved in anti-social behaviour. For participation today you
        will be paid by entering a prize draw to win a 50£ Amazon voucher. The study should take you approximately 40
        minutes to complete.</p>
    <p>For the experiment you will not be asked to include your name at any stage, instead you will be riven a
        randomly-generated ID number. That means that there is no way to connect your answers to you. Please note that
        because your results are anonymised at all stages of the experiment, it will not be possible to withdraw your
        data after the experiment is complete. Any data which could be used to identify you (such as age, gender,
        nationality) will be treated with great care and stored in a secure environment in accordance with the Data
        Protection Act 1998. In order to enter the prize draw you will be asked to write your email address. This data
        will be stored separately from the rest of the experiment and will not be used for any purpose other than paying
        you for participation. None of the data will be shared with anyone who is not directly involved with data
        analysis.</p>
    <p>You are free to drop out at any point during the experiment, and you will still be able to enter the lottery to
        win the voucher. If you have any questions or concerns, feel free to contact the researcher at any time during
        or after the experiment using the contact details provided at the bottom of the page. In the unlikely event that
        the experimenter cannot answer your concerns, please contact the supervisor of this project, Dr. Kyle Treiber,
        whose contact details are also listed.
        Please make an effort to make all decisions independently, without discussing them with others, and not to share
        anything about this experiment with other potential participants.</p>
    <form action="" method="post" class="form-vertical">
        <div class="form-group">
            <div class="checkbox">
                <label><input type="checkbox" name="checkbox_1" value="checkbox_1_value" required="required">I
                    have read and understood the instructions above. All the questions that I had were answered. I have
                    had
                    enough time to consider my decision.</label>
                <br>
            </div>

            <div class="checkbox">
                <label><input type="checkbox" name="checkbox_2" value="checkbox_2_value" required="required">I
                    understand that participation in this experiment is fully anonymised and the researcher has no way
                    of
                    connecting my answers back to me.
                </label>
                <br>
            </div>

            <div class="checkbox">
                <label><input type="checkbox" name="checkbox_3" value="checkbox_3_value" required="required">I
                    consent to the storage and use of my answers in this experiment for research purposes.</label>
                <br>
            </div>

            <div class="checkbox">
                <label><input type="checkbox" name="checkbox_4" value="checkbox_4_value" required="required">I
                    understand that my participation in this experiment is voluntary and that I can withdraw at any
                    point.</label>
                <br>
            </div>

            <button name="proceed" class="btn btn-default">Proceed</button>
            <div class="form-group">
    </form>
    <?php
    include("includes/connection.php");
    if (!$con) {
        die("Could not connect to server: " . mysqli_connect_error());
    }

    if (isset($_POST['proceed'])) {
        $userID = $_SESSION["user_id"];
        $sql = "UPDATE users SET agreed_to_conditions = 1 WHERE user_id =$userID";
        if (mysqli_query($con, $sql)) {
            echo "<script>window.open('environment_questionnaire.php','_self')</script>";
        }
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }
    ?>
</div>
</body>
<?php include("templates/footer.php"); ?>
</html>