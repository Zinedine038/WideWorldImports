<?php
session_start();

include "header.php";
?>

<?php if (isset($_SESSION["voornaam"])) {
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
    if ($_SESSION["newsletter"]==1) {
        print("Ja");
    } else {
        print("Nee");
    }
}
