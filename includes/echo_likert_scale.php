<?php
function echo_likert_scale($question, $scale_name) {
    echo("
    <label class='statement'>$question</label>
    <ul class='likert'>
        <li>
            <label><input type='radio' name='$scale_name' value='1'>Strongly disagree</label>
        </li>
        <li>
            <label><input type='radio' name='$scale_name' value='2'>Disagree</label>
        </li>
        <li>
            <label><input type='radio' name='$scale_name' value='3'>Neutral</label>
        </li>
        <li>
            <label><input type='radio' name='$scale_name' value='4'>Agree</label>
        </li>
        <li>
            <label><input type='radio' name='$scale_name' value='5' required='required'>Strongly agree</label>
        </li>
    </ul>
    ");
}