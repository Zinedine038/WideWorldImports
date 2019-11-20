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
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <?php
    include("functions.php");

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

    <script>
        function hoverOver() {
            var a = document.getElementById('paginaalles');
            var b = document.getElementById('bodyalles');
            var c = document.getElementById('productnaam');

            if (a) {
                document.getElementById('paginaalles').style.backgroundColor = 'rgba(0,0,0,0.5)';
            }

            if (b) {
                document.getElementById('bodyalles').style.backgroundColor = 'rgba(0,0,0,0.5)';
            }

            if (c) {
                document.getElementById('productnaam').style.color = 'rgba(0,0,0,0.8)';
            }


            var elements = document.getElementsByClassName('product-img');
            if (elements) {
                for (var i = 0; i < elements.length; i++) {
                    elements[i].style.outline = "318px solid rgba(0,0,0,0.8)";
                }
            }


            var elements2 = document.getElementsByClassName('btn-primary');
            if (elements2) {
                for (var i5 = 0; i5 < elements2.length; i5++) {
                    elements2[i5].style.color = 'rgba(255, 255, 255, 0.2)';
                    elements2[i5].style.backgroundColor = 'rgba(255,255,255,0.2)';
                }
            }

            var elements3 = document.getElementsByClassName('btn');
            if (elements3) {
                for (var i6 = 0; i6 < elements3.length; i6++) {
                    elements3[i6].setAttribute('style', 'background-color:rgba(0,0,0,0.5) !important');
                    elements3[i6].style.color = 'rgba(255, 255, 255, 0.2)';
                }
                }
            var elements4 = document.getElementsByClassName('px5');
            //of class px5
            if (elements4) {
                for (var ii2 = 0; ii2 < elements4.length; ii2++) {
                    elements4[ii2].setAttribute('style', 'background-color:rgba(0,0,0,0.5) !important');
                }
            }

            var elements100 = document.getElementsByClassName('pt-4');

            if (elements100) {
                for (var bii2 = 0; bii2 < elements100.length; bii2++) {
                    elements100[bii2].setAttribute('style', 'background-color:rgba(0,0,0,0.5) !important');
                }
            }
        }

        function hoverAway() {
            var elements99 = document.getElementsByClassName('px5');
            //of class px5
            if (elements99) {
                for (var iia2 = 0; iia2 < elements99.length; iia2++) {
                    elements99[iia2].removeAttribute('style');
                }
            }

            var elements100 = document.getElementsByClassName('pt-4');
            //of class px5
            if (elements100) {
                for (var bii2 = 0; bii2 < elements100.length; bii2++) {
                    elements100[bii2].removeAttribute('style');
                }

            }

            document.getElementById('paginaalles').style.backgroundColor = 'rgba(255,255,255,1)';
            document.getElementById('bodyalles').style.backgroundColor = 'rgba(255,255,255,1)';
            document.getElementById('productnaam').style.color= 'rgba(69,194,227,1)';


                var elements = document.getElementsByClassName('product-img');
                if (elements) {
                    for (var e1 = 0; e1 < elements.length; e1++) {
                        elements[e1].style.outline = "318px solid rgba(0,0,0,0)";
                    }
                }

            var elements2= document.getElementsByClassName('btn-primary');
            if (elements2) {
                for (var i2 = 0; i2 < elements2.length; i2++) {
                    elements2[i2].style.color = 'rgba(255, 255, 255, 1)';
                }
            }
            var elements10 = document.getElementsByClassName('px5');
            //of class px5
            for (var iii2 = 0; iii2 < elements10.length; iii2++) {
                elements10[iii2].removeAttribute('style');
            }
            var elements3= document.getElementsByClassName('btn-primary');

            for(var i3=0; i3<elements3.length; i3++) {
                elements3[i3].removeAttribute('style');

            }



        }

    </script>
</head>
<body id="bodyalles">

<div class="container-fluid header-bg">
    <div class="row">
        <div class="container">
            <nav class="navbar-expand-md d-flex flex-row align-items-center">
                <a class="navbar-brand" href="index.php"><img src="logo-wwi.png" class="logo" alt="logo" /></a>
                <div class="dropdown">
                    <button class="dropbtn" style="text-align: left;">Categorieën</button>
                    <div class="dropdown-content"> <?php
                        $rij1 = "StockGroupName";
                        $rij2 = "StockGroupID";

                        $result = DatabaseCatogorie("*","stockgroups");
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            $r1 = $row["$rij1"];
                            $r2 = $row["$rij2"];
                            print("<a href=http://localhost/wideworldimports/code/Index.php?stockitemgroupid=$r2>$r2. $r1</a><br>");
                        } ?>
                    </div>
                </div>
                <?php include 'livesearchbalk.php'?>
                <a class="navbar-brand" href="cart.php"><img src="winkelmand.png" class="logo" alt="logo" /></a>
                Winkelmandje: (
                <?php
                if(isset($_SESSION['cart']))
                {
                    $count = count($_SESSION['cart']);
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