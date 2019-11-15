<?php include 'header.php' ?>

<div class="container content">
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

<?php include 'footer.php' ?>