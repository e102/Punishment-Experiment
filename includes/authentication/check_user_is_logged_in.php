<?php
function check_user_is_logged_in(){
    if (isset($_SESSION["user_id"])) {
        return true;
    }
    else{
        return false;
    }
}