<?php
include "functions.php";

//get the q parameter from URL
$q=$_GET["q"];

//Zoekt alleen als de lengte langer is dan 0
if (strlen($q)>0) {
    $resultaat = search($q);

?>
<!-- Cellspacing en celpadding op 0 is om de border tussen de resultaten weg te halen. -->
<table cellspacing="0" cellpadding="5" style='width: 100%;'><?php
    // Maak teller aan
    $count=0;
    //Zorg voor achtergrond kleur afwisselend
    $omEnOmKleur=0;
    // Foreach loop om elk resultaat te weergeven uit de database.
    foreach ($resultaat as $id) {
        $naam = sql("stockitems", "stockitemname", $id);
        $prijs = sql("stockitems", "RecommendedRetailPrice", $id);
        // Limiteert de weergegeven resultaten tot 8.
        if ($count!=8) {
            if ($omEnOmKleur==0) {
                print("<tr><td style='background-color: #00fafa'><img src='../placeholder.jpg' style='height: 8%; width: 8%;'><a href=http://localhost/wideworldimports/code/productpage.php?stockitemid=$id>$naam</a></td><td style='border: 1px solid black'>$prijs</td></tr>");
                $omEnOmKleur=1;
            } elseif ($omEnOmKleur==1) {
                print("<tr><td style='background-color: #00bfbf'><img src='../placeholder.jpg' style='height: 8%; width: 8%;'><a href=http://localhost/wideworldimports/code/productpage.php?stockitemid=$id>$naam</a></td><td style='border: 1px solid deepskyblue'>$prijs</td></tr>");
                $omEnOmKleur=0;
            }
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