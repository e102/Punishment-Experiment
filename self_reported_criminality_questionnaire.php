<!DOCTYPE html>
<html>
<?php
include("templates/header.php");
include("includes/connection.php");
session_start();

include("templates/bootstrap_head.php");
echo_head("Criminality Questionnaire");

include_once("includes/Authenticator.php");
authenticator::authenticate_access("self_reported_criminality_questionnaire.php", "final_results.php");
?>

<body>
<div class="container-fluid">
    <h4>Criminality Questionnaire</h4>
    <form action="" method="post">
        <?php
        generate_questionnaire();
        ?>
        <br><br>
        <button name="submit" class="btn btn-default">Submit</button>
    </form>
</div>
</body>
<?php
if (isset($_POST['submit'])) {
    $userID = $_SESSION["user_id"];

    $shoplifted = htmlspecialchars($_POST['shoplifted']);
    $burglary_residential = htmlspecialchars($_POST['burglary_residential']);
    $burglary_non_residential = htmlspecialchars($_POST['burglary_non_residential']);
    $burglary_car = htmlspecialchars($_POST['burglary_car']);
    $theft = htmlspecialchars($_POST['theft']);
    $auto_theft = htmlspecialchars($_POST['auto_theft']);
    $vandalism = htmlspecialchars($_POST['vandalism']);
    $arson = htmlspecialchars($_POST['arson']);
    $robbery = htmlspecialchars($_POST['robbery']);
    $assault = htmlspecialchars($_POST['assault']);
    $traffic_offense = htmlspecialchars($_POST['traffic_offense']);
    $bought_or_given_stolen_property = htmlspecialchars($_POST['bought_or_given_stolen_property']);
    $fraud = htmlspecialchars($_POST['fraud']);
    $tried_drugs = htmlspecialchars($_POST['tried_drugs']);
    $sold_drugs = htmlspecialchars($_POST['sold_drugs']);
    $raped_someone = htmlspecialchars($_POST['raped_someone']);

    include_once "includes/generate_sql.php";
    $sql = generate_sql("shoplifted", $shoplifted, $userID);
    $sql .= generate_sql("burglary_residential", $burglary_residential, $userID);
    $sql .= generate_sql("burglary_non_residential", $burglary_non_residential, $userID);
    $sql .= generate_sql("burglary_car", $burglary_car, $userID);
    $sql .= generate_sql("theft", $theft, $userID);
    $sql .= generate_sql("auto_theft", $burglary_residential, $userID);
    $sql .= generate_sql("vandalism", $vandalism, $userID);
    $sql .= generate_sql("arson", $arson, $userID);
    $sql .= generate_sql("robbery", $robbery, $userID);
    $sql .= generate_sql("assault", $assault, $userID);
    $sql .= generate_sql("traffic_offense", $traffic_offense, $userID);
    $sql .= generate_sql("bought_or_given_stolen_property", $bought_or_given_stolen_property, $userID);
    $sql .= generate_sql("fraud", $fraud, $userID);
    $sql .= generate_sql("tried_drugs", $tried_drugs, $userID);
    $sql .= generate_sql("sold_drugs", $sold_drugs, $userID);
    $sql .= generate_sql("raped_someone", $raped_someone, $userID);

    if (mysqli_multi_query($con, $sql)) {
        echo("<script>window.open('comprehension_questionnaire.php', '_self')</script>");
    }
    else {
        echo("<script>alert('Could not connect to server')</script>");
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}

function generate_questionnaire() {
    echo "<p>How many times in the past 12 months have you:</p>";
    echo_question("stolen anything from a shop (for example, a CD, clothes, cosmetics or any other things).", "shoplifted");
    echo_question("broken into someone’s house or flat to steal something.", "burglary_residential");
    echo_question("broken into a non-residential building to steal something (for example, broken into a shop, school, warehouse, office).", "burglary_non_residential");
    echo_question("broken into a car to steal something.", "burglary_car");
    echo_question("not counting the events in which you broke into a car, house or non-residential building or shoplifted, have you something from another person (for example, money, a mobile telephone, a bicycle, a wallet or a purse, a handbag, jewelry, a watch).", "theft");
    echo_question("stolen a car.", "auto_theft");
    echo_question("damaged or destroyed things not belonging to you for fun or because you were bored or angry (for example, smashed windows or street lights, scratched the paint off cars, sprayed graffiti on a wall, damaged a bicycle).", "vandalism");
    echo_question("set fire to something you were not supposed to set fire to (for example, started a fire in a school/college/university, started a fire in an empty building, set fire to a house, started a fire in a playground, started a fire in a wood).", "arson");
    echo_question("used a weapon, hit or threatened to hurt someone, to take money or other things from them.", "robbery");
    echo_question("not counting events when you took money or other things from someone, beaten up or hit someone (for example punched, stabbed, kicked or head-butted someone). ", "assault");
    echo_question("committed a traffic offense such as speeding, driving without insurance, etc...", "traffic_offense");
    echo_question("bought, or been given/passed on stolen property (for example, handling, buying, or helping to sell stolen goods).", "bought_or_given_stolen_property");

    echo_question("comitted fraud, such as evading tax, pretending to be someone else, or using/creating false documents?", "fraud");
//    echo_question("evaded tax (e.g. not paying income tax when being paid cash-in-hand).", "tax_evasion");
//    echo_question("used stolen debit/credit cards.", "stolen_cards");
//    echo_question("pretended to be somebody else (e.g. using a stolen ID).", "impersonation");
//    echo_question("obtained goods through deception (e.g. items from work without permission).", "goods_by_deception");
//    echo_question("falsified documents (e.g. producing/selling fake ID cards, passports etc.).", "falsified_documents");

    echo_question("tried drugs (cannabis, amphetamines, ecstasy, heroin, cocaine, crack, LSD, GBH, crystal meth, tranquilisers, magic mushrooms).", "tried_drugs");
    echo_question("sold drugs (cannabis, amphetamines, ecstasy, heroin, cocaine, crack, LSD, GBH, crystal meth, tranquilisers, magic mushrooms).", "sold_drugs");
    echo_question("had sex with someone without their active consent.", "raped_someone");
}

function echo_question($question_text, $question_name) {
    echo("
    <label>$question_text<br>
    <input type = 'number' name='$question_name' required = 'required' min='0'>
    </label>
    <br><br>
    ");
}

include("templates/footer.php") ?>
</html>
