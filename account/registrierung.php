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

        //Warten bis der Benutzer eine Aktion ausführt
        if(isset($_GET['registieren'])) {                

                
            //Variablen die der Benutzer eingegeben hat aus dem Formular in Variabeln speichern
            $vorname = $_POST['input__vorname'];
            $nachname = $_POST['input__nachname'];
            $plz = $_POST['input__plz'];
            $ort = $_POST['input__ort'];
            $adresse = $_POST['input__adresse'];
            $telefonnummer = $_POST['input__telefonnummer'];
            $email = $_POST['input__email'];
            $passwort1 = $_POST['input__passwort1'];
            $passwort2 = $_POST['input__passwort2'];
            $passwortHash = password_hash($passwort1, PASSWORD_DEFAULT);

            //Überprüfung der Eingabe auf Korrektheit
            $error = false;
            //Überprüft ob ein Vorname eingegeben wurde
            if(strlen($vorname) == 0){
                echo 'Vorname fehlt ';
                $error = true;
            }
            //Überprüft ob ein Nachname eingegeben wurde            
            if(strlen($nachname) == 0){
                echo 'Nachname fehlt ';
                $error = true;
            }
            //Überprüft ob eine plz eingegeben wurde
            if(strlen($plz) == 0){
                echo 'Postleihzahl fehlt ';
                $error = true;
            }
            //Überprüft ob ein Ort eingegeben wurde
            if(strlen($ort) == 0){
                echo 'Ort fehlt ';
                $error = true;
            }
            //Überprüft ob eine Adresse eingegeben wurde
            if(strlen($adresse) == 0){
                echo 'Adresse fehlt ';
                $error = true;
            }
            //Überprüft ob eine Telefonnummer eingegeben wurde
            if(strlen($telefonnummer) == 0){
                echo 'Telefonnummer fehlt ';
                $error = true;
            }
            //Überprüft ob eine Email eingegeben wurde
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo 'Email ungültig ';
                $error = true;
            }
            //Überprüft ob ein Passwort eingegeben wurde
            if (strlen($passwort1) == 0) {
                echo 'Passwort fehlt ';
                $error = true;
            }
            //Überprüft ob das Passwort wiederholt wurde 
            if (strlen($passwort2) == 0) {
                echo 'Passwort wiederholen ';
                $error = true;
            }
            //Überprüft ob beide Passwöter übereinstimmen
            if ($passwort1 != $passwort2) {
                echo 'Passwörter stimmen nicht überein ';
                $error = true;
            }

            //Die Eingabe war korrekt
            if(!$error) {
                //Qeury erstellen und ausführen
                $query = "INSERT INTO Accounts(vorname, nachname, plz, ort, adresse, email, passwort) VALUES ('$vorname','$nachname','$plz','$ort','$adresse','$email','$passwortHash')";
                $db->query($query);
            } 
            
            //Datenbank schließen
            unset($db);
        }

    ?>
    <div class="navigationMenuLogo">
        <img src="image/AutostarLogo.png" width="200" height="40" onclick="window.location.href = '../index.php';">
    </div>
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <h1>Registrieren</h1>
                <form action= "?registieren=1" method="post" class="login">
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
                            <!-- input email -->
                            <input type="text" class="login__input" placeholder="E-Mail" name="input__email">
                        </div>
                    </div>
                    <div class="login__field__section">
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"></i>
                            <!-- input passwort 1 -->
                            <input type="password" class="login__input" placeholder="Passwort" name="input__passwort1">
                        </div>
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"></i>
                            <!-- input passwort 2 -->
                            <input type="password" class="login__input" placeholder="Passwort wiederholen" name="input__passwort2">
                        </div>
                    </div>
                    <a href="anmeldung.php">Bereits Registriert?</a><br />
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