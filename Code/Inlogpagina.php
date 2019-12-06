
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
print("Heb je nog geen account? <a href='inloggen.php'>klik hier</a><br>");
    if(password_verify($wachtwoord, $HashedWW)){
        print("Eureka!");
    }
        else{
            print ("Fuck");
    }

} ?>
</div> <?php
include "footer.php";