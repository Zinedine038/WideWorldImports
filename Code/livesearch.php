<?php
include "functions.php";

//get the q parameter from URL
$q=$_GET["q"];

//Zoekt alleen als de lengte langer is dan 0
if (strlen($q)>0) {
    $resultaat = search($q);

?>
<table><?php
    foreach ($resultaat as $id) {
        $naam = sql("stockitems", "stockitemname", $id);
        $prijs = sql("stockitems", "RecommendedRetailPrice", $id);
        print("<tr><td><a href=http://localhost/wideworldimports/code/productpage.php?stockitemid=$id>$naam</a></td><td>$prijs</td></tr>");
    }
?></table>
    <?php
}



//output the response

?>