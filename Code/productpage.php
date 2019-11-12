<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<?php
include "functions.php";

///Haalt productnummer uit GET, standaard is 1 om te kunnen testen
$productnr = 220;
if (isset($_GET["stockitemid"])) {
    $productnr = intval($_GET["stockitemid"]);
}

///Haalt de informatie op uit de database
$productnaam = sql("stockitems", "stockitemname", $productnr);
$prijs = sql("stockitems", "RecommendedRetailPrice", $productnr);
$marketing = sql("stockitems", "MarketingComments", $productnr);
$voorraad = sql("stockitemholdings", "QuantityOnHand", $productnr);
$gekoeld = sql("stockitems", "ischillerstock", $productnr);
$foto = sqlfoto($productnr);
?>
<head>
    <meta charset="UTF-8">
    <title>Wide World Importers - <?php print($productnaam); ?></title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col" align="center">
            <?php
            if ($foto) {
                print ('<img src="data:image/jpeg;base64,' . base64_encode($foto) . '" /><br>');
            } else { // zo niet, foto van categorie tonen
                print ("Afbeelding categorie<br>"); // Waar staan de categoriëen in de db??
            }
            ?>
        </div>

        <div class="col">
            <?php
            print ("<h5>$productnaam </h5> €$prijs <br>");
            if ($marketing) {
                print ("$marketing<br>");
            }
            print ("Voorraad: $voorraad<br>");

            // Als er een foto in de database van product staat

            if ($gekoeld) {
                print ("Product is gekoeld!");
                $temp = sqltemp($productnr);
                print ("Het product is $temp&deg;");
            }
            ?>
            <br>
            <button type="button" class="btn btn-primary">Plaats in winkelwagen</button>



        </div>
    </div>
    <br><br><br>

    <div class="row">
        <div class="col" align="center">
            <?php
            if ($foto) {
                print ('<img src="data:image/jpeg;base64,' . base64_encode($foto) . '" /><br>');
            } else { // zo niet, foto van categorie tonen
                print ("Afbeelding categorie<br>"); // Waar staan de categoriëen in de db??
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>