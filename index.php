<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autostar - Deine Auktionsseite für Automobile</title>
    <link rel="icon" type="image/png" href="image/AutostarLogoIconTab.png" wid>
    <link rel="stylesheet" href="stylesheet.css">
    <script language="javascript" type="text/javascript" src="javascript.js"></script>
</head>

<body>
    <section>
        <div class="backgroundImageFilter">
            <div class="navigationMenu">
                <div class="navigationMenuLogo">
                    <img src="image/AutostarLogo.png" width="200" height="40" onclick="window.location.href = ''">
                </div>
                <ul class="navigationElements">
                    <li><a href="">Home</a></li>
                    <li><a href="TopAngebote/topangebote.php">Top Angebote</a></li>
                    <li><a href="LastMinute/lastminute.php">Last-Minute</a></li>
                    <li><a href="Inserieren/inserieren.php">Verkaufen</a></li>
                </ul>
                <div class="navigationMenuButton">
                    <div class="navigationMenuButtonAnmelden">
                        <button onclick="window.location.href = 'account/anmeldung.php';"><b>Anmelden</b></button>
                    </div>
                    <div class="navigationMenuButtonRegistrieren">
                        <button onclick="window.location.href = 'account/registrierung/registrierung.php';"><b>Registrieren</b></button>
                    </div>
                </div>
            </div>
            <div class="searchBarFilterBox">
                <div class="searchBarSection">
                    <div class="searchBar">
                        <div class="searchBarBox">
                            <img src="image/search-interface-symbol.png" alt="" width="17" height="17">
                            <input type="search" text="Suchen...">
                        </div>
                    </div>
                </div>
                <div class="filterBoxSection">
                    <div class="filterBox">
                        <div class="filterBoxLeft">
                            <div class="PKW" id="PKW" onclick="colorSwitchPKW()">
                                <img class="filterBoxLeftPKWImg" id="filterBoxLeftPKWImg" src="image/car.png" alt="PKW" width="50" height="50">
                            </div>
                            <div class="MOPED" id="MOPED" onclick="colorSwitchMOPED()">
                                <img class="filterBoxLeftMOPEDImg" id="filterBoxLeftMOPEDImg" src="image/motorbike(2).png" alt="MOPED" width="50" height="50">
                            </div>
                            <div class="LKW" id="LKW" onclick="colorSwitchLKW()">
                                <img class="filterBoxLeftLKWImg" id="filterBoxLeftLKWImg" src="image/truck.png" alt="LKW" width="45" height="45">
                            </div>
                        </div>
                        <div class="filterBoxRight">
                            <div class="PKWRight">
                                <div class="filterBoxRightAttribute">
                                    <div>
                                        <div class="Marke">
                                            <h2>Marke</h2>
                                            <select>
                                                <option>Audi</option>
                                                <option>Audi</option>
                                                <option>Audi</option>
                                                <option>Audi</option>
                                                <option>Tesla</option>
                                            </select>
                                        </div>
                                        <div class="Modell">
                                            <h2>Modell</h2>
                                            <select>
                                                <option>RS6</option>
                                                <option>RS6</option>
                                                <option>RS6</option>
                                                <option>RS6</option>
                                                <option>Modell S</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="KilometerBis">
                                            <h2>Kilometer</h2>
                                            <input type="search" placeholder="Bis..." autocomplete="off" maxlength="10" type="number">
                                        </div>
                                        <div class="Erstzulassung">
                                            <h2>Erstzulassung</h2>
                                            <input type="search" placeholder="Jahr" autocomplete="off" maxlength="10" type="number">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="Preis">
                                            <h2>Preis</h2>
                                            <div class="preisAngabe">
                                                <input type="search" placeholder="Von..." autocomplete="off" maxlength="10" type="number">
                                                <input type="search" placeholder="Bis..." autocomplete="off" maxlength="10" type="number">
                                            </div>
                                        </div>
                                        <div class="btnAngebotSuchenDiv">
                                            <h2>Suchen</h2>
                                            <button class="btnAngebotSuchen">
                                                <img src="image/search-interface-symbol.png" alt="" width="17" height="17">
                                                <b>Angebot suchen</b>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="MOPEDRight"></div>
                            <div class="LKWRight"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="topOffer">
        <h1>Top-Angebote</h1>
        <?php
        require_once './db.php';

        $counter = 0;
        $showMax = 4;
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
        ?>
        <button class="btnMehrAnzeigen">
            Mehr Anzeigen
            <img src="image/right-arrows.png" width="20" height="20">
        </button>
    </section>
    <section class="baldAblaufend">
        <h1>Last-Minute-Angebote...</h1>
        <?php
        $counter = 0;
        $showMax = 4;
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
            <img src="image/right-arrows.png" width="20" height="20">
        </button>
    </section>
    <section class="AutostarApp">
        <img src="image/AutostarApp.png" width="350" height="500">
        <div class="AutostarAppText">
            <div class="AutostarAppUberschrift">
                <img src="image/AutostarLogo.png" width="250" height="50">
                <h1>-App downloaden!</h1>
            </div>
            <p>Lade dir jetzt unsere kostenlose Mobil-App herunter!</p>
            <div class="stores">
                <a class="playstore" href="https://play.google.com/" target="_blank">
                    <img src="image/playstore.png" width="40" height="40">
                    <p>Play Store</p>
                </a>
                <a class="appstore" href="https://www.apple.com/de/app-store/" target="_blank">
                    <img src="image/app-store.png" width="40" height="40">
                    <p>App Store</p>
                </a>
            </div>
        </div>
    </section>
    <section class="angebotMachen">
        <div class="angebotMachenBox">
            <div>
                <h1>Inserat aufgeben</h1>
            </div>
            <div class="angebotMachenBoxText">
                <div class="angebotMachenBoxTextLinks">
                    <img src="image/immobilienmakler.png" width="200" height="200">
                </div>
                <div class="angebotMachenBoxTextRechts">
                    <p><b>Inseriere auf Deutschlands größtem Fahrzeugauktionsmarkt</b></br></br>
                    Dann kannst Du Dein gebrauchtes Auto hier kostenlos verkaufen. Einfach und bequem. Zum maximalen Preis per Inserat oder schnell per Expressverkauf an einer mobile.de</p>
                </div>
            </div>
            <button class="btnJetztInserieren" onclick="window.location.href = 'Inserieren/inserieren.php';">Jetzt inserieren</button>
        </div>
    </section>
    <section class="AutostarProduct">
        <div class="AutostarProductBox">
            <img src="image/AutostarProductsBig.png" width="1000" height="500">
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