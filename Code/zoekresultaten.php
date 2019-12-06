<?php
//start session
session_start();
$page=1;
$count = 0;
if(isset($_GET["page"])){
    $page = $_GET["page"];
}
$zoekterm=$_GET["zoekterm"];
$resultsshown = 16;
if(isset($_GET["resultsshown"])){
    $resultsshown=$_GET["resultsshown"];
}

include_once("functions.php");
updateShoppingCart();


require_once('header.php');
require_once("winkelmandje/php/component.php");

?>







<div class="container">
    <div class="row">
        <form method="get">
           Resultaten per pagina: <select name='resultsshown' onchange="this.form.submit()"'>
                <option value=16 <?php if($resultsshown == 16){print("selected");} ?>>16</option>
                <option value=24 <?php if($resultsshown == 24){print("selected");} ?>>24</option>
                <option value=36 <?php if($resultsshown == 36){print("selected");} ?>>36</option>
            </select>
            <input type="hidden" name="zoekterm" value="<?php print($zoekterm); ?>">
            <input type="hidden" name="page" value="<?php print($page); ?>">

        </form>
    </div>
    <div class="row text-center py-5">
        <?php

        $result = search($zoekterm,$page, $resultsshown);
        foreach ($result AS $id) {
            $naam = sql("stockitems", "stockitemname", $id);
            $prijs = sql("stockitems", "UnitPrice", $id);
            $commentaar = sql("stockitems", "MarketingComments", $id);
            $Itemid = sql("stockitems", "StockItemID", $id);
            $oudePrijs = sql("stockitems", "RecommendedRetailPrice", $id);
            $rating = sql("stockitems", "Rating", $id);
            component($naam,$prijs,"./upload/product1.png",$commentaar,$Itemid,$oudePrijs, $rating);
            $count++;
        }

        ?>
    </div>
    <div class="row">
        <div class="col-sm">
        <?php
        $pagenext = $page + 1;
        $pageback = $page - 1;

        if($page > 1) {
            print("<button class=\"btn btn-outline-info\"><a href='zoekresultaten.php?zoekterm=$zoekterm&submit=Submit&page=$pageback'>Vorige</a></button>");
        }
        ?>
        </div>
        <div id="pagenumber" class="col-sm">
            <?php
            print("Pagina $page")
            ?>
        </div>
        <div class="col-sm">
            <?php
        if($count == $resultsshown) {
            print("<button id='volgendeknop' class=\"btn btn-outline-info\"><a href='zoekresultaten.php?zoekterm=$zoekterm&submit=Submit&page=$pagenext'>Volgende</a></button>");
        }

        ?>
        </div>

    </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>