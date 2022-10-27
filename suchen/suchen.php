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
    <script language="javascript" type="text/javascript" src="index.js"></script>
</head>

<body>
    <?php
        session_start();
        require_once '../db.php';
        require_once '../phpFunctions.php';
        if (isset($_GET['anmelden'])) {
            echo '<script>linkToAnmeldung()";</script>';
        }
        phpFunctions::printNavigationBar();
    ?>
    <section class="suchergebnisse">
        <h1>Deine Suchergebnisse...</h1>
        <?php
        $queryInserat = "SELECT * FROM Inserat JOIN Accounts ON Inserat.Inhaber_Nr = Accounts.account_ID ORDER BY Erstzulassung ASC";
        $resInserat = $db->query($queryInserat);

        if (empty($_SESSION['user'])) {
            phpFunctions::showOffer(10, $resInserat);
        } else {
            phpFunctions::showOffer(10, $resInserat, $_SESSION['id']);
        }
        unset($db);
        ?>
        <button class="btnMehrAnzeigen">
            Mehr Anzeigen
            <img src="image/down-arrow.png" width="20" height="20">
        </button>
    </section>
    <?php
        phpFunctions::printFooter();
    ?>
</body>

</html>