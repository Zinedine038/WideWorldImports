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

    $foto = array();

    ///SQL maakt statement, voert het uit en zet het in $result
    $sql = "SELECT imagepath FROM stockimages WHERE ImageID IN (SELECT ImageID FROM stockitemstockimages WHERE StockItemID = ?)";
    $connection = mysqli_connect($host, $user, $pass, $databasename, $port);
    $statement = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($statement, "i", $productnr);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    mysqli_stmt_close($statement);

    ///Haalt de foto op en stuurt hem terug

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        array_push($foto,$row["imagepath"]);}

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
function MaakVerbinding()
{
    $host = getHost();
    $databasename = getDatabasename();
    $port = getPort();
    $user = getUser();
    $pass = getPass();
    $connection = mysqli_connect($host, $user, $pass, $databasename);
    return $connection;
}
function Sluitverbinding($connection)
{
    mysqli_close($connection);
}

function VoegKlantToe($FirstName, $LastName, $Infix, $Streetname, $HouseNumber, $Annex ,$PostalCode, $City, $Email, $Password, $NewsLetter)
{
    $host = getHost();
    $databasename = getDatabasename();
    $port = getPort();
    $user = getUser();
    $pass = getPass();
    $connection = mysqli_connect($host, $user, $pass, $databasename);
    $Password = password_hash($Password, PASSWORD_DEFAULT);
    $statement = mysqli_prepare($connection, "INSERT INTO user (FirstName, LastName, Infix, Streetname, HouseNumber, Annex , PostalCode, City, Email, Password, NewsLetter) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
    mysqli_stmt_bind_param($statement, 'ssssisssssb', $FirstName, $LastName, $Infix, $Streetname, $HouseNumber, $Annex, $PostalCode, $City, $Email, $Password, $NewsLetter);
    mysqli_stmt_execute($statement);
    return mysqli_stmt_affected_rows($statement) == 1;
}

function KlantGegevensToevoegen($gegevens) {
    $connection = MaakVerbinding();
    if (VoegKlantToe($connection, $gegevens["FirstName"], $gegevens["LastName"], $gegevens["Streetname"], $gegevens["HouseNumber"], $gegevens["PostalCode"], $gegevens["City"], $gegevens["Email"], $gegevens["Password"]) == 1)
        $gegevens["melding"] = "De klant is toegevoegd";
    else $gegevens["melding"] = "Het toevoegen is mislukt";
    SluitVerbinding($connection);
    return $gegevens;
}

//Gets the parent from the parent array using a child key as search term (name, ID etc.)
function getparent($array, $needle) {
    foreach($array as $key => $value) {
        if(in_array($needle, $value)) return $key;
    }
}

//Calculates the total amount of items in the cart including multiple units of 1 item
function getTotalItems($array)
{
    $total = 0;
    for($i = 0; $i<count($array); $i++)
    {
        if(isset($array[$i]['amount']))
        {
            $total+=$array[$i]['amount'];
        }
    }
    return $total;
}

//Updates the shopping cart
function updateShoppingCart()
{
    if (isset($_POST['add'])) {
        if (isset($_SESSION['cart']))
        {
            $item_array_id = array_column($_SESSION['cart'], "product_id");
            //Add to an existing product
            if (in_array(($_POST['product_id']), $item_array_id))
            {
                $name = sql("stockitems", "stockitemname", $_POST["product_id"]);
                $keyIndex = getparent($_SESSION['cart'], $name);
                $_SESSION['cart'][$keyIndex]['amount'] += 1;
            }
            //Add a new unique item to the cart if the cart exists
            else
            {
                $count = count($_SESSION['cart']);
                $name = sql("stockitems", "stockitemname", $_POST["product_id"]);
                $item_array = array('product_id' => $_POST['product_id'],
                    'amount' => 1,
                    'name' => $name);
                $_SESSION['cart'][$count] = $item_array;
            }
        }
        //Creates the shopping cart and adds the item
        else
        {
            $name = sql("stockitems", "stockitemname", $_POST["product_id"]);
            $item_array = array('product_id' => $_POST['product_id'],
                'amount' => 1,
                'name' => $name);
            $_SESSION['cart'][0] = $item_array;
        }
    }
}

//Creates the database
class CreateDb
{
    //Constructor
    public function __construct($msg)
    {
        print($msg);
    }

    //Getdata function
    public function getData()
    {
        $host = getHost();
        $databasename = getDatabasename();
        $port = getPort();
        $user = getUser();
        $pass = getPass();
        $connection = mysqli_connect($host, $user, $pass, $databasename, $port);
        $sql = "SELECT StockItemID, StockItemName, RecommendedRetailPrice, Photo, SearchDetails, UnitPrice FROM stockitems";
        $result = mysqli_query($connection,$sql);
        if(mysqli_num_rows($result)>0)
        {
            return $result;
        }
    }
}







