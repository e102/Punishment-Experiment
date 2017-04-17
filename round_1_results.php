<!DOCTYPE html>
<html>
<?php include("templates/header.php");
include("includes/connection.php");
session_start();
?>

<head>
    <title>Game 1: Results</title>
    <link rel="stylesheet" href="styles/default.css" media="all"/>
</head>

<?php
$userID = $_SESSION["user_id"];
global $con;
$sql_query = "select * from users where user_ID = '$userID'";
$run_query = mysqli_query($con, $sql_query);
$check_query = mysqli_num_rows($run_query);

if ($check_query == 1) {
    while ($row = mysqli_fetch_array($run_query)) {
        $round_1c_player_ECU_at_end = $row["round_1c_player_ECU_at_end"];
    }
}
elseif ($check_query == 0) {
    throw new Exception("No user found with this id");
}
elseif ($check_query > 1) {
    throw new Exception("Multiple users found with this id");
}
else {
    throw new Exception("Unexpected error");
}

echo("
<body>
<h1>Final results for Game 1:</h1>

<p>You have finished the round and have $round_1c_player_ECU_at_end ECU's</p>
<p> These ECU's have been added to your bank. After you have finished 3 games, the ECU in your bank will determine your reward</p>
");
?>

<form action='' method='post'>
    <button name='submit'>Continue to game 2</button>
</form>

<?php
if (isset($_POST['submit'])) {
    echo("<script>window.open('round_2_instructions.php', '_self')</script>");
}
?>

<?php include("templates/footer.php") ?>
</html>
