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
    $driven_on_mobile = htmlspecialchars($_POST['driven_on_mobile']);
    $driven_through_red = htmlspecialchars($_POST['driven_through_red']);
    $speeding_residential = htmlspecialchars($_POST['speeding_residential']);
    $speeding_motorway = htmlspecialchars($_POST['speeding_motorway']);
    $drink_driving = htmlspecialchars($_POST['drink_driving']);
    $driving_without_a_licence = htmlspecialchars($_POST['driving_without_a_licence']);
    $driving_without_MOT = htmlspecialchars($_POST['driving_without_MOT']);
    $driving_without_insurance = htmlspecialchars($_POST['driving_without_insurance']);
    $driving_without_tax = htmlspecialchars($_POST['driving_without_tax']);
    $driving_without_permission = htmlspecialchars($_POST['driving_without_permission']);
    $bought_or_given_stolen_property = htmlspecialchars($_POST['bought_or_given_stolen_property']);
    $tax_evasion = htmlspecialchars($_POST['tax_evasion']);
    $stolen_cards = htmlspecialchars($_POST['stolen_cards']);
    $impersonation = htmlspecialchars($_POST['impersonation']);
    $goods_by_deception = htmlspecialchars($_POST['goods_by_deception']);
    $falsified_documents = htmlspecialchars($_POST['falsified_documents']);
    $tried_drugs = htmlspecialchars($_POST['tried_drugs']);
    $sold_drugs = htmlspecialchars($_POST['sold_drugs']);
    $raped_someone = htmlspecialchars($_POST['raped_someone']);

    include_once "includes/generate_sql.php";
    $sql = generate_sql("shoplifted",$shoplifted, $userID);
    $sql .= generate_sql("burglary_residential", $burglary_residential, $userID);
    $sql .= generate_sql("burglary_non_residential", $burglary_non_residential, $userID);
    $sql .= generate_sql("burglary_car", $burglary_car, $userID);
    $sql .= generate_sql("theft", $theft, $userID);
    $sql .= generate_sql("auto_theft", $burglary_residential, $userID);
    $sql .= generate_sql("vandalism", $vandalism, $userID);
    $sql .= generate_sql("arson", $arson, $userID);
    $sql .= generate_sql("robbery", $robbery, $userID);
    $sql .= generate_sql("assault", $assault, $userID);
    $sql .= generate_sql("driven_on_mobile", $driven_on_mobile, $userID);
    $sql .= generate_sql("driven_through_red", $driven_through_red, $userID);
    $sql .= generate_sql("speeding_motorway", $speeding_motorway, $userID);
    $sql .= generate_sql("drink_driving", $drink_driving, $userID);
    $sql .= generate_sql("driving_without_a_licence", $driving_without_a_licence, $userID);
    $sql .= generate_sql("driving_without_MOT", $driving_without_MOT, $userID);
    $sql .= generate_sql("driving_without_insurance", $driving_without_insurance, $userID);
    $sql .= generate_sql("driving_without_tax", $driving_without_tax, $userID);
    $sql .= generate_sql("driving_without_permission", $driving_without_permission, $userID);
    $sql .= generate_sql("bought_or_given_stolen_property", $bought_or_given_stolen_property, $userID);
    $sql .= generate_sql("tax_evasion", $tax_evasion, $userID);
    $sql .= generate_sql("stolen_cards", $stolen_cards, $userID);
    $sql .= generate_sql("impersonation", $impersonation, $userID);
    $sql .= generate_sql("goods_by_deception", $goods_by_deception, $userID);
    $sql .= generate_sql("falsified_documents", $falsified_documents, $userID);
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
    echo_question("Not counting the events in which you broke into a car, house or non-residential building or shoplifted, have you something from another person (for example, money, a mobile telephone, a bicycle, a wallet or a purse, a handbag, jewelry, a watch).", "theft");
    echo_question("stolen a car.", "auto_theft");
    echo_question("damaged or destroyed things not belonging to you for fun or because you were bored or angry (for example, smashed windows or street lights, scratched the paint off cars, sprayed graffiti on a wall, damaged a bicycle).", "vandalism");
    echo_question("set fire to something you were not supposed to set fire to (for example, started a fire in a school/college/university, started a fire in an empty building, set fire to a house, started a fire in a playground, started a fire in a wood).", "arson");
    echo_question("used a weapon, hit or threatened to hurt someone, to take money or other things from them.", "robbery");
    echo_question("Not counting events when you took money or other things from someone, beaten up or hit someone (for example punched, stabbed, kicked or head-butted someone). ", "assault");
    echo_question("driven while talking on mobile phone.", "driven_on_mobile");
    echo_question("driven through a red light.", "driven_through_red");
    echo_question("been speeding through a residential area (above 30 mph).", "speeding_residential");
    echo_question("been speeding on a motorway (above 70 mph).", "speeding_motorway");
    echo_question("been drink-driving (driving whilst likely to be over the legal blood-alcohol limit).", "drink_driving");
    echo_question("driven a car with no driving licence.", "driving_without_a_licence");
    echo_question("driven your own car with no MOT.", "driving_without_MOT");
    echo_question("driven your own car with no insurance.", "driving_without_insurance");
    echo_question("driven your car with no car tax.", "driving_without_tax");
    echo_question("driven a car without the owner’s permission.", "driving_without_permission");
    echo_question("bought, or been given/passed on stolen property. (For example, handling, buying, or helping to sell stolen goods).", "bought_or_given_stolen_property");
    echo_question("evaded tax (e.g. not paying income tax when being paid cash-in-hand).", "tax_evasion");
    echo_question("used stolen debit/credit cards.", "stolen_cards");
    echo_question("pretended to be somebody else (e.g. using a stolen ID).", "impersonation");
    echo_question("obtained goods through deception (e.g. items from work without permission).", "goods_by_deception");
    echo_question("falsified documents (e.g. producing/selling fake ID cards, passports etc.).", "falsified_documents");
    echo_question("tried drugs (cannabis, amphetamines, ecstasy, heroin, cocaine, crack, LSD, GBH, crystal meth, tranquilisers, magic mushrooms).", "tried_drugs");
    echo_question("sold drugs (cannabis, amphetamines, ecstasy, heroin, cocaine, crack, LSD, GBH, crystal meth, tranquilisers, magic mushrooms).", "sold_drugs");
    echo_question("forced anyone into having sex.", "raped_someone");
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