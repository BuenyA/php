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
    
    //aktuelle Daten des Session Users aus der Datenbank laden
    $session_ID = $_SESSION['id'];
    $query = "SELECT * FROM accounts WHERE account_ID = '$session_ID'";
    $resAcc = $db->query($query);
    $row = $resAcc->fetch();
    


    //Falls Änderungen zum Account kamen -> in die Datenbank 
    if (isset($_POST['aendern__submit'])) {

        //Werte aus der Form entnehmen und in Variablen speichern
        $vorname = trim($_POST['input__vorname']);
        $nachname = trim($_POST['input__nachname']);
        $plz = trim($_POST['input__plz']);
        $ort = trim($_POST['input__ort']);
        $adresse = trim($_POST['input__adresse']);
        $telefonnummer = trim($_POST['input__telefonnummer']);
        $email = trim($_POST['input__email']);
        $passwort1 = trim($_POST['input__passwort1']);
        $passwort2 = trim($_POST['input__passwort2']);
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
        if ($telefonnummer != $row['telefon_Nr'] && $telefonnummer != "" && is_numeric($telefonnummer) && strlen($telefonnummer) < 16) {
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
    }

        //Falls Änderungen zu einem Inserat kamen -> in die Datenbank 
        if (isset($_POST['auktionSpeichern'])) {
      
            //Werte aus der Form entnehmen und in Variablen speichern
            $inseratNr = trim($_POST['Inserat_Nr']);
            $marke = trim($_POST['input__marke']);
            $modell = trim($_POST['input__modell']);
            $kilometerstand = trim($_POST['input__kilometerstand']);
            $ps = trim($_POST['input__ps']);
            $kraftstoffart = trim($_POST['input__kraftstoffart']);
            $getriebeart = trim($_POST['input__getriebeart']);
            $auktionsbeginn = trim($_POST['input__auktionsbeginn']);
            $auktionsende = trim($_POST['input__auktionsende']);
            $erstzulassung = trim($_POST['input__erstzulassung']);
            $beschreibung = trim($_POST['input__beschreibung']);
            //Variable die schaut ob eine Änderung durchgeführt wurde
            $aenderung = false;
    
            //SQL Statements, falls eine Änderung unternommen wurde
            //Änderung Marke
            if ($marke != $row['Marke'] && $marke != "") {
                $query = "UPDATE `Inserat` SET `Marke`='$marke' WHERE `Inserat_Nr`='$inseratNr'";
                $db->query($query);
                $aenderung = true;
            }
            //Änderung Modell
            if ($modell != $row['Modell'] && $modell != "") {
                $query = "UPDATE `Inserat` SET `Modell`='$modell' WHERE `Inserat_Nr`='$inseratNr'";
                $db->query($query);
                $aenderung = true;
            }
            //Änderung Kilometerstand
            if ($kilometerstand != $row['Kilometerstand'] && $kilometerstand != "") {
                $query = "UPDATE `Inserat` SET `Kilometerstand`='$kilometerstand' WHERE `Inserat_Nr`='$inseratNr'";
                $db->query($query);
                $aenderung = true;
            }
            //Änderung PS
            if ($ps != $row['PS'] && $ps != "") {
                $query = "UPDATE `Inserat` SET `PS`='$ps' WHERE `Inserat_Nr`='$inseratNr'";
                $db->query($query);
                $aenderung = true;
            }
            //Änderung Kraftstoffart
            if ($kraftstoffart != $row['Kraftstoffart'] && $kraftstoffart != "") {
                $query = "UPDATE `Inserat` SET `Kraftstoffart`='$kraftstoffart' WHERE `Inserat_Nr`='$inseratNr'";
                $db->query($query);
                $aenderung = true;
            }
            //Änderung Getriebeart
            if ($getriebeart != $row['Getriebeart'] && $getriebeart != "") {
                $query = "UPDATE `Inserat` SET `Getriebeart`='$getriebeart' WHERE `Inserat_Nr`='$inseratNr'";
                $db->query($query);
                $aenderung = true;
            }
            //Änderung Auktionsbeginn
            if ($auktionsbeginn != $row['Auktionsbeginn'] && $auktionsbeginn != "") {
                $query = "UPDATE `Inserat` SET `Auktionsbeginn`='$auktionsbeginn' WHERE `Inserat_Nr`='$inseratNr'";
                $db->query($query);
                $aenderung = true;
            }
            //Änderung Auktionsende
            if ($auktionsende != $row['Auktionsende'] && $auktionsende != "") {
                $query = "UPDATE `Inserat` SET `Auktionsende`='$auktionsende' WHERE `Inserat_Nr`='$inseratNr'";
                $db->query($query);
                $aenderung = true;
            }
            //Änderung Erstzulassung
            if ($erstzulassung != $row['Erstzulassung'] && $erstzulassung != "") {
                $query = "UPDATE `Inserat` SET `Erstzulassung`='$erstzulassung' WHERE `Inserat_Nr`='$inseratNr'";
                $db->query($query);
                $aenderung = true;
            }
            //Änderung Beschreibung
            if ($beschreibung != $row['Beschreibung'] && $beschreibung != "") {
                $query = "UPDATE `Inserat` SET `Beschreibung`='$beschreibung' WHERE `Inserat_Nr`='$inseratNr'";
                $db->query($query);
                $aenderung = true;
            }                         

    
            //Falls eine Änderung durchgeführt wurde
            if ($aenderung) {
                //Weiterleitung zu Bestätigungsseite
                //echo '<script>window.location = "./erfolgreichAenderung.php";</script>';   
            }
        }

        //Falls das Inserat gelöscht wird
        if (isset($_POST['auktionloeschena'])) {
      
            //Werte aus der Form entnehmen und in Variablen speichern
            $inseratNr = trim($_POST['Inserat_Nr']);

            $query = "DELETE * FROM `Inserat` WHERE `Inserat_Nr`='$inseratNr'";
            $db->query($query);

            //Weiterleitung zu Bestätigungsseite
            echo '<script>window.location = "./erfolgreichAenderung.php";</script>';   
            
        }

    phpFunctions::printNavigationBar();
    ?>
    <section class="accountManagement">
        <?php
        if ($_GET['page'] == 'MeinKonto') {
            
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
                                                        <!-- input vorname -->
                                                        <label>Vorname</label>
                                                        <input name="input__vorname" value="'.$row['vorname'].'"/>
                                                    </div>
                                                    <div class="login__field">
                                                        <!-- input nachname -->
                                                        <label>Nachname</label>
                                                        <input name="input__nachname" value="'.$row['nachname'].'"/>
                                                    </div>
                                                </div>
                                                <div class="login__field__section">
                                                    <div class="login__field login__field__plz">
                                                        <!-- input plz -->
                                                        <label>PLZ</label>
                                                        <input name="input__plz" value="'.$row['plz'].'"/>
                                                    </div>
                                                    <div class="login__field">
                                                        <!-- input ort -->
                                                        <label>Ort</label>
                                                        <input name="input__ort" value="'.$row['ort'].'"/>
                                                    </div>
                                                    <div class="login__field">
                                                        <!-- input adresse -->
                                                        <label>Adresse</label>
                                                        <input name="input__adresse" value="'.$row['adresse'].'"/>
                                                    </div>
                                                    <div class="login__field">
                                                        <!-- input telefonnummer -->
                                                        <label>Telefonnummer</label>
                                                    <input name="input__telefonnummer" value="'.$row['telefon_Nr'].'" />
                                                </div>
                                                </div>
                                                <div class="login__field__section">
                                                    <div class="login__field">
                                                        <!-- input email -->
                                                        <label>E-Mail</label>
                                                        <input name="input__email" value="'.$row['email'].'"/>
                                                    </div>
                                                    <div class="login__field">
                                                        <!-- input passwort -->
                                                        <label>Passwort</label>
                                                        <input name="input__passwort1" />
                                                </div>
                                                <div class="login__field">
                                                    <!-- input passwort -->
                                                    <label>Passwort wiederholen</label>
                                                    <input name="input__passwort2" />
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
                            </div>
                        ';

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

            //Selektierung der Auktionen
            $queryInserat = "SELECT * FROM Inserat JOIN Accounts ON Inserat.Inhaber_Nr = Accounts.account_ID WHERE account_ID = " . $_SESSION['id'];
            $resInserat = $db->query($queryInserat);

            //Ausgabe, falls keien Inserate vorhanden
            if(!$resInserat->rowCount() > 0) {
                echo '<h1 class="keinFavorit">Sie haben keine Auktionen inseriert</h1>';
            }

            //Anzeige der Inserate
            if ($resInserat !== false && $resInserat->rowCount() > 0) {
                foreach ($resInserat as $row) {
                    $InsNr = $row['Inserat_Nr'];

                    //Selektierung der Angebote für den Preis
                    $queryAngebot = "SELECT * FROM Angebote WHERE Inserat_Nr = $InsNr ORDER BY Angebot DESC";
                    $resAngebot = $db->query($queryAngebot);
                    
                    //Preisselektierung
                    if($resAngebot->rowCount() > 0) {
                        $rowAngebot = $resAngebot->fetch();
                        $preis = $rowAngebot['Angebot'];
                    } else {
                        $preis = $row['Preis'];
                    }

                    //Selektierung der Bilder -> ORDER BY erstellt am
                    $queryAngebot = "SELECT * FROM Inseratbilder WHERE Inserat_Nr = $InsNr ORDER BY Erstellt_Am DESC";
                    $resAngebot = $db->query($queryAngebot);

                    echo '
                            <div class="auktionsAnzeige">
                                <form method="post">
                                    <div class="auktionsAnzeigeTop">
                                        <div class="auktionsAnzeigePics">
                                            <h10>'.$row['Marke'].' '.$row['Modell'].'</h10>
                                            <img src="../image/auto_jaguar.jpg" alt="Bild konnte nicht geladen werden..." width="600" height="300">
                                            <div class="auktionsAnzeigePicsButton">
                                                <button>Bilder hinzufügen</button>
                                                <button>Bild löschen</button>
                                            </div>
                                        </div>
                                        <div class="seperator"></div>
                                        <div class="auktionsAnzeigeDaten">
                                            <h10>Daten</h10>
                                            <div class="auktionsAnzeigeZeile">
                                                <div class="auktionsAnzeigeElement">
                                                    <label>Marke</label>
                                                    <input type="text" name ="input__marke" value="'.$row['Marke'].'"/ required>
                                                </div>
                                                <div class="auktionsAnzeigeElement">
                                                    <label>Modell</label>
                                                    <input type="text" name ="input__modell" value="'.$row['Modell'].'"/ required>
                                                </div>
                                            </div>
                                            <div class="auktionsAnzeigeZeile">
                                                <div class="auktionsAnzeigeElement">
                                                    <label>Kilometerstand</label>
                                                    <input type="text" name ="input__kilometerstand" value="'.number_format($row['Kilometerstand'], 0, '.', '.').'"/ required>
                                                </div>
                                                <div class="auktionsAnzeigeElement">
                                                    <label>PS</label>
                                                    <input type="text" name ="input__ps" value="'.number_format($row['PS'], 0, '.', '.').'"/ required>
                                                </div>
                                            </div>
                                            <div class="auktionsAnzeigeZeile">
                                                <div class="auktionsAnzeigeElement">
                                                    <label>Kraftstoffart</label>
                                                    <input type="text" name ="input__kraftstoffart" value="'.$row['Kraftstoffart'].'"/ required>
                                                </div>
                                                <div class="auktionsAnzeigeElement">
                                                    <label>Getriebeart</label>
                                                    <input type="text" name ="input__getriebeart" value="'.$row['Getriebeart'].'"/ required>
                                                </div>
                                            </div>
                                            <div class="auktionsAnzeigeZeile">
                                                <div class="auktionsAnzeigeElement">
                                                    <label>Auktionsbeginn</label>
                                                    <input type="datetime" name ="input__auktionsbeginn" value="'.$row['Auktionsbeginn'].'"/ required>
                                                </div>
                                                <div class="auktionsAnzeigeElement">
                                                    <label>Auktionsende</label>
                                                    <input type="datetime" name ="input__auktionsende" value="'.$row['Auktionsende'].'"/ required>
                                                </div>
                                            </div>
                                            <div class="auktionsAnzeigeElement">
                                                <label>Erstzulassung</label>
                                                <input type="year" name ="input__erstzulassung" value="'.$row['Erstzulassung'].'"/ required>
                                                <input class="hidden" type="number" name="Inserat_Nr" value="'.$row['Inserat_Nr'].'"/>
                                            </div>
                                            <div class="auktionsAnzeigeElement auktionsAnzeigeElementBeschreibung">
                                                <label>Beschreibung</label>
                                                <textarea name ="input__beschreibung" type="text">"'.$row['Beschreibung'].'"</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="seperator"></div>
                                    <div class="auktionsAnzeigeBottom">
                                        <div class="auktionsAnzeigeBottomLoeschen" name="auktionLoeschen">
                                            <button  name="auktionloeschena>Auktion löschen</button>
                                        </div>
                                        <div class="auktionsAnzeigeBottomSpeichern">
                                            <button name="auktionSpeichern">Auktion speichern</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            ';
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
                echo '<h1 class="keinFavorit">Sie haben kein Gebot abgegeben</h1>';
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