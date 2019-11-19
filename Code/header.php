<!-------- DIT BESTAND IS VOOR ALLE PAGINA'S DE HEADER -------->
<!-------- IMPORT DEZE INDIEN NIET AANWEZIG D.M.V. INCLUDE FUNCTIE -------->

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
    <!--- FONTS --->
    <link href="https://fonts.googleapis.com/css?family=Raleway:700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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
    $foto = sqlfoto($productnr);
    ?>
    <title>Wide World Importers - <?php print($productnaam);?></title>
</head>
<body>
<div class="container-fluid header-bg">
    <div class="row">
        <div class="container">
            <nav class="navbar-expand-md d-flex flex-row align-items-center">
                <a class="navbar-brand" href="index.php"><img src="logo-wwi.png" class="logo" alt="logo" /></a>
                <?php include 'livesearchbalk.php'?>
                <a class="navbar-brand" href="./Winkelmandje/cart.php"><img src="winkelmand.png" class="logo" alt="logo" /></a>
                Cart: (
                <?php
                if(isset($_SESSION['cart']))
                {
                    $count = count($_SESSION['cart'])-1;
                    echo "<span id=\"cart_count\">$count</span>";
                }
                else
                {
                    echo "<span id=\"cart_count\">0</span>";
                }
                ?>
                )
            </nav>
        </div>
    </div>
</div>