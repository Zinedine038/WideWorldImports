<?php
    //Sessie starten voor karretje
    session_start();
    //Kar behaviour
    if(isset($_POST['add']))
    {
        //print_r($_POST['product_id']);
        if(isset($_SESSION['cart']))
        {
            $item_array_id = array_column($_SESSION['cart'],"product_id");

            if(in_array(($_POST['product_id']), $item_array_id))
            {
                echo "<script>alert('product is already added to your cart')</script>";
                echo "<script>window.location = 'index.php</script>";
            }
            else
            {
                $count=count($_SESSION['cart']);
                $item_array=array('product_id' => $_POST['product_id']);
                $_SESSION['cart'][$count]=$item_array;
            }
        }
        else
        {
            $item_array=array('product_id' => $_POST['product_id']);
            //Create new session variable
            $_SESSION['cart'][0] = $item_array;
        }
    }
    include 'header.php';
?>

    <div class="container content">
        <div class="row">
            <div class="col-12">
                <h1 id="productnaam"><?php print ($productnaam) ?></h1>
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
                $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                ?>
                <br>
                <form action= <?php echo $actual_link ?> method="post">
                    <button type="submit" class="btn btn-primary" name="add">Plaats in winkelwagen</button>
                    <input type='hidden' name='product_id' value=<?php echo $_GET["stockitemid"] ?>>
                    <?php $product=$_GET["stockitemid"];?>
                </form>
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

                    <?php

                    $gp= gerelateerdeProducten($product);
                    $foto = sqlfoto($gp["0"]["StockitemID"]);
                    $fototje = $foto["0"];
                    print ('<img src='.$fototje.' class="product-img"/><br>');
                    ?>

                </div>
                <div class="col-md-4">

                    <?php

                    $gp= gerelateerdeProducten($product);
                    $foto = sqlfoto($gp["1"]["StockitemID"]);
                    $fototje = $foto["0"];
                    print ('<img src='.$fototje.' class="product-img"/><br>');
                    ?>
                </div>
                <div class="col-md-4">

                    <?php

                    $gp= gerelateerdeProducten($product);
                    $gp= gerelateerdeProducten($product);
                    $foto = sqlfoto($gp["2"]["StockitemID"]);
                    $fototje = $foto["0"];
                    print ('<img src='.$fototje.' class="product-img"/><br>');
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!--- END RELEVANTE PRODUCTEN --->

<?php include 'footer.php' ?>