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
        session_start();
        require_once '../db.php';
        require_once '../phpFunctions.php';
        if (isset($_GET['anmelden'])) {
            echo '<script>linkToAnmeldung();</script>';
        }
        if (isset($_GET['insertMerken'])) {
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
    <section class="produkt">
        <?php
            $queryInserat = "SELECT * FROM Inserat JOIN Accounts ON Inserat.Inhaber_Nr = Accounts.account_ID";
            $resInserat = $db->query($queryInserat);
            $rowIns = $resInserat->fetch();
            echo '
                <div class="produktArea">
                    <div class="produktAreaLeft">
                        <img src="../image/auto_jaguar.jpg" alt="Bild konnte nicht geladen werden..." width="450" height="350">
                    </div>
                    <div class="produktAreaRight">
                        <h1>'.$rowIns['Marke'].' '.$rowIns['Modell'].'</h1>
                        <p>'.number_format($rowIns['Kilometerstand'] ,0, ',', '.') . ' km, ' . ceil($rowIns['PS'] / 1.35962) . ' kW (' . $rowIns['PS'] . ' PS), ' . $rowIns['Kraftstoffart'] . ', ' . $rowIns['Getriebeart'] . '</p>
                        <h7>'.number_format($rowIns['Preis'] ,0, ',', '.').' €</h7>
                        <p>'.number_format(($rowIns['Preis'] / 1.19) ,2, ',', '.') .'€ (Netto), 19,00% MwSt.</p>
                        <p>'.$rowIns['vorname'].' '.$rowIns['nachname'].'</p>
                        <p>'.$rowIns['plz'].' '.$rowIns['ort'].'</p>
                        <form action="?anmelden=1" method="post">
                            <input type="submit" value="      Angebot aufgeben" class="merkenButton" />
                        </form>
                        <form action="?anmelden=1" method="post">
                            <input type="submit" value="      Merken" class="merkenButton" />
                        </form>
                    </div>
                </div>
                <div class="produktShortView">
                    <div class="produktShortViewArea">
                        <div class="produktShortViewField">
                            <p>Kilometerstand</p>
                            <h6>'.number_format($rowIns['Kilometerstand'] ,0, ',', '.').' km</h6>
                        </div>
                        <div class="produktShortViewField">
                            <p>Getriebeart</p>
                            <h6>'.$rowIns['Getriebeart'].'</h6>
                        </div>
                    </div>
                    <div class="produktShortViewArea">
                        <div class="produktShortViewField">
                            <p>Erstzulassung</p>
                            <h6>'.$rowIns['Erstzulassung'].'</h6>
                        </div>
                        <div class="produktShortViewField">
                            <p>Fahrzeughalter</p>
                            <h6>'.$rowIns['vorname'].' '.$rowIns['nachname'].'</h6>
                        </div>
                    </div>
                    <div class="produktShortViewArea">
                        <div class="produktShortViewField">
                            <p>Leistung</p>
                            <h6>'. ceil($rowIns['PS'] / 1.35962).' kW (' . $rowIns['PS'] . ' PS)</h6>
                        </div>
                        <div class="produktShortViewField">
                            <p>Kraftstoffart</p>
                            <h6>'.$rowIns['Kraftstoffart'].'</h6>
                        </div>
                    </div>
                </div>
                <div class="produktBeschreibung">
                    <h7><b>Inseratbeschreibung</b></h7>
                    <p>'.$rowIns['Beschreibung'].'</p>
                </div>
                <div class="angebotAufgeben">
                    <div class="angebotUberschrift">
                        <h7><b>Dein Angebot an '.$rowIns['vorname'].' '.$rowIns['nachname'].'</b></h7>
                    </div>
                    <div class="angebotAufgebenBody">
                        <form action="/action_page.php">
                            <div class="angebotAufgebenLeft">
                                <textarea id="w3review" name="w3review" rows="20" cols="70">Guten Tag '.$rowIns['vorname'].',</textarea>
                                </br>
                            </div>
                            <div class="angebotAufgebenRight">
                                <h7><b>Dein Name:</b></h7>
                                <input type="text" name="input_user" class="login__input login__input__email" placeholder="Vorname und Nachname">
                                <h7><b>Deine E-Mail-Adresse:</b></h7>
                                <input type="text" name="input_email" class="login__input login__input__email" placeholder="E-Mail">
                                <p>Beim Absenden des Angebots binden<br> Sie sich an einen kostenpflichtigen Vertrag.</p>
                                <input type="submit" value="Absenden" class="absendenButton">
                            </div>
                        </form>
                    </div>
                </div>
            ';
            unset($db);
        ?>
    </section>
    <?php
        phpFunctions::printFooter();
    ?>
</body>

</html>