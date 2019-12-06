<?php
$host = getHost();
$databasename = getDatabasename();
$port = getPort();
$user = getUser();
$pass = getPass();

$page = 1;
if (isset($_GET["page"])) {
$page = $_GET["page"];
}
$resultsperpage = 16;
if (isset($_GET["resultsperpage"])) {
$resultsperpage = $_GET["resultsperpage"];
}
$limitmin = $resultsperpage * ($page - 1);

$connection = mysqli_connect($host, $user, $pass, $databasename, $port);
if (isset($_GET["stockitemgroupid"])) {
$StockitemstockgroupID = $_GET["stockitemgroupid"];
$sql = "SELECT StockItemName, StockItemID, RecommendedRetailPrice, MarketingComments, UnitPrice FROM stockitems JOIN stockitemstockgroups USING (stockitemID) WHERE stockgroupID = ? LIMIT ?, ?";
$statement = mysqli_prepare($connection, $sql);
mysqli_stmt_bind_param($statement, "iii", $StockitemstockgroupID, $limitmin, $resultsperpage);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);
mysqli_stmt_close($statement); ?>
<div class="container pt-5">
    <div class="row">
        <div class="col">
            <form method="get">
                Resultaten per pagina: <select name='resultsperpage' onchange="this.form.submit()"'>
                <option value=16 <?php if ($resultsperpage == 16) {
                    print("selected");
                } ?>>16
                </option>
                <option value=24 <?php if ($resultsperpage == 24) {
                    print("selected");
                } ?>>24
                </option>
                <option value=36 <?php if ($resultsperpage == 36) {
                    print("selected");
                } ?>>36
                </option>
                </select>
                <input type="hidden" name="stockitemgroupid" value="<?php print($StockitemstockgroupID); ?>">
                <input type="hidden" name="page" value="<?php print($page); ?>">
            </form>
        </div>
    </div>
    <h2><?php $resie = categorieNaam($StockitemstockgroupID);
        print($resie["0"]["stockgroupname"]); ?>
    </h2>

    <div class="row text-center py-2"><?php
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $naam = $row["StockItemName"];
            $id = $row["StockItemID"];
            $prijs = $row["UnitPrice"];
            $oudePrijs = $row["RecommendedRetailPrice"];
            $Beschrijving = $row["MarketingComments"];
            $foto = sqlfoto($id);
            $fotoo = $foto["0"];
            component($naam, $prijs, $fotoo, $Beschrijving, $id, $oudePrijs);
            $i++;
        } ?>
    </div>
</div>

    <?php
    if (isset($_GET["stockitemid"])) {
        $productnr = intval($_GET["stockitemid"]);
    }
} ?>

<div class="container">
    <div class="row pb-3">
        <div class="col-sm">
            <?php
            $pagenext = $page + 1;
            $pageback = $page - 1;

            if ($page > 1) {
            print("<button class=\"btn btn-outline-info\"><a href='index.php?stockitemgroupid=$StockitemstockgroupID&page=$pageback'>Vorige</a></button>");
            } ?>
        </div>
        <div id="pagenumber" class="col-sm">
            <?php
            print("Pagina $page");
            ?>
        </div>
        <div class="col-sm">
            <?php
            if ($i == $resultsperpage) {
            print("<button id='volgendeknop' class=\"btn btn-outline-info\"><a href='index.php?stockitemgroupid=$StockitemstockgroupID&page=$pagenext'>Volgende</a></button>");
            } ?>
        </div>
    </div>
</div>