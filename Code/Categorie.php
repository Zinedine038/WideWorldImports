<?php
include "functions.php";
function Rijen($kolom, $tabel, $rij1, $rij2) //$kolom is welke kolom je wil, zelfde met $tabel en $rij1 en $rij 2 is welke rijen (array) die je wilt
{
///Database connectie info
    $host = "localhost";
    $databasename = "wideworldimporters";
    $port = 3306;
    $user = "root";
    $pass = "";
///SQL maakt statement, voert het uit en zet het in $result
    $connection = mysqli_connect($host, $user, $pass, $databasename, $port);
    $sql = "SELECT $kolom FROM $tabel";
    $statement = mysqli_prepare($connection, $sql);

    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $r1 = $row["$rij1"];
        $r2 = $row["$rij2"];
        print("<tr><td><a href=http://localhost/wideworldimports/code/Groups.php?stockitemgroupid=$r2>$r2. $r1</a></td><td></td></tr><br>");
    }
}
$tabel = "stockgroups";
$kolom = "*";
$rij1 = "StockGroupName";
$rij2 = "StockGroupID";
Rijen($kolom, $tabel, $rij1, $rij2); //$kolom is welke kolom je wil, zelfde met $tabel en $rij1 en $rij 2 is welke rijen (array) die je wilt