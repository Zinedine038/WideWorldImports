<?php
session_start();

$count = 0;
$i = 0;

include_once("functions.php");
updateShoppingCart();

include 'header.php';
include 'Winkelmandje/php/Component.php';
include_once '../config.php';


include 'paginanummer.php';

include 'footer.php'; ?>