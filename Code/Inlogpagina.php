
<?php
session_start();
include "header.php";
include_once '../config.php';
?>
<div style="width: 90%; padding: 5%">
<h2>Inloggen</h2>
<form xmlns="http://www.w3.org/1999/html" method="post">
<div class="form-group">
                    Email
                    <input type="text" name="Email" placeholder="Vul hier je email"
                           class="form-control input-lg" required>
                </div>
    <div class="form-group">
        Wachtwoord
        <input type="password" name="wachtwoord" placeholder="Vul hier je wachtwoord"
               class="form-control input-lg" required>
    </div>
    <input type="submit" value="Aanmelden">
</form>
<?php
print("Heb je nog geen account? <a href='inloggen.php'>klik hier</a><br>");
$host = getHost();
$databasename = getDatabasename();
$port = getPort();
$user = getUser();
$pass = getPass();
if(isset($_POST["wachtwoord"])) {
    $wachtwoord = $_POST["wachtwoord"];
    $email = $_POST["Email"];
    $connection = mysqli_connect($host, $user, $pass, $databasename, $port);
    $sql= "SELECT Password FROM user WHERE Email = ?";
    $statement = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($statement, "s", $email);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    mysqli_stmt_close($statement);
    $row = mysqli_fetch_array($result);
    $HashedWW = $row["Password"];

    if(password_verify($wachtwoord, $HashedWW)){
        $connection = mysqli_connect($host, $user, $pass, $databasename, $port);
        $sql= "SELECT FirstName, LastName, Infix, Streetname, HouseNumber, Annex, PostalCode, City, Email,NewsLetter FROM user WHERE Email = ?";
        $statement = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($statement, "s", $email);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        mysqli_stmt_close($statement);
        $row = mysqli_fetch_array($result);

        $_SESSION["voornaam"] = $row["FirstName"];
        $_SESSION["achternaam"] = $row["LastName"];
        $_SESSION["tussenvoegsel"] = $row["Infix"];
        $_SESSION["email"] = $row["Email"];
        $_SESSION["huisnummer"] = $row["HouseNumber"];
        $_SESSION["annex"] = $row["Annex"];
        $_SESSION["straatnaam"] = $row["Streetname"];
        $_SESSION["plaats"] = $row["City"];
        $_SESSION["postcode"] = $row["PostalCode"];
        $_SESSION["newsletter"] = $row["NewsLetter"];
        $URL="accountinfo.php";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
        die();
    }
        else{
            print ("Email of wachtwoord is incorrect");
    }

} ?>
</div> <?php
include "footer.php";