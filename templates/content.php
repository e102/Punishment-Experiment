<!DOCTYPE html>
<html>
<div id="content">
    <div id="signup_form">
        <form action="" method="post">
            <h2>Sign Up</h2>
            <table>
                <tr>
                    <td align="right">Name:</td>
                    <td><input type="text" name="user_name" placeholder="Enter Your Name" required="required"/></td>
                </tr>
                <tr>
                    <td align="right">Password:</td>
                    <td><input type="text" name="user_password" placeholder="Enter your password"
                               required="required"/></td>
                </tr>
                <tr>
                    <td align="right">Email</td>
                    <td><input type="email" name="user_email" placeholder="Enter your email" required="required"/>
                    </td>
                </tr>
                <tr>
                    <td align="right">Country</td>
                    <td>
                        <select name="user_country" required="required" selected value="">
                            <option value="">Select A Country</option>
                            <?php
                            foreach ($countries as $country) {
                                echo('<option value="' . $country . '">' . $country . '</option>');
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right">Gender</td>
                    <td>
                        <select name="user_gender" required="required">
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <button name="sign_up">Sign Up</button>
                    <td>
                </tr>
            </table>
        </form>
        <?php
        include 'user_insert.php';
        ?>
    </div>
</div>
</html>