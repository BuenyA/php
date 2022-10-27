<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrieren</title>
    <link rel="stylesheet" href="registrierung.css">
    <script language="javascript" type="text/javascript" src="javascript.js"></script>
</head>

<body>
    <?php

        //Datenbank import
        require('../db.php');
        require('function_registrierung.php');


        //Warten bis der Benutzer eine Aktion ausführt
        if(isset($_GET['registieren'])) {

            echo 'HALLO';
                
            //Variablen die der Benutzer eingegeben hat aus dem Formular in Variabeln speichern
            $vorname = $_POST['vorname'];
            $nachname = $_POST['nachname'];
            $plz = $_POST['plz'];
            $ort = $_POST['ort'];
            $adresse = $_POST['adresse'];
            $telefonnummer = $_POST['telefonnummer'];
            $email = $_POST['email'];
            $passwort = $_POST['passwort'];


            //Schauen ob die Eingabe einen Fehler hat
            $error = new function_registrierung ($vorname, $nachname, 
                $plz, $ort, $adresse, $telefonnummer, $email, $passwort);
            $error -> input__test();

            if($error) {
                //Die Eingabe war korrekt
                echo 'Eingabe war korrekt - Account wurde angelegt!';

            } else {
                //Die Eingabe war fehlerhaft
                echo 'Eingabe war Falsch - Bitte Wiederholen!';
            }


        }

    ?>
    <div class="navigationMenuLogo">
        <img src="image/AutostarLogo.png" width="200" height="40" onclick="window.location.href = '../index.php';">
    </div>
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <h1>Registrieren</h1>
                <form action= "registieren" class="login">
                    <div class="login__field__section">
                        <div class="login__field">
                            <i class="login__icon fas fa-user"></i>
                            <!-- input vorname -->
                            <input type="text" class="login__input" placeholder="Vorname" name="input__vorname">
                        </div>
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"></i>
                            <!-- input nachname -->
                            <input type="text" class="login__input" placeholder="Nachname" name="input__nachname">
                        </div>
                    </div>
                    <div class="login__field__section">
                        <div class="login__field login__field__plz">
                            <i class="login__icon fas fa-user"></i>
                            <!-- input plz -->
                            <input type="text" class="login__input login__input__plz" placeholder="PLZ" maxlength="5" name="input__plz">
                        </div>
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"></i>
                            <!-- input ort -->
                            <input type="text" class="login__input" placeholder="Ort" name="input__ort">
                        </div>
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"></i>
                            <!-- input adresse -->
                            <input type="text" class="login__input" placeholder="Straße und Hausnummer" name="input__adresse">
                        </div>
                    </div>
                    <div class="login__field__section">
                        <div class="login__field">
                            <i class="login__icon fas fa-user"></i>
                            <!-- input telefonnummer -->
                            <input type="text" class="login__input" placeholder="Telefonnummer" name="input__telefonnummer">
                        </div>
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"></i>
                            <!-- input geburtstag -->
                            <input type="date" class="login__input" placeholder="Geburtsdatum" name="input__geburtstag">
                        </div>
                    </div>
                    <div class="login__field__section">
                        <div class="login__field">
                            <i class="login__icon fas fa-user"></i>
                            <!-- input email -->
                            <input type="text" class="login__input" placeholder="E-Mail" name="input__email">
                        </div>
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"></i>
                            <!-- input passwort -->
                            <input type="password" class="login__input" placeholder="Passwort" name="input__passwort">
                        </div>
                    </div>
                    <a href="../../account/anmeldung.php">Bereits Registriert?</a><br />
                    <!-- sumbit button -->
                    <button class="button login__submit" name="registrieren__submit">
                        <span class="button__text">Registrieren</span>
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