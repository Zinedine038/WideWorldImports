<html>
<head>
</head>
<body>
<div id="pagina">
<?php
include "functions.php";

//get the q parameter from URL
$q = $_GET["q"];

//Zoekt alleen als de lengte langer is dan 0
if (strlen($q) > 0) {
    $resultaat = search($q);
    if (isset($_GET["stockitemid"])) {
        $productnr = intval($_GET["stockitemid"]);
    }
    ?>
    <style>
        /* tijdelijke inline css */
        tr.resultaatbalkje:hover {
            background-color: rgba(0, 174, 241, 0.3);
        }

        a {
            text-decoration: none;
            color: black;
        }

        p:hover {
            text-decoration: underline;
            color: #0000fa;
        }

        p{
            width: 300px;
            word-wrap: break-word; /* Breek de zin als te lang is*/
        }

        strong {
            font-weight: 700;
        }

    </style>
    <!-- Cellspacing en celpadding op 0 is om de border tussen de resultaten weg te halen. -->
    <table id="resultaattabel" cellspacing="0" cellpadding="5" style='width: 100%; text-align: center; vertical-align: center;'><?php
        // Maak teller aan
        $count = 0;
        //Zorg voor achtergrond kleur afwisselend
        $omEnOmKleur = 0;
        // Foreach loop om elk resultaat te weergeven uit de database.
        foreach ($resultaat as $id) {
            //Haal de naam en de prijs van het product uit de database op.
            $naam = sql("stockitems", "stockitemname", $id);
            $prijs = sql("stockitems", "RecommendedRetailPrice", $id);
            // Geef de prijs weer met een komma, in plaats van een punt en zet er een euroteken voor.
            $prijs="€".str_replace(".",",", $prijs);
            // Limiteert de weergegeven resultaten tot 8.
            if ($count != 6) {
                $foto = sqlfoto($id);
                $fototje = $foto["0"];
                //Geef de resultaten in een lijst mee aan de livesearch, met een css om in het midden te staan. De resultaten zijn een link naar het product, de achtergrond van de producten is om en om een verschillende tint blauw.
                if ($omEnOmKleur == 0) {
                    if ($foto != NULL) {
                        //De tr is de link, zodat je op het hele blokje kan drukken inclusief het plaatje en de prijs om naar de informatie van het product te gaan, in plaats van dat je precies op de tekst moet drukken.
                        print("<tr onClick='window.location.href=\"http://localhost/wideworldimports/code/productpage.php?stockitemid=$id\"' class='resultaatbalkje' style='cursor: pointer';>
                                <td>
                                 <img src=$fototje style='mix-blend-mode: multiply; width: 55px; float: left;'>
                                 <p style='display:inline-block;'>$naam
                                </td>
                                 <td><strong>$prijs</strong>
                                 </td>
                                </tr>");
                    } else {
                        print("<tr onClick='window.location.href=\"http://localhost/wideworldimports/code/productpage.php?stockitemid=$id\"' class='resultaatbalkje' style='cursor: pointer';>
                                <td>
                                 <img src='../placeholder.jpg' style='mix-blend-mode: multiply; width: 60px; float: left; vertical-align: middle;'>
                                 <p style='display: inline-block;'>$naam
                                </td>
                                <td><strong>$prijs</strong>
                                </td>
                               </tr>");
                    }

                    $omEnOmKleur = 1;
                } elseif ($omEnOmKleur == 1) {
                    if ($foto != NULL) {
                        print("<tr onClick='window.location.href=\"http://localhost/wideworldimports/code/productpage.php?stockitemid=$id\"' class='resultaatbalkje' style='cursor: pointer;'>
                                <td>
                                 <img src='$fototje' style='word-wrap: break-word; width: 55px; mix-blend-mode:multiply; float:left; vertical-align:middle;'>
                                 <p style='display: inline-block;'>$naam</p></td><td><strong>$prijs</strong>
                                </td>
                               </tr>");
                    } else {
                        print("
                               <tr onClick='window.location.href=\"http://localhost/wideworldimports/code/productpage.php?stockitemid=$id\"' class='resultaatbalkje' style='cursor: pointer;'>
                                <td style='word-wrap: break-word'>       
                                 <img src='../placeholder.jpg' style='mix-blend-mode: multiply; width: 60px; float: left; vertical-align: middle;'>
                                 <p style='display: inline-block;'>$naam</p>
                                </td>
                               <td><strong>$prijs</strong></td>
                               </tr>");
                    }
                    $omEnOmKleur = 0;
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
</div>
</body>
</html>
