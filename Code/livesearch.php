<?php
include "functions.php";

// Verkrijgt q parameter van de URL
$q = $_GET["q"];

//Zoekt alleen als de lengte langer is dan 0
if (strlen($q) > 0) {
    $resultaat = search($q,1,24);
    if (isset($_GET["stockitemid"])) {
        $productnr = intval($_GET["stockitemid"]);
    }
    ?>
<div class="contaier">
    <table id="resultaattabel" cellspacing="0" cellpadding="5" style='vertical-align: center;'>
    <tbody id="overlaylive" onmouseover="hoverOver()" onmouseleave="hoverAway()">
    <?php
        // Maak teller aan
        $count = 0;
        //Zorg voor achtergrond kleur afwisselend
        $omEnOmKleur = 0;
        // Foreach loop om elk resultaat te weergeven uit de database.
        foreach ($resultaat as $id) {
            //Haal de naam en de prijs van het product uit de database op.
            $naam = sql("stockitems", "stockitemname", $id);
            $prijs = sql("stockitems", "UnitPrice", $id);
            $oudePrijs = sql("stockitems", "RecommendedRetailPrice", $id);
            // Geef de prijs weer met een komma, in plaats van een punt en zet er een euroteken voor.
            $prijs="€".str_replace(".",",", $prijs);
            // Limiteert de weergegeven resultaten tot 6.
            if ($count != 6) {
                $foto = sqlfoto($id);
                $fototje = $foto["0"];
                //Geef de resultaten in een lijst mee aan de livesearch, met een css om in het midden te staan. De resultaten zijn een link naar het product, de achtergrond van de producten is om en om een verschillende tint blauw.
                if ($omEnOmKleur == 0) {
                    if ($foto != NULL) {
                        //De tr is de link, zodat je op het hele blokje kan drukken inclusief het plaatje en de prijs om naar de informatie van het product te gaan, in plaats van dat je precies op de tekst moet drukken.
                        print("
                               <tr onClick='window.location.href=\"http://localhost/wideworldimports/code/productpage.php?stockitemid=$id\"' class='resultaatbalkje' style='cursor: pointer';>
                                <td class='container d-flex h-100 align-items-center'>
                                 <img class='livefoto justify-content-center align-self-center' src=$fototje style='mix-blend-mode: multiply;'>
                                 

                                 <p class='mb-0' style='display:inline-block;'>$naam</p>
                                </td>
                                 <td><strong><strike>€$oudePrijs</strike> $prijs</strong>
                                 </td>
                                </tr>");
                    } else {
                        print("<tr onClick='window.location.href=\"http://localhost/wideworldimports/code/productpage.php?stockitemid=$id\"' class='resultaatbalkje' style='cursor: pointer';>
                                <td class='container d-flex h-100 align-items-center'>
                                 <img class='livefoto justify-content-center align-self-center' src='../placeholder.jpg' style='mix-blend-mode: multiply; vertical-align: middle;'>
                                 <p class='mb-0' style='display: inline-block;'>$naam</p>
                                </td>
                                <td><strong><strike>€$oudePrijs</strike> $prijs</strong>
                                </td>
                               </tr>");
                    }

                    $omEnOmKleur = 1;
                } elseif ($omEnOmKleur == 1) {
                    if ($foto != NULL) {
                        print("<tr onClick='window.location.href=\"http://localhost/wideworldimports/code/productpage.php?stockitemid=$id\"' class='resultaatbalkje' style='cursor: pointer;'>
                                <td class='container d-flex h-100 align-items-center'>
                                 <img class='livefoto justify-content-center align-self-center' src='$fototje' style='word-wrap: break-word; mix-blend-mode:multiply; vertical-align:middle;'>
                                 <p class='mb-0' style='display: inline-block;'>$naam</p>
                                 </td>
                                 <td>
                                 <strong><strike>€$oudePrijs</strike> $prijs</strong>
                                </td>
                               </tr>");
                    } else {
                        print("
                               <tr onClick='window.location.href=\"http://localhost/wideworldimports/code/productpage.php?stockitemid=$id\"' class='resultaatbalkje' style='cursor: pointer;'>
                                <td class='container d-flex h-100 align-items-center' style='word-wrap: break-word' >       
                                 <img class='livefoto justify-content-center align-self-center' src='../placeholder.jpg' style='mix-blend-mode: multiply; vertical-align: middle;'>
                                 <p class='mb-0' style='display: inline-block;'>$naam</p>
                                </td>
                               <td><strong><strike>€$oudePrijs</strike> $prijs</strong></td>
                               </tr>");
                    }
                    $omEnOmKleur = 0;
                }
            } else {
                break;
            }
            $count++;
        }
        ?></tbody></table>
</div>
    <?php
}
//output the response
?>
