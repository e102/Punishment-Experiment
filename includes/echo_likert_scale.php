<?php
function echo_likert_scale($question, $scale_name){
    echo("
    <label class='statement'>$question</label>
    <ul class='likert'>
      <li>
        <input type='radio' name='$scale_name' value='5' required='required'>
        <label>Strongly agree</label>
      </li>
      <li>
        <input type='radio' name='$scale_name' value='4'>
        <label>Agree</label>
      </li>
      <li>
        <input type='radio' name='$scale_name' value='3'>
        <label>Neutral</label>
      </li>
      <li>
        <input type='radio' name='$scale_name' value='2'>
        <label>Disagree</label>
      </li>
      <li>
        <input type='radio' name='$scale_name' value='1'>
        <label>Strongly disagree</label>
      </li>
    </ul>
    ");
}