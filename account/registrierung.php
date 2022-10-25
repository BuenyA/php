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
    if (isset($_GET['registrieren__submit'])) {

        //Datenbank import
        require('../../db.php');
        require('function_registrierung.php');

        //Überprüfung ob die Eingabe korrekt war
        $fehler = new function_registrierung(
            $_GET['input__vorname'],
            $_GET['input__nachname'],
            $_GET['input__plz'],
            $_GET['input__ort'],
            $_GET['input__adresse'],
            $_GET['input__telefonnummer'],
            $_GET['input__geburtstag'],
            $_GET['input__email'],
            $_GET['input__passwort']
        );
        $fehler->input__test();
        if (!$fehler) {
            echo 'Kein Fehler';
        } else {
            echo 'Fehler';
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
                <form class="login">
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