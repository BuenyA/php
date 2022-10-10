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
    <div class="navigationMenuLogo">
        <img src="image/mobile_logo.png" width="150" height="50" onclick="window.location.href = '../index.php';">
    </div>
    <div class="containerBlur"></div>
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <h1>Passwort <br /> Zurücksetzen</h1>
                <form class="login">
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" class="login__input" placeholder="E-Mail">
                    </div>
                    <a href="../Anmeldung/anmeldung.php">Zurück zum Login</a><br /><br/>
                    <button class="button resetPw__submit">
                        <span class="button__text">Code anfordern</span>
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