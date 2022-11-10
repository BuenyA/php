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

    //Einbinden von Funktionen
    require '../db.php';
    require '../phpFunctions.php';
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
    phpFunctions::printNavigationBar();
    ?>
    <section class="accountManagement">
        <?php
        if ($_GET['page'] == 'MeinKonto') {

            //aktuelle Daten des Session Users aus der Datenbank laden
            $session_ID = $_SESSION['id'];
            $query = "SELECT * FROM accounts WHERE account_ID = '$session_ID'";
            $resAcc = $db->query($query);
            $row = $resAcc->fetch();


            //Falls Änderungen kamen -> in die Datenbank 
            if (isset($_POST['aendern__submit'])) {

                //Werte aus der Form entnehmen und in Variablen speichern
                $vorname = $_POST['textarea__vorname'];
                $nachname = $_POST['textarea__nachname'];
                $plz = $_POST['textarea__plz'];
                $ort = $_POST['textarea__ort'];
                $adresse = $_POST['textarea__adresse'];
                $telefonnummer = $_POST['textarea__telefonnummer'];
                $email = $_POST['textarea__email'];
                $passwort1 = $_POST['textarea__passwort1'];
                $passwort2 = $_POST['textarea__passwort2'];
                $passwortHash = password_hash($passwort1, PASSWORD_DEFAULT);
                //Variable die schaut ob eine Änderung durchgeführt wurde
                $aenderung = false;

                //SQL Statements, falls eine Änderung unternommen wurde
                //Änderung Vorname
                if ($vorname != $row['vorname'] && $vorname != "") {
                    $query = "UPDATE `Accounts` SET `vorname`='$vorname' WHERE `account_ID`='$session_ID'";
                    $db->query($query);
                    $aenderung = true;
                }
                //Änderung Nachname
                if ($nachname != $row['nachname'] && $nachname != "") {
                    $query = "UPDATE `Accounts` SET `nachname`='$nachname' WHERE `account_ID`='$session_ID'";
                    $db->query($query);
                }
                //Änderung Postleihzahl
                if ($plz != $row['plz'] && $plz != "" && is_numeric($plz) && strlen($plz) == 5) {
                    $query = "UPDATE `Accounts` SET `plz`='$plz' WHERE `account_ID`='$session_ID'";
                    $db->query($query);
                    $aenderung = true;
                }
                //Änderung Ort
                if ($ort != $row['ort'] && $ort != "") {
                    $query = "UPDATE `Accounts` SET `ort`='$ort' WHERE `account_ID`='$session_ID'";
                    $db->query($query);
                    $aenderung = true;
                }
                //Änderung Adresse
                if ($adresse != $row['adresse'] && $adresse != "") {
                    $query = "UPDATE `Accounts` SET `adresse`='$adresse' WHERE `account_ID`='$session_ID'";
                    $db->query($query);
                    $aenderung = true;
                }
                //Änderung Telefonnummer
                if ($telefonnummer != $row['telefon_Nr'] && $telefonnummer != "" && is_numeric($telefonnummer) && strlen($telefonnummer) < 20) {
                    $query = "UPDATE `Accounts` SET `telefon_Nr`='$telefonnummer' WHERE `account_ID`='$session_ID'";
                    $db->query($query);
                    $aenderung = true;
                }
                //Änderung Email
                if ($email != $row['email'] && $email != "" && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $query = "UPDATE `Accounts` SET `email`='$email' WHERE `account_ID`='$session_ID'";
                    $db->query($query);
                    $aenderung = true;
                }
                //Änderung Passwort
                if($passwort1 != null && $passwort2 != null && $passwortHash != null && $passwort1 != "" && $passwort2 != "" && $passwort1 == $passwort2) {
                    $query = "UPDATE `Accounts` SET `passwort`='$passwortHash' WHERE `account_ID`='$session_ID'";
                    $db->query($query);
                    $aenderung = true;
                }

                //Falls eine Änderung durchgeführt wurde
                if ($aenderung) {
                    //Weiterleitung zu Bestätigungsseite
                    echo '<script>window.location = "./erfolgreichAenderung.php";</script>';   
                }

                // echo '<script>window.location = "./meinAccount.php";</script>';

            }

            //Meine Account Bearbeitung
            echo '<h1>Guten Tag ' . $_SESSION['vorname'] . '</h1>
                        <div class="accountManagementBody">
                            <div class="accountManagementNavigation">
                                <ul class="accountManagementNavigationElements">
                                    <li class="accountManagementNavigationElementsActive"><a href="?page=MeinKonto">Mein Konto</a></li>
                                    <li><a href="?page=MeineAuktionen">Meine Auktionen</a></li>
                                    <li><a href="?page=MeineGebote">Meine Gebote</a></li>
                                    <li><a href="?page=MeineFavoriten">Meine Favoriten</a></li>
                                </ul>
                            </div>
                            <div class="accountManagementElements">
                                <div class="accountManagementBox">
                                    <h2>Mein Account</h2>
                                    <div class="screen">
                                        <div class="screen__content">
                                            <form class="login" method="post">
                                                <div class="login__field__section">
                                                    <div class="login__field">
                                                        <i class="login__icon fas fa-user"></i>
                                                        <!-- input vorname -->
                                                        <textarea name="textarea__vorname" rows= "1" cols="20">' . $row['vorname'] . '</textarea>
                                                    </div>
                                                    <div class="login__field">
                                                        <i class="login__icon fas fa-lock"></i>
                                                        <!-- input nachname -->
                                                        <textarea name="textarea__nachname" rows= "1" cols="20">' . $row['nachname'] . '</textarea>
                                                    </div>
                                                </div>
                                                <div class="login__field__section">
                                                    <div class="login__field login__field__plz">
                                                        <i class="login__icon fas fa-user"></i>
                                                        <!-- input plz -->
                                                        <textarea name="textarea__plz" rows= "1" cols="20">' . $row['plz'] . '</textarea>
                                                    </div>
                                                    <div class="login__field">
                                                        <i class="login__icon fas fa-lock"></i>
                                                        <!-- input ort -->
                                                        <textarea name="textarea__ort" rows= "1" cols="20">' . $row['ort'] . '</textarea>
                                                    </div>
                                                    <div class="login__field">
                                                        <i class="login__icon fas fa-lock"></i>
                                                        <!-- input adresse -->
                                                        <textarea name="textarea__adresse" rows= "1" cols="20">' . $row['adresse'] . '</textarea>
                                                    </div>
                                                    <div class="login__field">
                                                        <i class="login__icon fas fa-lock"></i>
                                                        <!-- input telefonnummer -->
                                                    <textarea name="textarea__telefonnummer" rows= "1" cols="20">' . $row['telefon_Nr'] . '</textarea>
                                                </div>
                                                </div>
                                                <div class="login__field__section">
                                                    <div class="login__field">
                                                        <i class="login__icon fas fa-user"></i>
                                                        <!-- input email -->
                                                        <textarea name="textarea__email" rows= "1" cols="20">' . $row['email'] . '</textarea>
                                                    </div>
                                                    <div class="login__field">
                                                        <i class="login__icon fas fa-user"></i>
                                                        <!-- input passwort -->
                                                        <textarea name="textarea__passwort1" rows= "1" cols="20"></textarea>
                                                </div>
                                                <div class="login__field">
                                                        <i class="login__icon fas fa-user"></i>
                                                        <!-- input passwort -->
                                                        <textarea name="textarea__passwort2" rows= "1" cols="20"></textarea>
                                                </div>
                                                </div>
                                                <button class="button login__submit" name="aendern__submit">
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

        //Verwaltung meiner Inserate
        } elseif ($_GET['page'] == 'MeineAuktionen') {
            echo '<h1>Meine Auktionen</h1>
                        <div class="accountManagementBody">
                            <div class="accountManagementNavigation">
                                <ul class="accountManagementNavigationElements">
                                    <li><a href="?page=MeinKonto">Mein Konto</a></li>
                                    <li class="accountManagementNavigationElementsActive"><a href="?page=MeineAuktionen">Meine Auktionen</a></li>
                                    <li><a href="?page=MeineGebote">Meine Gebote</a></li>
                                    <li><a href="?page=MeineFavoriten">Meine Favoriten</a></li>
                                </ul>
                            </div>
                            <div class="accountManagementElements">';
            $queryInserat = "SELECT * FROM Inserat JOIN Accounts ON Inserat.Inhaber_Nr = Accounts.account_ID WHERE account_ID = " . $_SESSION['id'];
            $resInserat = $db->query($queryInserat);

            if(!$resInserat->rowCount() > 0) {
                echo '<h1 class="keinFavorit">Sie haben keine Auktionen inseriert</h1>';
            }

            if ($resInserat !== false && $resInserat->rowCount() > 0) {
                foreach ($resInserat as $row) {
                    $InsNr = $row['Inserat_Nr'];
                    $queryAngebot = "SELECT * FROM Angebote WHERE Inserat_Nr = $InsNr ORDER BY Angebot DESC";
                    $resAngebot = $db->query($queryAngebot);
                    if($resAngebot->rowCount() > 0) {
                        $rowAngebot = $resAngebot->fetch();
                        $preis = $rowAngebot['Angebot'];
                    } else {
                        $preis = $row['Preis'];
                    }
                    echo '
                        <a class="topOfferLink" href="../Angebote/produkt.php?produkt='.$row['Inserat_Nr'].'">
                            <div class="topOffers">
                                <img src="../image/auto_jaguar.jpg" alt="Bild konnte nicht geladen werden..." width="250" height="250">
                                <div class="topOffersRight">
                                    <div class="topOffersRightTop">
                                        <h2>' . $row['Marke'] . ' ' . $row['Modell'] . '</h2>
                                        <p class="auktionspreis"><b>' . number_format($preis ,0, '.', '.') . ' €</b></p>
                                    </div>
                                    <h5 id="counter'.$row['Auktionsende'].'"></h5>
                                    <p>
                                        ' . number_format($row['Kilometerstand'] ,0, ',', '.') . ' km, ' . ceil($row['PS'] / 1.35962) . ' kW (' . $row['PS'] . ' PS), ' . $row['Kraftstoffart'] . ', ' . $row['Getriebeart'] . '
                                    </p>
                                    <p>
                                        ' . $row['vorname'] . ' ' . $row['nachname'] . ' </br>
                                        Tel.: +49 123 456789</br>
                                        Ort: ' . $row['ort'] . '
                                    </p>
                                    <form action="?insertMerken=1" method="post">
                                        <input class="displayNone" type="text" name="InseratNr" value="'.$row['Inserat_Nr'].'">
                                        <input class="displayNone" type="text" name="AccID" value="'.$_SESSION['id'].'">
                                    </form>
                                </div>
                            </div>
                        </a>';
                }
            }
            echo '
                    </div>
                ';

        //Verwaltung meiner Gebote
        } elseif ($_GET['page'] == 'MeineGebote') {
            echo '<h1>Meine Gebote</h1>
                        <div class="accountManagementBody">
                            <div class="accountManagementNavigation">
                                <ul class="accountManagementNavigationElements">
                                    <li><a href="?page=MeinKonto">Mein Konto</a></li>
                                    <li><a href="?page=MeineAuktionen">Meine Auktionen</a></li>
                                    <li class="accountManagementNavigationElementsActive"><a href="?page=MeineGebote">Meine Gebote</a></li>
                                    <li><a href="?page=MeineFavoriten">Meine Favoriten</a></li>
                                </ul>
                            </div>
                            <div class="accountManagementElements">';

            //Selektireung auf E-Mail funktioniert noch nicht----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
            $queryInserat = "SELECT * FROM Angebote JOIN Accounts ON Angebote.Account_Nr = Accounts.account_ID JOIN Inserat ON Inserat.Inserat_Nr = Angebote.Inserat_Nr WHERE Angebote.Account_Nr = " . $_SESSION['id'] . " OR Angebote.Email = '" . $_SESSION['user'] . "' ORDER BY Angebote.Erstellt_Am DESC";
            $resInserat = $db->query($queryInserat);

            //Wenn Favoriten vorhanden sind...
            if(!$resInserat->rowCount() > 0) {
                echo '<h1 class="keinFavorit">Sie haben keine Auktionen favorisiert</h1>';
            }

            //Drucke Gebote
            if ($resInserat !== false && $resInserat->rowCount() > 0) {
                foreach ($resInserat as $row) {
                    echo '
                    <a class="topOfferLink" href="../Angebote/produkt.php?produkt='.$row['Inserat_Nr'].'">
                        <div class="topOfferPlace">
                            <div class="gebotBox">
                                <img src="../image/auto_jaguar.jpg" alt="Bild konnte nicht geladen werden..." width="150" height="150">
                                <div class="geboteRight">
                                    <div class="topOffersRightTop">
                                        <h2>' . $row['Marke'] . ' ' . $row['Modell'] . '</h2>
                                    </div>
                                    <p class="anfangspreis">Ursprünglicher Preis: ' . number_format($row['Preis'], 0, '.', '.') . ' €</p>
                                    <p>
                                        ' . $row['vorname'] . ' ' . $row['nachname'] . ' </br>
                                        Tel.: +49 123 456789</br>
                                        Ort: ' . $row['ort'] . '
                                    </p>
                                </div>
                                <p class="auktionspreisGebot"><b>' . number_format($row['Angebot'], 0, '.', '.') . ' €</b></p>
                            </div>
                        </div>
                    </a>';
                }
                
            }
            echo '
                        </div>
                    ';

        //Verwaltung meiner favorisierten Auktionen
        } elseif ($_GET['page'] == 'MeineFavoriten') {
            echo '<h1>Meine Favoriten</h1>
                        <div class="accountManagementBody">
                            <div class="accountManagementNavigation">
                                <ul class="accountManagementNavigationElements">
                                    <li><a href="?page=MeinKonto">Mein Konto</a></li>
                                    <li><a href="?page=MeineAuktionen">Meine Auktionen</a></li>
                                    <li><a href="?page=MeineGebote">Meine Gebote</a></li>
                                    <li class="accountManagementNavigationElementsActive"><a href="?page=MeineFavoriten">Meine Favoriten</a></li>
                                </ul>
                            </div>
                            <div class="accountManagementElements">';
            $ID = $_SESSION['id'];

            //Selektierung der Favoriten
            $queryInserat = "SELECT * FROM Merken JOIN Inserat ON Merken.InseratNr = Inserat.Inserat_Nr JOIN Accounts ON Inserat.Inhaber_Nr = Accounts.account_ID WHERE AccountNr = $ID";
            $resInserat = $db->query($queryInserat);

            //Erster Datensatz
            $rowInserat = $resInserat->fetch();

            //Dynamische Wahl, welche Klasse dem Merken-Button vergeben werden soll 
            if ($resInserat !== false && $resInserat->rowCount() > 0) {
                $cssClassVariable = 'merkenButtonPressed';
            } else {
                $cssClassVariable = 'merkenButton';
            }
            
            //Wenn Favoriten vorhanden sind...
            if($resInserat->rowCount() > 0) {

                //Selektierung nach Angeboten
                $InsNr = $rowInserat['InseratNr'];
                $queryAngebot = "SELECT * FROM Angebote WHERE Inserat_Nr = $InsNr ORDER BY Angebot DESC";
                $resAngebot = $db->query($queryAngebot);
                if($resAngebot->rowCount() > 0) {
                    $rowAngebot = $resAngebot->fetch();
                    $preis = $rowAngebot['Angebot'];
                } else {
                    $preis = $rowInserat['Preis'];
                }

                //Counter für die dynamische Zeitanzeige Klasse
                $counter = 0;

                //Variablendeklaration für dynamische Zeitanzeige
                $waiting_day = strtotime($rowInserat['Auktionsende']);
                $getDateTime = date("F d, Y H:i:s", $waiting_day); // JavaScript Variable

                $resInserat = $db->query($queryInserat);
            } else {
                echo '<h1 class="keinFavorit">Sie haben keine Auktionen favorisiert</h1>';
            }

            //Row zurücksetzen
            if ($resInserat !== false && $resInserat->rowCount() > 0) {
                foreach ($resInserat as $row) {
                    echo '
                        <a class="topOfferLink" href="../Angebote/produkt.php?produkt='.$row['Inserat_Nr'].'">
                            <div class="topOffers">
                                <img src="../image/auto_jaguar.jpg" alt="Bild konnte nicht geladen werden..." width="250" height="250">
                                <div class="topOffersRight">
                                    <div class="topOffersRightTop">
                                        <h2>' . $row['Marke'] . ' ' . $row['Modell'] . '</h2>
                                        <p class="auktionspreis"><b>' . number_format($preis ,0, '.', '.') . ' €</b></p>
                                    </div>
                                    <h5 id="counter'.$counter.'"></h5>
                                    <script>calculateTime("'.$getDateTime.'", "'.$counter.'");</script>
                                    <p>
                                        ' . number_format($row['Kilometerstand'] ,0, ',', '.') . ' km, ' . ceil($row['PS'] / 1.35962) . ' kW (' . $row['PS'] . ' PS), ' . $row['Kraftstoffart'] . ', ' . $row['Getriebeart'] . '
                                    </p>
                                    <p>
                                        ' . $row['vorname'] . ' ' . $row['nachname'] . ' </br>
                                        Tel.: +49 123 456789</br>
                                        Ort: ' . $row['ort'] . '
                                    </p>
                                    <form action="?insertMerken=1" method="post">
                                        <input class="displayNone" type="text" name="InseratNr" value="'.$row['Inserat_Nr'].'">
                                        <input class="displayNone" type="text" name="AccID" value="'.$_SESSION['id'].'">
                                        <input type="submit" value="      Merken" class="'.$cssClassVariable.'" />
                                    </form>
                                </div>
                            </div>
                        </a>';
                $counter = $counter + 1;
                }
            }
            echo '
                    </div>
                ';
        }
        ?>
        <div class="accountManagementSpace"></div>
    </section>
    <?php
        phpFunctions::printFooter();
    ?>
</body>

</html>