
<?php
session_start();
include "header.php";
MaakVerbinding();

?>
<h2>Inloggen</h2>
<form xmlns="http://www.w3.org/1999/html">
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
if(isset($_GET["wachtwoord"])) {
    $wachtwoord = $_GET["wachtwoord"];
    $Hash = password_hash($wachtwoord, PASSWORD_DEFAULT);
    $email = $_GET["Email"];
    $wachtwoordDatabase = "SELECT Password FROM user WHERE Email = $email";
    if($Hash == $wachtwoordDatabase){
        print("Eureka!");
    }
        else{
            print ("Fuck");
    }
}
include "footer.php";