<?php
//Sessie starten voor karretje
session_start();
//Kar behaviour
include_once "functions.php";
updateShoppingCart();

include 'header.php';
?>

    <div class="container content">
        <div class="row">
            <div class="col">
                <h1 id="productnaam"><?php print ($productnaam) ?></h1>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-7">
                <?php
                if($productnr >= 220 && $productnr <=227){?>
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="false">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block product-img" src="<?php print($foto["0"]); ?>" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <iframe width="630" height="315" src="https://www.youtube.com/embed/cMGvdksBguI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
               <?php }
                else{
                if (!isset($foto["1"])) {
                    print ('<img src="' . $foto["0"] . '" class="product-img"/><br>');
                } else { ?>
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block product-img" src="<?php print($foto["0"]); ?>" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block product-img" src="<?php print($foto["1"]); ?>" alt="Second slide">
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                <?php }} ?>
            </div>
            <div class="col-md-5">
                <?php
                print ("<s><h5 style='color: #ff0000'>€$oudePrijs</h5></s>");
                print ("<h3 class='inh'>€$prijs</h3><br>");
                // als product onder de 50 is geeft die waarschuwing aan
                if ($voorraad < 50 && $voorraad > 0){
                    print("<h4>Let op! Voorraad is beperkt!</h4><br>");
                }
                /// Print de voorraad en eventueel bericht als product bijna uitverkocht is
                print ("Voorraad: $voorraad<br>");
                if ($marketing) {
                    print ("$marketing<br>");
                }

                // Als product gekoeld is, toon temperatuur
                if ($gekoeld) {
                    print ("Product is gekoeld! ");
                    $temp = sqltemp($productnr);
                    print ("Het product is $temp&deg;.");
                }
                $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                ?>
                <br>

                <form action= <?php echo $actual_link ?> method="post">
                    <button type="submit" class="btn btn-success" name="add" <?php
                    if ($voorraad <= 0) { print ("id=knopuit disabled");} ?>>Plaats in winkelwagen</button>
                    <input type='hidden' name='product_id' value=<?php echo $_GET["stockitemid"] ?>>
                    <?php $product = $_GET["stockitemid"]; ?>
                </form>
            </div>
        </div>
    </div>

    <!--- START RELEVANTE PRODUCTEN --->
    <div class="container-fluid bg">
        <div class="container rel-prod pt-4 pb-2">
            <div class="row">
                <div class="col">
                    <h2 class="inh pb-2">Gerelateerde producten</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?php
                    $gp = gerelateerdeProducten($product);
                    $gerelateerdproductID = ($gp["0"]["StockitemID"]);
                    $foto = sqlfoto($gerelateerdproductID);
                    $gerelateerdProductNaam = sql("stockitems", "stockitemname", $gerelateerdproductID);
                    $fototje = $foto["0"];
                    print('<a href="http://localhost/wideworldimports/code/productpage.php?stockitemid=' . $gerelateerdproductID . '">');
                    print ('<img src=' . $fototje . ' class="gerel-prod-img pb-3"/><p style="color: white;">' . $gerelateerdProductNaam . '</p></a>');
                    ?>
                </div>
                <div class="col-md-4">
                    <?php
                    $gp = gerelateerdeProducten($product);
                    $gerelateerdproductID = ($gp["1"]["StockitemID"]);
                    $gerelateerdProductNaam = sql("stockitems", "stockitemname", $gerelateerdproductID);
                    $foto = sqlfoto($gerelateerdproductID);
                    $fototje = $foto["0"];
                    print('<a href="http://localhost/wideworldimports/code/productpage.php?stockitemid=' . $gerelateerdproductID . '">');
                    print ('<img src=' . $fototje . ' class="gerel-prod-img pb-3" /><p style="color: white">' . $gerelateerdProductNaam . '</p></a>');
                    ?>
                </div>
                <div class="col-md-4">
                    <?php
                    $gp = gerelateerdeProducten($product);
                    $gerelateerdproductID = ($gp["2"]["StockitemID"]);
                    $gerelateerdProductNaam = sql("stockitems", "stockitemname", $gerelateerdproductID);
                    $foto = sqlfoto($gerelateerdproductID);
                    $fototje = $foto["0"];
                    print('<a href="http://localhost/wideworldimports/code/productpage.php?stockitemid=' . $gerelateerdproductID . '">');
                    print ('<img src=' . $fototje . ' class="gerel-prod-img pb-3" /><p style="color: white">' . $gerelateerdProductNaam . '</p></a>');
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!--- END RELEVANTE PRODUCTEN --->

<?php include 'footer.php' ?>