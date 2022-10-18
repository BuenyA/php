<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserat aufgeben</title>
    <link rel="stylesheet" href="inserieren.css">
    <!-- <script language="javascript" type="module" src="inserieren.js"></script> -->
</head>

<body>
    <?php
    require_once '../db.php';

    $showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll

    if (isset($_GET['inserieren'])) {
        $error = false;
        $marke = $_POST['marke'];
        $modell = $_POST['modell'];
        $preis = $_POST['preis'];
        $beschreibung = $_POST['beschreibung'];
        $kilometerstand = $_POST['kilometerstand'];
        $ps = $_POST['ps'];
        $kraftstoffart = $_POST['kraftstoffart'];
        $getriebeart = $_POST['getriebeart'];
        $erstzulassung = $_POST['erstzulassung'];
        $auktionsbeginnDatum = $_POST['auktionsbeginnDatum'];
        $auktionsendeDatum = $_POST['auktionsendeDatum'];
        $auktionsbeginnUhrzeit = $_POST['auktionsbeginnUhrzeit'];
        $auktionsendeUhrzeit = $_POST['auktionsendeUhrzeit'];

        /* if (strlen($marke) == 0) {
            echo 'Das Feld darf nicht leer sein!';
            $error = true;
        } */

        if (!$error) {
            $query = "INSERT INTO Inserat (Marke, Modell, Preis, Beschreibung, Kilometerstand, PS, Kraftstoffart, Getriebeart, Erstzulassung, Auktionsbeginn, Auktionsbeginn_Uhrzeit, Auktionsende, Auktionsende_Uhrzeit, Inhaber_Nr) VALUES ('$marke', '$modell', $preis, '$beschreibung', $kilometerstand, $ps, '$kraftstoffart', '$getriebeart', '$erstzulassung', '$auktionsbeginnDatum', '$auktionsbeginnUhrzeit', '$auktionsendeDatum', '$auktionsendeUhrzeit', 1)";
            $db->query($query);
        }

        unset($db);
    }
    ?>
    <div class="navigationMenu">
        <div class="navigationMenuLogo">
            <img src="image/AutostarLogo.png" width="200" height="40" onclick="window.location.href = '../index.php'">
        </div>
        <ul class="navigationElements">
            <li><a href="../index.php">Home</a></li>
            <li><a href="../TopAngebote/topangebote.php">Top Angebote</a></li>
            <li><a href="../LastMinute/lastminute.php">Last-Minute</a></li>
            <li><a href="../Inserieren/inserieren.php">Verkaufen</a></li>
        </ul>
        <div class="navigationMenuButton">
            <div class="navigationMenuButtonAnmelden">
                <button onclick="window.location.href = '../account/anmeldung.php'"><b>Anmelden</b></button>
            </div>
            <div class="navigationMenuButtonRegistrieren">
                <button onclick="window.location.href = '../account/registrierung/registrierung.php'"><b>Registrieren</b></button>
            </div>
        </div>
    </div>
    <section class="eingaben">
        <form action="?inserieren=1" method="post">
            Marke<br>
            <input type="text" size="40" maxlength="250" name="modell"><br>
            Preis1 <br>
            <input type="number" size="10" name="preis1" value="100000" id="preisanzeige" class="preisanzeige" max="200000" min="0" step="100"> <br>
            <input type="range" min="0" max="200000" step="100" id="regler"> <br>
            Modell<br>
            <input type="text" size="40" maxlength="250" name="modell"><br>
            Preis<br>
            <input type="number" size="40" maxlength="250" name="preis"><br>
            Beschreibung<br>
            <input type="text" size="40" maxlength="250" name="beschreibung"><br>
            Kilometerstand<br>
            <input type="number" size="40" maxlength="250" name="kilometerstand"><br>
            PS<br>
            <input type="number" size="40" maxlength="250" name="ps"><br>
            Kraftstoffart<br>
            <input type="text" size="40" maxlength="250" name="kraftstoffart"><br>
            Getriebeart<br>
            <input type="text" size="40" maxlength="250" name="getriebeart"><br>
            Erstzulassung<br>
            <input type="date" size="40" maxlength="250" name="erstzulassung"><br>
            Auktionsbeginn<br>
            <input type="date" size="40" maxlength="250" name="auktionsbeginnDatum"><br>
            Uhrzeit<br>
            <input type="time" size="40" maxlength="250" name="auktionsbeginnUhrzeit"><br>
            Auktionsende<br>
            <input type="date" size="40" maxlength="250" name="auktionsendeDatum"><br>
            Uhrzeit<br>
            <input type="time" size="40" maxlength="250" name="auktionsendeUhrzeit"><br>
            
            <input type="submit" value="Abschicken">
        </form>
    </section>
    <script src="./inserieren.js"> 

    </script> 
</body>

</html>