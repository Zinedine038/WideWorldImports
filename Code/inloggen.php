<!--
MOET FORMS EIGEN ID GEVEN WERKT DAAROM NU NIET
-->

<?php
    include "header.php";
    $postcode = "";
    $huisnummer="";
    $plaats="";
    /// Zet variabelen naar user input en haalt de eventuele spaties weg, maakt de postcode upper case
    if (isset($_GET["submit"])) {
        $postcode =  strtoupper(str_replace(" ","",$_GET["postcode"]));
        $huisnummer = trim($_GET["huisnummer"]);
        $plaats = trim($_GET["gemeentenaam"]);
    }

    if(isset($_GET["postcode"]) AND isset($_GET["huisnummer"])) {
        $resultaten = zoekadres($postcode,$huisnummer);
/// Controleerd of er resultaten gevonden zijn
        if($resultaten!=0) {
            $straat = $resultaten["straatnaam"];
            $plaats = $resultaten["gemeentenaam"];
        }
        else{
            print("Deze deze combinatie is niet gevonden!");
        }}
    ?>
    <div class="container">
    <h2>Account aanmaken</h2>

    <form action="inloggen.php" method="post">
        <form method="get" action="productpage.php">
        <div class="row" style="width: 90%; padding: 5%">

            <div class="col-md-6">

                <div class="form-group">
                <div class="form-group">
                    Voornaam
                    <input type="text" name="voornaam" placeholder="Typ hier je voornaam" class="form-control input-lg">
                </div>
                    <?php
                    print ($_GET["postcode"]);
                    ?>
                    <div class="form-group">
                        Tussenvoegsel
                        <input type="text" name="tussenvoegsel" placeholder="Typ hier je tussenvoegsel"
                               class="form-control input-lg">
                    </div>


                    <div class="form-group">
                        Achternaam
                        <input type="text" name="achternaam" placeholder="Typ hier je achternaam"
                               class="form-control input-lg">
                    </div>


                    <div class="form-group">
                        Email
                        <input type="text" name="email" placeholder="Typ hier je email-adres" class="form-control input-lg">
                    </div>

                    Wachtwoord
                    <div class="form-group">
                        <input type="text" name="wachtwoord" placeholder="Typ hier je wachtwoord"
                               class="form-control input-lg">
                    </div>
                </div>
            </div>



                <div class="col-md-6">
                Straatnaam
                <div class="form-group">
                    <input type="text" value="<?php print $plaats ?>" name="straatnaam" placeholder="Typ hier je Straatnaam" class="form-control input-lg">
                </div>



                Huisnummer
                <div class="form-group">
                    <input type="number" value="<?php print $huisnummer ?>" name="huisnummer" placeholder="Typ hier je Huisnummer" class="form-control input-lg">
                </div>


                Postcode
                <div class="form-group">
                    <input type="text" value="<?php print $postcode ?>"
                           name="postcode" placeholder="Typ hier je Postcode" class="form-control input-lg">
                </div>
                        <input type="submit" name="submit" value="Vul automatisch in" class="btn btn-secondary"><br>



                    Plaats
                    <div class="form-group">
                        <input type="text" value="<?php if(isset($plaats)) {print($plaats);}?>"
                               name="gemeentenaam" placeholder="Typ hier je Plaats" class="form-control input-lg">
                    </div>


                <div class="form-group checkbox custom-control custom-checkbox">

                    <input type="checkbox" class="custom-control-input" id="defaultUnchecked" name="Spam">
                    <label class="custom-control-label" for="defaultUnchecked">
                        Wil je platgegooit worden met spam?
                    </label>
                </div>
                    <div>
                        <input type="submit" name="verzenden" class="btn btn-primary">
                    </div>
        </form>
    </form>
            </div>
        </div>


    </div>



    <?php /*
    Gebruikersid auto
    Voornaam
    Achternaam
    Tussenvoegsel
    Straatnaam
    Huisnummer
    Postcode
    Stad
    Email-adres
    Wachtwoord
    NIEUWSSPAM? Ja of nee
    Date= Datum maken met functie insert into
    */
    include "footer.php";
    ?>
