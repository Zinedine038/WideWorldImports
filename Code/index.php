<?php
session_start();
include 'header.php';
include 'Winkelmandje/php/Component.php';

    $host = "worldwide.cok6cy6n9dfy.eu-central-1.rds.amazonaws.com";
    $databasename = "wideworldimporters";
    $port = 3306;
    $user = "ICTM1n3";
    $pass = "Windesheim2019"; //eigen password invullen
    $connection = mysqli_connect($host, $user, $pass, $databasename, $port);
    if (isset($_GET["stockitemgroupid"])) {
    $StockitemstockgroupID = $_GET["stockitemgroupid"];
    $sql = "SELECT StockItemName, StockItemID, RecommendedRetailPrice, MarketingComments FROM stockitems JOIN stockitemstockgroups USING (stockitemID) WHERE stockgroupID = ?";
        $statement = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($statement, "i", $StockitemstockgroupID);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        mysqli_stmt_close($statement); ?>
        <font style="margin-left: 5.9%; padding-top: 1%; display: inline-block" size="6"><?php
                $resie= categorieNaam($StockitemstockgroupID);
                print($resie["0"]["stockgroupname"]);
                ?> </font>

        <div class="container">
        <div class="row text-center py-5"><?php
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $naam = $row["StockItemName"];
        $id = $row["StockItemID"];
        $prijs = $row["RecommendedRetailPrice"];
        $Beschrijving = $row["MarketingComments"];
        $foto = sqlfoto($id);
        $fotoo = $foto["0"];
        component($naam, $prijs, $fotoo, $Beschrijving, $id);
       /* if ($foto != NULL) {
            //De tr is de link, zodat je op het hele blokje kan drukken inclusief het plaatje en de prijs om naar de informatie van het product te gaan, in plaats van dat je precies op de tekst moet drukken.
            print("<tr onClick='window.location.href=\"http://localhost/wideworldimports/code/productpage.php?stockitemid=$id\"' class='resultaatbalkje' style='cursor: pointer';>
                                <td>
                                 
                                 <p style='display:inline-block;'><a href=http://localhost/wideworldimports/code/productpage.php?stockitemid=$id >$naam</a>
                                 <img src=$fotoo style='mix-blend-mode: multiply; width: 55px; float: left;'>
                                </td>
                                 <td><strong>$prijs</strong>
                                 </td>
                                </tr>");

        } else {
            print("<tr onClick='window.location.href=\"http://localhost/wideworldimports/code/productpage.php?stockitemid=$id\"' class='container' style='cursor: pointer';>
                                <td>
                                 <img src='../placeholder.jpg' style='mix-blend-mode: multiply; width: 60px; float: left; vertical-align: middle;'>
                                 <p style='display: inline-block;'><a href=http://localhost/wideworldimports/code/productpage.php?stockitemid=$id /> $naam </a>
                                </td>
                                <td><strong>$prijs</strong>
                                </td>
                               </tr>");
        }
    */
        } ?> </div>
</div>
<?php
// print("<tr></tr><a href=http://localhost/wideworldimports/code/productpage.php?stockitemid=$id>$naam</a></tr><br>");
    if (isset($_GET["stockitemid"])) {
        $productnr = intval($_GET["stockitemid"]);
    }
}

// VERANDER HIER HET THEMA
$thema = "sinterklaas";

if ($thema == "sinterklaas") {
?>
    <div class="container-fluid p-0">
        <img src="images/HEADER-SINTERKLAAS.jpg" class="header-img" alt="header">
    </div>
<?php } if ($thema == "kerst") { ?>
    <div class="container-fluid p-0">
        <img src="https://www.hmcdn.eu/ImageRepository/Converted/baf/baf003f5-65d2-41a5-a159-a92124ca7b7d.jpg" class="header-img" alt="header">
    </div>
<?php }

include'footer.php'; ?>