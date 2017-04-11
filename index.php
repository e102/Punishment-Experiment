<!DOCTYPE html>
<title>Login</title>
<?php
session_start();
include("templates/header.php");
?>

<html>
<div id="content">
    <div id="signup_form">
        <form action="" method="post">
            <h2>Sign In</h2>
            <p>Please sign in with your unique user identifier</p>
            <table>
                <tr>
                    <td align="right">Identifier:</td>
                    <td><input type="text" name="user_ID" placeholder="Enter your id" required="required"/></td>
                </tr>
                <tr>
                    <td colspan="6">
                        <button name="sign_up">Sign In</button>
                    <td>
                </tr>
            </table>
        </form>
        <?php
        include("includes/connection.php");

        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if (isset($_POST['sign_up'])) {
            $user_payment_id = mysqli_real_escape_string($con, $_POST['user_ID']);

            $get_id = "select * from valid_user_id_list where user_id = '$user_payment_id'";
            $run_payment_id = mysqli_query($con, $get_id);
            $check_payment_id = mysqli_num_rows($run_payment_id);

            if ($check_payment_id == 0) {
                echo "<script>alert('Your ID has not been recognized.')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            }

            else {
                try {
                    createUser($user_payment_id);
                    $_SESSION['user_id'] = getUserID($user_payment_id);
                    echo "<script>alert('Welcome to the game!')</script>";
                    echo "<script>window.open('terms_and_conditions.php','_self')</script>";
                } catch (Exception $e) {
                    echo($e->getMessage());
                }
            }
        }

        function createUser($user_payment_id) {
            $get_id = "select * from users where user_payment_id = '$user_payment_id'";
            global $con;
            $run_id = mysqli_query($con, $get_id);
            $check_id = mysqli_num_rows($run_id);

            if ($check_id == 1) {
                echo("<script>console.log('User already exists')</script>");
            }
            elseif ($check_id == 0) {
                $sql = "INSERT INTO users(user_payment_id) VALUES ('$user_payment_id')";
                if (mysqli_query($con, $sql)) {
                    echo "<script>console.log('New record created successfully')</script>";
                }
                else {
                    throw new Exception("SQL Error");
                }
            }
            elseif ($check_id > 1) {
                throw new Exception("Serious error. Check user != 0 or 1");
            }


        }

        function getUserID($user_payment_id) {
            global $con;
            $sql_query = "select * from users where user_payment_id = '$user_payment_id'";
            $run_query = mysqli_query($con, $sql_query);
            $check_query = mysqli_num_rows($run_query);

            if ($check_query == 1) {
                while ($row = mysqli_fetch_array($run_query)) {
                    return $row["user_ID"];
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
        }

        ?>
    </div>
</div>
</html>

<?php
include("templates/footer.php");
?>