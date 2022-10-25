<?php
    class phpFunctions {
        public static function showOffer($showMax, $resInserat) {
            $counter = 0;
            // $showMax = 4; Parameter
            // $resInserat Parameter
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
        }

        public static function printNavigationBar() {
            if (empty($_SESSION['user'])) {
                echo '
                <div class="navigationMenu">
                    <div class="navigationMenuLogo">
                        <img src="image/AutostarLogo.png" width="200" height="40" onclick="window.location.href = \'../index.php\'">
                    </div>
                    <ul class="navigationElements">
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="../TopAngebote/topangebote.php">Top Angebote</a></li>
                        <li><a href="../LastMinute/lastminute.php">Last-Minute</a></li>
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
            } else {
                echo '
                <div class="navigationMenu">
                    <div class="navigationMenuLogo">
                        <img src="image/AutostarLogo.png" width="200" height="40" onclick="window.location.href = \'../index.php\'">
                    </div>
                    <ul class="navigationElements">
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="../TopAngebote/topangebote.php">Top Angebote</a></li>
                        <li><a href="../LastMinute/lastminute.php">Last-Minute</a></li>
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
                    <img src="image/AutostarLogo.png" width="200" height="40">
                    <p class="footerFooter">Unsere AGBs - Datenschutzerklärung - Impressum - Hinweise zu Cookies - Hinweise zu interessenbasierter Werbung </br>
                        ©1996-2022 Autostar AG und Partner-Unternehmen</p>
                </div>
            </section>
            ';
        }
    }
