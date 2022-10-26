<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autostar - Last Minute Angebote</title>
    <link rel="icon" type="image/png" href="image/AutostarLogoIconTab.png" wid>
    <link rel="stylesheet" href="../stylesheet.css">
    <link rel="stylesheet" href="meinAccount.css">
    <script language="javascript" type="text/javascript" src="../index.js"></script>
</head>

<body>
    <?php
        require_once '../db.php';
        require_once '../phpFunctions.php';
        session_start();
        if (isset($_GET['abmelden'])) {
            session_destroy();
            echo "<script>reloadWindow();</script>";
        } elseif (!isset($_GET['page'])) {
            echo '<script>reloadWindowMeinAccount();</script>';
        }
        if (empty($_SESSION['user'])) {
            echo '<script>linkToAnmeldung();</script>';
        }
        phpFunctions::printNavigationBar();
    ?>
    <section class="accountManagement">
        <?php
            if($_GET['page'] == 'MeinKonto') {
                echo '<h1>Guten Tag ' . $_SESSION['vorname'] . '</h1>
                        <div class="accountManagementBody">
                            <div class="accountManagementNavigation">
                                <ul class="accountManagementNavigationElements">
                                    <li class="accountManagementNavigationElementsActive"><a href="?page=MeinKonto">Mein Konto</a></li>
                                    <li><a href="?page=MeineInserate">Meine Inserate</a></li>
                                    <li><a href="?page=MeineGebote">Meine Gebote</a></li>
                                    <li><a href="?page=MeineFavoriten">Meine Favoriten</a></li>
                                    <li><a href="?page=MeineNachrichten">Meine Nachrichten</a></li>
                                </ul>
                            </div>
                            <div class="accountManagementElements">
                                <div class="accountManagementBox">
                                    <h2>Mein Account</h2>
                                    <div class="screen">
                                        <div class="screen__content">
                                            <form class="login">
                                                <div class="login__field__section">
                                                    <div class="login__field">
                                                        <i class="login__icon fas fa-user"></i>
                                                        <!-- input vorname -->
                                                        <input type="text" class="login__input" placeholder="Vorname" name="input__vorname">
                                                    </div>
                                                    <div class="login__field">
                                                        <i class="login__icon fas fa-lock"></i>
                                                        <!-- input nachname -->
                                                        <input type="text" class="login__input" placeholder="Nachname" name="input__nachname">
                                                    </div>
                                                </div>
                                                <div class="login__field__section">
                                                    <div class="login__field login__field__plz">
                                                        <i class="login__icon fas fa-user"></i>
                                                        <!-- input plz -->
                                                        <input type="text" class="login__input login__input__plz" placeholder="PLZ" maxlength="5" name="input__plz">
                                                    </div>
                                                    <div class="login__field">
                                                        <i class="login__icon fas fa-lock"></i>
                                                        <!-- input ort -->
                                                        <input type="text" class="login__input" placeholder="Ort" name="input__ort">
                                                    </div>
                                                    <div class="login__field">
                                                        <i class="login__icon fas fa-lock"></i>
                                                        <!-- input adresse -->
                                                        <input type="text" class="login__input" placeholder="Straße und Hausnummer" name="input__adresse">
                                                    </div>
                                                </div>
                                                <div class="login__field__section">
                                                    <div class="login__field">
                                                        <i class="login__icon fas fa-user"></i>
                                                        <!-- input telefonnummer -->
                                                        <input type="text" class="login__input" placeholder="Telefonnummer" name="input__telefonnummer">
                                                    </div>
                                                    <div class="login__field">
                                                        <i class="login__icon fas fa-lock"></i>
                                                        <!-- input geburtstag -->
                                                        <input type="date" class="login__input" placeholder="Geburtsdatum" name="input__geburtstag">
                                                    </div>
                                                </div>
                                                <div class="login__field__section">
                                                    <div class="login__field">
                                                        <i class="login__icon fas fa-user"></i>
                                                        <!-- input email -->
                                                        <input type="text" class="login__input" placeholder="E-Mail" name="input__email">
                                                    </div>
                                                    <div class="login__field">
                                                        <i class="login__icon fas fa-lock"></i>
                                                        <!-- input passwort -->
                                                        <input type="password" class="login__input" placeholder="Passwort" name="input__passwort">
                                                    </div>
                                                </div>
                                                <button class="button login__submit" name="registrieren__submit">
                                                    <span class="button__text">Ändern</span>
                                                    <i class="button__icon fas fa-chevron-right"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="accountAusloggenBox">
                                    <div class="accountAusloggenBoxLeft">
                                        <h2>Ausloggen</h2>
                                        <p>Möchten Sie sich ausloggen? <br />Dann betätigen Sie die folgende Schaltfläche.</p>
                                    </div>
                                    <div class="accountAusloggenBoxRight">
                                        <form class="" action="?abmelden=1" method="post">
                                            <button class="button" id="submit" name="btn__submit"><b>Log Out</b></button>
                                        </form>
                                    </div>
                                </div>
                            </div>';
            } elseif($_GET['page'] == 'MeineInserate') {
                echo '<h1>Meine Inserate</h1>
                        <div class="accountManagementBody">
                            <div class="accountManagementNavigation">
                                <ul class="accountManagementNavigationElements">
                                    <li><a href="?page=MeinKonto">Mein Konto</a></li>
                                    <li class="accountManagementNavigationElementsActive"><a href="?page=MeineInserate">Meine Inserate</a></li>
                                    <li><a href="?page=MeineGebote">Meine Gebote</a></li>
                                    <li><a href="?page=MeineFavoriten">Meine Favoriten</a></li>
                                    <li><a href="?page=MeineNachrichten">Meine Nachrichten</a></li>
                                </ul>
                            </div>
                            <div class="accountManagementElements">';
                $queryInserat = "SELECT * FROM Inserat JOIN Accounts ON Inserat.Inhaber_Nr = Accounts.account_ID ORDER BY Erstzulassung ASC";
                $resInserat = $db->query($queryInserat);
                if ($resInserat !== false && $resInserat->rowCount() > 0) {
                    foreach ($resInserat as $row) {
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
                        </div>
                        ';
                    }
                    echo '
                        </div>
                    ';
                }
            } elseif ($_GET['page'] == 'MeineGebote'){
                echo '<h1>Meine Gebote</h1>
                        <div class="accountManagementBody">
                            <div class="accountManagementNavigation">
                                <ul class="accountManagementNavigationElements">
                                    <li><a href="?page=MeinKonto">Mein Konto</a></li>
                                    <li><a href="?page=MeineInserate">Meine Inserate</a></li>
                                    <li class="accountManagementNavigationElementsActive"><a href="?page=MeineGebote">Meine Gebote</a></li>
                                    <li><a href="?page=MeineFavoriten">Meine Favoriten</a></li>
                                    <li><a href="?page=MeineNachrichten">Meine Nachrichten</a></li>
                                </ul>
                            </div>
                            <div class="accountManagementElements">';
                $queryInserat = "SELECT * FROM Inserat JOIN Accounts ON Inserat.Inhaber_Nr = Accounts.account_ID ORDER BY Erstzulassung ASC";
                $resInserat = $db->query($queryInserat);
                if ($resInserat !== false && $resInserat->rowCount() > 0) {
                    foreach ($resInserat as $row) {
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
                        </div>';
                    }
                    echo '
                        </div>
                    ';
                }
            } elseif ($_GET['page'] == 'MeineFavoriten'){
                echo '<h1>Meine Favoriten</h1>
                        <div class="accountManagementBody">
                            <div class="accountManagementNavigation">
                                <ul class="accountManagementNavigationElements">
                                    <li><a href="?page=MeinKonto">Mein Konto</a></li>
                                    <li><a href="?page=MeineInserate">Meine Inserate</a></li>
                                    <li><a href="?page=MeineGebote">Meine Gebote</a></li>
                                    <li class="accountManagementNavigationElementsActive"><a href="?page=MeineFavoriten">Meine Favoriten</a></li>
                                    <li><a href="?page=MeineNachrichten">Meine Nachrichten</a></li>
                                </ul>
                            </div>
                            <div class="accountManagementElements">';
                $queryInserat = "SELECT * FROM Inserat JOIN Accounts ON Inserat.Inhaber_Nr = Accounts.account_ID ORDER BY Erstzulassung ASC";
                $resInserat = $db->query($queryInserat);
                if ($resInserat !== false && $resInserat->rowCount() > 0) {
                    foreach ($resInserat as $row) {
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
                        </div>';
                    }
                    echo '
                        </div>
                    ';
                }
            } elseif ($_GET['page'] == 'MeineNachrichten'){
                echo '<h1>Meine Nachrichten</h1>
                        <div class="accountManagementBody">
                            <div class="accountManagementNavigation">
                                <ul class="accountManagementNavigationElements">
                                    <li><a href="?page=MeinKonto">Mein Konto</a></li>
                                    <li><a href="?page=MeineInserate">Meine Inserate</a></li>
                                    <li><a href="?page=MeineGebote">Meine Gebote</a></li>
                                    <li><a href="?page=MeineFavoriten">Meine Favoriten</a></li>
                                    <li class="accountManagementNavigationElementsActive"><a href="?page=MeineNachrichten">Meine Nachrichten</a></li>
                                </ul>
                            </div>
                            <div class="accountManagementElements">';
                $queryInserat = "SELECT * FROM Inserat JOIN Accounts ON Inserat.Inhaber_Nr = Accounts.account_ID ORDER BY Erstzulassung ASC";
                $resInserat = $db->query($queryInserat);
                echo '
                    </div>
                    ';
            }
        ?>
            <div class="accountManagementSpace">

            </div>
        </div>
    </section>
    <?php
        phpFunctions::printFooter();
    ?>
</body>

</html>