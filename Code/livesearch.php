<?php
include "functions.php";

//get the q parameter from URL
$q=$_GET["q"];

//Zoekt alleen als de lengte langer is dan 0
if (strlen($q)>0) {
    $resultaat = search($q);

?>
<!-- Cellspacing en celpadding op 0 is om de border tussen de resultaten weg te halen. -->
<table cellspacing="0" cellpadding="5"><?php
    // Maak teller aan
    $count=0;
    //Zorg voor achtergrond kleur afwisselend
    $omEnOmKleur=0;
    // Foreach loop om elk resultaat te weergeven uit de database.
    foreach ($resultaat as $id) {
        $naam = sql("stockitems", "stockitemname", $id);
        $prijs = sql("stockitems", "RecommendedRetailPrice", $id);
        // Limiteert de weergegeven resultaten tot 20.
        if ($count!=20) {
            if ($omEnOmKleur==0) {
                print("<tr><td style='background-color: #00fafa'><a href=http://localhost/wideworldimports/code/productpage.php?stockitemid=$id>$naam</a></td><td>$prijs</td></tr>");
                $omEnOmKleur=1;
            } elseif ($omEnOmKleur==1) {
                print("<tr><td style='background-color: #00bfbf'><a href=http://localhost/wideworldimports/code/productpage.php?stockitemid=$id>$naam</a></td><td>$prijs</td></tr>");
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