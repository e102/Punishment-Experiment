<?php
function determine_AI_type($AI_number) {
    if ($AI_number == 2) {
        return "lazy";
    }
    elseif ($AI_number == 3) {
        return "normal";
    }
    elseif ($AI_number == 4) {
        return "mean";
    }
    else {
        throw new Exception("Player number not recognized!");
    }
}