<?php
session_start();

$count = 0;
$i = 0;

include_once("functions.php");
updateShoppingCart();

include 'header.php';
include 'Winkelmandje/php/Component.php';
include_once '../config.php';

// VERANDER HIER HET THEMA
$thema = "neutraal";

if ($thema == "sinterklaas") {
    ?>
    <div class="container-fluid p-0">
        <img src="images/HEADER-SINTERKLAAS.jpg" class="header-img" alt="header">
    </div>
<?php }
if ($thema == "kerst") { ?>
    <div class="container-fluid p-0">
        <img src="images/HEADER-KERSTMAN.jpg" class="header-img" alt="header">
    </div>
<?php }
if ($thema == "neutraal") { ?>
    <div class="container-fluid p-0">
        <img src="images/HEADER-NEUTRAAL.jpg" class="header-img" alt="header">
    </div>
<?php }

include 'paginanummer.php';

include 'footer.php'; ?>