<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inlogpagina</title>
</head>
<body>
<?php
include "header.php";
?>

<h2>Account aanmaken</h2>

<form action="inloggen.php" method="post">
    <div class="row" style="width: 100%">
        <div class="col-md-6">

            <div class="form-group">
            <div class="form-group">
                Voornaam
                <input type="text" name="voornaam" placeholder="Typ hier je voornaam" class="form-control input-lg">
            </div>

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
            <div class="form-group2">
                <input type="text" name="straatnaam" placeholder="Typ hier je Straatnaam" class="form-control input-lg">
            </div>

            Huisnummer
            <div class="form-group2">
                <input type="text" name="huisnummer" placeholder="Typ hier je Huisnummer" class="form-control input-lg">
            </div>

            Postcode
            <div class="form-group2">
                <input type="text" name="postcode" placeholder="Typ hier je Postcode" class="form-control input-lg">
            </div>
            <div class="form-group2">
            Wil je platgegooit worden met spam?
            <input type="checkbox" name="Spam">
            </div>
        </div>
    </div>
</form>



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
*/ ?>
</body>
</html>