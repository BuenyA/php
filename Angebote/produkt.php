<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autostar - Angebot</title>
    <link rel="icon" type="image/png" href="image/AutostarLogoIconTab.png" wid>
    <link rel="stylesheet" href="../allgemeines/stylesheet.css">
    <link rel="stylesheet" href="produkt.css">
    <script language="javascript" type="text/javascript" src="../allgemeines/index.js"></script>
</head>

<body>
    <?php
        //Start Session + Dateieinbindung + Print Navigationbar
        session_start();
        require '../allgemeines/db.php';
        require '../phpFunctions.php';

        //Produkt Selektierung
        $url = $_SERVER['REQUEST_URI'];
        if (str_contains($url, '?produkt=')) {
            $proID = substr($url, strrpos($url, 'produkt=' ) + 8);
            if (str_contains($proID, '?')) {
                $proID = substr($proID, 0, strpos($proID, "?"));
            }
            $produktURL = substr($url, strrpos($url, '.php' ) + 4);
        } else {
            header('Location: ../index.php');
        }
        
        //Insert Angebote
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
            header('Location: ./vielenDankAngebot.php');
        }

        //Selektierung nach dem Inserat
        $queryInserat = "SELECT * FROM Inserat JOIN Accounts ON Inserat.Inhaber_Nr = Accounts.account_ID WHERE Inserat.Inserat_Nr = $proID";
        $resInserat = $db->query($queryInserat);
        
        if($resInserat->rowCount() == 0) {
            header('Location: ../index.php');
        }

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

        phpFunctions::printNavigationBar();
    ?>
    <section class="produkt">
        <?php
            //Dynamische HTML-Ausgabe
            echo '
                <div class="produktArea">
                    <div class="produktAreaLeft">
                        <div class="slideshow">';
            
            //Selektierung nach den Inseratbildern
            $queryBilder = "SELECT * FROM Inseratbilder WHERE Inserat_Nr = $InsNr ORDER BY Erstellt_Am ASC";
            $resBilder = $db->query($queryBilder);
            if($resBilder->rowCount() >0) {
                foreach ($resBilder as $rowBilder) {
                    echo '
                            <div class="slide">
                                <img src="data:image/jpeg;base64,'.base64_encode($rowBilder['Bild']).'" width="640" height="400"/>
                            </div>
                    ';
                }
    
                echo '
                                <a class="pfeil pfeil-links" onclick="umschalten(-1)"><span>&#10094;</span></a>
                                <a class="pfeil pfeil-rechts" onclick="umschalten(1)"><span>&#10095;</span></a>
                                <ol class="indikatorenliste">';
    
                for ($i=0; $i < $resBilder->rowCount(); $i++) { 
                    echo '
                        <li class="indikator" onclick="springeZuEintrag(i)">&#8226;</li>
                    ';
                }
            } else {
                $queryBilder = "SELECT * FROM Inseratbilder WHERE Bild_Nr = 0 LIMIT 1";
                $resBilder = $db->query($queryBilder);
                $rowBilder = $resBilder->fetch();

                echo '
                        <div class="slide">
                            <img src="data:image/jpeg;base64,'.base64_encode($rowBilder['Bild']).'" width="640" height="400"/>
                        </div>
                        <ol class="indikatorenliste">
                        <li class="indikator" onclick="springeZuEintrag(i)">&#8226;</li>';
            }        
            
            echo '
                            </ol>
                        </div>
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

            //Gibt die letzten 3 Angebote der Auktion ausgeben
            if($resAngebot->rowCount() > 0) {
                $maxZaehler = 0;
                $minZaehler = $resAngebot->rowCount();

                //Damit auch das letzte Angebot geprintet wird, da bereits ein fetch() durchgefürht wurde
                echo '  <div class="showAngebote">
                                <div class="showAngeboteTag">
                                    <h8>'.$minZaehler.'. Angebot</h8>
                                </div>
                                <div class="showAngebotePreis">
                                    <h8>'.number_format($rowAngebot['Angebot'] ,0, ',', '.').' €</h8>
                                </div>
                            </div>
                        ';

                //Print der restlichen 2 Angebote
                foreach ($resAngebot as $rowAngebot) {
                    if($maxZaehler == 2) {
                        if ($resAngebot->rowCount() > 4) {
                            echo '  <div class="showAngebote">
                                        <h8>...</h8>
                                    </div>';
                        }
                        break;
                    }
                    $maxZaehler = $maxZaehler + 1;
                    $minZaehler = $minZaehler - 1;
                    echo '  <div class="showAngebote">
                                <div class="showAngeboteTag">
                                    <h8>'.$minZaehler.'. Angebot</h8>
                                </div>
                                <div class="showAngebotePreis">
                                    <h8>'.number_format($rowAngebot['Angebot'] ,0, ',', '.').' €</h8>
                                </div>
                            </div>
                        ';
                }
            }
            
            //Gibt den Mindestauktionspreis aus
            echo '  <div class="showAngebote">
                        <div class="showAngeboteTag">
                            <h8>Mindestauktion</h8>
                        </div>
                        <div class="showAngebotePreis">
                            <h8>'.number_format($rowIns['Preis'] ,0, ',', '.').' €</h8>
                        </div>
                    </div>';

            //Wenn Autkion ausgelaufen
            if ($rowIns['Auktionsende'] < date('Y-m-d H:i:s') || $rowIns['Auktionsbeginn'] > date('Y-m-d H:i:s')) {
                echo '</div>
                    </form>
                </div>
            </div>
            ';

            //Wenn User ein Gast ist
            } elseif (empty($_SESSION['user'])) {
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

            //Wenn User angemeldet ist
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
    <script src="./slideshow.js"></script>
</body>

</html>