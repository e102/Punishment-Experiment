<!DOCTYPE html>
<?php
session_start();
include("templates/header.php");
include("includes/connection.php");
include("templates/bootstrap_head.php");
echo_head("login");
?>
<body>
<div class="container-fluid">
    <h2>Sign In</h2>
    <form action="" method="post" class="form-vertical">
        <div class="form-group">
            <label>User Identifier:</label>
            <input type="text" class="form-control" name="user_ID" placeholder="Enter your id"
                   required="required"/>
            <button name="sign_up" class="btn btn-default">Sign In</button>
        </div>
    </form>
</div>
</body>
</html>

<?php
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
    }
    else {
        try {
            if (!check_user_exists($user_payment_id)) {
                createUser($user_payment_id);
            }
            $_SESSION['user_id'] = getUserID($user_payment_id);
            $_SESSION["current_page"] = "index.php";
            echo "<script>window.open('terms_and_conditions.php','_self')</script>";
        } catch (Exception $e) {
            echo($e->getMessage());
        }
    }
}

function createUser($user_payment_id) {
    global $con;

    $sql_create_user = "INSERT INTO users(user_payment_id) VALUES ('$user_payment_id')";
    if (mysqli_query($con, $sql_create_user)) {
        echo "<script>console.log('First time logging in. New user profile created successfully')</script>";
    }
    else {
        throw new Exception(mysqli_error($con));
    }

    $payment_condition = rand(0, 1);
    echo "<script>console.log('payment condition = $payment_condition')</script>";
    $sql_update_payment_condition = "UPDATE users SET paid_based_on_ECU = '$payment_condition' WHERE user_payment_id = '$user_payment_id'";
    if (mysqli_query($con, $sql_update_payment_condition)) {
        echo "<script>console.log('Payment condition created successfully')</script>";
    }
    else {
        throw new Exception(mysqli_error($con));
    }
}

function check_user_exists($user_payment_id) {
    $get_id = "select * from users where user_payment_id = '$user_payment_id'";
    global $con;
    $run_id = mysqli_query($con, $get_id);
    $check_id = mysqli_num_rows($run_id);

    if ($check_id == 1) {
        return true;
    }
    elseif ($check_id == 0) {
        return false;
    }
    else {
        throw new Exception("more than 1 user with that payment id found in database");
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

include("templates/footer.php");
?>