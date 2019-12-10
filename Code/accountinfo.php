<?php
session_start();

include "header.php";
// MOET IN HEADER
if (!(isset($_SESSION["ingelogd"]))) {
    $_SESSION["ingelogd"] = false;
}
?>


<?php if ($_SESSION["ingelogd"] == true) {
    print($_SESSION["voornaam"]);
}