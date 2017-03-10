<!DOCTYPE html>
<html>
<?php include("templates/header.php"); ?>
<head>
    <title>Terms and Conditions</title>
    <link rel="stylesheet" href="styles/default.css" media="all"/>
</head>

<title>Instructions</title>

<body>
<h1>Instructions</h1>
<p>You are now entering the decision-making game, commonly referred to as the Public Goods Game, which will consist of
    one practice round and three parts. Every part will consist of three rounds in total and is a slightly different
    variation of the initial game. It is important that you read these instructions carefully as the decisions that you
    make in the experiment will affect which lottery you will be able to enter. Your total payoff for the experiment
    will be the results of one of the parts of the experiment chosen at random by the computer. In this experiment we
    use Experiment Currency Units (ECU’s) also referred to as tokens, which will be later transformed into payments
    according to the following rate:</p>

<p>10 ECU = 1£</p>

<p>You have been grouped with three other participants and will remain playing with them for the entirety of the game.
    They have been given the same instructions that you are reading now and play by exactly the same rules. In the
    beginning of the experiment you and all the other participants will be endowed with 20 ECU, which you can choose to
    either contribute to the Social Good, or keep for yourself. For every ECU contributed to the Social Good every
    participant will receive 0.4 ECU’s. That makes the social return of every contributed token equal to 4*0.4 = 1.6.
    Every token that has not been contributed to the social good remains at your disposal.</p>

<p>The number of the period appears in the top left corner of the screen. In the top right corner you can see how many
    more seconds remain for you to decide on the distribution of your points. Your decision must be made before the time
    displayed is 0 seconds, otherwise the programme will automatically contribute 0 to the Social Good. Your endowment
    in the beginning of each part is 20 ECUs. The amount of ECU in the next round depends on your decisions in the
    previous round. You have to decide how many points you want to contribute to the project by typing a number between
    0 and 20 in the input field. This field can be reached by clicking it with the mouse. As soon as you have decided
    how many points to contribute to the project, you have also decided how many ECUS you keep for yourself: this is (20
    - your contribution) ECUs. After entering your contribution you must press the O.K. button (either with the mouse,
    or by pressing the Enter - key). Once you have done this your decision can no longer be revised.</p>

<p>After all members of your group have made their decision the following income screen will show you the total amount
    of points contributed by all four group members to the project (including your contribution). Also this screen shows
    you how many ECUs you have earned at the first stage. The income for the other players will be calculated in the
    same way as yours.</p>

<p>Your income for the round will consist of:</p>
<ul>
    <li>the tokens which you have kept for yourself (“Income from ECU kept”);</li>
    <li>the “income from the project”. This income is calculated as follows: your income from the project = 0.4 x the
        total contribution of all 4 group members to the project.
    </li>
</ul>
<br>
<p>In total: payout = (20 - your contribution to the project) + 0.4*(total contributions to the project)</p>


<h1>Comprehension Quiz</h1>
<p>These questions are designed to check if you have understood the instructions. The programme will not allow you to
    continue to the start of the game unless of the questions have been answered correctly.</p>

<form name="comprehension_quiz" action="" method="post">
    <h4>Round 1</h4>
    <p> In round 1, you contribute 20 ECU’s to the Social Good. The other participants contribute 0.</p>
    <p> What is your total payoff for round 1?</p>
    <input type="radio" name="question_1" value="1"><label for="1">1</label><br>
    <input type="radio" name="question_1" value="5"><label for="5">5</label><br>
    <input type="radio" id="question_1_correct_answer" name="question_1" value="8"><label for="8">8</label><br>
    <input type="radio" name="question_1" value="14"><label for="14">12</label><br>
    <input type="radio" name="question_1" value="20"><label for="20">20</label><br>

    <p>What is the <b>other participants</b> total payoff for round 1?</p>
    <input type="radio" name="question_2" value="0"><label for="0">0</label><br>
    <input type="radio" name="question_2" value="14"><label for="14">14</label><br>
    <input type="radio" name="question_2" value="20"><label for="20">20</label><br>
    <input type="radio" id = "question_2_correct_answer" name="question_2" value="28"><label for="28">28</label><br>
    <input type="radio" name="question_2" value="32"><label for="32">32</label><br>

    <h4>Round 2</h4>
    <p> In round 2, you contribute 20 ECU’s to the Social Good. The other 3 players also contribute
        20 ECU’s. What is <b>your</b> total payoff for round 2?</p>
    <input type="radio" name="question_3" value="1"><label for=">1">1</label><br>
    <input type="radio" name="question_3" value="11"><label for="11">11</label><br>
    <input type="radio" id = "question_3_correct_answer" name="question_3" value="32"><label for="32">32</label><br>
    <input type="radio" name="question_2" value="38"><label for="38">38</label><br>
    <input type="radio" name="question_3" value="40"><label for="40">40</label><br>

    <h4>Round 3</h4>
    <p>In round 3, you contribute 4 ECU’s to the Social Good, player Green contributes 0,
        player Red contributes 8 and player Blue contributes 20. What is <b>your</b> total payoff for round 3?.</p>
    <input type="text" id="question_4"><label>ECU's</label>
    <p>What is Blue's total payoff for round 3?</p>
    <input type="text" id="question_5"><label>ECU's</label>
    <p>What is Red's total payoff for round 3?</p>
    <input type="text" id="question_6"><label>ECU's</label>
    <p>What is the total payoff of Green for this round? (answer: 28).</p>
    <input type="text" id="question_7"><label>ECU's</label>
    <div></div>
    <button onclick="submit_quiz()">Submit</button>
</form>

<script>
    function submit_quiz() {
        if (validate_answers() == true) {
            alert("Answers correct");
        }
        else {
            alert("Answers incorrect. Please try again");
        }
    }

    function validate_answers() {
        var question_1_answer = document.getElementById('question_1_correct_answer').checked;
        var question_2_answer = document.getElementById('question_2_correct_answer').checked;
        var question_3_answer = document.getElementById('question_3_correct_answer').checked;
        var question_4_answer = document.getElementById('question_4').value;
        console.log(question_4_answer);
        var question_5_answer = document.getElementById('question_5').value;
        var question_6_answer = document.getElementById('question_6').value;
        var question_7_answer = document.getElementById('question_7').value;

        return question_1_answer && question_2_answer && question_3_answer && (question_4_answer == 24) && (question_5_answer == 8) && (question_6_answer == 20) && (question_7_answer == 28);
    }
</script>
</body>
<?php include("templates/footer.php") ?>
</html>
