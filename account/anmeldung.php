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

//Datenbank import
require('../db.php');

//Warten bis der Benutzer einen Anmeldeversuch startet
if(isset($_GET["btn__submit"])) {



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
                        <!-- Input email -->
                        <input type="text" name="input__email" class="login__input login__input__email" placeholder="E-Mail">
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <!-- input passwort -->
                        <input type="password" name="input__passwort" class="login__input login__input__passwort" placeholder="Passwort">
                    </div>
                    <a href="../account/registrierung/registrierung.php">Noch keinen Account?</a><br />
                    <a href="../account/passwordReset.php">Passwort vergessen?</a>
                    <!-- sumbit button -->
                    <button class="button login__submit" id="submit" name="btn__submit">
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