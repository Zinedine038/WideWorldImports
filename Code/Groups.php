<?php
include "Categorie.php";
$host = "localhost";
$databasename = "wideworldimporters";
$port = 3306;
$user = "root";
$pass = ""; //eigen password invullen
$connection = mysqli_connect($host, $user, $pass, $databasename, $port);
$StockitemstockgroupID = $_GET["stockitemgroupid"];
$sql = "SELECT * FROM stockitems JOIN stockitemstockgroups USING (stockitemID) WHERE stockgroupID = $StockitemstockgroupID";
$result = mysqli_query($connection, $sql);
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $naam = $row["StockItemName"];
    $id = $row["StockItemID"];
    print("<tr><td><a href=http://localhost/wideworldimports/code/productpage.php?stockitemid=$id>$naam</a></td><td></td></tr><br>");
}
if(isset($_GET["stockitemid"])) {
    $productnr = intval($_GET["stockitemid"]);

}
