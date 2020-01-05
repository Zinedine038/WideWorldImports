<?php
// Importeert benodigde header en start sessie.
session_start();
include "header.php";
?>
<!-- Geeft een melding dat betaling geslaagd is -->

    <h1 style="text-align: center">Betaling geslaagd, bedankt voor uw aankoop!<br><br><br></h1>

<?php
// Maakt de winkelmand leeg en importeert de footer.
emptyShoppingCart();
include "footer.php";
?>