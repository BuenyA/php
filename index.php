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
        require './db.php';
        require './phpFunctions.php';
        if (isset($_GET['anmelden'])) {
            echo '<script>window.location = "./account/anmeldung.php";</script>';
        }
        if (isset($_GET['insertMerken']) && sizeof($_POST) !== 0) {
            $InseratNrPost = $_POST['InseratNr'];
            $AccIDPost = $_POST['AccID'];
            $queryMerken = "SELECT * FROM Merken WHERE InseratNr = $InseratNrPost AND AccountNr = $AccIDPost";
            $resMerken = $db->query($queryMerken);
            if ($resMerken !== false && $resMerken->rowCount() > 0) {
                $queryMerkenDelete = "DELETE FROM Merken WHERE InseratNr = $InseratNrPost AND AccountNr = $AccIDPost";
                $resMerkenDelete = $db->query($queryMerkenDelete);
            } else {
                $queryMerkenInsert = "INSERT INTO Merken(InseratNr, AccountNr) VALUES ('$InseratNrPost','$AccIDPost')";
                $resMerkenInsert = $db->query($queryMerkenInsert);
            }
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
                    <li><a href="Angebote/topangebote.php">Top Angebote</a></li>
                    <li><a href="Angebote/lastminute.php">Last-Minute</a></li>
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
                <form action="./suchen/suchen.php" method="get">
                    <div class="filterBoxRight">
                        <div>
                            <div class="Marke">
                                <h2>Marke</h2>
                                <?php
                                    $query = "SELECT * FROM Inserat GROUP BY Marke";
                                    $resInserat = $db->query($query);
                                    echo "<select name='Marke' onChange='auswaehlen(this)'>";
                                    echo "<option value=''>Bitte wählen...</option>";
                                    foreach ($resInserat as $row) {
                                        if (isset($_GET['Marke']) && $_GET['Marke'] == $row['Marke']) {
                                            echo "<option value='".$row["Marke"]."' selected value>".$row["Marke"]."</option>";
                                        } else {
                                            echo "<option value='".$row["Marke"]."'>".$row["Marke"]."</option>";
                                        }
                                    }
                                    echo "</select>"; 
                                ?>
                            </div>
                            <div class="Modell">
                                <h2>Modell</h2>
                                <select name="Modell">
                                    <?php
                                        echo "<option value=''>Bitte wählen...</option>";
                                        if (isset($_GET['Marke'])) {
                                            $query = "SELECT * FROM Inserat WHERE Marke = '" . $_GET['Marke'] . "'GROUP BY Modell";
                                            $resInserat = $db->query($query);
                                            foreach ($resInserat as $row) {
                                                echo '<option>'.$row['Modell'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div>
                            <div class="KilometerBis">
                                <h2>Kilometer</h2>
                                <input type="search" placeholder="Bis..." autocomplete="off" maxlength="10" type="number" name="KM">
                            </div>
                            <div class="Erstzulassung">
                                <h2>Erstzulassung</h2>
                                <input type="search" placeholder="Ab Jahr..." autocomplete="off" maxlength="10" type="number" name="Erstzulassung">
                            </div>
                        </div>
                        <div>
                            <div class="Erstzulassung">
                                <h2>Preis</h2>
                                <!-- <div class="preisAngabe">
                                    <input type="search" placeholder="Von..." autocomplete="off" maxlength="10" type="number" name="preisVon">
                                    <input type="search" placeholder="Bis..." autocomplete="off" maxlength="10" type="number" name="preisBis">
                                </div> -->
                                <input type="search" placeholder="Bis..." autocomplete="off" maxlength="10" type="number" name="preisBis">
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
                </form>
            </div>
        </div>
    </section>
    <section class="topOffer">
        <h1>Top-Angebote</h1>
        <?php
            $queryInserat = "SELECT * FROM Inserat JOIN Accounts ON Inserat.Inhaber_Nr = Accounts.account_ID WHERE Auktionsende >= CURRENT_TIMESTAMP ORDER BY Preis ASC";
            $resInserat = $db->query($queryInserat);

            if (empty($_SESSION['user'])) {
                phpFunctions::showOffer(4, $resInserat);
            } else {
                phpFunctions::showOffer(4, $resInserat, $_SESSION['id']);
            }
        ?>
        <a href="./Angebote/topangebote.php" class="btnMehrAnzeigen">
            Mehr Anzeigen
            <img src="image/right-arrows.png" width="20" height="20">
        </a>
    </section>
    <section class="topOffer">
        <h1>Last-Minute-Angebote...</h1>
        <?php
            $queryInserat = "SELECT * FROM Inserat JOIN Accounts ON Inserat.Inhaber_Nr = Accounts.account_ID WHERE Auktionsende >= CURRENT_TIMESTAMP ORDER BY Auktionsende ASC";
            $resInserat = $db->query($queryInserat);
            if (empty($_SESSION['user'])) {
                phpFunctions::showOffer(8, $resInserat, 0, 4);
            } else {
                phpFunctions::showOffer(8, $resInserat, $_SESSION['id'], 4);
            }
            unset($db);
        ?>
        <a href="./Angebote/lastminute.php" class="btnMehrAnzeigen">
            Mehr Anzeigen
            <img src="image/right-arrows.png" width="20" height="20">
        </a>
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