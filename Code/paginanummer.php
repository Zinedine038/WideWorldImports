<?php
$i = 0;


    if (isset($_GET["stockitemid"])) {
        $productnr = intval($_GET["stockitemid"]);
    }
?>
<div class="row">
    <div class="col-sm">
        <?php
        $pagenext = $page + 1;
        $pageback = $page - 1;

        if($page > 1) {
        print("<button class=\"btn btn-outline-info\"><a href='index.php?stockitemgroupid=$StockitemstockgroupID&page=$pageback'>Vorige</a></button>");
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
        if($i == $resultsperpage) {
        print("<button id='volgendeknop' class=\"btn btn-outline-info\"><a href='index.php?stockitemgroupid=$StockitemstockgroupID&page=$pagenext'>Volgende</a></button>");
        }

        ?>
    </div>

</div>