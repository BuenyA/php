<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autostar - Last Minute Angebote</title>
    <link rel="icon" type="image/png" href="image/AutostarLogoIconTab.png" wid>
    <link rel="stylesheet" href="topangebote.css">
    <!-- <script language="javascript" type="text/javascript" src="javascript.js"></script> -->
</head>

<body>
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
                <div class="navigationMenuButtonAnmelden">
                    <button onclick="window.location.href = '../account/anmeldung.php'"><b>Anmelden</b></button>
                </div>
                <div class="navigationMenuButtonRegistrieren">
                    <button onclick="window.location.href = '../account/registrierung/registrierung.php'"><b>Registrieren</b></button>
                </div>
            </div>
        </div>
    </div>
    <section class="baldAblaufend">
        <h1>Top Angebote</h1>
        <?php
        require_once '../db.php';

        $counter = 0;
        $showMax = 6;
        $queryInserat = "SELECT * FROM Inserat JOIN Accounts ON Inserat.Inhaber_Nr = Accounts.account_ID ORDER BY Erstzulassung ASC";
        $resInserat = $db->query($queryInserat);
        
        if ($resInserat !== false && $resInserat->rowCount() > 0) {
            foreach ($resInserat as $row) {
                if ($counter == $showMax) {
                    break;
                }
                if (($counter % 2) == 0) {
                    echo '
                        <div class="topOfferPlace">
                            <div class="topOffers">
                                <img src="image/auto_jaguar.jpg" alt="Bild konnte nicht geladen werden..." width="250" height="250">
                                <div class="topOffersRight">
                                    <div class="topOffersRightTop">
                                        <h2>' . $row['Marke'] . ' ' . $row['Modell'] . '</h2>
                                        <p class="auktionspreis"><b>' . number_format($row['Preis'] ,0, '.', '.') . ' €</b></p>
                                    </div>
                                    <p>
                                        ' . number_format($row['Kilometerstand'] ,0, ',', '.') . ' km, ' . ceil($row['PS'] / 1.35962) . ' kW (' . $row['PS'] . ' PS), ' . $row['Kraftstoffart'] . ', ' . $row['Getriebeart'] . '
                                    </p>
                                    <p>
                                        ' . $row['vorname'] . ' ' . $row['nachname'] . ' </br>
                                        Tel.: +49 123 456789</br>
                                        Ort: ' . $row['ort'] . '
                                    </p>
                                    <button>
                                        <img src="image/herz.png" width="13" height="13">
                                        Merken
                                    </button>
                                </div>
                            </div>
                        ';
                } else {
                    echo '
                            <div class="topOffers">
                                <img src="image/auto_jaguar.jpg" alt="Bild konnte nicht geladen werden..." width="250" height="250">
                                <div class="topOffersRight">
                                    <div class="topOffersRightTop">
                                        <h2>' . $row['Marke'] . ' ' . $row['Modell'] . '</h2>
                                        <p class="auktionspreis"><b>' . number_format($row['Preis'] ,0, ',', '.') . ' €</b></p>
                                    </div>
                                    <p>
                                        ' . number_format($row['Kilometerstand'] ,0, ',', '.') . ' km, ' . ceil($row['PS'] / 1.35962) . ' kW (' . $row['PS'] . ' PS), ' . $row['Kraftstoffart'] . ', ' . $row['Getriebeart'] . '
                                    </p>
                                    <p>
                                        ' . $row['vorname'] . ' ' . $row['nachname'] . ' </br>
                                        Tel.: +49 123 456789</br>
                                        Ort: ' . $row['ort'] . '
                                    </p>
                                    <button>
                                        <img src="image/herz.png" width="13" height="13">
                                        Merken
                                    </button>
                                </div>
                            </div>
                        </div>
                        ';
                }
                $counter++;
            }
            if (($counter % 2) != 0) {
                echo '</div>';
            }
        }
        unset($db);
        ?>
        <button class="btnMehrAnzeigen">
            Mehr Anzeigen
            <img src="image/down-arrow.png" width="20" height="20">
        </button>
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