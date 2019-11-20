<?php
session_start();
include'header.php' ?>
<?php include'footer.php' ?>
<link rel="stylesheet" type="text/css" href="css/style.css"> <?php

    $host = "localhost";
    $databasename = "wideworldimporters";
    $port = 3306;
    $user = "root";
    $pass = ""; //eigen password invullen
    $connection = mysqli_connect($host, $user, $pass, $databasename, $port);
    $StockitemstockgroupID = $_GET["stockitemgroupid"];
    $sql = "SELECT * FROM stockitems JOIN stockitemstockgroups USING (stockitemID) WHERE stockgroupID = $StockitemstockgroupID";
    $result = mysqli_query($connection, $sql);
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $naam = $row["StockItemName"];
    $id = $row["StockItemID"];
    $foto = sqlfoto($id);
    $fotoo=$foto["0"];
        if ($foto != NULL) {
            //De tr is de link, zodat je op het hele blokje kan drukken inclusief het plaatje en de prijs om naar de informatie van het product te gaan, in plaats van dat je precies op de tekst moet drukken.
            print("<tr onClick='window.location.href=\"http://localhost/wideworldimports/code/productpage.php?stockitemid=$id\"' class='container' style='cursor: pointer';>
                                <td>
                                 
                                 <p style='display:inline-block;'><a href=http://localhost/wideworldimports/code/productpage.php?stockitemid=$id /> $naam</a>
                                 <img src=$fotoo style='mix-blend-mode: multiply; width: 55px; float: left;'>
                                </td>
                                 <td><strong>$prijs</strong>
                                 </td>
                                </tr>");

        } else {
            print("<tr onClick='window.location.href=\"http://localhost/wideworldimports/code/productpage.php?stockitemid=$id\"' class='container' style='cursor: pointer';>
                                <td>
                                 <img src='../placeholder.jpg' style='mix-blend-mode: multiply; width: 60px; float: left; vertical-align: middle;'>
                                 <p style='display: inline-block;'><a href=http://localhost/wideworldimports/code/productpage.php?stockitemid=$id /> $naam </a>
                                </td>
                                <td><strong>$prijs</strong>
                                </td>
                               </tr>");
        }
    }
// print("<tr></tr><a href=http://localhost/wideworldimports/code/productpage.php?stockitemid=$id>$naam</a></tr><br>");
if(isset($_GET["stockitemid"])) {
    $productnr = intval($_GET["stockitemid"]);
}?>