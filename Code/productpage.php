<?php include 'header.php' ?>

    <div class="container content">
        <div class="row">
            <div class="col-12">
                <h1><?php print ($productnaam) ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7" align="center">
                <?php
                if ($foto) {
                    print ('<img src="' . $foto["0"] . '" class="product-img"/><br>');
                } else { // zo niet, foto van categorie tonen
                    print ("Afbeelding categorie<br>"); // Waar staan de categoriëen in de db??
                }
                ?>
            </div>
            <div class="col-md-5">
                <?php
                print ("<h3 class='inh'>€$prijs</h3><br>");
                print ("Voorraad: $voorraad<br>");
                if ($marketing) {
                    print ("$marketing<br>");
                }

                // Als er een foto in de database van product staat
                if ($gekoeld) {
                    print ("Product is gekoeld! ");
                    $temp = sqltemp($productnr);
                    print ("Het product is $temp&deg;.");
                }
                ?>
                <br>
                <button type="button" class="btn btn-primary">Plaats in winkelwagen</button>
            </div>
        </div>
    </div>

    <!--- START RELEVANTE PRODUCTEN --->
    <div class="container-fluid bg">
        <div class="container rel-prod pt-3 pb-3">
            <div class="row">
                <div class="col">
                    <h2 class="inh">Gerelateerde producten</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    GERELATEERD PRODUCT 1
                </div>
                <div class="col-md-4">
                    GERELATEERD PRODUCT 2
                </div>
                <div class="col-md-4">
                    GERELATEERD PRODUCT 3
                </div>
            </div>
        </div>
    </div>
    <!--- END RELEVANTE PRODUCTEN --->

<?php include 'footer.php' ?>