<?php
include "functions.php";

//get the q parameter from URL
$q=$_GET["q"];

//Zoekt alleen als de lengte langer is dan 0
if (strlen($q)>0) {
    $resultaat = search($q);
    if(isset($_GET["stockitemid"])){
        $productnr=intval($_GET["stockitemid"]);
    }
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
            $foto = sqlfoto($id);
            $fototje = $foto["0"];
            //Geef de resultaten in een lijst mee aan de livesearch, met een css om in het midden te staan. De resultaten zijn een link naar het product, de achtergrond van de producten is om en om een verschillende tint blauw.
            if ($omEnOmKleur==0) {
                if ($foto!=NULL) {
                    print("<tr><td style='background-color: #68838b;'><img src=$fototje style='height: 40px; width: 40px; float: left;'><a style='text-align: center; padding-top: 2%; display: block;' href=http://localhost/wideworldimports/code/productpage.php?stockitemid=$id>$naam</a></td><td style='border: 1px solid black'>$prijs</td></tr>");
                } else {
                    print("<tr><td style='background-color: #68838b;'><img src='../placeholder.jpg' style='height: 40px; width: 40px; float: left;'><a style='text-align: center; padding-top: 2%; display: block;' href=http://localhost/wideworldimports/code/productpage.php?stockitemid=$id>$naam</a></td><td style='border: 1px solid black'>$prijs</td></tr>");
                }

                $omEnOmKleur=1;
            } elseif ($omEnOmKleur==1) {
                if ($foto!=NULL) {
                    print("<tr><td style='background-color: #00bfbf'><img src=$fototje style='height: 40px; width: 40px; float: left;'><a style='text-align: center; padding-top: 2%; display: block;' href=http://localhost/wideworldimports/code/productpage.php?stockitemid=$id>$naam</a></td><td style='border: 1px solid deepskyblue'>$prijs</td></tr>");
                } else {
                    print("<tr><td style='background-color: #00bfbf;'><img src='../placeholder.jpg' style='height: 40px; width: 40px; float: left;'><a style='text-align: center; padding-top: 2%; display: block;' href=http://localhost/wideworldimports/code/productpage.php?stockitemid=$id>$naam</a></td><td style='border: 1px solid deepskyblue'>$prijs</td></tr>");
                }
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