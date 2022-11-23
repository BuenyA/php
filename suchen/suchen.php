<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autostar - Last Minute Angebote</title>
    <link rel="icon" type="image/png" href="image/AutostarLogoIconTab.png" wid>
    <link rel="stylesheet" href="../stylesheet.css">
    <link rel="stylesheet" href="suchen.css">
    <script language="javascript" type="text/javascript" src="../index.js"></script>
</head>

<body>
    <?php
        session_start();
        require '../db.php';
        require '../phpFunctions.php';
        if (isset($_GET['anmelden'])) {
            echo '<script>linkToAnmeldung()";</script>';
        }
        if (isset($_POST['insertMerken'])) {
            $InseratNrPost = trim($_POST['InseratNr']);
            $AccIDPost = trim($_POST['AccID']);
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

        if (isset($_POST['mehrAnzeigenValue'])) {
            $anzeigen = (int)$_POST['mehrAnzeigenValue'] + 10;
        } else {
            $anzeigen = 10;
        }

        echo '<section class="baldAblaufend">
                <h1>Top-Angebote</h1>
            ';

            $WHERE = '';

            //Dynmische Markenselektion
            if(isset($_GET['Marke']) && $_GET['Marke'] !== '') {
                $WHERE = "AND Marke = '" . $_GET['Marke'] . "' ";
            }

             //Dynmische Modellselektion
            if(isset($_GET['Modell']) && $_GET['Modell'] !== '') {
                $WHERE .= "AND Modell = '" . $_GET['Modell'] . "' ";
            }

            //Dynmische Kilometerselektion
            if (isset($_GET['KM']) && $_GET['KM'] !== '') {
                $WHERE .= "AND Kilometerstand <= '" . $_GET['KM'] . "' ";
            }

            //Dynmische Erstzulassungselektion
            if (isset($_GET['Erstzulassung']) && $_GET['Erstzulassung'] !== '') {
                $WHERE .= "AND Erstzulassung >= '" . $_GET['Erstzulassung'] . "' ";
            }

            //Dynmische preisBisselektion
            if (isset($_GET['preisBis']) && $_GET['preisBis'] !== '') {
                $WHERE .= "AND Preis <= '" . $_GET['preisBis'] . "' ";
            } 

            $queryInserat = "SELECT * FROM Inserat JOIN Accounts ON Inserat.Inhaber_Nr = Accounts.account_ID WHERE Auktionsende >= CURRENT_TIMESTAMP AND Auktionsbeginn <= CURRENT_TIMESTAMP " . $WHERE . " ORDER BY Auktionsende ASC";
            $resInserat = $db->query($queryInserat);

            if (empty($_SESSION['user'])) {
                phpFunctions::showOffer($anzeigen, $resInserat);
            } else {
                phpFunctions::showOffer($anzeigen, $resInserat, $_SESSION['id']);
            }
            
            echo '<form method="post">
                        <input class="hidden" type="number" name="mehrAnzeigenValue" value="'.$anzeigen.'"/>
                        <button class="btnMehrAnzeigen" name="btnMehrAnzeigen">
                            Mehr Anzeigen
                            <img src="../image/down-arrow.png" width="20" height="20">
                        </button>
                    </form>
                </section>
                ';

        phpFunctions::printFooter();
        unset($db);
    ?>
</body>

</html>