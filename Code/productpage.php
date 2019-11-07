<!DOCTYPE html>
<html lang="en">
<?php
include "functions.php";

///Haalt productnummer uit GET, standaard is 1 om te kunnen testen
$productnr=1;
if(isset($_GET["stockitemid"])){
    $productnr=intval($_GET["stockitemid"]);
}
///Haalt de informatie op uit de database
$productnaam = sql("stockitems", "stockitemname", $productnr);
$prijs = sql("stockitems", "RecommendedRetailPrice", $productnr);
$marketing = sql("stockitems", "MarketingComments", $productnr);
$voorraad = sql("stockitemholdings", "QuantityOnHand", $productnr);
$gekoeld = sql("stockitems","ischillerstock",$productnr);
$foto = sql("stockitems", "Photo", $productnr);

?>

<head>
    <meta charset="UTF-8">
    <title>Wide World Importers - <?php print($productnaam);?></title>


</head>
<body>
<?php


print("$productnaam - €$prijs <br> $marketing <br> Voorraad: $voorraad<br>");
if($gekoeld){
    print("Product is gekoeld!");
    echo '<img src="data:image/jpeg;base64,'.base64_encode( $foto ).'"/>';
}



?>

</body>
</html>