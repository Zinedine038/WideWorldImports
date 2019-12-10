<?php
session_start();

include "header.php";
// MOET IN HEADER
if (!(isset($_SESSION["voornaam"]))) {
    $_SESSION["ingelogd"] = false;
}
?>


<?php if ($_SESSION["voornaam"] == true) {
    print_r($_SESSION);
}