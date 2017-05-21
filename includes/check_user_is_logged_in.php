<?php
function check_user_is_logged_in(){
    if (!(isset($_SESSION["user_id"]))) {
        echo("
                <script>
                alert('Illegal page access! You must login before you can play the game.');
                window.open('index.php','_self')
                </script>
                ");
        die();
    }
}