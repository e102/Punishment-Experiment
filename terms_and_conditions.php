<!DOCTYPE html>
<?php
session_start();
include("templates/header.php");
?>

<html>
<head>
    <title>Terms and Conditions</title>
    <link rel="stylesheet" href="styles/default.css" media="all"/>
</head>

<body>
<!--Container starts-->
<div class="container">
    <h3>Welcome </h3>
    <p>Thank you for agreeing to participate in today’s experiment. You are now about to take part in a decision-making
        experiment which serves as a part of an independent research project, for which you will be paid by entering a
        lottery to win a prize (SPECIFY). There will be (SEVERAL) prizes you might be able to enter the lottery for,
        however, that would entirely depend on your decisions in this game. In order to receive the price, you will be
        required to fill in several questionnaires as well as play a decision-making game.<br>
        For the experiment you will be given a randomly generated user number, which ensures that neither the
        experimenter nor the other participants will be able to connect your answers to you. Please note that because
        your results are anonymised at all stages of the experiment, it will not be possible to withdraw your data after
        the experiment is complete. Any personal data will be stored in a secure environment in accordance with the Data
        Protection Act 1998.<br>
        Please note that you are free to drop out at any point during the experiment, at which point you will still be
        able to enter the basic draw for the cheapest prize, however, will not be able to enter the lottery for the
        bigger ones. Shall you have any questions or concerns, feel free to contact the experimenter at any time during
        the experiment or after it using the contact details provided at the bottom of the page. In the unlikely event
        that the experimenter cannot answer your questions, please contact the supervisor of this project, Dr. Kyle
        Treiber (CONTACT DETAILS HERE).
        Please refrain from communicating with the other participants (current or former) for the duration of the
        experiment and make all decisions independently, without discussing them with others.</p>
    <form action="" method="post">
        <input type="checkbox" name="agrees_to_terms_checkbox" value="agreed_to_t&c" required="required"> I have read
        and understood the
        above<br>
        <button name="proceed">Proceed</button>
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
            echo "<script>window.open('instructions.php','_self')</script>";
        }
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }
    ?>
</div>
<!--Container ends-->
</body>
<?php include("templates/footer.php"); ?>
</html>