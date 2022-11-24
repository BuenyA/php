<?php
    class phpFunctions {
        public static function showOffer($showMax, $resInserat, $AccNr = 0, $counter = 0) {
            
            //Eigene Datenbankverbindung, um keine dynamische Einbindung der Datei: db.php zu machen
            $dsn = 'mysql:dbname=Autostar;host=db;port=3306';
            try {
                $db = new PDO( $dsn, 'root', '' );
            } catch (PDOException $e){
                exit( 'Connection failed: ' . $e->getMessage());
            }
            
            //URL zurechtschneiden für die Produktanzeige
            $url= $_SERVER['REQUEST_URI'];
            if (str_contains($url, 'php/Angebote')) {
                $url = './produkt.php';
            } elseif (str_contains($url, 'php/index.php')) {
                $url = './Angebote/produkt.php';
            } else {
                $url = '../Angebote/produkt.php';
            }

            //Angebot zeigen bei nicht eigeloggten Usern
            if (empty($_SESSION['user'])) {
                if ($resInserat !== false && $resInserat->rowCount() > 0) {
                    foreach ($resInserat as $row) {

                        //Anzahl der Anzeigen begrenzen
                        if ($counter == $showMax) {
                            break;
                        }

                        //Selektierung nach Angeboten
                        $InsNr = $row['Inserat_Nr'];
                        $queryAngebot = "SELECT * FROM Angebote WHERE Inserat_Nr = $InsNr ORDER BY Angebot DESC";
                        $resAngebot = $db->query($queryAngebot);
                        if($resAngebot->rowCount() > 0) {
                            $rowAngebot = $resAngebot->fetch();
                            $preis = $rowAngebot['Angebot'];
                        } else {
                            $preis = $row['Preis'];
                        }

                        //Selekt des Hauptbildes
                        $queryBilder = "SELECT * FROM Inseratbilder WHERE Inserat_Nr = $InsNr AND Hauptbild = 1 LIMIT 1";
                        $resBilder = $db->query($queryBilder);
                        if($resBilder->rowCount() >0) {
                            $rowBilder = $resBilder->fetch();
                        } else {
                            $queryBilder = "SELECT * FROM Inseratbilder WHERE Bild_Nr = 0 LIMIT 1";
                            $resBilder = $db->query($queryBilder);
                            $rowBilder = $resBilder->fetch();
                        }                        
                        
                        //Variablendeklaration für dynamische Zeitanzeige
                        $waiting_day = strtotime($row['Auktionsende']);
                        $getDateTime = date("F d, Y H:i:s", $waiting_day); // JavaScript Variable
                        
                        //Wenn das Angebot auf der linken Seite ist -> Print dynamic HTML-Code
                        if (($counter % 2) == 0) {
                            echo '
                                <div class="topOfferPlace">
                                    <a class="topOfferLink" href="'.$url.'?produkt='.$row['Inserat_Nr'].'">
                                        <div class="topOffers">
                                            <img src="data:image/png;base64,'.base64_encode($rowBilder['Bild']).'" width="250" height="250"/>
                                            <div class="topOffersRight">
                                                <div class="topOffersRightTop">
                                                    <h2>' . $row['Marke'] . ' ' . $row['Modell'] . '</h2>
                                                    <p class="auktionspreis"><b>' . number_format($preis ,0, '.', '.') . ' €</b></p>
                                                </div>
                                                <h5 id="counter'.$counter.'"></h5>
                                                <script>calculateTime("'.$getDateTime.'", "'.$counter.'");</script>
                                                <p>
                                                    ' . number_format($row['Kilometerstand'] ,0, ',', '.') . ' km, ' . ceil($row['PS'] / 1.35962) . ' kW (' . $row['PS'] . ' PS), ' . $row['Kraftstoffart'] . ', ' . $row['Getriebeart'] . ', ' . $row['Erstzulassung'] . '
                                                </p>
                                                <p>
                                                    ' . $row['vorname'] . ' ' . $row['nachname'] . ' </br>
                                                    Tel.: +49 123 456789</br>
                                                    Ort: ' . $row['ort'] . '
                                                </p>
                                                <form action="?anmelden=1" method="post">
                                                    <input type="submit" value="      Merken" class="merkenButton" />
                                                </form>
                                            </div>
                                        </div>
                                    </a>
                                ';

                        //Wenn das Angebot auf der rechten Seite ist -> Print dynamic HTML-Code
                        } else {
                            echo '
                                    <a class="topOfferLink" href="'.$url.'?produkt='.$row['Inserat_Nr'].'">
                                        <div class="topOffers">
                                            <img src="data:image/jpeg;base64,'.base64_encode($rowBilder['Bild']).'" width="250" height="250"/>
                                            <div class="topOffersRight">
                                                <div class="topOffersRightTop">
                                                    <h2>' . $row['Marke'] . ' ' . $row['Modell'] . '</h2>
                                                    <p class="auktionspreis"><b>' . number_format($preis ,0, ',', '.') . ' €</b></p>
                                                </div>
                                                <h5 id="counter'.$counter.'"></h5>
                                                <script>calculateTime("'.$getDateTime.'", "'.$counter.'");</script>
                                                <p>
                                                    ' . number_format($row['Kilometerstand'] ,0, ',', '.') . ' km, ' . ceil($row['PS'] / 1.35962) . ' kW (' . $row['PS'] . ' PS), ' . $row['Kraftstoffart'] . ', ' . $row['Getriebeart'] . ', ' . $row['Erstzulassung'] . '
                                                </p>
                                                <p>
                                                    ' . $row['vorname'] . ' ' . $row['nachname'] . ' </br>
                                                    Tel.: +49 123 456789</br>
                                                    Ort: ' . $row['ort'] . '
                                                </p>
                                                <form action="?anmelden=1" method="post">
                                                    <input type="submit" value="      Merken" class="merkenButton" />
                                                </form>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                ';
                        }
                        $counter++;
                    }

                    //Beendet das übergreifende div, wenn die Anzahl der Anzeigen ungerade sind
                    if (($counter % 2) != 0) {
                        echo '</div>';
                    }
                }

            //Angebot zeigen bei nicht eingeloggten Usern
            } else {
                if ($resInserat !== false && $resInserat->rowCount() > 0) {
                    foreach ($resInserat as $row) {

                        //Anzahl der Anzeigen begrenzen
                        if ($counter == $showMax) {
                            break;
                        }

                        //Selektierung nach Angeboten
                        $InsNr = $row['Inserat_Nr'];
                        $queryAngebot = "SELECT * FROM Angebote WHERE Inserat_Nr = $InsNr ORDER BY Angebot DESC";
                        $resAngebot = $db->query($queryAngebot);
                        if($resAngebot->rowCount() > 0) {
                            $rowAngebot = $resAngebot->fetch();
                            $preis = $rowAngebot['Angebot'];
                        } else {
                            $preis = $row['Preis'];
                        }

                        //Selekt des Hauptbildes
                        $queryBilder = "SELECT * FROM Inseratbilder WHERE Inserat_Nr = $InsNr AND Hauptbild = 1 LIMIT 1";
                        $resBilder = $db->query($queryBilder);
                        $rowBilder = $resBilder->fetch();

                        //Selektion, ob der verwendete Account, dass jeweilige Produkt favorisiert hat
                        $queryMerken = "SELECT * FROM Merken WHERE InseratNr = $InsNr AND AccountNr = $AccNr";
                        $resMerken = $db->query($queryMerken);

                        //Dynamische Wahl, welche Klasse dem Merken-Button vergeben werden soll 
                        if ($resMerken !== false && $resMerken->rowCount() > 0) {
                            $cssClassVariable = 'merkenButtonPressed';
                        } else {
                            $cssClassVariable = 'merkenButton';
                        }

                        //Variablendeklaration für dynamische Zeitanzeige
                        $waiting_day = strtotime($row['Auktionsende']);
                        $getDateTime = date("F d, Y H:i:s", $waiting_day); // JavaScript Variable

                        //Wenn das Angebot auf der linken Seite ist -> Print dynamic HTML-Code
                        if (($counter % 2) == 0) {
                            echo '
                                <div class="topOfferPlace">
                                    <a class="topOfferLink" href="'.$url.'?produkt='.$row['Inserat_Nr'].'">
                                        <div class="topOffers">
                                            <img src="data:image/jpeg;base64,'.base64_encode($rowBilder['Bild']).'" width="250" height="250"/>
                                            <div class="topOffersRight">
                                                <div class="topOffersRightTop">
                                                    <h2>' . $row['Marke'] . ' ' . $row['Modell'] . '</h2>
                                                    <p class="auktionspreis"><b>' . number_format($preis ,0, '.', '.') . ' €</b></p>
                                                </div>
                                                <h5 id="counter'.$counter.'"></h5>
                                                <script>calculateTime("'.$getDateTime.'", "'.$counter.'");</script>
                                                <p>
                                                    ' . number_format($row['Kilometerstand'] ,0, ',', '.') . ' km, ' . ceil($row['PS'] / 1.35962) . ' kW (' . $row['PS'] . ' PS), ' . $row['Kraftstoffart'] . ', ' . $row['Getriebeart'] . ', ' . $row['Erstzulassung'] . '
                                                </p>
                                                <p>
                                                    ' . $row['vorname'] . ' ' . $row['nachname'] . ' </br>
                                                    Tel.: +49 123 456789</br>
                                                    Ort: ' . $row['ort'] . '
                                                </p>
                                                <form method="post">
                                                    <input class="displayNone" type="text" name="InseratNr" value="'.$row['Inserat_Nr'].'">
                                                    <input class="displayNone" type="text" name="AccID" value="'.$_SESSION['id'].'">
                                                    <input type="submit" value="      Merken" name="insertMerken" class="'.$cssClassVariable.'" />
                                                </form>
                                            </div>
                                        </div>
                                    </a>
                                ';

                        //Wenn das Angebot auf der rechten Seite ist -> Print dynamic HTML-Code
                        } else {
                            echo '
                                    <a class="topOfferLink" href="'.$url.'?produkt='.$row['Inserat_Nr'].'">
                                        <div class="topOffers">
                                            <img src="data:image/jpeg;base64,'.base64_encode($rowBilder['Bild']).'" width="250" height="250"/>
                                            <div class="topOffersRight">
                                                <div class="topOffersRightTop">
                                                    <h2>' . $row['Marke'] . ' ' . $row['Modell'] . '</h2>
                                                    <p class="auktionspreis"><b>' . number_format($preis ,0, ',', '.') . ' €</b></p>
                                                </div>
                                                <h5 id="counter'.$counter.'"></h5>
                                                <script>calculateTime("'.$getDateTime.'", "'.$counter.'");</script>
                                                <p>
                                                    ' . number_format($row['Kilometerstand'] ,0, ',', '.') . ' km, ' . ceil($row['PS'] / 1.35962) . ' kW (' . $row['PS'] . ' PS), ' . $row['Kraftstoffart'] . ', ' . $row['Getriebeart'] . ', ' . $row['Erstzulassung'] . '
                                                </p>
                                                <p>
                                                    ' . $row['vorname'] . ' ' . $row['nachname'] . ' </br>
                                                    Tel.: +49 123 456789</br>
                                                    Ort: ' . $row['ort'] . '
                                                </p>
                                                <form method="post">
                                                    <input class="displayNone" type="text" name="InseratNr" value="'.$row['Inserat_Nr'].'">
                                                    <input class="displayNone" type="text" name="AccID" value="'.$_SESSION['id'].'">
                                                    <input type="submit" value="      Merken" name="insertMerken" class="'.$cssClassVariable.'" />
                                                </form>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                ';
                        }
                        $counter++;
                    }
                    if (($counter % 2) != 0) {
                        echo '</div>';
                    }
                }
            }
        }

        //Druckt die Navigationbar
        public static function printNavigationBar() {

            //Bei keiner Anmeldung -> Mit Button Anmelden und Registrieren
            if (empty($_SESSION['user'])) {
                echo '
                <div class="navigationMenu">
                    <div class="navigationMenuLogo">
                        <img src="../image/AutostarLogo.png" width="200" height="40" onclick="window.location.href = \'../index.php\'">
                    </div>
                    <ul class="navigationElements">
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="../Angebote/topangebote.php">Top Angebote</a></li>
                        <li><a href="../Angebote/lastminute.php">Last-Minute</a></li>
                        <li><a href="../Inserieren/inserieren.php">Verkaufen</a></li>
                    </ul>
                    <div class="navigationMenuButton">
                        <div class="navigationMenuButtonAnmelden">
                            <button onclick="window.location.href = \'../account/anmeldung.php\'"><b>Anmelden</b></button>
                        </div>
                        <div class="navigationMenuButtonRegistrieren">
                            <button onclick="window.location.href = \'../account/registrierung.php\'"><b>Registrieren</b></button>
                        </div>
                    </div>
                </div>
                ';

            //Bei Anmeldung -> Mit Button Mein Account
            } else {
                echo '
                <div class="navigationMenu">
                    <div class="navigationMenuLogo">
                        <img src="../image/AutostarLogo.png" width="200" height="40" onclick="window.location.href = \'../index.php\'">
                    </div>
                    <ul class="navigationElements">
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="../Angebote/topangebote.php">Top Angebote</a></li>
                        <li><a href="../Angebote/lastminute.php">Last-Minute</a></li>
                        <li><a href="../Inserieren/inserieren.php">Verkaufen</a></li>
                    </ul>
                    <div class="navigationMenuButton">
                        <div class="navigationMenuButtonMeinAccount">
                            <button onclick="window.location.href = \'../account/meinAccount.php\'"><img src="../image/nutzer.png" width="15" height="15"><b>Mein Account</b></button>
                        </div>
                    </div>
                </div>
                ';
            }
        }

        //Druckt den Footer
        public static function printFooter() {
            echo '
            <section class="footer">
                <div class="footerArea">
                    <div class="footerRegion">
                        <h4><b>Unternehmen</b></h4>
                        <p>Über Uns</p>
                        <p>Kontakt</p>
                        <p>Hilfe</p>
                    </div>
                    <div class="footerRegion">
                        <h4><b>Verkaufen</b></h4>
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
                        <h4><b>Handel</b></h4>
                        <p>Anmelden</p>
                        <p>Registrieren</p>
                        <p>Verkaufen</p>
                        <p>Händler AGBs</p>
                    </div>
                    <div class="footerRegion">
                        <h4><b>Hilfe</b></h4>
                        <p>Barrierefreiheit</p>
                        <p>Sicherheitsportal</p>
                        <p>Rechtsportal</p>
                        <p>Fragen und Antworten</p>
                    </div>
                </div>
                <div class="footerBelow">
                    <img src="../image/AutostarLogo.png" width="200" height="40">
                    <p class="footerFooter">Unsere AGBs - Datenschutzerklärung - Impressum - Hinweise zu Cookies - Hinweise zu interessenbasierter Werbung </br>
                        ©1996-2022 Autostar AG und Partner-Unternehmen</p>
                </div>
            </section>
            ';
        }
    }
?>