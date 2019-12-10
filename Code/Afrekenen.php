<?php
session_start();
include "header.php";
include_once '../config.php';
?>

<div style="width: 90%; padding: 5%; display:  <?php if (1===1) {print("none");} else {print("unset");} ?>">
    <h2>Inloggen</h2>
    <form xmlns="http://www.w3.org/1999/html" method="post">
        <div class="form-group">
            Email
            <input type="text" name="Email" placeholder="Vul hier je email"
                   class="form-control input-lg" required>
        </div>
        <div class="form-group">
            Wachtwoord
            <input type="password" name="wachtwoord" placeholder="Vul hier je wachtwoord"
                   class="form-control input-lg" required>
        </div>
        <input type="submit" value="Aanmelden">
    </form>
    <?php
    $host = getHost();
    $databasename = getDatabasename();
    $port = getPort();
    $user = getUser();
    $pass = getPass();
    if(isset($_POST["wachtwoord"])) {
        $wachtwoord = $_POST["wachtwoord"];
        $email = $_POST["Email"];
        $connection = mysqli_connect($host, $user, $pass, $databasename, $port);
        $sql= "SELECT Password FROM user WHERE Email = ?";
        $statement = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($statement, "s", $email);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        mysqli_stmt_close($statement);
        $row = mysqli_fetch_array($result);
        $HashedWW = $row["Password"];
        if(password_verify($wachtwoord, $HashedWW)){
            print("Eureka!");
        }
        else{
            print ("Fuck");
        }

    } ?>
</div>

<?php
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
        print("<h1 style='color: red; text-align: center; background-color: #00fafa'>Adres niet gevonden, geef een geldige postcode en huisnummer op!</h1>");
        //error, wordt al weergeven bij bovenstaande functie.
    }}





?>

<?php

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

    VoegKlantToe($_POST["voornaam"], $_POST["achternaam"], $tussenvoegseltoevoeg, $_POST["straatnaam"], $_POST["huisnummer"], $huisnummertoevoeg ,$_POST["postcode"], $_POST["plaats"], $_POST["email"], $_POST["wachtwoord"], $spam);
    print("<h1 style='color: red; text-align: center; background-color: #00fafa'>Account is succesvol aangemaakt!</h1>");
    $URL="inlogpagina.php";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    die();
} elseif (isset($_POST["verzenden"])) {
    print("<h1 style='color: red; text-align: center; background-color: #00fafa'><h1>Error: vul alle velden in!</h1>");
}

?>

<div class="container">
    <h2>Controlleer je gegevens</h2>

    <div class="row" style="width: 90%; padding: 5%">

        <div class="col-md-6">





            <form action="Afrekenen.php" method="post" onsubmit="return formKlopt();">





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
                    <input title="Wachtwoord moet minimaal uit 8 tekens bestaan, en moet 1 hoofdletter, kleine letter, cijfer en ander karakter bevatten!" type="password" name="wachtwoord" placeholder="Typ hier je wachtwoord" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                           class="form-control input-lg" id="wachtwoord" value="<?php if (isset($wachtwoord)) {print $wachtwoord;}?>">
                </div>

                <div class="form-group checkbox custom-control custom-checkbox">

                    <input type="checkbox" class="custom-control-input checkboxbericht" id="defaultUnchecked" name="spam" <?php if ($spam==1){print("checked");}?>>
                    <label class="custom-control-label" for="defaultUnchecked">
                        Wil je platgegooit worden met spam?
                    </label>
                </div>


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



            <form onsubmit="formVul()" action="Afrekenen.php" method="post">
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
                <input type="submit" name="submit" value="Vul automatisch in" class="btn btn-secondary">

                <br>

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
include "footer.php";
?>
