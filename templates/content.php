<!DOCTYPE html>
<html>
<div id="content">
    <div id="signup_form">
        <form action="" method="post">
            <h2>Sign Up</h2>
            <p>Please sign in with your unique user identifier</p>
            <table>
                <tr>
                    <td align="right">Identifier:</td>
                    <td><input type="text" name="user_ID" placeholder="Enter your id" required="required"/></td>
                </tr>
                <tr>
                    <td colspan="6">
                        <button name="sign_up">Sign Up</button>
                    <td>
                </tr>
            </table>
        </form>
        <?php
        include("includes/connection.php");
        if (isset($_POST['sign_up'])) {
            $user_id = mysqli_real_escape_string($con, $_POST['user_ID']);

            $get_id = "select * from valid_user_id_list where user_id = '$user_id'";
            $run_id = mysqli_query($con, $get_id);
            $check_id = mysqli_num_rows($run_id);

            if ($check_id == 0) {
                echo "<script>alert('Your ID has not been recognized.')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            }

            else {
                $_SESSION["user_id"] = $user_id;
                echo "<script>alert('Registration successful!')</script>";
                echo "<script>window.open('home.php','_self')</script>";
            }
        }
        ?>
    </div>
</div>
</html>