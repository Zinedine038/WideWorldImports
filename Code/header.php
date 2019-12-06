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

    <script>
        //scripts voor inlogpagina
        function formVul(){

            if (document.getElementById("voornaam") != null) {
                var voornaam = document.getElementById("voornaam").value;
                document.getElementById("voornaam2").value=voornaam;
            }

             if (document.getElementById("tussenvoegsel") != null) {
                 var tussenvoegsel1 = document.getElementById("tussenvoegsel").value;
                 document.getElementById("tussenvoegsel2").value=tussenvoegsel1;
             }
             if (document.getElementById("achternaam") != null) {
                 var achternaam1 = document.getElementById("achternaam").value;
                 document.getElementById("achternaam2").value=achternaam1;
             }
             if (document.getElementById("email") != null) {
                 var email1 = document.getElementById("email").value;
                 document.getElementById("email2").value=email1;
             }
             if (document.getElementById("wachtwoord") != null) {
                 var wachtwoord1 = document.getElementById("wachtwoord").value;
                 document.getElementById("wachtwoord2").value=wachtwoord1;
             }
             if (document.querySelector('.checkboxbericht').checked) {
                 document.getElementById("spam2").value=1;
             } else {
                 document.getElementById("spam2").value=0;
             }

        }

        function formKlopt() {


            var huisnummerbestaat = document.getElementById("huisnummer2").value;
            var postcodebestaat = document.getElementById("postcode2").value;
            var straatbestaat = document.getElementById("straatnaam2").value;
            var plaatsbestaat = document.getElementById("plaats2").value;
            if (document.getElementById("huisnummertoe") != null) {
                var huisnummertoe = document.getElementById("huisnummertoe").value;
            }
            <?php
            if (isset($_POST["postcode2"])) {
                $postcode = $_GET["postcode2"];
            }
            if (isset($_POST["huisnummer2"])) {
                $huisnummer = $_GET["huisnummer2"];
            }
            if (isset($_POST["huisnummertoe"])) {
                $huisnummertoe = $_POST["huisnummertoe"];
            }


            ?>

            if (!(document.querySelector('.checkboxbericht').checked)) {
                var check = document.getElementsByClassName('checkboxbericht');
                if (check) {
                    for (var ie = 0; ie < check.length; ie++) {
                        check[ie].removeAttribute('checked');
                    }
                }
                document.getElementById("spam").value=0;
            }

        }


        //script voor overal
        function hoverOver() {

            if (document.getElementById('paginaalles') != null) {
                var a = document.getElementById('paginaalles');
            }

            if (document.getElementById('bodyalles') != null) {
                var b = document.getElementById('bodyalles');
            }

            if (document.getElementById('productnaam') !=null) {
                var c = document.getElementById('productnaam');
            }

            if (a) {
                document.getElementById('paginaalles').style.backgroundColor = 'rgba(0,0,0,0.5)';
            }

            if (b) {
                document.getElementById('bodyalles').style.backgroundColor = 'rgba(0,0,0,0.5)';
            }

            if (c) {
                document.getElementById('productnaam').style.color = 'rgba(0,0,0,0.8)';
            }

            var elements1 = document.getElementsByClassName('product-img');
            if (elements1) {
                for (var i1 = 0; i1 < elements1.length; i1++) {
                    elements1[i1].setAttribute('style', 'filter: brightness(45%) !important');
                }
            }

            var elements2 = document.getElementsByClassName('h-25');
            if (elements2) {
                for (var i2 = 0; i2 < elements2.length; i2++) {
                    elements2[i2].setAttribute('style', 'filter: brightness(45%) !important');
                }
            }

            var elements3 = document.getElementsByClassName('cart-items');
            if (elements3) {
                for (var i3 = 0; i3 < elements3.length; i3++) {
                    elements3[i3].setAttribute('style', 'filter: brightness(45%) !important');
                }
            }

            var elements4 = document.getElementsByClassName('plaatjescomponent');
            if (elements4) {
                for (var i4 = 0; i4 < elements4.length; i4++) {
                    elements4[i4].setAttribute('style', 'filter: brightness(45%) !important');
                }
            }

            var elements5 = document.getElementsByClassName('price');
            if (elements5) {
                for (var i5 = 0; i5 < elements5.length; i5++) {
                    elements5[i5].style.color = 'rgba(0,0,0,0.8)';
                }
            }


            var elements6 = document.getElementsByClassName('card-title');
            if (elements6) {
                for (var i6 = 0; i6 < elements6.length; i6++) {
                    elements6[i6].style.color = 'rgba(0,0,0,0.8)';
                }
            }


            var elements7 = document.getElementsByClassName('shadow');
            if (elements7) {
                for (var i7 = 0; i7 < elements7.length; i7++) {
                    elements7[i7].setAttribute('style', 'background-color:rgba(0,0,0,0.5) !important');
                }
            }


            var elements8 = document.getElementsByClassName('btn');
            if (elements8) {
                for (var i8 = 0; i8 < elements8.length; i8++) {
                    elements8[i8].setAttribute('style', 'filter: brightness(40%) !important');
                }
            }


            var elements9 = document.getElementsByClassName('btn-warning');
            if (elements9) {
                for (var i9 = 0; i9 < elements9.length; i9++) {
                    elements9[i9].setAttribute('style', 'background-color:rgba(0,0,0,0.4); border:rgba(0,0,0,0.5); !important');
                }
            }


            var elements10 = document.getElementsByClassName('px5');
            if (elements10) {
                for (var i10 = 0; i10 < elements10.length; i10++) {
                    elements10[i10].setAttribute('style', 'background-color:rgba(0,0,0,0.5) !important');
                }
            }

            var elements11 = document.getElementsByClassName('text-secondary');
            if (elements11) {
                for (var i11 = 0; i11 < elements11.length; i11++) {
                    elements11[i11].setAttribute('style', 'filter: brightness(40%) !important');
                }
            }

        }

        function hoverAway() {

            var elements1 = document.getElementsByClassName('h-25');
            if (elements1) {
                for (var i1 = 0; i1 < elements1.length; i1++) {
                    elements1[i1].removeAttribute('style');
                }
            }

            var elements2 = document.getElementsByClassName('cart-items');
            if (elements2) {
                for (var i2 = 0; i2 < elements2.length; i2++) {
                    elements2[i2].removeAttribute('style');
                }
            }

            var elements3 = document.getElementsByClassName('plaatjescomponent');
            if (elements3) {
                for (var i3 = 0; i3 < elements3.length; i3++) {
                    elements3[i3].removeAttribute('style');
                }
            }

            var elements4 = document.getElementsByClassName('card-title');
            if (elements4) {
                for (var i4 = 0; i4 < elements4.length; i4++) {
                    elements4[i4].style.color = 'rgba(69,194,227,1)';
                }
            }

            var elements5 = document.getElementsByClassName('price');
            if (elements5) {
                for (var i5 = 0; i5 < elements5.length; i5++) {
                    elements5[i5].style.color = 'rgba(69,194,227,1)';
                }
            }

            var elements6 = document.getElementsByClassName('shadow');
            if (elements6) {
                for (var i6 = 0; i6 < elements6.length; i6++) {
                    elements6[i6].removeAttribute('style');
                }
            }

            var elements7= document.getElementsByClassName('px5');
            if (elements7) {
                for (var i7 = 0; i7 < elements7.length; i7++) {
                    elements7[i7].removeAttribute('style');
                }
            }

            var elements8= document.getElementsByClassName('btn-warning');
            if (elements8) {
                for (var i8 = 0; i8 < elements8.length; i8++) {
                    elements8[i8].removeAttribute('style');
                }
            }

            var elements9 = document.getElementsByClassName('product-img');
            if (elements9) {
                for (var i9 = 0; i9 < elements9.length; i9++) {
                    elements9[i9].removeAttribute('style');
                }
            }


             var elements10 = document.getElementsByClassName('px5');
             if (elements10) {
                 for (var iii2 = 0; iii2 < elements10.length; iii2++) {
                    elements10[iii2].removeAttribute('style');
                 }
             }

            var elements11 = document.getElementsByClassName('text-secondary');
            if (elements11) {
                for (var i11 = 0; i11 < elements11.length; i11++) {
                   elements11[i11].removeAttribute('style');
                }
             }

            var elements12 = document.getElementsByClassName('btn');
            if (elements12) {
                for (var i12 = 0; i12 < elements12.length; i12++) {
                    elements12[i12].removeAttribute('style');
                }
            }


            document.getElementById('paginaalles').style.backgroundColor = 'rgba(255,255,255,1)';
            document.getElementById('bodyalles').style.backgroundColor = 'rgba(255,255,255,1)';

            if (document.getElementById('productnaam') != null) {
                document.getElementById('productnaam').style.color = 'rgba(69,194,227,1)';
            }

        }

    </script>
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
                            <a class="wit pr-3" href="Inlogpagina.php">
                                <i class="fas fa-running order-first"></i>
                                <i class="fab fa-accessible-icon order-last"></i>
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
</div>