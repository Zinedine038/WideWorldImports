<!--
MOET FORMS EIGEN ID GEVEN WERKT DAAROM NU NIET
-->



<?php
    include "header.php";
    $postcode="";
    $huisnummer="";
    $plaats="";
    $straat="";
 if (isset($_GET["huisnummer"]) || isset($_GET["postcode"])) {
        /// Zet variabelen naar user input en haalt de eventuele spaties weg, maakt de postcode upper case
        $postcode = strtoupper(str_replace(" ", "", $_GET["postcode"]));
        $huisnummer = trim($_GET["huisnummer"]);
        $huisnummertoe=strtoupper($_GET["huisnummertoe"]);
    }

if (isset($_GET["verzenden"])) {
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
        print("<h1 style='color: red; text-align: center; background-color: #00fafa'>Adres niet gevonden, geef een geldige postcode en huisnummer op!</h1>");
        //error, wordt al weergeven bij bovenstaande functie.
    }}





    ?>

<?php

if (isset($_GET["voornaam"]) && isset($_GET["achternaam"]) && isset($_GET["email"]) || isset($_GET["wachtwoord"]) || isset($_GET["spam"]) || isset($_GET["huisnummer2"]) || isset($_GET["postcode2"]) || isset($_GET["straatnaam2"]) || isset($_GET["plaats2"]) || isset($_GET["verzenden"]))
{
    if (isset($_GET["huisnummertoe"])) {
        $huisnummertoevoeg= $_GET["huisnummertoe"];
    } else {
        $huisnummertoevoeg=" ";
    }

    if (isset($_GET["tussenvoegsel"])) {
        $tussenvoegseltoevoeg= $_GET["tussenvoegsel"];
    } else {
        $tussenvoegseltoevoeg="";
    }

    if (isset($_GET["Spam"])) {
        $spam=true;
    } else {
        $spam=false;
    }


    VoegKlantToe($_GET["voornaam"], $_GET["achternaam"], $tussenvoegseltoevoeg, $_GET["straatnaam2"], $_GET["huisnummer2"], $huisnummertoevoeg ,$_GET["postcode2"], $_GET["plaats2"], $_GET["email"], $_GET["wachtwoord"], $spam);
}

?>

<script>

    function autoinvul(){
        var voornaam = document.getElementById("voornaam").value;
        alert(voornaam);

        // var tussenvoegsel = document.getElementById("tussenvoegsel").value;
        // var achternaam =document.getElementById("achternaam").value;
        // var email = document.getElementById("email").value;
        // var wachtwoord = document.getElementById("wachtwoord").value;
        // var spam = document.getElementById("spam").value;

        //window.location.href = "inloggen.php?huisnummer3=" + voornaam + "&voornaam3" + tussenvoegsel + "&tussenvoegsel3" + achternaam + " &achternaam3" + email + "&email3" + wachtwoord + "wachtwoord3" + spam + "&spam3";
    }
    
    function formKlopt() {
        <?php
            $postcode=$_GET["postcode"];
            $huisnummer=$_GET["huisnummer"];
            $huisnummertoe=$_GET["huisnummertoe"];
        ?>

        var huisnummerbestaat = document.getElementById("huisnummer2").value;
        var postcodebestaat = document.getElementById("postcode2").value;
        var straatbestaat = document.getElementById("straatnaam2").value;
        var plaatsbestaat = document.getElementById("plaats2").value;
        var huisnummertoe = document.getElementById("huisnummertoe").value;


        if (huisnummerbestaat, postcodebestaat, straatbestaat, plaatsbestaat, huisnummertoe) {
            document.getElementById("straatnaam2").value="<?php print($straat);?>";
            document.getElementById("plaats2").value="<?php print($plaats);?>";
            document.getElementById("postcode").value="<?php print($postcode);?>";
            document.getElementById("huisnummer2").value="<?php print($huisnummer);?>";
            document.getElementById("huisnummertoe2").value="<?php print($huisnummertoe);?>";
            return true;
        } else {
            alert("Vul de postcode en huisnummer eerst in!");
            return false;

        }

    }

</script>

    <div class="container">
    <h2>Account aanmaken</h2>

        <div class="row" style="width: 90%; padding: 5%">

            <div class="col-md-6">





    <form action="inloggen.php" method="get" onsubmit="return formKlopt();">





                <div class="form-group">
                    Voornaam
                    <input type="text" name="voornaam" placeholder="Typ hier je voornaam" required
                           class="form-control input-lg">
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

        <div class="form-group checkbox custom-control custom-checkbox">

            <input type="checkbox" class="custom-control-input" id="defaultUnchecked" name="Spam">
            <label class="custom-control-label" for="defaultUnchecked">
                Wil je platgegooit worden met spam?
            </label>
        </div>


        <input name="huisnummer2" type="text" id="huisnummer2" value="<?php print($huisnummer) ?>">
        <input name="postcode2" type="text" id="postcode2" value="<?php print($postcode) ?>">
        <input name="huisnummertoe" type="text" id="huisnummertoe2" value="<?php print($huisnummertoe) ?>">
        <input name="straatnaam2" type="text" id="straatnaam2" value="<?php print($straat) ?>">
        <input name="plaats2" type="text" id="plaats2" value="<?php print($plaats); ?>">
        <div>
            <input onclick="autoinvul();" type="submit" name="verzenden" class="btn btn-primary">
        </div>
    </form>
</div>





                <div class="col-md-6">



                    <form action="inloggen.php" method="get">
                        Huisnummer
                        <div class="form-group">
                            <input type="number" value="<?php if (isset ($huisnummer)) {print $huisnummer;}?>" name="huisnummer" placeholder="Typ hier je Huisnummer" class="form-control input-lg" required>
                        </div>


                        Huisnummertoevoegingen
                        <div class="form-group">
                            <input type="text" maxlength="3" value="<?php if (isset ($huisnummertoe)) {print $huisnummertoe;}?>" name="huisnummertoe" placeholder="Typ hier je Huisnummer toevoeging" class="form-control input-lg">
                        </div>

                        Postcode
                        <div class="form-group">
                            <input type="text" value="<?php if (isset ($postcode)) {print $postcode;} ?>"
                                   name="postcode" placeholder="Typ hier je Postcode" class="form-control input-lg" required>
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
                        <input type="submit" name="submit" value="Vul automatisch in" class="btn btn-secondary" onclick="autoinvul()">
                        </div>

                        <br>


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
