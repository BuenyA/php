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
    }
