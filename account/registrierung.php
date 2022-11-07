<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrieren</title>
    <link rel="stylesheet" href="registrierung.css">
    <script language="javascript" type="text/javascript" src="../index.js"></script>
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

            //Die Eingabe war korrekt
            if((filter_var($email, FILTER_VALIDATE_EMAIL)) && ($passwort1 == $passwort2)) {
                //Qeury erstellen und ausführen
                $query = "INSERT INTO Accounts(vorname, nachname, plz, ort, adresse, telefon_Nr, email, passwort) VALUES ('$vorname','$nachname','$plz','$ort','$adresse', '$telefonnummer', '$email','$passwortHash')";
                $db->query($query);

                //Weiterleitung zu Bestätigungsseite
                
            } else {
                //Überprüft ob eine gültige Email eingegeben wurde
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo 'Email ungültig ';
                }
                //Überprüft ob beide Passwöter übereinstimmen
                if ($passwort1 != $passwort2) {
                    echo 'Passwörter stimmen nicht überein ';
                }
            }
            
            //Datenbank schließen
            unset($db);
        }

    ?>
    <div class="navigationMenuLogo">
        <img src="image/AutostarLogo.png" width="200" height="40" onclick="reloadWindow()">
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
                            <input type="text" class="login__input" placeholder="Vorname" name="input__vorname" required>
                        </div>
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"></i>
                            <!-- input nachname -->
                            <input type="text" class="login__input" placeholder="Nachname" name="input__nachname" required>
                        </div>
                    </div>
                    <div class="login__field__section">
                        <div class="login__field login__field__plz">
                            <i class="login__icon fas fa-user"></i>
                            <!-- input plz -->
                            <input type="text" class="login__input login__input__plz" placeholder="PLZ" maxlength="5" name="input__plz" required>
                        </div>
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"></i>
                            <!-- input ort -->
                            <input type="text" class="login__input" placeholder="Ort" name="input__ort" required>
                        </div>
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"></i>
                            <!-- input adresse -->
                            <input type="text" class="login__input" placeholder="Straße und Hausnummer" name="input__adresse" required>
                        </div>
                    </div>
                    <div class="login__field__section">
                        <div class="login__field">
                            <i class="login__icon fas fa-user"></i>
                            <!-- input telefonnummer -->
                            <input type="text" class="login__input" placeholder="Telefonnummer" name="input__telefonnummer" required>
                        </div>
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"></i>
                            <!-- input email -->
                            <input type="text" class="login__input" placeholder="E-Mail" name="input__email" required>
                        </div>
                    </div>
                    <div class="login__field__section">
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"></i>
                            <!-- input passwort 1 -->
                            <input type="password" class="login__input" placeholder="Passwort" name="input__passwort1" required>
                        </div>
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"></i>
                            <!-- input passwort 2 -->
                            <input type="password" class="login__input" placeholder="Passwort wiederholen" name="input__passwort2" required>
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