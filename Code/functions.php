<?php

///Geeft de waarde van 1 veld terug uit de database aan de hand van het productnummer
function sql($tabel, $veld, $productnr)
{
    ///Database connectie info
    $host = "localhost";
    $databasename = "wideworldimporters";
    $port = 3306;
    $user = "root";
    $pass = "";

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
function search($zoekterm)
{
    ///Database connectie info
    $host = "localhost";
    $databasename = "wideworldimporters";
    $port = 3306;
    $user = "root";
    $pass = "";

    ///maakt lege array aan waar zo de product IDs in komen
    $IDs = array();

    $zoektermem = explode(" ", $zoekterm);
    $aantalzoektermen = count($zoektermem);

    foreach ($zoektermem as $term) {
        ///SQL maakt statement, voert het uit en zet het in $result
        $likestring = "%" . $term . "%";
        $sql = "SELECT StockItemID FROM stockitems WHERE SearchDetails LIKE ? OR Tags LIKE ?";
        $connection = mysqli_connect($host, $user, $pass, $databasename, $port);
        $statement = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($statement, "ss", $likestring, $likestring);
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