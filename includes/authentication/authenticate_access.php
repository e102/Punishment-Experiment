<?php
function authenticate_access($this_page_name, $previous_page_name) {
    include("check_referring_page_is_valid.php");
    include("check_user_is_logged_in.php");
    if (check_referring_page_is_valid($this_page_name, $previous_page_name, $_SESSION["current_page"]) && check_user_is_logged_in()) {
        $_SESSION["current_page"] = $this_page_name;
    }
    else {
        echo("
                <script>
                alert('Illegal page access!');
                window.open('index.php','_self')
                </script>
                ");
        die();
    }
}