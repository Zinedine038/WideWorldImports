<?php

include "../config.php";

///Geeft de waarde van 1 veld terug uit de database aan de hand van het productnummer
function sql($tabel, $veld, $productnr)
{
    $host = getHost();
    $databasename = getDatabasename();
    $port = getPort();
    $user = getUser();
    $pass = getPass();

    ///SQL maakt statement, voert het uit en zet het in $result
    $sql = "SELECT " . $veld . " FROM " . $tabel . " WHERE stockitemid = ?";
    $connection = mysqli_connect($host, $user, $pass, $databasename, $port);
    $statement = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($statement, "i", $productnr);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    mysqli_stmt_close($statement);

    ///Haalt veld op en stuurt het terug
    while ($productinfo = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $naam = $productinfo["$veld"];
    }
    return $naam;
}


///Neemt een zoekterm en geeft product ID's terug
function search($zoekterm, $page, $resultsperpage)
{
    $host = getHost();
    $databasename = getDatabasename();
    $port = getPort();
    $user = getUser();
    $pass = getPass();

    ///maakt lege array aan waar zo de product IDs in komen
    $IDs = array();
    $limitmin = $resultsperpage * ($page-1);




    $zoektermem = explode(" ", $zoekterm);
    $aantalzoektermen = count($zoektermem);

    foreach ($zoektermem as $term) {
        ///SQL maakt statement, voert het uit en zet het in $result
        $likestring = "%" . $term . "%";
        $sql = "SELECT StockItemID FROM stockitems WHERE SearchDetails LIKE ? OR Tags LIKE ? OR StockItemID LIKE ? LIMIT ?, ?";
        $connection = mysqli_connect($host, $user, $pass, $databasename, $port);
        $statement = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($statement, "sssii", $likestring, $likestring, $likestring, $limitmin, $resultsperpage);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        mysqli_stmt_close($statement);

        ///Zet gevonden product ID's in array
        while ($productinfo = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            array_push($IDs, $productinfo["StockItemID"]);
        }
    }

    ///Controleerd of de gevonden ID's net zo vaak voorkomen als het aantal zoektermen,
    ///verwijderd degene waarbij dat niet zo is
    for ($i = 1; $i < $aantalzoektermen; $i++) {
        $uniek = array_unique($IDs);
        foreach ($uniek as $value) {
            $remove = array_search($value, $IDs);
            unset($IDs[$remove]);
        }
    }
    return $IDs;
}

///Neemt postcode en huisnummer en stuurt array met resultaten terug
function zoekadres($postcode, $huisnummer){
    ///Roept API aan met postcode en huisnummer, zet daarna de json om in een array
    $url = "https://geodata.nationaalgeoregister.nl/locatieserver/free?fq=postcode:" . $postcode . "&fq=huisnummer:" . $huisnummer;
    $json = file_get_contents($url);
    $obj = json_decode($json, true);

///Controleerd of er iets geldigs gevonden is en stuurt of een 0 terug of het resultaat
    $found = $obj["response"]["numFound"];
    if ($found != 0) {
        $results = $obj["response"]["docs"]["0"];
        return $results;
    } else {
        return $found;
    }

}




///Geeft foto terug uit de database aan de hand van het productnummer
function sqlfoto($productnr)
{
    ///Database connectie info
    $host = getHost();
    $databasename = getDatabasename();
    $port = getPort();
    $user = getUser();
    $pass = getPass();


    ///SQL maakt statement, voert het uit en zet het in $result
    $sql = "SELECT imagepath FROM stockimages WHERE ImageID IN (SELECT ImageID FROM stockitemstockimages WHERE StockItemID = ?)";
    $connection = mysqli_connect($host, $user, $pass, $databasename, $port);
    $statement = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($statement, "i", $productnr);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    mysqli_stmt_close($statement);

    ///Haalt de foto op en stuurt hem terug

    $foto = mysqli_fetch_array($result);

    if (!isset($foto["0"])) {

        $sql = "SELECT imagepath FROM stockimages WHERE ImageID IN (SELECT ImageID FROM stockgroupstockimages WHERE StockGroupID IN (SELECT StockGroupID FROM stockitemstockgroups WHERE StockItemID = ? AND StockGroupID != 1)) limit 1";
        $connection = mysqli_connect($host, $user, $pass, $databasename, $port);
        $statement = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($statement, "i", $productnr);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        mysqli_stmt_close($statement);

        ///Haalt de foto op en stuurt hem terug

        $foto = mysqli_fetch_array($result);
    }

    return $foto;
}

// Geef producttemperatuur weer
function sqltemp($productnr)
{
    ///Database connectie info
    $host = getHost();
    $databasename = getDatabasename();
    $port = getPort();
    $user = getUser();
    $pass = getPass();

    ///SQL maakt statement, voert het uit en zet het in $result
    $sql = "SELECT temperature FROM coldroomtemperatures WHERE coldroomsensornumber = (SELECT ischillerstock FROM stockitems WHERE stockitemid = ?)";
    $connection = mysqli_connect($host, $user, $pass, $databasename, $port);
    $statement = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($statement, "i", $productnr);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    mysqli_stmt_close($statement);

    ///Haalt de temperatuur op en stuurt hem terug
    $productinfo = mysqli_fetch_array($result);

    $temp = $productinfo["temperature"];

    return number_format($temp, 1, ',', '.');
}
function DatabaseCatogorie($kolom, $tabel)
{
///Database connectie info
    $host = getHost();
    $databasename = getDatabasename();
    $port = getPort();
    $user = getUser();
    $pass = getPass();
///SQL maakt statement, voert het uit en zet het in $result
$connection = mysqli_connect($host, $user, $pass, $databasename, $port);
$sql = "SELECT $kolom FROM $tabel";
$statement = mysqli_prepare($connection, $sql);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);
mysqli_stmt_close($statement);


return ($result);
}



function gerelateerdeProducten ($stockid){
    $host = getHost();
    $databasename = getDatabasename();
    $port = getPort();
    $user = getUser();
    $pass = getPass();
    $sql = "SELECT StockitemID FROM stockitemstockgroups WHERE StockGroupID IN
(SELECT StockGroupID FROM stockitemstockgroups WHERE StockItemID = ? AND StockGroupID != 1)
ORDER BY rand() LIMIT 3";
        $connection = mysqli_connect($host, $user, $pass, $databasename, $port);
        $statement = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($statement, "i", $stockid);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_stmt_close($statement);
    return ($result);
}

function categorieNaam($productnr)
{
    $host = getHost();
    $databasename = getDatabasename();
    $port = getPort();
    $user = getUser();
    $pass = getPass();

    ///SQL maakt statement, voert het uit en zet het in $result
    $sql = "SELECT stockgroupname FROM stockgroups where stockgroupid = ?";
    $connection = mysqli_connect($host, $user, $pass, $databasename, $port);
    $statement = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($statement, "i", $productnr);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    ///Haalt veld op en stuurt het terug
    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($statement);
    return ($result);
}

class CreateDb
{
    public function __construct($msg)
    {
        print($msg);
    }

    public function getData()
    {
        $host = getHost();
        $databasename = getDatabasename();
        $port = getPort();
        $user = getUser();
        $pass = getPass();
        $connection = mysqli_connect($host, $user, $pass, $databasename, $port);
        $sql = "SELECT StockItemID, StockItemName, RecommendedRetailPrice, Photo, SearchDetails FROM stockitems";
        $result = mysqli_query($connection,$sql);
        if(mysqli_num_rows($result)>0)
        {
            return $result;
        }
    }
}







