<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anmelden</title>
    <link rel="stylesheet" href="anmeldung.css">
    <!-- <script language="javascript" type="text/javascript" src="javascript.js"></script> -->
</head>
<body>

<?php
if(isset($_POST["submit"])){
    echo "hallo";
    require("db.php");
    $stmt = $db->prepare("SELECT * FROM accounts WHERE email = :login__input__email");
    $stmt->bindParam(":login__input__email", $_POST["email"]);
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count == 1){
      $row = $stmt->fetch();
      if(password_verify($_POST["login__input__passwort"], $row["passwort"])){
        session_start();
        $_SESSION["login__input__email"] = $row["email"];
        header("Location: índex.php");
        echo "anmeldung erfolgreich";
      } else {
        echo "Der Login ist fehlgeschlagen";
      }
    } else {
      echo "Der Login ist fehlgeschlagen";
    }
  }

?>

    <div class="navigationMenuLogo">
        <img src="image/AutostarLogo.png" width="200" height="40" onclick="window.location.href = '../index.php';">
    </div>
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <h1>Anmelden</h1>
                <form class="login">
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" class="login__input login__input__email" placeholder="E-Mail">
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" class="login__input login__input__passwort" placeholder="Passwort">
                    </div>
                    <a href="../account/registrierung/registrierung.php">Noch keinen Account?</a><br />
                    <a href="../account/passwordReset.php">Passwort vergessen?</a>
                    <button class="button login__submit" id="submit">
                        <span class="button__text">Anmelden</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>
                </form>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>
</body>
</html>