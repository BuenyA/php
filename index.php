<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autostar</title>
    <link rel="stylesheet" href="stylesheet.css">
    <script language="javascript" type="text/javascript" src="javascript.js"></script>
</head>

<body>
    <section>   
        <div class="backgroundImageFilter">
            <div class="navigationMenu">
                <div class="navigationMenuLogo">
                    <img src="image/AutostarLogo.png" width="200" height="40">
                </div>
                <ul class="navigationElements">
                    <li><a href="">Home</a></li>
                    <li><a href="">Top Angebote</a></li>
                    <li><a href="">Last-Minute</a></li>
                    <li><a href="">Verkaufen</a></li>
                </ul>
                <div class="navigationMenuButton">
                    <button onclick="window.location.href = 'registrierung/registrierung.php';">Registrieren</button>
                    <button onclick="window.location.href = 'anmeldung/anmeldung.php';">Anmelden</button>
                </div>
            </div>
            <div class="searchBarFilterBox">
                <div class="searchBarSection">
                    <h1>Finde dein Traumauto!</h1>
                    <p>
                        Hier findest Du alles, was mit Fahrzeugen zu tun hat – verschaff </br>
                        Dir ganz einfach einen Überblick über den gesamten Automarkt. Hier warten täglich über 1,2 Millionen Fahrzeuge auf Dich.
                    </p>
                    <div class="searchBar">
                        <div class="searchBarBox">
                            <img src="image/search-interface-symbol.png" alt="" width="17" height="17">
                            <input type="search" text="Suchen...">
                        </div>
                    </div>
                </div>
                <div class="filterBoxSection">
                    <h1>Filter</h1>
                    <p>Verfeienere deine Suche, um ein perfektes Suchergebnis zur erreichen!</p>
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
                                            <h2>Eingabe</h2>
                                            <button class="btnAngebotSuchen">
                                                <img src="image/search-interface-symbol.png" alt="" width="17" height="17">
                                                Angebot suchen
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="MOPEDRight">
        
                            </div>
                            <div class="LKWRight">
        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="topOffer">
        <h1>Top-Angebote</h1>
        <div class="topOfferPlace">
            <div class="topOffersSegment">
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
                        <button>Bieten</button>
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
                        <button>Bieten</button>
                    </div>
                </div>
            </div>
            <div class="topOffersSegment">
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
                        <button>Bieten</button>
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
                        <button>Bieten</button>
                    </div>
                </div>
            </div>
        </div>
        <button class="btnMehrAnzeigen">
            Mehr Anzeigen
            <img src="image/right-arrows.png" width="20" height="20">
        </button>
    </section>
    <section class="baldAblaufend">
        <h1>Last-Minute...</h1>
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
                        <button>Bieten</button>
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
                        <button>Bieten</button>
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
                        <button>Bieten</button>
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
                        <button>Bieten</button>
                    </div>
                </div>
            </div>
        </div>
        <button class="btnMehrAnzeigen">
            Mehr Anzeigen
            <img src="image/right-arrows.png" width="20" height="20">
        </button>
    </section>
    <section class="angebotMachen">
        <div class="angebotMachenBox">
            <div>
                <h1>Inserat aufgeben</h1>
            </div>
            <div class="angebotMachenBoxText">
                <div class="angebotMachenBoxTextLinks">
                    <p><b>Inseriere auf Deutschlands größtem Fahrzeugmarkt</b></br></br>
                    Dann kannst Du Dein gebrauchtes Auto hier kostenlos verkaufen. Einfach und bequem. Zum maximalen Preis per Inserat oder schnell per Expressverkauf an einer mobile.de</p>
                </div>
                <div class="angebotMachenBoxTextRechts">
                    <p><b>Inseriere auf Deutschlands größtem Fahrzeugmarkt</b></br></br>
                    Dann kannst Du Dein gebrauchtes Auto hier kostenlos verkaufen. Einfach und bequem. Zum maximalen Preis per Inserat oder schnell per Expressverkauf an einer mobile.de</p>
                </div>
            </div>
            <button class="btnJetztInserieren">Jetzt inserieren</button>
        </div>
    </section>
    <section class="footer">
        <div class="footerArea">
            <div class="footerRegion">
                <p class="littleHeadline"><b>Unternehmen</b></p>
                <p>Über Uns</p>
                <p>Kontakt</p>
                <p>Hilfe</p>
            </div>
            <div class="footerRegion">
                <p class="littleHeadline"><b>Handel</b></p>
                <p>Anmelden</p>
                <p>Registrieren</p>
                <p>Verkaufen</p>
                <p>Händler AGBs</p>
            </div>
        </div>
        <p class="footerFooter">Unsere AGBs - Datenschutzerklärung - Impressum - Hinweise zu Cookies - Hinweise zu interessenbasierter Werbung </br>
        ©1996-2022 Auktionshaus AG und Partner-Unternehmen</p>
    </section>
</body>
</html>