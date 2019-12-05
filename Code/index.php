<?php
session_start();

$count=0;
$i=0;
if (isset($_POST['add'])) {
    include_once("functions.php");
    //print_r($_POST['product_id']);
    if (isset($_SESSION['cart'])) {
        $item_array_id = array_column($_SESSION['cart'], "product_id");

        if (in_array(($_POST['product_id']), $item_array_id)) {
            $name = sql("stockitems","stockitemname",$_POST["product_id"]);
            $keyIndex = getparent($_SESSION['cart'],$name);
            $_SESSION['cart'][$keyIndex]['amount']+=1;
        } else {
            $count=count($_SESSION['cart']);
            $name = sql("stockitems","stockitemname",$_POST["product_id"]);
            $item_array=array('product_id' => $_POST['product_id'],
                'amount' => 1,
                'name' => $name  );
            $_SESSION['cart'][$count]=$item_array;
        }
    } else {
        $name = sql("stockitems","stockitemname",$_POST["product_id"]);
        $item_array=array('product_id' => $_POST['product_id'],
            'amount' => 1,
            'name' => $name);
        $_SESSION['cart'][0] = $item_array;
    }
}
include 'header.php';
include 'Winkelmandje/php/Component.php';
include_once '../config.php';

    $host = getHost();
    $databasename = getDatabasename();
    $port = getPort();
    $user = getUser();
    $pass = getPass();

    $page = 1;
    if(isset($_GET["page"])){
        $page = $_GET["page"];
    }
    $resultsperpage = 16;
    if(isset($_GET["resultsperpage"])){
    $resultsperpage = $_GET["resultsperpage"]; }
    $limitmin = $resultsperpage * ($page-1);

    $connection = mysqli_connect($host, $user, $pass, $databasename, $port);
    if (isset($_GET["stockitemgroupid"])) {
    $StockitemstockgroupID = $_GET["stockitemgroupid"];
    $sql = "SELECT StockItemName, StockItemID, RecommendedRetailPrice, MarketingComments FROM stockitems JOIN stockitemstockgroups USING (stockitemID) WHERE stockgroupID = ? LIMIT ?, ?";
    $statement = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($statement, "iii", $StockitemstockgroupID,$limitmin,$resultsperpage);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    mysqli_stmt_close($statement); ?>
    <div class="container">
        <div class="row">
            <form method="get">
                Resultaten per pagina: <select name='resultsperpage' onchange="this.form.submit()"'>
                <option value=16 <?php if($resultsperpage == 16){print("selected");} ?>>16</option>
                <option value=24 <?php if($resultsperpage == 24){print("selected");} ?>>24</option>
                <option value=36 <?php if($resultsperpage == 36){print("selected");} ?>>36</option>
                </select>
                <input type="hidden" name="stockitemgroupid" value="<?php print($StockitemstockgroupID); ?>">
                <input type="hidden" name="page" value="<?php print($page); ?>">

            </form>
        </div>
        <font style="padding-top: 1%; display: inline-block" size="6"><?php
            $resie = categorieNaam($StockitemstockgroupID);
            print($resie["0"]["stockgroupname"]);
            ?> </font>
        <div class="row text-center py-5"><?php
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $naam = $row["StockItemName"];
                $id = $row["StockItemID"];
                $prijs = $row["RecommendedRetailPrice"];
                $Beschrijving = $row["MarketingComments"];
                $foto = sqlfoto($id);
                $fotoo = $foto["0"];
                component($naam, $prijs, $fotoo, $Beschrijving, $id);
                $i++;

            } ?> </div>
    </div>
    <?php

    if (isset($_GET["stockitemid"])) {
        $productnr = intval($_GET["stockitemid"]);
    }
}?>
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
<?php
// VERANDER HIER HET THEMA
$thema = "neutraal";

if ($thema == "sinterklaas") {
    ?>
    <div class="container-fluid p-0">
        <img src="images/HEADER-SINTERKLAAS.jpg" class="header-img" alt="header">
    </div>
<?php }
if ($thema == "kerst") { ?>
    <div class="container-fluid p-0">
        <img src="images/HEADER-KERSTMAN.jpg" class="header-img" alt="header">
    </div>
<?php }
if ($thema == "neutraal") { ?>
    <div class="container-fluid p-0">
        <img src="images/HEADER-NEUTRAAL.jpg" class="header-img" alt="header">
    </div>
<?php }

include 'footer.php'; ?>