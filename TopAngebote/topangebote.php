<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autostar - Last Minute Angebote</title>
    <link rel="icon" type="image/png" href="image/AutostarLogoIconTab.png" wid>
    <link rel="stylesheet" href="../stylesheet.css">
    <link rel="stylesheet" href="topangebote.css">
    <script language="javascript" type="text/javascript" src="../index.js"></script>
</head>

<body>
    <?php
        session_start();
        require_once '../db.php';
        require_once '../phpFunctions.php';
        phpFunctions::printNavigationBar();
    ?>
    <section class="topAngebote">
        <h1>Top-Angebote</h1>
        <?php
        $queryInserat = "SELECT * FROM Inserat JOIN Accounts ON Inserat.Inhaber_Nr = Accounts.account_ID ORDER BY Erstzulassung ASC";
        $resInserat = $db->query($queryInserat);
        
        phpFunctions::showOffer(6, $resInserat);
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