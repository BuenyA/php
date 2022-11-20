<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autostar - Last Minute Angebote</title>
    <link rel="icon" type="image/png" href="image/AutostarLogoIconTab.png" wid>
    <link rel="stylesheet" href="../stylesheet.css">
    <link rel="stylesheet" href="lastminute.css">
    <script language="javascript" type="text/javascript" src="../index.js"></script>
</head>

<body>
    <?php
        session_start();
        require '../db.php';
        require '../phpFunctions.php';
        if (isset($_GET['anmelden'])) {
            header('Location: ../account/anmeldung.php');
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

        $anzeigen = 10;

        if (isset($_POST['btnMehrAnzeigen'])) {
            $anzeigen = $anzeigen + 10;
        }

        phpFunctions::printNavigationBar();
    ?>
    <section class="baldAblaufend">
        <h1>Last-Minute-Angebote...</h1>
        <?php
        $queryInserat = "SELECT * FROM Inserat JOIN Accounts ON Inserat.Inhaber_Nr = Accounts.account_ID WHERE Auktionsende >= CURRENT_TIMESTAMP AND Auktionsbeginn <= CURRENT_TIMESTAMP ORDER BY Auktionsende ASC";
        $resInserat = $db->query($queryInserat);
        
        if (empty($_SESSION['user'])) {
            phpFunctions::showOffer($anzeigen, $resInserat);
        } else {
            phpFunctions::showOffer($anzeigen, $resInserat, $_SESSION['id']);
        }
        unset($db);
        ?>
        <form method="post">
            <button class="btnMehrAnzeigen" name="btnMehrAnzeigen">
                Mehr Anzeigen
                <img src="image/down-arrow.png" width="20" height="20">
            </button>
        </form>
    </section>
    <?php
        phpFunctions::printFooter();
    ?>
</body>

</html>