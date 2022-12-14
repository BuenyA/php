<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mein Account</title>
    <link rel="icon" type="image/png" href="../image/AutostarLogoIconTab.png">
    <link rel="stylesheet" href="../allgemeines/stylesheet.css">
    <link rel="stylesheet" href="meinAccount.css">
    <script language="javascript" type="text/javascript" src="../allgemeines/index.js"></script>
</head>

<body>
    <?php

    //Einbinden von Funktionen
    require '../allgemeines/db.php';
    require '../allgemeines/phpFunctions.php';
    session_start();
    if (isset($_GET['abmelden'])) {
        session_destroy();
        header('Location: ../index.php');

    } elseif (!isset($_GET['page'])) {
        header('Location: ?page=MeinKonto');
    }
    if (empty($_SESSION['user'])) {
        header('Location: ./anmeldung.php');
    }
    if (isset($_POST['insertMerken'])) {
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

    $query = "SELECT * FROM Inserat WHERE Inhaber_Nr = '$session_ID'";
    $resAcc = $db->query($query);
    $rowInserat = $resAcc->fetch();


    //Falls ??nderungen zum Account kamen -> in die Datenbank 
    if (isset($_POST['aendern__submit'])) {

        //Werte aus der Form entnehmen und in Variablen speichern
        $vorname = htmlentities(trim($_POST['input__vorname']));
        $nachname = htmlentities(trim($_POST['input__nachname']));
        $plz = htmlentities(trim($_POST['input__plz']));
        $ort = htmlentities(trim($_POST['input__ort']));
        $adresse = htmlentities(trim($_POST['input__adresse']));
        $telefonnummer = htmlentities(trim($_POST['input__telefonnummer']));
        $email = htmlentities(trim($_POST['input__email']));
        $passwort1 = htmlentities(trim($_POST['input__passwort1']));
        $passwort2 = htmlentities(trim($_POST['input__passwort2']));
        $passwortHash = htmlentities(password_hash($passwort1, PASSWORD_DEFAULT));
        //Variable die schaut ob eine ??nderung durchgef??hrt wurde
        $aenderung = false;

        //SQL Statements, falls eine ??nderung unternommen wurde
        //??nderung Vorname
        if ($vorname != $row['vorname'] && $vorname != "") {
            $query = "UPDATE `Accounts` SET `vorname`='$vorname' WHERE `account_ID`='$session_ID'";
            $db->query($query);
            $aenderung = true;
        }
        //??nderung Nachname
        if ($nachname != $row['nachname'] && $nachname != "") {
            $query = "UPDATE `Accounts` SET `nachname`='$nachname' WHERE `account_ID`='$session_ID'";
            $db->query($query);
            $aenderung = true;
        }
        //??nderung Postleihzahl
        if ($plz != $row['plz'] && $plz != "" && is_numeric($plz) && strlen($plz) == 5) {
            $query = "UPDATE `Accounts` SET `plz`='$plz' WHERE `account_ID`='$session_ID'";
            $db->query($query);
            $aenderung = true;
        }
        //??nderung Ort
        if ($ort != $row['ort'] && $ort != "") {
            $query = "UPDATE `Accounts` SET `ort`='$ort' WHERE `account_ID`='$session_ID'";
            $db->query($query);
            $aenderung = true;
        }
        //??nderung Adresse
        if ($adresse != $row['adresse'] && $adresse != "") {
            $query = "UPDATE `Accounts` SET `adresse`='$adresse' WHERE `account_ID`='$session_ID'";
            $db->query($query);
            $aenderung = true;
        }
        //??nderung Telefonnummer
        if ($telefonnummer != $row['telefon_Nr'] && $telefonnummer != "" && is_numeric($telefonnummer) && strlen($telefonnummer) < 16) {
            $query = "UPDATE `Accounts` SET `telefon_Nr`='$telefonnummer' WHERE `account_ID`='$session_ID'";
            $db->query($query);
            $aenderung = true;
        }
        //??nderung Email
        if ($email != $row['email'] && $email != "" && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $query = "UPDATE `Accounts` SET `email`='$email' WHERE `account_ID`='$session_ID'";
            $db->query($query);
            $aenderung = true;
        }
        //??nderung Passwort
        if($passwort1 != null && $passwort2 != null && $passwortHash != null && $passwort1 != "" && $passwort2 != "" && $passwort1 == $passwort2) {
            $query = "UPDATE `Accounts` SET `passwort`='$passwortHash' WHERE `account_ID`='$session_ID'";
            $db->query($query);
            $aenderung = true;
        }

        //Falls eine ??nderung durchgef??hrt wurde
        if ($aenderung) {
            //Weiterleitung zu Best??tigungsseite
            header('Location: ./erfolgreichAenderung.php');
        }
    }

    //Falls ??nderungen zu einem Inserat kamen -> in die Datenbank 
    if (isset($_POST['auktionSpeichern'])) {
  
        //Werte aus der Form entnehmen und in Variablen speichern
        $inseratNr = htmlentities(trim($_POST['Inserat_Nr']));
        $marke = htmlentities(trim($_POST['input__marke']));
        $modell = htmlentities(trim($_POST['input__modell']));
        $kilometerstand = htmlentities(trim($_POST['input__kilometerstand']));
        $ps = htmlentities(trim($_POST['input__ps']));
        $kraftstoffart = htmlentities(trim($_POST['input__kraftstoffart']));
        $getriebeart = htmlentities(trim($_POST['input__getriebeart']));
        $erstzulassung = htmlentities(trim($_POST['input__erstzulassung']));
        $beschreibung = htmlentities(trim($_POST['input__beschreibung']));
        //Variable die schaut ob eine ??nderung durchgef??hrt wurde
        $aenderung = false;

        //SQL Statements, falls eine ??nderung unternommen wurde
        //??nderung Marke
        if ($marke != $rowInserat['Marke'] && $marke != "") {
            $query = "UPDATE `Inserat` SET `Marke`='$marke' WHERE `Inserat_Nr`='$inseratNr'";
            $db->query($query);
            $aenderung = true;
        }
        //??nderung Modell
        if ($modell != $rowInserat['Modell'] && $modell != "") {
            $query = "UPDATE `Inserat` SET `Modell`='$modell' WHERE `Inserat_Nr`='$inseratNr'";
            $db->query($query);
            $aenderung = true;
        }
        //??nderung Kilometerstand
        if ($kilometerstand != $rowInserat['Kilometerstand'] && $kilometerstand != "") {
            $query = "UPDATE `Inserat` SET `Kilometerstand`='$kilometerstand' WHERE `Inserat_Nr`='$inseratNr'";
            $db->query($query);
            $aenderung = true;
        }
        //??nderung PS
        if ($ps != $rowInserat['PS'] && $ps != "") {
            $query = "UPDATE `Inserat` SET `PS`='$ps' WHERE `Inserat_Nr`='$inseratNr'";
            $db->query($query);
            $aenderung = true;
        }
        //??nderung Kraftstoffart
        if ($kraftstoffart != $rowInserat['Kraftstoffart'] && $kraftstoffart != "") {
            $query = "UPDATE `Inserat` SET `Kraftstoffart`='$kraftstoffart' WHERE `Inserat_Nr`='$inseratNr'";
            $db->query($query);
            $aenderung = true;
        }
        //??nderung Getriebeart
        if ($getriebeart != $rowInserat['Getriebeart'] && $getriebeart != "") {
            $query = "UPDATE `Inserat` SET `Getriebeart`='$getriebeart' WHERE `Inserat_Nr`='$inseratNr'";
            $db->query($query);
            $aenderung = true;
        }
        //??nderung Erstzulassung
        if ($erstzulassung != $rowInserat['Erstzulassung'] && $erstzulassung != "") {
            $query = "UPDATE `Inserat` SET `Erstzulassung`='$erstzulassung' WHERE `Inserat_Nr`='$inseratNr'";
            $db->query($query);
            $aenderung = true;
        }
        //??nderung Beschreibung
        if ($beschreibung != $rowInserat['Beschreibung'] && $beschreibung != "") {
            $query = "UPDATE `Inserat` SET `Beschreibung`='$beschreibung' WHERE `Inserat_Nr`='$inseratNr'";
            $db->query($query);
            $aenderung = true;
        }                         

        //Falls eine ??nderung durchgef??hrt wurde
        if ($aenderung) {
            //Weiterleitung zu Best??tigungsseite
            header('Location: ./erfolgreichAenderung.php');
        }
    }

    //Falls das Inserat gel??scht wird
    if (isset($_POST['auktionLoeschen'])) {
  
        //Werte aus der Form entnehmen und in Variablen speichern
        $inseratNr = trim($_POST['Inserat_Nr']);
        $query = "DELETE FROM Inserat WHERE Inserat_Nr = $inseratNr";
        $db->query($query);

        //Weiterleitung zu Best??tigungsseite
        header('Location: ./erfolgreichAenderung.php');
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
                            <div class="accountManagementElements accountManagementElementsAcc">
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
                                                    <span class="button__text">??ndern</span>
                                                    <i class="button__icon fas fa-chevron-right"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="accountAusloggenBox">
                                    <div class="accountAusloggenBoxLeft">
                                        <h2>Ausloggen</h2>
                                        <p>M??chten Sie sich ausloggen? <br />Dann bet??tigen Sie die folgende Schaltfl??che.</p>
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
            $queryInserat = "SELECT * FROM Inserat JOIN Accounts ON Inserat.Inhaber_Nr = Accounts.account_ID WHERE account_ID = " . $_SESSION['id'] . " ORDER BY Inserat.Erstellt_Am DESC";
            $resInserat = $db->query($queryInserat);

            //Ausgabe, falls keien Inserate vorhanden
            if(!$resInserat->rowCount() > 0) {
                echo '<h1 class="keinFavorit">Sie haben keine Auktionen inseriert</h1>';
            }

            //Anzeige der Inserate
            if ($resInserat !== false && $resInserat->rowCount() > 0) {
                foreach ($resInserat as $rowInserat) {
                    $InsNr = $rowInserat['Inserat_Nr'];

                    //Selektierung der Angebote f??r den Preis
                    $queryAngebot = "SELECT * FROM Angebote WHERE Inserat_Nr = $InsNr ORDER BY Angebot DESC";
                    $resAngebot = $db->query($queryAngebot);
                    
                    //Preisselektierung
                    if($resAngebot->rowCount() > 0) {
                        $rowAngebot = $resAngebot->fetch();
                        $preis = $rowAngebot['Angebot'];
                    } else {
                        $preis = $rowInserat['Preis'];
                    }

                    //Selektierung der Bilder -> ORDER BY erstellt am
                    $queryBilder = "SELECT * FROM Inseratbilder WHERE Inserat_Nr = $InsNr ORDER BY Erstellt_Am ASC";
                    $resBilder = $db->query($queryBilder);
                    $rowBilder = $resBilder->fetch();

                    echo '
                            <div class="auktionsAnzeige">
                                <form method="post">
                                    <div class="auktionsAnzeigeTop">
                                        <div class="auktionsAnzeigePics">
                                            <h10>'.$rowInserat['Marke'].' '.$rowInserat['Modell'].'</h10>
                                            <img src="data:image/jpeg;base64,'.base64_encode($rowBilder['Bild']).'" width="600" height="300"/>
                                        </div>
                                        <div class="seperator"></div>
                                        <div class="auktionsAnzeigeDaten">
                                            <h10>Daten</h10>
                                            <div class="auktionsAnzeigeZeile">
                                                <div class="auktionsAnzeigeElement">
                                                    <label>Marke</label> 
                                                    <input type="text" name="input__marke" value="'.$rowInserat['Marke'].'"/ required>
                                                </div>
                                                <div class="auktionsAnzeigeElement">
                                                    <label>Modell</label>
                                                    <input type="text" name="input__modell" value="'.$rowInserat['Modell'].'"/ required>
                                                </div>
                                            </div>
                                            <div class="auktionsAnzeigeZeile">
                                                <div class="auktionsAnzeigeElement">
                                                    <label>Kilometerstand</label>
                                                    <input type="text" name="input__kilometerstand" value="'.$rowInserat['Kilometerstand'].'"/ required>
                                                </div>
                                                <div class="auktionsAnzeigeElement">
                                                    <label>PS</label>
                                                    <input type="text" name="input__ps" value="'.number_format($rowInserat['PS'], 0, '.', '.').'"/ required>
                                                </div>
                                            </div>
                                            <div class="auktionsAnzeigeZeile">
                                                <div class="auktionsAnzeigeElement">
                                                    <label>Kraftstoffart</label>
                                                    <input type="text" name="input__kraftstoffart" value="'.$rowInserat['Kraftstoffart'].'"/ required>
                                                </div>
                                                <div class="auktionsAnzeigeElement">
                                                    <label>Getriebeart</label>
                                                    <input type="text" name="input__getriebeart" value="'.$rowInserat['Getriebeart'].'"/ required>
                                                </div>
                                            </div>
                                            
                                            <div class="auktionsAnzeigeElement">
                                                <label>Erstzulassung</label>
                                                <input type="year" name="input__erstzulassung" value="'.$rowInserat['Erstzulassung'].'"/ required>
                                                <input class="hidden" type="number" name="Inserat_Nr" value="'.$rowInserat['Inserat_Nr'].'"/>
                                            </div>
                                            <div class="auktionsAnzeigeElement auktionsAnzeigeElementBeschreibung">
                                                <label>Beschreibung</label>
                                                <textarea name="input__beschreibung" type="text">'.$rowInserat['Beschreibung'].'</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="seperator"></div>
                                    <div class="auktionsAnzeigeBottom">
                                        <div class="auktionsAnzeigeBottomLoeschen">
                                            <button name="auktionLoeschen">Auktion l??schen</button>
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

                    //Selektierung nach den Inseratbildern
                    $queryBilder = "SELECT * FROM Inseratbilder WHERE Inserat_Nr = ".$row['Inserat_Nr']." AND Hauptbild = 1 ORDER BY Erstellt_Am DESC";
                    $resBilder = $db->query($queryBilder);
                    $rowBilder = $resBilder->fetch();

                    //Selektierung auf das h??chste Angebot
                    $queryMaxAngebot = "SELECT * FROM Angebote WHERE Inserat_Nr = ".$row['Inserat_Nr']." AND Angebot > ".$row['Angebot'];
                    $resMaxAngebot = $db->query($queryMaxAngebot);

                    if($resMaxAngebot->rowCount() > 0) {
                        $cssGebotBox = 'maxGebot';
                        $cssUeberboten = 'ueberboten2';
                    } else {
                        $cssGebotBox = '';
                        $cssUeberboten = 'ueberboten';
                    }

                    echo '
                    <a class="topOfferLink" href="../Angebote/produkt.php?produkt='.$row['Inserat_Nr'].'">
                        <div class="topOfferPlace">
                            <div class="gebotBox '.$cssGebotBox.'">
                                <img src="data:image/jpeg;base64,'.base64_encode($rowBilder['Bild']).'" width="150" height="150"/>
                                <div class="geboteRight">
                                    <div class="topOffersRightTop">
                                        <h2>' . $row['Marke'] . ' ' . $row['Modell'] . '</h2>
                                    </div>
                                    <p class="anfangspreis">Urspr??nglicher Preis: ' . number_format($row['Preis'], 0, '.', '.') . ' ???</p>
                                    <p class="'.$cssUeberboten.'">Du wurdest ??berboten!</p>
                                    <p>
                                        ' . $row['vorname'] . ' ' . $row['nachname'] . ' </br>
                                        Tel.: +49 123 456789</br>
                                        Ort: ' . $row['ort'] . '
                                    </p>
                                </div>
                                <p class="auktionspreisGebot"><b>' . number_format($row['Angebot'], 0, '.', '.') . ' ???</b></p>
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

                //Counter f??r die dynamische Zeitanzeige Klasse
                $counter = 0;

                //Variablendeklaration f??r dynamische Zeitanzeige
                $waiting_day = strtotime($rowInserat['Auktionsende']);
                $getDateTime = date("F d, Y H:i:s", $waiting_day); // JavaScript Variable

                $resInserat = $db->query($queryInserat);
            } else {
                echo '<h1 class="keinFavorit">Sie haben keine Auktionen favorisiert</h1>';
            }

            //Row zur??cksetzen
            if ($resInserat !== false && $resInserat->rowCount() > 0) {
                foreach ($resInserat as $row) {

                    //Selektierung nach den Inseratbildern
                    $queryBilder = "SELECT * FROM Inseratbilder WHERE Inserat_Nr = ".$row['Inserat_Nr']." AND Hauptbild = 1 ORDER BY Erstellt_Am DESC";
                    $resBilder = $db->query($queryBilder);
                    $rowBilder = $resBilder->fetch();

                    echo '
                        <a class="topOfferLink" href="../Angebote/produkt.php?produkt='.$row['Inserat_Nr'].'">
                            <div class="topOffers">
                                <img src="data:image/jpeg;base64,'.base64_encode($rowBilder['Bild']).'" width="250" height="250"/>
                                <div class="topOffersRight">
                                    <div class="topOffersRightTop">
                                        <h2>' . $row['Marke'] . ' ' . $row['Modell'] . '</h2>
                                        <p class="auktionspreis"><b>' . number_format($preis ,0, '.', '.') . ' ???</b></p>
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
                                    <form method="post">
                                        <input class="displayNone" type="text" name="InseratNr" value="'.$row['Inserat_Nr'].'">
                                        <input class="displayNone" type="text" name="AccID" value="'.$_SESSION['id'].'">
                                        <input type="submit" value="      Merken" name="insertMerken" class="'.$cssClassVariable.'" />
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
    <script src="./slideshow.js"></script>
</body>

</html>