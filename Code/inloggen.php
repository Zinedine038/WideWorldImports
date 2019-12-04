<!--
MOET FORMS EIGEN ID GEVEN WERKT DAAROM NU NIET
-->

<?php
    include "header.php";
    $postcode="";
    $huisnummer="";
    $plaats="";

 if (isset($_GET["huisnummer"]) || isset($_GET["postcode"])) {
        /// Zet variabelen naar user input en haalt de eventuele spaties weg, maakt de postcode upper case
        $postcode = strtoupper(str_replace(" ", "", $_GET["postcode"]));
        $huisnummer = trim($_GET["huisnummer"]);
    }

if (isset($_GET["submit"])) {
    if ($postcode == "" || $huisnummer == "") {
        print("<h1 style='color: red; text-align: center; background-color: #00fafa'>Geef je huisnummer en postcode!</h1>");
    }
}

if  ($postcode!="" && $huisnummer!="") {
    $resultaten = zoekadres($postcode,$huisnummer);
/// Controleerd of er resultaten gevonden zijn
    if($resultaten!=0) {
        $straat = $resultaten["straatnaam"];
        $straat="$straat $huisnummer";
        $plaats = $resultaten["gemeentenaam"];
    }
    else{
        print("<h1 style='color: red; text-align: center; background-color: #00fafa'>Adres niet gevonden, geef een geldige postcode en huisnummer op!</h1>");
        //error, wordt al weergeven bij bovenstaande functie.
    }}





    ?>
    <div class="container">
    <h2>Account aanmaken</h2>

        <form action="inloggen.php" method="get">
            Huisnummer
            <div class="form-group">
                <input type="number" value="<?php if (isset ($huisnummer)) {print $huisnummer;}?>" name="huisnummer" placeholder="Typ hier je Huisnummer" class="form-control input-lg" required>
            </div>


            Postcode
            <div class="form-group">
                <input type="text" value="<?php if (isset ($postcode)) {print $postcode;} ?>"
                       name="postcode" placeholder="Typ hier je Postcode" class="form-control input-lg" required>
            </div>
            <input type="submit" name="submit" value="Vul automatisch in" class="btn btn-secondary">
        <br>
        </form>
    <form action="verzenden.php" method="get">
        <form method="get" action="productpage.php">
        <div class="row" style="width: 90%; padding: 5%">

            <div class="col-md-6">

                <div class="form-group">
                <div class="form-group">
                    Voornaam
                    <input type="text" name="voornaam" placeholder="Typ hier je voornaam"
                           class="form-control input-lg" required>
                </div>

                    <div class="form-group">
                        Tussenvoegsel
                        <input type="text" name="tussenvoegsel" placeholder="Typ hier je tussenvoegsel"
                               class="form-control input-lg">
                    </div>


                    <div class="form-group">
                        Achternaam
                        <input type="text" name="achternaam" placeholder="Typ hier je achternaam" required
                               class="form-control input-lg">
                    </div>


                    <div class="form-group">
                        Email
                        <input type="text" name="email" placeholder="Typ hier je email-adres" required
                               class="form-control input-lg">
                    </div>

                    Wachtwoord
                    <div class="form-group">
                        <input title="Wachtwoord moet minimaal uit 8 tekens bestaan, en moet 1 hoofdletter, kleine letter, cijfer en ander karakter bevatten!" type="password" name="wachtwoord" placeholder="Typ hier je wachtwoord" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                               class="form-control input-lg">
                    </div>
                </div>
            </div>



                <div class="col-md-6">
                Straatnaam
                <div class="form-group">
                    <input type="text" value="<?php if (isset ($straat)) {print $straat;}?>" name="straatnaam" placeholder="Typ hier je Straatnaam" readonly
                           class="form-control input-lg">
                </div>


                    Plaats
                    <div class="form-group">
                        <input type="text" value="<?php if(isset($plaats)) {print($plaats);}?>"
                               name="gemeentenaam" placeholder="Typ hier je Plaats" readonly
                               class="form-control input-lg">
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
