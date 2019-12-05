<?php
    //Sessie starten voor karretje
    session_start();
    //Kar behaviour
    include_once "functions.php";



    if(isset($_POST['add']))
    {
        //print_r($_POST['product_id']);
        if(isset($_SESSION['cart']))
        {
            $item_array_id = array_column($_SESSION['cart'],"product_id");
            if(in_array(($_POST['product_id']), $item_array_id))
            {
                $name = sql("stockitems","stockitemname",$_POST["product_id"]);
                $keyIndex = getparent($_SESSION['cart'],$name);
                $_SESSION['cart'][$keyIndex]['amount']+=1;
            }
            else
            {
                $count=count($_SESSION['cart']);
                $name = sql("stockitems","stockitemname",$_POST["product_id"]);
                $item_array=array('product_id' => $_POST['product_id'],
                                  'amount' => 1,
                                  'name' => $name  );
                $_SESSION['cart'][$count]=$item_array;
            }
        }
        else
        {
            $name = sql("stockitems","stockitemname",$_POST["product_id"]);
            $item_array=array('product_id' => $_POST['product_id'],
                'amount' => 1,
                'name' => $name);
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
    <div class="row ">
    <div class="col-md-7">
<?php
if (!isset($foto["1"])) {
    print ('<img src="' . $foto["0"] . '" class="product-img"/><br>');
} else { ?>
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="<?php print($foto["0"]);?>" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="<?php print($foto["1"]);?>" alt="Second slide">
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

   <?php }?>

    </div>
    <div class="col-md-5">
        <?php
        print (" <s><h3 class='inh'>€$oudePrijs </h3></s><br>");
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
            <?php $product = $_GET["stockitemid"]; ?>
        </form>
    </div>
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

                    $gp = gerelateerdeProducten($product);
                    $gerelateerdproductID = ($gp["0"]["StockitemID"]);
                    $foto = sqlfoto($gerelateerdproductID);
                    $gerelateerdProductNaam = sql("stockitems", "stockitemname", $gerelateerdproductID);

                    $fototje = $foto["0"];
                    print('<a href="http://localhost/wideworldimports/code/productpage.php?stockitemid=' . $gerelateerdproductID . '">');
                    print ('<img src=' . $fototje . ' class="product-img"/><p style="color: white;">' . $gerelateerdProductNaam . '</p></a>');
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
                    print ('<img src=' . $fototje . ' class="product-img"/><p style="color: white">' . $gerelateerdProductNaam . '</p></a>');
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
                    print ('<img src=' . $fototje . ' class="product-img"/><p style="color: white">' . $gerelateerdProductNaam . '</p></a>');
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!--- END RELEVANTE PRODUCTEN --->

    <?php include 'footer.php' ?>