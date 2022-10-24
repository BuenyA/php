<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autostar - Last Minute Angebote</title>
    <link rel="icon" type="image/png" href="image/AutostarLogoIconTab.png" wid>
    <link rel="stylesheet" href="meinAccount.css">
    <script language="javascript" type="text/javascript" src="anmeldung.js"></script>
</head>

<body>
    <?php
        session_start();
        if (isset($_GET['abmelden'])) {
            session_destroy();
            echo "<script>reloadWindow();</script>";
        }
    ?>
    <div class="backgroundImageFilter">
        <div class="navigationMenu">
            <div class="navigationMenuLogo">
                <img src="image/AutostarLogo.png" width="200" height="40" onclick="window.location.href = '../index.php'">
            </div>
            <ul class="navigationElements">
                <li><a href="../index.php">Home</a></li>
                <li><a href="">Top Angebote</a></li>
                <li><a href="../lastminute/lastminute.php">Last-Minute</a></li>
                <li><a href="../inserieren/inserieren.php">Verkaufen</a></li>
            </ul>
            <div class="navigationMenuButton">
                <?php
                if (!empty($_SESSION['user'])) {
                    echo '
                            <div class="navigationMenuButtonAnmelden">
                            <button onclick="window.location.href = \'account/anmeldung.php\'"><b>Anmelden</b></button>
                            </div>
                            <div class="navigationMenuButtonRegistrieren">
                                <button onclick="window.location.href = \'account/registrierung.php\'"><b>Registrieren</b></button>
                            </div>';
                } else {
                    echo '
                            <div class="navigationMenuButtonMeinAccount">
                                <button onclick="window.location.href = \'account/meinAccount.php\'"><img src="image/nutzer.png" width="15" height="15"><b>Mein Account</b></button>
                            </div>';
                }
                ?>
            </div>
        </div>
    </div>
    <section class="accountManagement">
        <div class="accountManagementBox">
            <form class="login" action="?abmelden=1" method="post">
                <button class="button login__submit" id="submit" name="btn__submit">Log Out</button>
            </form>
        </div>
    </section>
    <section class="footer">
        <div class="footerArea">
            <div class="footerRegion">
                <h1><b>Unternehmen</b></h1>
                <p>Über Uns</p>
                <p>Kontakt</p>
                <p>Hilfe</p>
            </div>
            <div class="footerRegion">
                <h1><b>Verkaufen</b></h1>
                <p>Verkäuferportal</p>
                <p>Anleitung zum Verkaufen</p>
                <p>News für gewerbliche Verkäufer</p>
                <p>Gebühren</p>
                <p>eBay Shop eröffnen</p>
                <p>Grundsätze für Verkäufer: Übersicht</p>
                <p>Verkäufer-Tools</p>
                <p>Versand</p>
                <p>International verkaufen</p>
                <p>Rechtsportal</p>
                <p>Verkäuferschutz</p>
                <p>Elektronik-Ankauf</p>
            </div>
            <div class="footerRegion">
                <h1><b>Handel</b></h1>
                <p>Anmelden</p>
                <p>Registrieren</p>
                <p>Verkaufen</p>
                <p>Händler AGBs</p>
            </div>
            <div class="footerRegion">
                <h1><b>Hilfe</b></h1>
                <p>Barrierefreiheit</p>
                <p>Sicherheitsportal</p>
                <p>Rechtsportal</p>
                <p>Fragen und Antworten</p>
            </div>
        </div>
        <div class="footerBelow">
            <img src="image/AutostarLogo.png" width="200" height="40">
            <p class="footerFooter">Unsere AGBs - Datenschutzerklärung - Impressum - Hinweise zu Cookies - Hinweise zu interessenbasierter Werbung </br>
                ©1996-2022 Autostar AG und Partner-Unternehmen</p>
        </div>
    </section>
</body>

</html>            