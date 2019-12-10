<?php
session_start();

include "header.php";
?>

<?php if (isset($_SESSION["voornaam"])) {
    print ($_SESSION["voornaam"]);
    print ($_SESSION["tussenvoegsel"]);
    print ($_SESSION["achternaam"]);
    print ($_SESSION["email"]);
    print ($_SESSION["huisnummer"]);
    print ($_SESSION["annex"]);
    print ($_SESSION["straatnaam"]);
    print ($_SESSION["plaats"]);
    print ($_SESSION["postcode"]);
    print ($_SESSION["newsletter"]);
}
