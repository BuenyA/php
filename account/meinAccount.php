<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autostar - Last Minute Angebote</title>
    <link rel="icon" type="image/png" href="image/AutostarLogoIconTab.png" wid>
    <link rel="stylesheet" href="meinAccount.css">
    <script language="javascript" type="text/javascript" src="../index.js"></script>
</head>

<body>
    <?php
    session_start();
    if (isset($_GET['abmelden'])) {
        session_destroy();
        echo "<script>reloadWindow();</script>";
    }
    if (empty($_SESSION['user'])) {
        echo '<script>linkToAnmeldung();</script>';
    }
    ?>
    <div class="backgroundImageFilter">
        <div class="navigationMenu">
            <div class="navigationMenuLogo">
                <img src="image/AutostarLogo.png" width="200" height="40" onclick="window.location.href = '../index.php'">
            </div>
            <ul class="navigationElements">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../topangebote/topangebote.php">Top Angebote</a></li>
                <li><a href="../lastminute/lastminute.php">Last-Minute</a></li>
                <li><a href="../inserieren/inserieren.php">Verkaufen</a></li>
            </ul>
            <div class="navigationMenuButton">
                <?php
                if (!empty($_SESSION['user'])) {
                    echo '
                            <div class="navigationMenuButtonAnmelden">
                            <button onclick="window.location.href = \'anmeldung.php\'"><b>Anmelden</b></button>
                            </div>
                            <div class="navigationMenuButtonRegistrieren">
                                <button onclick="window.location.href = \'registrierung.php\'"><b>Registrieren</b></button>
                            </div>';
                } else {
                    echo '
                            <div class="navigationMenuButtonMeinAccount">
                                <button onclick="window.location.href = \'meinAccount.php\'"><img src="../image/nutzer.png" width="15" height="15"><b>Mein Account</b></button>
                            </div>';
                }
                ?>
            </div>
        </div>
    </div>
    <section class="accountManagement">
        <?php
        echo '<h1>Guten Tag ' . $_SESSION['vorname'] . '</h1>';
        ?>
        <div class="accountManagementBody">
            <div class="accountManagementNavigation">
                <div class="accountManagementNavigationMeinKonto">
                    <h3>Mein Konto</h3>
                </div>
                <h3>Meine Inserate</h3>
                <h3>Meine Gebote</h3>
                <h3>Meine Favoriten</h3>
            </div>
            <div class="accountManagementElements">
                <div class="accountManagementBox">
                    <h2>Mein Account</h2>
                </div>
                <div class="accountAusloggenBox">
                    <div class="accountAusloggenBoxLeft">
                        <h2>Ausloggen</h2>
                        <p>Möchten Sie sich ausloggen? <br />Dann betätigen Sie die folgende Schaltfläche.</p>
                    </div>
                    <div class="accountAusloggenBoxRight">
                        <form class="login" action="?abmelden=1" method="post">
                            <button class="button login__submit" id="submit" name="btn__submit"><b>Log Out</b></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="accountManagementSpace">

            </div>
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