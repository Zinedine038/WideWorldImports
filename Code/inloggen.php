<?php
// Zet de header in de pagina en intialiseert en prepareert variabelen.
    include "header.php";
    $postcode="";
    $huisnummer="";
    $plaats="";
    $straat="";
    $voornaam="";
    $achternaam="";
    $email="";
    $wachtwoord="";
    $spam="";



if (isset($_POST["voornaam"])) {
    $voornaam=$_POST["voornaam"];
}
if (isset($_POST["tussenvoegsel"])) {
    $tussenvoegsel=$_POST["tussenvoegsel"];
}
if (isset($_POST["achternaam"])) {
    $achternaam=$_POST["achternaam"];
}
if (isset($_POST["email"])) {
    $email=$_POST["email"];
}
if (isset($_POST["wachtwoord"])) {
    $wachtwoord=$_POST["wachtwoord"];
}

if (isset($_POST["spam"])) {
    if ($_POST["spam"]==true) {
        $spam = 1;
    } else {
        $spam=0;
    }
}


if (isset($_POST["huisnummer"]) || isset($_POST["postcode"])) {
        /// Zet variabelen naar user input en haalt de eventuele spaties weg, maakt de postcode upper case
        $postcode = strtoupper(str_replace(" ", "", $_POST["postcode"]));
        $huisnummer = trim($_POST["huisnummer"]);
        $huisnummertoe=strtoupper($_POST["huisnummertoe"]);
    }

if (isset($_POST["submit"])) {
    if ($postcode == "" || $huisnummer == "") {
        print("<h1 style='color: red; text-align: center; background-color: #00fafa'>Geef je huisnummer en postcode!</h1>");
    }
}

if  ($postcode!="" && $huisnummer!="") {
    $resultaten = zoekadres($postcode,$huisnummer);
/// Controleerd of er resultaten gevonden zijn
    if($resultaten!=0) {
        $straat = $resultaten["straatnaam"];
        $plaats = $resultaten["gemeentenaam"];
    }
    else{
        // Geeft foutmelding bij ongeldige postcode en huisnummer.
        print("<h1 style='color: red; text-align: center; background-color: #00fafa'>Adres niet gevonden, geef een geldige postcode en huisnummer op!</h1>");
    }}

    ?>

<?php

// Voert alleen de gegevens in de database als alles is in gevuld en er op de verzend-knop gedrukt is.

if (isset($_POST["voornaam"]) && isset($_POST["achternaam"]) && isset($_POST["email"]) && isset($_POST["wachtwoord"]) && isset($_POST["huisnummer"]) && ($_POST["huisnummer"]!="") && isset($_POST["postcode"]) && ($_POST["postcode"]!="") && isset($_POST["straatnaam"]) && ($_POST["straatnaam"]!="") && isset($_POST["plaats"]) && ($_POST["plaats"]!="") && isset($_POST["verzenden"]))
{
    if (isset($_POST["huisnummertoe"])) {
        $huisnummertoevoeg= $_POST["huisnummertoe"];
    } else {
        $huisnummertoevoeg="";
    }

    if (isset($_POST["tussenvoegsel"])) {
        $tussenvoegseltoevoeg=$_POST["tussenvoegsel"];
    } else {
        $tussenvoegseltoevoeg="";
    }
        if (isset($_POST["spam"])) {
            $spam=true;
        } else {
            $spam=false;
        }

    // Zet resultaat van de databasefuncties in variabele en controlleert deze vervolgens om te kijken bij het toevoegen van een klant of deze actie gelukt is.
    // Zo niet geeft het een errormelding terug.

    $succes = VoegKlantToe($_POST["voornaam"], $_POST["achternaam"], $tussenvoegseltoevoeg, $_POST["straatnaam"], $_POST["huisnummer"], $huisnummertoevoeg ,$_POST["postcode"], $_POST["plaats"], $_POST["email"], $_POST["wachtwoord"], $spam);
    if($succes) {
        print("<h1 style='color: red; text-align: center; background-color: #00fafa'>Account is succesvol aangemaakt!</h1>");
        $URL="inlogpagina.php";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
        die();
    } else{
        print("<h1 style='color: red; text-align: center; background-color: #00fafa'>Error: Er bestaat al een account met dit emailadres</h1>");
    }



} elseif (isset($_POST["verzenden"])) {
    print("<h1 style='color: red; text-align: center; background-color: #00fafa'><h1>Error: vul alle velden in!</h1>");
}

