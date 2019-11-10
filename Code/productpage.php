<!DOCTYPE html>
<html lang="en">
<?php
    include "functions.php";

    ///Haalt productnummer uit GET, standaard is 1 om te kunnen testen
    $productnr=220;
    if(isset($_GET["stockitemid"])){
        $productnr=intval($_GET["stockitemid"]);
    }

    ///Haalt de informatie op uit de database
    $productnaam = sql("stockitems", "stockitemname", $productnr);
    $prijs = sql("stockitems", "RecommendedRetailPrice", $productnr);
    $marketing = sql("stockitems", "MarketingComments", $productnr);
    $voorraad = sql("stockitemholdings", "QuantityOnHand", $productnr);
    $gekoeld = sql("stockitems","ischillerstock",$productnr);
    $foto = sqlfoto($productnr);
?>
<head>
    <meta charset="UTF-8">
    <title>Wide World Importers - <?php print($productnaam); ?></title>
</head>
<body>
<?php
    print ("$productnaam - €$prijs <br>");
    if ($marketing) {
        print ("$marketing<br>");
    }
    print ("Voorraad: $voorraad<br>");

    // Als er een foto in de database van product staat
    if ($foto) {
        print ('<img src="data:image/jpeg;base64,'.base64_encode($foto).'" /><br>');
    } else { // zo niet, foto van categorie tonen
        print ("Afbeelding categorie<br>"); // Waar staan de categoriëen in de db??
    }

    if($gekoeld){
        print ("Product is gekoeld!");
        print ('<img src="data:image/jpeg;base64,'.base64_encode($foto).'" /><br>');

        $temp = sqltemp($productnr);
        print ("Het product is $temp&deg;");
    }
?>
</body>
</html>