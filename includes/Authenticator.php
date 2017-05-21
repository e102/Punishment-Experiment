<?php

class authenticator {
    public static function authenticate_access($this_page_name, $previous_page_name) {
        if (self::check_referring_page_is_valid($this_page_name, $previous_page_name, $_SESSION["current_page"]) && self::check_user_is_logged_in()) {
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

    private static function check_referring_page_is_valid($expected_referring_page_1, $expected_referring_page_2, $actual_referring_page) {
        if ($actual_referring_page == $expected_referring_page_1 || $actual_referring_page == $expected_referring_page_2) {
            return true;
        }
        else {
            return false;
        }
    }

    private static function check_user_is_logged_in() {
        if (isset($_SESSION["user_id"])) {
            return true;
        }
        else {
            return false;
        }
    }
}