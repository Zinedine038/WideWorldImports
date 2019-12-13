<!-------- DIT BESTAND IS VOOR ALLE PAGINA'S DE HEADER -------->
<!-------- IMPORT DEZE INDIEN NIET AANWEZIG D.M.V. INCLUDE FUNCTIE -------->

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">

<html id="paginaalles">
<head>
    <!--- FONTS --->
    <link href="https://fonts.googleapis.com/css?family=Raleway:700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400&display=swap" rel="stylesheet">

    <!--- CSS --->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- DROPDOWN SHIT EWA KILL -->
    <link rel="stylesheet" type="text/css" href="css/Dropdown.css">

    <!--- BOOTSTRAP --->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <?php
    include_once("functions.php");

    ///Haalt productnummer uit GET, standaard is 1 om te kunnen testen
    $productnr=1;
    if(isset($_GET["stockitemid"])){
        $productnr=intval($_GET["stockitemid"]);
    }
    ///Haalt de informatie op uit de database
    $productnaam = sql("stockitems", "stockitemname", $productnr);
    $prijs = sql("stockitems", "UnitPrice", $productnr);
    $marketing = sql("stockitems", "MarketingComments", $productnr);
    $voorraad = sql("stockitemholdings", "QuantityOnHand", $productnr);
    $gekoeld = sql("stockitems","ischillerstock",$productnr);
    $oudePrijs = sql("stockitems","RecommendedRetailPrice",$productnr);
    $foto = sqlfoto($productnr);
    ?>
    <title>Wide World Importers - <?php print($productnaam);?></title>
    <?php include "davidscreatievecode.php" ?>
</head>
<body id="bodyalles">

<div class="container-fluid header-bg">
    <div class="row">
        <div class="container">
            <nav class="navbar navbar-expand-lg d-flex flex-row align-items-center">
                <a class="navbar-brand py-0" href="index.php"><img src="logo-wwi.png" class="logo" alt="logo" /></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars hamburger-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="ml-md-auto order-last d-flex">
                        <div class="order-1 py-2">

                                <?php if(isset($_SESSION["voornaam"])){ ?>
                                <a class="wit pr-3" href="accountinfo.php"> <?php $voornaam = $_SESSION["voornaam"];
                                    print ("Welkom $voornaam");?>
                                </a>
                                <?php } else { ?>
                            <a class="wit pr-3" href="Inlogpagina.php">
                                <i class="fas fa-running order-first"></i>
                                    <i class="fab fa-accessible-icon order-last"></i>
                            </a>
                                <?php }?>
                            </a>
                        </div>
                        <div class="order-2 py-2">
                            <a class="wit" href="cart.php">
                                <i class="fas fa-shopping-cart"></i>
                                <span class='badge badge-warning' id='lblCartCount'>
                                    <?php
                                    if (isset($_SESSION['cart'])) {
                                        $count = getTotalItems($_SESSION['cart']);
                                        echo "<span id=\"cart_count\">$count</span>";
                                    } else {
                                        echo "<span id=\"cart_count\">0</span>";
                                    } ?>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropbtn" style="text-align: left;">Categorieën</button>
                        <div class="dropdown-content"> <?php
                            $rij1 = "StockGroupName";
                            $rij2 = "StockGroupID";
                            $result = DatabaseCatogorie("*", "stockgroups");
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                $r1 = $row["$rij1"];
                                $r2 = $row["$rij2"];
                                print("<a href=http://localhost/wideworldimports/code/Index.php?stockitemgroupid=$r2>$r2. $r1</a><br>");
                            } ?>
                        </div>
                    </div>
                    <?php include 'livesearchbalk.php' ?>
                </div>
            </nav>
        </div>
    </div>
    <?php
    // VERANDER HIER HET THEMA
$thema = "kerst";

if ($thema == "sinterklaas") {
    ?>
    <div class="row">
        <img src="images/HEADER-SINTERKLAAS.jpg" class="header-img" alt="header">
    </div>
<?php }
if ($thema == "kerst") { ?>
    <div class="row">
        <img src="images/HEADER-KERSTMAN.jpg" class="header-img" alt="header">
    </div>
<?php }
if ($thema == "neutraal") { ?>
    <div class="row">
        <img src="images/HEADER-NEUTRAAL.jpg" class="header-img" alt="header">
    </div>
<?php } ?>
</div>