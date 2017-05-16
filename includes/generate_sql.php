<?php
function generate_sql($field, $value, $userID){
    return "UPDATE users SET $field = '$value' WHERE user_id =$userID;";
}