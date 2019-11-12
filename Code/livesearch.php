<?php
include "functions.php";

//get the q parameter from URL
$q=$_GET["q"];

//Zoekt alleen als de lengte langer is dan 0
if (strlen($q)>0) {
    $resultaat = search($q);

?>
<table><?php
    // Maak teller aan
    $count=0;
    // Foreach loop om elk resultaat te weergeven uit de database.
    foreach ($resultaat as $id) {
        $naam = sql("stockitems", "stockitemname", $id);
        $prijs = sql("stockitems", "RecommendedRetailPrice", $id);
        // Limiteert de weergegeven resultaten tot 20.
        if ($count!=20) {
            print("<tr><td><a href=http://localhost/wideworldimports/code/productpage.php?stockitemid=$id>$naam</a></td><td>$prijs</td></tr>");
        } else {
            break;
        }
        $count++;
        }
?></table>
    <?php
}



//output the response

?>