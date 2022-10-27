<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserat aufgeben</title>
    <link rel="stylesheet" href="../stylesheet.css">
    <link rel="stylesheet" href="inserieren.css">
    <script language="javascript" type="text/javascript" src="inserieren.js"></script>
</head>

<body>
    <?php
    session_start();
    require_once '../phpFunctions.php';

    if (empty($_SESSION['user'])) {
        echo '<script>linkToAnmeldung();</script>';
    }

    require_once '../db.php';

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

        /* if (strlen($marke) == 0 or strlen($modell) == 0 or strlen($preis) == 0 or strlen($beschreibung) == 0 or strlen($kilometerstand) == 0 or strlen($ps) == 0 or strlen($kraftstoffart) == 0 or strlen($getriebeart) == 0 or strlen($erstzulassung) == 0 or strlen($auktionsbeginnDatum) == 0 or strlen($auktionsendeDatum) == 0 or strlen($auktionsbeginnUhrzeit) == 0 or strlen($auktionsendeUhrzeit) == 0) {
            echo 'Das Feld darf nicht leer sein!';
            $error = true;
        } */

        if(!empty($_SESSION['id'])) {
            $id = $_SESSION['id'];
        } else {
            $error = true;
            echo '<script>linkToAnmeldung();</script>';
        }

        if (!$error) {
            $query = "INSERT INTO Inserat (Marke, Modell, Preis, Beschreibung, Kilometerstand, PS, Kraftstoffart, Getriebeart, Erstzulassung, Auktionsbeginn, Auktionsbeginn_Uhrzeit, Auktionsende, Auktionsende_Uhrzeit, Inhaber_Nr) VALUES ('$marke', '$modell', $preis, '$beschreibung', $kilometerstand, $ps, '$kraftstoffart', '$getriebeart', '$erstzulassung', '$auktionsbeginnDatum', '$auktionsbeginnUhrzeit', '$auktionsendeDatum', '$auktionsendeUhrzeit', '$id')";
            $db->query($query);
        }

        unset($db);
    }
    phpFunctions::printNavigationBar();
    ?>
    <section class="eingaben">
        <form action="?inserieren=1" method="post">
            Marke<br>
            <input type="text" size="40" maxlength="250" name="marke"><br>
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
    <?php
        phpFunctions::printFooter();
    ?>
</body>

</html>