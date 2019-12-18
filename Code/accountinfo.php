<?php
session_start();

include "header.php";
// error voorkomen als je niet ingelogd bent dat je eerst een error ziet voordat je wordt geredirect
if (isset($_SESSION["postcode"])) {
    $postcode = $_SESSION["postcode"];
    $huisnummer = $_SESSION["huisnummer"];
    if(isset($_POST["spam"])) {
        $_POST["spam"] = 1;
    }
    else {
        $_POST["spam"] = 0;
    }
    $_SESSION["newsletter"] = $_POST["spam"];
}
 else {
    $postcode = "";
    $huisnummer = "";
}
//Fix voor het niet gebruiken van de invul knop
/// Zet variabelen naar user input en haalt de eventuele spaties weg, maakt de postcode upper case
if (isset($_POST["submit"])) {
    $_SESSION["postcode"] = strtoupper(str_replace(" ", "", $_POST["postcode"]));
    $_SESSION["huisnummer"] = trim($_POST["huisnummer"]);

/// Als zowel postcode als huisnummer zijn ingevuld roept hij de functie zoekadres() aan
    if (isset($_POST["postcode"]) AND isset($_POST["huisnummer"])) {
        $postcode = $_POST["postcode"];
        $huisnummer = $_POST["huisnummer"];
        $resultaten = zoekadres($postcode, $huisnummer);
/// Controleerd of er resultaten gevonden zijn
        if ($resultaten != 0) {
            $straat = $resultaten["straatnaam"];
            $plaats = $resultaten["woonplaatsnaam"];
            $_SESSION["voornaam"] = $_POST["voornaam"];
            $_SESSION["achternaam"] = $_POST["achternaam"];
            $_SESSION["tussenvoegsel"] = $_POST["tussenvoegsel"];
            $_SESSION["annex"] = $_POST["huisnummertoe"];
            $_SESSION["postcode"] = $_POST["postcode"];
            $_SESSION["plaats"] = $_POST["plaats"];
            $_SESSION["newsletter"] = $_POST["spam"];
            $_SESSION["straatnaam"] = $resultaten["straatnaam"];
            $_SESSION["plaats"] = $resultaten["woonplaatsnaam"];
        } else {
            print("Deze deze combinatie is niet gevonden!");

        }
    }
}
if (isset($_SESSION["voornaam"])) {
    $spam = $_SESSION["newsletter"];
    ?>
    <div class="container">
        <h2>Accountgegevens</h2>

        <div class="row" style="width: 90%; padding: 5%">

            <div class="col-md-6">


                <form onsubmit="formVul()" action="accountinfo.php" method="post">


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
                            print("checked");}else {print("unchecked");}
                         ?>>
                        <label class="custom-control-label" for="defaultUnchecked">
                            Wil je platgegooit worden met spam?
                        </label>
                    </div>


                    <input style="display: none" name="huisnummer" type="text" id="huisnummer2"
                           value="<?php if(isset($_POST["huisnummer"])){ print($_POST["huisnummer"]);} else { print($_SESSION["huisnummer"]);}?>">
                    <input style="display: none" name="postcode" type="text" id="postcode2"
                           value="<?php if(isset($_POST["postcode"])){ print($_POST["postcode"]);} else { print($_SESSION["postcode"]);}?>">
                    <input style="display: none" name="huisnummertoe" type="text" id="huisnummertoe2"
                           value="<?php if (isset($_POST["annex"])) {
                               print($_POST["annex"]);
                           } ?>">
                    <input style="display: none" name="straatnaam" type="text" id="straatnaam2"
                           value="<?php if(isset($_POST["submit"])){ print($straat);} else { print($_SESSION["straatnaam"]);}?>">
                    <input style="display: none" name="plaats" type="text" id="plaats2"
                           value="<?php if(isset($_POST["submit"])){ print($plaats);} else { print($_SESSION["plaats"]);}?>">
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
                        <input type="text" value="<?php if (isset($_POST["straatnaam"])){ print($straat);} else {print($_SESSION["straatnaam"]);} ?>" name="straatnaam"
                               placeholder="Typ hier je Straatnaam" readonly
                               class="form-control input-lg">
                    </div>


                    Plaats
                    <div class="form-group">
                        <input type="text" value="<?php if (isset($_POST["plaats"])){ print($plaats);} else {print($_SESSION["plaats"]);} ?>"
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
    //Accountgegevens aanpassen
    if (isset($_POST["Gegevens"])){
        $connection = MaakVerbinding();
        $gelukt = Bewerk($connection, $_POST["voornaam"], $_POST["achternaam"], $_POST["tussenvoegsel"], $_POST["straatnaam"], $_POST["huisnummer"], $_POST["huisnummertoe"], $_POST["postcode"], $_POST["plaats"], $_POST["spam"], $_SESSION["UserID"]);
        if ($gelukt == 1){
            print("Account aanpassen is gelukt");
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
        else{
            print("Account aanpassen is gefaald");
        }
        $URL = "accountinfo.php";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
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
}
include "footer.php";