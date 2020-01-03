<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<?php
session_start();
if (isset($_SESSION["voornaam"])){
include "header.php";
?>
<div class="container">
    <h2>Wachtwoord aanpassen</h2>

    <div class="row" style="width: 90%; padding: 5%">

        <div class="col-md-6">

            <form method="post">
                <div class="form-group">
                    Wachtwoord
                    <input type="password" name="wachtwoord" placeholder="Vul hier je wachtwoord"
                           class="form-control input-lg" required>
                </div>

                Nieuw wachtwoord
                <div class="form-group">
                    <input type="password" name="nieuw_wachtwoord" placeholder="Typ hier je wachtwoord" required
                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                           class="form-control input-lg" id="wachtwoord"
                           onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Wachtwoord moet minimaal uit 8 tekens bestaan, en moet 1 hoofdletter, kleine letter, cijfer en ander karakter bevatten!' : ''); if(this.checkValidity()) form.bevestig_ww.pattern = this.value;"
                    />

                </div>
                Bevestig nieuw wachtwoord
                <div class="form-group">
                    <input placeholder="Bevestig het wachtwoord" class="form-control input-lg"
                           title="Vul het wachtwoord hetzelfde als hierboven in!" type="password" id="bevestig_ww"
                           name="bevestig_ww" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                           onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Vul het wachtwoord hetzelfde als hierboven in!' : '');"
                           required
                    />
                </div>
                <input type="submit" name="wijzigen" value="Wachtwoord wijzigen" class="btn btn-primary">
        </div>
    </div>
</div>
</form>
</body>
<?php
if (isset($_POST["wijzigen"])) {
    $wachtwoord = $_POST["wachtwoord"];
    $nieuwww = $_POST["nieuw_wachtwoord"];
    $bevestig = $_POST["bevestig_ww"];
    $userid = $_SESSION["UserID"];
    $connection = MaakVerbinding();
    $sql = "SELECT Password FROM user WHERE UserID = ?";
    $statement = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($statement, "i", $userid);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    mysqli_stmt_close($statement);
    $row = mysqli_fetch_array($result);
    $HashedWW = $row["Password"];
    Sluitverbinding($connection);
    //controleren dat het wachtwoord klopt en voldoet aan de eisen
    if (password_verify($wachtwoord, $HashedWW) && $nieuwww != $wachtwoord && $nieuwww == $bevestig) {
        $Password = password_hash($nieuwww, PASSWORD_DEFAULT);
        $connection = MaakVerbinding();
        $sql = "UPDATE user SET Password=? WHERE UserID = ?";
        $statement = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($statement, "si", $Password, $userid);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        mysqli_stmt_close($statement);
        Sluitverbinding($connection);
    } elseif ($nieuwww != $bevestig){
        print("<h1 style='color: red; text-align: center; background-color: #00fafa'><h1>Error: Voer het zelfde wachtwoord in!</h1>");
    } else{
        print("<h1 style='color: red; text-align: center; background-color: #00fafa'><h1>Error: Wachtwoord is incorrect!</h1>");
    }
}
}
else {
    $URL = "index.php";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
}
include "footer.php";