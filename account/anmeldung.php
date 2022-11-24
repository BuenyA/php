<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anmelden</title>
    <link rel="stylesheet" href="anmeldung.css">
    <script language="javascript" type="text/javascript" src="../allgemeines/index.js"></script>
</head>

<body>
    <div class="navigationMenuLogo">
        <img src="../image/AutostarLogo.png" width="200" height="40" onclick="reloadWindow()">
    </div>
    <div class="container">
        <?php
        session_start();
        require('../allgemeines/db.php');
        if (isset($_GET['anmelden']) && sizeof($_POST) !== 0) {
            $query = "SELECT * FROM Accounts WHERE email = '" . $_POST['input__email'] . "'";
            $res = $db->query($query);
            $rowLog = $res->fetch();
            if ($_POST['input__passwort'] !== '' and $res->rowCount() > 0) {
                if (password_verify($_POST['input__passwort'], $rowLog['passwort'])) {
                    if ($res !== false && $res->rowCount() > 0) {
                        $_SESSION['user'] = $_POST['input__email'];
                        $_SESSION['id'] = $rowLog['account_ID'];
                        $_SESSION['vorname'] = $rowLog['vorname'];
                        $_SESSION['nachname'] = $rowLog['nachname'];
                    }
                }
            }
        }
        if(!empty($_SESSION['user'])) {
            header('Location: ../index.php');
        }
        if (empty($_SESSION['user'])) {
            echo '
            <div class="screen">
            <div class="screen__content">
                <h1>Anmelden</h1>
                <form class="login" action="?anmelden=1" method="post">
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <!-- Input email -->
                        <input type="email" name="input__email" class="login__input login__input__email" placeholder="E-Mail" required>
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <!-- input passwort -->
                        <input type="password" name="input__passwort" class="login__input login__input__passwort" placeholder="Passwort" required>
                    </div>';
            if (isset($_GET['anmelden'])) {
                echo    '<div class="falschesPasswort" id="falschesPasswort">
                            <p>Falsche Angaben! Bitte erneut versuchen.</p>
                        </div>';
            }
                echo '  <a href="registrierung.php">Noch keinen Account?</a><br />
                        <a href="passwordReset.php">Passwort vergessen?</a>
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
            </div>';
        }
        ?>
    </div>
</body>

</html>