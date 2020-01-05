<?php
session_start();

$count = 0;
$i = 0;

include_once("functions.php");
updateShoppingCart();

include 'header.php';
include 'Winkelmandje/php/Component.php';
include_once '../config.php';

//Generates a list of random products
$result = getRandomProducts(12);
$teller=1;
$randomProducts=array();
while($row=$result->fetch_assoc())
{
    $randomProducts[$teller]["ID"] = $row["StockItemID"];
    $randomProducts[$teller]["Naam"] = $row["StockItemName"];
    $randomProducts[$teller]["OudePrijs"] = number_format($row["RecommendedRetailPrice"],2,",",".");
    $randomProducts[$teller]["Foto"] = $row["Photo"];
    $randomProducts[$teller]["SearchDetails"] = $row["SearchDetails"];
    $randomProducts[$teller]["Prijs"] = number_format($row["UnitPrice"],2,",",".");
    $randomProducts[$teller]["Rating"] = $row["Rating"];
    $teller+=1;
}
$current=1;
//Carousel HTML code, gets random objects and puts them in a carousel
?>

<div class="container">
<?php
if(!isset($_GET["stockitemgroupid"])) {
    ?>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row">
                    <?php component($randomProducts[$current]["Naam"], $randomProducts[$current]["Prijs"], $randomProducts[$current]["Foto"], $randomProducts[$current]["SearchDetails"], $randomProducts[$current]["ID"], $randomProducts[$current]["OudePrijs"], $randomProducts[$current]["Rating"]);
                    $current++; ?>
                    <?php component($randomProducts[$current]["Naam"], $randomProducts[$current]["Prijs"], $randomProducts[$current]["Foto"], $randomProducts[$current]["SearchDetails"], $randomProducts[$current]["ID"], $randomProducts[$current]["OudePrijs"], $randomProducts[$current]["Rating"]);
                    $current++; ?>
                    <?php component($randomProducts[$current]["Naam"], $randomProducts[$current]["Prijs"], $randomProducts[$current]["Foto"], $randomProducts[$current]["SearchDetails"], $randomProducts[$current]["ID"], $randomProducts[$current]["OudePrijs"], $randomProducts[$current]["Rating"]);
                    $current++; ?>
                    <?php component($randomProducts[$current]["Naam"], $randomProducts[$current]["Prijs"], $randomProducts[$current]["Foto"], $randomProducts[$current]["SearchDetails"], $randomProducts[$current]["ID"], $randomProducts[$current]["OudePrijs"], $randomProducts[$current]["Rating"]);
                    $current++; ?>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row">
                    <?php component($randomProducts[$current]["Naam"], $randomProducts[$current]["Prijs"], $randomProducts[$current]["Foto"], $randomProducts[$current]["SearchDetails"], $randomProducts[$current]["ID"], $randomProducts[$current]["OudePrijs"], $randomProducts[$current]["Rating"]);
                    $current++; ?>
                    <?php component($randomProducts[$current]["Naam"], $randomProducts[$current]["Prijs"], $randomProducts[$current]["Foto"], $randomProducts[$current]["SearchDetails"], $randomProducts[$current]["ID"], $randomProducts[$current]["OudePrijs"], $randomProducts[$current]["Rating"]);
                    $current++; ?>
                    <?php component($randomProducts[$current]["Naam"], $randomProducts[$current]["Prijs"], $randomProducts[$current]["Foto"], $randomProducts[$current]["SearchDetails"], $randomProducts[$current]["ID"], $randomProducts[$current]["OudePrijs"], $randomProducts[$current]["Rating"]);
                    $current++; ?>
                    <?php component($randomProducts[$current]["Naam"], $randomProducts[$current]["Prijs"], $randomProducts[$current]["Foto"], $randomProducts[$current]["SearchDetails"], $randomProducts[$current]["ID"], $randomProducts[$current]["OudePrijs"], $randomProducts[$current]["Rating"]);
                    $current++; ?>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row">
                    <?php component($randomProducts[$current]["Naam"], $randomProducts[$current]["Prijs"], $randomProducts[$current]["Foto"], $randomProducts[$current]["SearchDetails"], $randomProducts[$current]["ID"], $randomProducts[$current]["OudePrijs"], $randomProducts[$current]["Rating"]);
                    $current++; ?>
                    <?php component($randomProducts[$current]["Naam"], $randomProducts[$current]["Prijs"], $randomProducts[$current]["Foto"], $randomProducts[$current]["SearchDetails"], $randomProducts[$current]["ID"], $randomProducts[$current]["OudePrijs"], $randomProducts[$current]["Rating"]);
                    $current++; ?>
                    <?php component($randomProducts[$current]["Naam"], $randomProducts[$current]["Prijs"], $randomProducts[$current]["Foto"], $randomProducts[$current]["SearchDetails"], $randomProducts[$current]["ID"], $randomProducts[$current]["OudePrijs"], $randomProducts[$current]["Rating"]);
                    $current++; ?>
                    <?php component($randomProducts[$current]["Naam"], $randomProducts[$current]["Prijs"], $randomProducts[$current]["Foto"], $randomProducts[$current]["SearchDetails"], $randomProducts[$current]["ID"], $randomProducts[$current]["OudePrijs"], $randomProducts[$current]["Rating"]);
                    $current++; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="buttons">
        <span class="left">
            <a class="fas fa-angle-left" href="#carouselExampleIndicators" role="button" data-slide="prev">
            </a>
        </span>
        <span class="right" style="float: right">
            <a class="fas fa-angle-right" href="#carouselExampleIndicators" role="button" data-slide="next">
            </a>
        </span>
    </div>
</div>
<?php
}
include 'paginanummer.php';

include 'footer.php'; ?>