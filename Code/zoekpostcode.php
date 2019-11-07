<!DOCTYPE html>
<html lang="en">
<head>

    <?php
    /// Importeert functions en vangt onbestaande variabele error op
    include "functions.php";
    $postcode = "";
    $huisnummer="";
    /// Zet variabelen naar user input en haalt de eventuele spaties weg, maakt de postcode upper case
    if (isset($_GET["submit"])) {
        $postcode =  strtoupper(str_replace(" ","",$_GET["postcode"]));
        $huisnummer = trim($_GET["huisnummer"]);
    }
    ?>

    <meta charset="UTF-8">
    <title>$Title$</title>
</head>
<body>

<!-- Formuliertje --->
<form method="get">
    Postcode<br>
    <input type="text" name="postcode" value="<?php print $postcode ?>""><br>
    Huisnummer<br>
    <input type="number" name="huisnummer" value="<?php print $huisnummer ?>""><br>
    <input type="submit" name="submit" value="Submit">
</form>

<?php
/// Als zowel postcode als huisnummer zijn ingevuld roept hij de functie zoekadres() aan
if(isset($_GET["postcode"]) AND isset($_GET["huisnummer"])) {
$resultaten = zoekadres($postcode,$huisnummer);
/// Controleerd of er resultaten gevonden zijn
if($resultaten!=0) {
    $straat = $resultaten["straatnaam"];
    $plaats = $resultaten["gemeentenaam"];
    print("Straat: $straat<br>Plaats: $plaats");
}
else{
    print("Deze deze combinatie is niet gevonden!");

}}
        ?>
</body>
</html>