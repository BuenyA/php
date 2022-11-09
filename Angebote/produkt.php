<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autostar - Last Minute Angebote</title>
    <link rel="icon" type="image/png" href="image/AutostarLogoIconTab.png" wid>
    <link rel="stylesheet" href="../stylesheet.css">
    <link rel="stylesheet" href="produkt.css">
    <script language="javascript" type="text/javascript" src="../index.js"></script>
</head>

<body>
    <?php
        //Start Session + Dateieinbindung + Print Navigationbar
        session_start();
        require '../db.php';
        require '../phpFunctions.php';
        phpFunctions::printNavigationBar();
    ?>
    <section class="produkt">
        <?php
            //Produkt Selektierung
            $url = $_SERVER['REQUEST_URI'];
            if (str_contains($url, '?produkt=')) {
                $proID = substr($url, strrpos($url, 'produkt=' ) + 8);
                if (str_contains($proID, '?')) {
                    $proID = substr($proID, 0, strpos($proID, "?"));
                }
                $produktURL = substr($url, strrpos($url, '.php' ) + 4);
            } else {
                echo '<script>reloadWindow();</script>';
            }
            
            //Insert Angebot
            if (sizeof($_POST) !== 0 || isset($_POST['submit'])) {
                
                //Wenn angemeldet, dann ID und EMAIL insert 
                if(!empty($_SESSION['id'])) {
                    $id = $_SESSION['id'];
                    $email = $_SESSION['user'];
                //Wenn nicht angemeldet, dann nur EMAIL insert 
                } else {
                    $id = 'Null';
                    $email = $_POST['input_email'];
                }

                //Insert into Angebote
                $gebot = $_POST['input_gebot'];
                $query = "INSERT INTO Angebote(Inserat_Nr, Angebot, Email, Account_Nr) VALUES ($proID, $gebot, '$email', $id)";
                $db->query($query);

                //Laden der Dankesseite
                echo '<script>loadDanke();</script>';
            }

            //Selektierung des Produktes
            $queryInserat = "SELECT * FROM Inserat JOIN Accounts ON Inserat.Inhaber_Nr = Accounts.account_ID WHERE Inserat.Inserat_Nr = $proID";
            $resInserat = $db->query($queryInserat);
            $rowIns = $resInserat->fetch();
            $waiting_day = strtotime($rowIns['Auktionsende']);
            $getDateTime = date("F d, Y H:i:s", $waiting_day);

            //Selektierung nach Angeboten
            $InsNr = $rowIns['Inserat_Nr'];
            $queryAngebot = "SELECT * FROM Angebote WHERE Inserat_Nr = $InsNr ORDER BY Angebot DESC";
            $resAngebot = $db->query($queryAngebot);
            if($resAngebot->rowCount() > 0) {
                $rowAngebot = $resAngebot->fetch();
                $preis = $rowAngebot['Angebot'];
            } else {
                $preis = $rowIns['Preis'];
            }

            //Dynamische HTML-Ausgabe
            echo '
                <div class="produktArea">
                    <div class="produktAreaLeft">
                        <img src="../image/auto_jaguar.jpg" alt="Bild konnte nicht geladen werden..." width="640" height="400">
                    </div>
                    <div class="produktAreaRight">
                        <div class="produktAreaRightElements">
                            <h5 class="uerberschrift">'.$rowIns['Marke'].' '.$rowIns['Modell'].'</h5>
                            <h4 id="counter1"></h4>
                            <script>calculateTime("'.$getDateTime.'", "1");</script>
                            <div class="separator"></div>
                            <h6>'.number_format($preis ,0, ',', '.').' €</h6>
                            <h7>'.number_format(($preis / 1.19) ,2, ',', '.') .'€ (Netto), zzgl. 19% MwSt.</h7>
                            <div class="separator"></div>
                            <p>'.number_format($rowIns['Kilometerstand'] ,0, ',', '.') . ' km, ' . ceil($rowIns['PS'] / 1.35962) . ' kW (' . $rowIns['PS'] . ' PS), ' . $rowIns['Kraftstoffart'] . ', ' . $rowIns['Getriebeart'] . '</p>
                            <div class="separator"></div>
                            <p><b>'.$rowIns['vorname'].' '.$rowIns['nachname'].'</b></p>
                            <p>'.$rowIns['plz'].' '.$rowIns['ort'].'</p>
                            <div class="produktAreaRightElementsButton">
                                <a href="#angebotAufgeben" type="submit" class="angebotAufgebenButton">Angebot aufgeben</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="produktShortView">
                    <div class="produktShortViewArea">
                        <div class="produktShortViewField">
                            <div>
                                <img src="../image/speedometer.png" alt="Bild konnte nicht geladen werden..." width="30" height="30">
                            </div>
                            <div>
                                <p>Kilometerstand</p>
                                <h6>'.number_format($rowIns['Kilometerstand'] ,0, ',', '.').' km</h6>
                            </div>
                        </div>
                        <div class="produktShortViewField">
                            <div>
                                <img src="../image/getriebe.png" alt="Bild konnte nicht geladen werden..." width="30" height="30">
                            </div>
                            <div>
                                <p>Getriebeart</p>
                                <h6>'.$rowIns['Getriebeart'].'</h6>
                            </div>
                        </div>
                    </div>
                    <div class="produktShortViewArea">
                        <div class="produktShortViewField">
                            <div>
                                <img src="../image/kalender.png" alt="Bild konnte nicht geladen werden..." width="30" height="30">
                            </div>
                            <div>
                                <p>Erstzulassung</p>
                                <h6>'.$rowIns['Erstzulassung'].'</h6>
                            </div>
                        </div>
                        <div class="produktShortViewField">
                            <div>
                                <img src="../image/benutzer.png" alt="Bild konnte nicht geladen werden..." width="30" height="30">
                            </div>
                            <div>
                                <p>Fahrzeughalter</p>
                                <h6>'.$rowIns['vorname'].' '.$rowIns['nachname'].'</h6>
                            </div>
                        </div>
                    </div>
                    <div class="produktShortViewArea">
                        <div class="produktShortViewField">
                            <div>
                                <img src="../image/strom.png" alt="Bild konnte nicht geladen werden..." width="30" height="30">
                            </div>
                            <div>
                                <p>Leistung</p>
                                <h6>'. ceil($rowIns['PS'] / 1.35962).' kW (' . $rowIns['PS'] . ' PS)</h6>
                            </div>
                        </div>
                        <div class="produktShortViewField">
                            <div>
                                <img src="../image/tankstelle.png" alt="Bild konnte nicht geladen werden..." width="30" height="30">
                            </div>
                            <div>
                                <p>Kraftstoffart</p>
                                <h6>'.$rowIns['Kraftstoffart'].'</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="produktBeschreibung">
                    <h7><b>Inseratbeschreibung</b></h7>
                    <p>'.$rowIns['Beschreibung'].'</p>
                </div>
                <div class="angebotAufgeben" id="angebotAufgeben">
                    <div class="angebotUberschrift">
                        <h7><b>Dein Angebot an '.$rowIns['vorname'].' '.$rowIns['nachname'].'</b></h7>
                    </div>
                    <div class="angebotAufgebenBody">
                        <form method="post">
                            <div class="angebotAufgebenLeft">
                                <div class="angebotAufgebenLeftPreis">
                                    <h7>Der aktuelle Preis:</h7>
                                    <h4>'.number_format($preis ,0, ',', '.').' €</h4>
                                </div>
                                <div class="angebotAufgebenLeftCounter">
                                    <h7>Die Auktion läuft ab in:</h7>
                                    <h4 id="counter2"></h4>
                                    <script>calculateTime("'.$getDateTime.'", "2");</script>
                                </div>
                                <div class="separator"></div>
                                <h7>Die letzten Angebote:</h7>
                            ';

            /* //Gibt alle Angebote des Inserates aus
            if($resAngebot->rowCount() > 1) {
                foreach ($resAngebot as $rowAngebot) {
                    echo '<br/><h7>'.number_format($rowAngebot['Angebot'] ,0, ',', '.').' €</h7>
                            <h7> '.$rowAngebot['Erstellt_Am'].'</h7>';
                }
            } */

            //Email als Input-Feld, wenn nicht angemeldet
            if (empty($_SESSION['user'])) {
                echo '</div>
                        <div class="angebotAufgebenRight">
                            <h7><b>Dein Gebot:</b></h7>
                            <input type="number" name="input_gebot" placeholder="€" min="'.($preis + 50).'" required>
                            <h7><b>Deine E-Mail-Adresse:</b></h7>
                            <input type="email" name="input_email" placeholder="E-Mail" required>
                            <p>Beim Absenden des Angebots binden<br> Sie sich an einen kostenpflichtigen Vertrag.</p>
                            <input type="submit" value="Absenden" class="absendenButton">
                        </div>
                    </form>
                </div>
            </div>
            ';

            //Statisches Email-Feld, wenn angemeldet
            } else {
                echo '</div>
                        <div class="angebotAufgebenRight">
                            <h7><b>Dein Gebot:</b></h7>
                            <input type="number" name="input_gebot" placeholder="€" min="'.($preis + 50).'" required>
                            <h7><b>Deine E-Mail-Adresse:</b></h7>
                            <h8 type="text" name="input_email">'.$_SESSION['user'].'</h8>
                            <p>Beim Absenden des Angebots binden<br> Sie sich an einen kostenpflichtigen Vertrag.</p>
                            <input type="submit" value="Absenden" class="absendenButton">
                        </div>
                    </form>
                </div>
            </div>
            ';
            }
            unset($db);
        ?>
    </section>
    <?php
        //Drucke Footer
        phpFunctions::printFooter();
    ?>
</body>

</html>