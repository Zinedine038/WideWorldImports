<?php
session_start();

include "header.php";
 $postcode = "";
    $huisnummer="";
    /// Zet variabelen naar user input en haalt de eventuele spaties weg, maakt de postcode upper case
    if (isset($_GET["submit"])) {
        $_SESSION["postcode"] =  strtoupper(str_replace(" ","",$_GET["postcode"]));
        $_SESSION["huisnummer"] = trim($_GET["huisnummer"]);
    }

/// Als zowel postcode als huisnummer zijn ingevuld roept hij de functie zoekadres() aan
if (isset($_GET["postcode"]) AND isset($_GET["huisnummer"])) {
    $resultaten = zoekadres($postcode, $huisnummer);
/// Controleerd of er resultaten gevonden zijn
    if ($resultaten != 0) {
        $straat = $resultaten["straatnaam"];
        $plaats = $resultaten["gemeentenaam"];
        print("Straat: $straat<br>Plaats: $plaats");
    } else {
        print("Deze deze combinatie is niet gevonden!");

    }
}

if (isset($_SESSION["voornaam"])) {
    $spam = $_SESSION["newsletter"];
    ?>
    <div class="container">
        <h2>Accountgegevens</h2>

        <div class="row" style="width: 90%; padding: 5%">

            <div class="col-md-6">


                <form method="post">


                    <div class="form-group">
                        Voornaam
                        <input type="text" name="voornaam" placeholder="Typ hier je voornaam" required id="voornaam"
                               class="form-control input-lg" value="<?php print $_SESSION["voornaam"]; ?>">
                    </div>

                    <div class="form-group">
                        Tussenvoegsel
                        <input type="text" name="tussenvoegsel" placeholder="Typ hier je tussenvoegsel"
                               id="tussenvoegsel"
                               class="form-control input-lg" value="<?php print $_SESSION["tussenvoegsel"]; ?>">
                    </div>


                    <div class="form-group">
                        Achternaam
                        <input type="text" name="achternaam" placeholder="Typ hier je achternaam" required
                               id="achternaam"
                               class="form-control input-lg" value="<?php print $_SESSION["achternaam"]; ?>">
                    </div>


                    <div class="form-group">
                        Email
                        <input type="email" name="email" placeholder="Typ hier je email-adres" id="email" disabled
                               class="form-control input-lg" value="<?php print $_SESSION["email"]; ?>">
                    </div>

                    <div class="form-group checkbox custom-control custom-checkbox">

                        <input type="checkbox" class="custom-control-input checkboxbericht" id="defaultUnchecked"
                               name="spam" <?php if ($_SESSION["newsletter"] == 1) {
                            print("checked");
                        } ?>>
                        <label class="custom-control-label" for="defaultUnchecked">
                            Wil je platgegooit worden met spam?
                        </label>
                    </div>


                    <input style="display: none" name="huisnummer" type="text" id="huisnummer2"
                           value="<?php print($_SESSION["huisnummer"]); ?>">
                    <input style="display: none" name="postcode" type="text" id="postcode2"
                           value="<?php print($_SESSION["postcode"]); ?>">
                    <input style="display: none" name="huisnummertoe" type="text" id="huisnummertoe2"
                           value="<?php if (isset($_SESSION["annex"])) {
                               print($_SESSION["annex"]);
                           } ?>">
                    <input style="display: none" name="straatnaam" type="text" id="straatnaam2"
                           value="<?php print($_SESSION["straatnaam"]); ?>">
                    <input style="display: none" name="plaats" type="text" id="plaats2"
                           value="<?php print($_SESSION["plaats"]); ?>">
                    <div>
                        <input type="submit" name="Gegevens" value="Gegevens aanpassen" class="btn btn-primary"
                               formmethod="post">
                        <input type="submit" name="Destroy" value="Uitloggen" class="btn btn-primary" formmethod="post">
                    </div>
                </form>
            </div>


            <div class="col-md-6">


                <form onsubmit="formVul()" action="accountinfo.php" method="post">
                    Postcode
                    <div class="form-group">
                        <input type="text" value="<?php print $_SESSION["postcode"]; ?>"
                               name="postcode" placeholder="Typ hier je Postcode" class="form-control input-lg"
                               required>
                    </div>
                    Huisnummer
                    <div class="form-group">
                        <input type="number" value="<?php print $_SESSION["huisnummer"]; ?>" name="huisnummer"
                               placeholder="Typ hier je Huisnummer" class="form-control input-lg" required>
                    </div>


                    Huisnummertoevoegingen
                    <div class="form-group">
                        <input type="text" maxlength="3" value="<?php print $_SESSION["annex"]; ?>" name="huisnummertoe"
                               placeholder="Typ hier je Huisnummer toevoeging" class="form-control input-lg">
                    </div>


                    Straatnaam
                    <div class="form-group">
                        <input type="text" value="<?php print $_SESSION["straatnaam"]; ?>" name="straatnaam"
                               placeholder="Typ hier je Straatnaam" readonly
                               class="form-control input-lg">
                    </div>


                    Plaats
                    <div class="form-group">
                        <input type="text" value="<?php print($_SESSION["plaats"]); ?>"
                               name="plaats" placeholder="Typ hier je Plaats" readonly
                               class="form-control input-lg">
                    </div>
                    <input type="submit" name="submit" value="Vul automatisch in" class="btn btn-secondary">

                    <br>

                    <input style="display: none" name="voornaam" type="text" id="voornaam2"
                           value="<?php print($_SESSION["voornaam"]); ?>">
                    <input style="display: none" name="tussenvoegsel" type="text" id="tussenvoegsel2"
                           value="<?php print($_SESSION["tussenvoegsel"]); ?>">
                    <input style="display: none" name="achternaam" type="text" id="achternaam2"
                           value="<?php print($_SESSION["achternaam"]); ?>">
                    <input style="display: none" name="email" type="text" id="email2"
                           value="<?php print($_SESSION["email"]); ?>">
                    <input style="display: none" name="spam" type="text" id="spam2"
                           value="<?php if ($_SESSION["newsletter"] == 1) {
                               print(1);
                           } else {
                               print(0);
                           } ?>">


            </div>


            </form>


        </div>

    </div>

    </div>
    <?php
    print("Voornaam:");
    print ($_SESSION["voornaam"]);
    print ("<br>Tussenvoegsel:");
    print ($_SESSION["tussenvoegsel"]);
    print ("<br>Achternaam:");
    print ($_SESSION["achternaam"]);
    print("<br>Email:");
    print ($_SESSION["email"]);
    print("<br>Huisnummer:");
    print ($_SESSION["huisnummer"]);
    print("<br>Huisnummer toevoegsel:");
    print ($_SESSION["annex"]);
    print("<br>Straatnaam:");
    print ($_SESSION["straatnaam"]);
    print("<br>Plaats:");
    print ($_SESSION["plaats"]);
    print("<br>Postcode:");
    print ($_SESSION["postcode"]);
    print("<br>Wilt spam:");
    if ($_SESSION["newsletter"] == 1) {
        print("Ja");
    } else {
        print("Nee");
    } ?>
    <form>
        <input type="submit" name="Destroy" value="Uitloggen" class="btn btn-primary" formmethod="post">
    </form>
   <?php
    //Accountgegevens aanpassen
    if (isset($_POST["Gegevens"])){
        $connection = MaakVerbinding();
        $gelukt = Bewerk($connection, $_POST["voornaam"], $_POST["achternaam"], $_POST["tussenvoegsel"], $_POST["straatnaam"], $_POST["huisnummer"], $_POST["huisnummertoe"], $_POST["postcode"], $_POST["plaats"], $_POST["email"], $_POST["spam"]);
        if ($gelukt == 1){
            print("Account aanpassen is gelukt");
        }
        else{
            print("Account aanpassen is gefaald");
        }
        $URL = "accountinfo.php";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        $_SESSION["voornaam"] = $_POST["voornaam"];
        $_SESSION["achternaam"] = $_POST["achternaam"];
        $_SESSION["tussenvoegsel"] = $_POST["tussenvoegsel"];
        $_SESSION["straatnaam"] = $_POST["straatnaam"];
        $_SESSION["huisnummer"] = $_POST["huisnummer"];
        $_SESSION["annex"] = $_POST["huisnummertoe"];
        $_SESSION["postcode"] = $_POST["postcode"];
        $_SESSION["plaats"] = $_POST["plaats"];
        $_SESSION["newsletter"] = $_POST["spam"];
    }
    // Uitloggen
    if (isset($_POST["Destroy"])) {
        Session_destroy();
        $URL = "index.php";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    } ?><?php
} else {
    $URL = "index.php";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
} ?>
