<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autostar - Deine Auktionsseite für Automobile!</title>
    <link rel="icon" type="image/png" href="image/AutostarLogoIconTab.png">
    <link rel="stylesheet" href="indexSheet.css">
    <script language="javascript" type="text/javascript" src="index.js"></script>
</head>

<body>
    <?php
        session_start();
        require_once './db.php';
        require_once './phpFunctions.php';
        if (isset($_GET['anmelden'])) {
            echo '<script>window.location = "./account/anmeldung.php";</script>';
        }
    ?>
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
                    <?php
                        if (empty($_SESSION['user'])) {
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
            <div class="searchBarFilterBox">
                <h1>Finde dein Traumauto!</h1>
                <div class="filterBoxSection">
                    <div class="filterBox">
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
            $queryInserat = "SELECT * FROM Inserat JOIN Accounts ON Inserat.Inhaber_Nr = Accounts.account_ID ORDER BY Erstzulassung ASC";
            $resInserat = $db->query($queryInserat);

            phpFunctions::showOffer(4, $resInserat);
        ?>
        <button class="btnMehrAnzeigen">
            Mehr Anzeigen
            <img src="image/right-arrows.png" width="20" height="20">
        </button>
    </section>
    <section class="baldAblaufend">
        <h1>Last-Minute-Angebote...</h1>
        <?php
            $queryInserat = "SELECT * FROM Inserat JOIN Accounts ON Inserat.Inhaber_Nr = Accounts.account_ID ORDER BY Erstzulassung ASC";
            $resInserat = $db->query($queryInserat);
            
            phpFunctions::showOffer(7, $resInserat, 4);
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
                    Dann kannst Du Dein gebrauchtes Auto hier kostenlos verkaufen. Einfach und bequem. Zum maximalen Preis per Inserat oder schnell per Expressverkauf</p>
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
    <?php
        phpFunctions::printFooter();
    ?>
</body>
</html>