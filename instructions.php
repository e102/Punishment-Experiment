<!DOCTYPE html>
<html>
<?php include("templates/header.php"); ?>
<head>
    <title>Terms and Conditions</title>
    <link rel="stylesheet" href="styles/default.css" media="all"/>
</head>
<title>Instructions</title>

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
    beginning of the experiment you and all the other participants will be endowed with 20 ECU, which y0u can choose to
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
        total contribution of all 4 group members to the project.</li>
</ul>
<br>
<p>In total: payout = (20 - your contribution to the project) + 0.4*(total contributions to the project)</p>
<?php include("templates/footer.php") ?>
</html>