?>

    <div class="container">
    <h2>Account aanmaken</h2>

        <div class="row" style="width: 90%; padding: 5%">

            <div class="col-md-6">



        <!-- Formulier voor het aanmaken van een account inclusief alle NAW-gegevens. -->

    <form action="inloggen.php" method="post" onsubmit="return formKlopt();">





                <div class="form-group">
                    Voornaam
                    <input type="text" name="voornaam" placeholder="Typ hier je voornaam" required id="voornaam"
                           class="form-control input-lg" value="<?php if (isset($voornaam)) {print $voornaam;}?>">
                </div>

                    <div class="form-group">
                        Tussenvoegsel
                        <input type="text" name="tussenvoegsel" placeholder="Typ hier je tussenvoegsel" id="tussenvoegsel"
                               class="form-control input-lg" value="<?php if (isset($tussenvoegsel)) {print $tussenvoegsel;}?>">
                    </div>


                    <div class="form-group">
                        Achternaam
                        <input type="text" name="achternaam" placeholder="Typ hier je achternaam" required id="achternaam"
                               class="form-control input-lg" value="<?php if (isset($achternaam)) {print $achternaam;}?>">
                    </div>


                    <div class="form-group">
                        Email
                        <input type="email" name="email" placeholder="Typ hier je email-adres" required id="email"
                               class="form-control input-lg" value="<?php if (isset($email)) {print $email;}?>">
                    </div>

                    Wachtwoord
                    <div class="form-group">
                        <input type="password" name="wachtwoord" placeholder="Typ hier je wachtwoord" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                               class="form-control input-lg" id="wachtwoord"
                               onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Wachtwoord moet minimaal uit 8 tekens bestaan, en moet 1 hoofdletter, kleine letter, cijfer en ander karakter bevatten!' : ''); if(this.checkValidity()) form.bevestig_ww.pattern = this.value;"
                        />

                    </div>
                    Bevestig wachtwoord
                    <div class="form-group">
                        <input placeholder="Bevestig het wachtwoord" class="form-control input-lg"
                               title="Vul het wachtwoord hetzelfde als hierboven in!" type="password" id="bevestig_ww" name="bevestig_ww" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                               onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Vul het wachtwoord hetzelfde als hierboven in!' : '');"
                               required
                        />
                    </div>




        <div class="form-group checkbox custom-control custom-checkbox">

            <input type="checkbox" class="custom-control-input checkboxbericht" id="defaultUnchecked" name="spam" <?php if ($spam==1){print("checked");}?>>
            <label class="custom-control-label" for="defaultUnchecked">
                Wil je platgegooit worden met spam?
            </label>
        </div>

        <!-- Onzichtbare tabel voor synchroniseren postcodeinfo -->

        <input style="display: none" name="huisnummer" type="text" id="huisnummer2" value="<?php print($huisnummer); ?>">
        <input style="display: none" name="postcode" type="text" id="postcode2" value="<?php print($postcode); ?>">
        <input style="display: none" name="huisnummertoe" type="text" id="huisnummertoe2" value="<?php if (isset($huisnummertoe)) { print($huisnummertoe);} ?>">
        <input style="display: none" name="straatnaam" type="text" id="straatnaam2" value="<?php print($straat); ?>">
        <input style="display: none" name="plaats" type="text" id="plaats2" value="<?php print($plaats); ?>">
        <div>
            <input type="submit" name="verzenden" class="btn btn-primary">
        </div>
    </form>
</div>





                <div class="col-md-6">

                    <!-- Formulier voor postcode en postcode informatie (huisnummer, huisnummertoevoegingen, straatnaam en plaats. -->

                    <form onsubmit="formVul()" action="inloggen.php" method="post">
                        Postcode
                        <div class="form-group">
                            <input type="text" value="<?php if (isset ($postcode)) {print $postcode;} ?>"
                                   name="postcode" placeholder="Typ hier je Postcode" class="form-control input-lg" required>
                        </div>
                        Huisnummer
                        <div class="form-group">
                            <input type="number" value="<?php if (isset ($huisnummer)) {print $huisnummer;}?>" name="huisnummer" placeholder="Typ hier je Huisnummer" class="form-control input-lg" required>
                        </div>


                        Huisnummertoevoegingen
                        <div class="form-group">
                            <input type="text" maxlength="3" value="<?php if (isset ($huisnummertoe)) {print $huisnummertoe;}?>" name="huisnummertoe" placeholder="Typ hier je Huisnummer toevoeging" class="form-control input-lg">
                        </div>


                            Straatnaam
                            <div class="form-group">
                                <input type="text" value="<?php if (isset ($straat)) {print $straat;}?>" name="straatnaam" placeholder="Typ hier je Straatnaam" readonly
                                       class="form-control input-lg">
                            </div>


                            Plaats
                            <div class="form-group">
                                <input type="text" value="<?php if(isset($plaats)) {print($plaats);}?>"
                                       name="plaats" placeholder="Typ hier je Plaats" readonly
                                       class="form-control input-lg">
                            </div>
                        <input type="submit" name="submit" value="Vul automatisch in" class="btn btn-secondary">

                        <br>

                        <!-- Onzichtbare tabel voor synchroniseren formulier met postcode info -->

                        <input style="display: none" name="voornaam" type="text" id="voornaam2" value="<?php print($voornaam); ?>">
                        <input style="display: none" name="tussenvoegsel" type="text" id="tussenvoegsel2" value="<?php if (isset($tussenvoegsel)) {print($tussenvoegsel);}?>">
                        <input style="display: none" name="achternaam" type="text" id="achternaam2" value="<?php print($achternaam); ?>">
                        <input style="display: none" name="email" type="text" id="email2" value="<?php print($email); ?>">
                        <input style="display: none" name="wachtwoord" type="text" id="wachtwoord2" value="<?php print($wachtwoord); ?>">
                        <input style="display: none" name="spam" type="text" id="spam2" value="<?php if ($spam==1){print(1);} else {print(0);}?>">


                </div>




                    </form>


                </div>

            </div>

        </div>






    <?php
    // Zet footer onderaan pagina.
    include "footer.php";
    ?>
