<!DOCTYPE html>
<html lang="en">
<!--- Importeer functions en vangt foutmelding onbestaande variabele af --->
<?php
include "functions.php";
$zoekterm = "";
if (isset($_GET["submit"])) {
    $zoekterm = $_GET["zoekterm"];
}
?>
<head>
    <meta charset="UTF-8">
    <title>Zoek product</title>
</head>


<body>
<!--- Zoekbalk --->
<form method="get">
    Zoekterm<br>
    <input type="text" name="zoekterm" value="<?php print $zoekterm ?>""><br>
    <input type="submit" name="submit" value="Submit">
</form>

<?php
///Checkt of er is gezocht
if (isset($_GET["submit"])) {
/// Print de headers van het het resultaten tabel
print("<table> <tr> <th>Product</th><th>Prijs</th></tr>");
///Haalt resultaten op
    $resultaat = search($zoekterm);

    ///Zet de resultaten in tabel
    foreach ($resultaat as $id) {
        $naam = sql("stockitems", "stockitemname", $id);
        $prijs = sql("stockitems", "RecommendedRetailPrice", $id);
        print("<tr><td><a href=http://localhost/WWItest/productpage.php?stockitemid=$id>$naam</a></td><td>$prijs</td></tr>");
    }
    }
    ?>


</body>
</html>