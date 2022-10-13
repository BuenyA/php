<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autostar - Last Minute Angebote</title>
    <link rel="icon" type="image/png" href="image/AutostarLogoIconTab.png" wid>
    <link rel="stylesheet" href="lastminute.css">
    <!-- <script language="javascript" type="text/javascript" src="javascript.js"></script> -->
</head>

<body>
    <?php
    require_once '../db.php';

    $query = "SELECT * FROM Inserat ORDER BY Erstzulassung ASC";

    $res = $db->query($query);
    if ($res !== false && $res->rowCount() > 0) {
        foreach ($res as $row) {
            echo 'Marke: ' . $row['Marke'] . ', Modell: ' . $row['Modell'];
        }
    }

    unset($db);
    ?>
    <div class="backgroundImageFilter">
        <div class="navigationMenu">
            <div class="navigationMenuLogo">
                <img src="image/AutostarLogo.png" width="200" height="40" onclick="window.location.href = '../index.php'">
            </div>
            <ul class="navigationElements">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../TopAngebote/topangebote.php">Top Angebote</a></li>
                <li><a href="">Last-Minute</a></li>
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
        <h1>Last-Minute-Angebote...</h1>
        <div class="topOfferPlace">
            <div>
                <div class="topOffers">
                    <img src="image/auto_jaguar.jpg" alt="Bild konnte nicht geladen werden..." width="250" height="250">
                    <div class="topOffersRight">
                        <div class="topOffersRightTop">
                            <h2>Audi A5 quattro</h2>
                            <p class="auktionspreis"><b>24.000 €</b></p>
                        </div>
                        <p>
                            52.000 km, 140 kW (190 PS), Kombi, Benzin,
                            Automatik, HU 02/2024, 4/5 Türen...
                        </p>
                        <p>
                            Bünyamin Aydemir</br>
                            Tel.: +49 123 456789</br>
                            Bietigheim-Bissigen
                        </p>
                        <button>
                            <img src="image/herz.png" width="13" height="13">
                            Merken
                        </button>
                    </div>
                </div>
                <div class="topOffers">
                    <img src="image/auto_jaguar.jpg" alt="Bild konnte nicht geladen werden..." width="250" height="250">
                    <div class="topOffersRight">
                        <div class="topOffersRightTop">
                            <h2>Audi A5 quattro</h2>
                            <p class="auktionspreis"><b>24.000 €</b></p>
                        </div>
                        <p>
                            52.000 km, 140 kW (190 PS), Kombi, Benzin,
                            Automatik, HU 02/2024, 4/5 Türen...
                        </p>
                        <p>
                            Bünyamin Aydemir</br>
                            Tel.: +49 123 456789</br>
                            Bietigheim-Bissigen
                        </p>
                        <button>
                            <img src="image/herz.png" width="13" height="13">
                            Merken
                        </button>
                    </div>
                </div>
            </div>
            <div>
                <div class="topOffers">
                    <img src="image/auto_jaguar.jpg" alt="Bild konnte nicht geladen werden..." width="250" height="250">
                    <div class="topOffersRight">
                        <div class="topOffersRightTop">
                            <h2>Audi A5 quattro</h2>
                            <p class="auktionspreis"><b>24.000 €</b></p>
                        </div>
                        <p>
                            52.000 km, 140 kW (190 PS), Kombi, Benzin,
                            Automatik, HU 02/2024, 4/5 Türen...
                        </p>
                        <p>
                            Bünyamin Aydemir</br>
                            Tel.: +49 123 456789</br>
                            Bietigheim-Bissigen
                        </p>
                        <button>
                            <img src="image/herz.png" width="13" height="13">
                            Merken
                        </button>
                    </div>
                </div>
                <div class="topOffers">
                    <img src="image/auto_jaguar.jpg" alt="Bild konnte nicht geladen werden..." width="250" height="250">
                    <div class="topOffersRight">
                        <div class="topOffersRightTop">
                            <h2>Audi A5 quattro</h2>
                            <p class="auktionspreis"><b>24.000 €</b></p>
                        </div>
                        <p>
                            52.000 km, 140 kW (190 PS), Kombi, Benzin,
                            Automatik, HU 02/2024, 4/5 Türen...
                        </p>
                        <p>
                            Bünyamin Aydemir</br>
                            Tel.: +49 123 456789</br>
                            Bietigheim-Bissigen
                        </p>
                        <button>
                            <img src="image/herz.png" width="13" height="13">
                            Merken
                        </button>
                    </div>
                </div>
            </div>
        </div>
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