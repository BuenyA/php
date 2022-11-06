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
    <div class="Überschrift">
        <h1 class="Überschrift-text">Jetzt Kostenlos Versteigern!</h1>
    </div>
    <section class="Foto-oben"></section>
    <section class="eingaben">
        <form action="?inserieren=1" method="post">
            <div class="big-box">
                <div class="Marke-Modell">
                    <div class="Marke">
                        <p class="Marke-text">
                            Marke
                        </p>
                        <input class="Marke-eingabe" type="text" size="40" maxlength="250" name="marke" placeholder="    z.B. Mercedes" required>
                    </div>
                    <div class="Modell">
                        <p class="Modell-text">
                            Modell
                        </p>
                        <input class="Modell-eingabe" type="text" size="40" maxlength="250" name="modell" placeholder="    z.B. A-Klasse" required>
                    </div>
                </div>
                <div class="Preis-Beschreibung">
                    <div class="Preis">
                        <p class="Preis-text">
                            Preis
                        </p>
                        <input class="Preis-eingabe" type="number" size="40" maxlength="250" name="preis" placeholder="    z.B. 10000" required>
                    </div>
                    <div class="Beschreibung">
                        <p class="Beschreibung-text">
                            Beschreibung
                        </p>
                        <input class= "Beschreibung-eingabe" type="text" size="40" maxlength="250" name="beschreibung" placeholder="    Erzähle uns etwas über dein Auto" required>
                    </div>
                </div>
                <div class="Kilometerstand-PS">
                    <div class="Kilometerstand">
                        <p class="Kilometerstand-text">
                            Kilometerstand
                        </p>
                        <input class= "Kilometerstand-eingabe" type="number" size="40" maxlength="250" name="kilometerstand" placeholder="    z.B. 150000" required>
                    </div>
                    <div class="PS">
                        <p class="PS-text">
                            PS
                        </p>
                        <input class="PS-eingabe" type="number" size="40" maxlength="250" name="ps" placeholder="    z.B. 200" required>
                    </div>
                </div>
                <div class="Kraftstoffart-Getriebeart">
                    <div class="Kraftstoffart">
                        <p class="Kraftstoffart-text">
                            Kraftstoffart
                        </p>
                        <input class= "Kraftstoffart-eingabe" type="text" size="40" maxlength="250" name="kraftstoffart" placeholder="    z.B. Benzin" required>
                    </div>
                    <div class="Getriebeart">
                        <p class="Getriebeart-text">
                            Getriebeart
                        </p>
                        <input class="Getriebeart-eingabe" type="text" size="40" maxlength="250" name="getriebeart" placeholder="    z.B. Automatikgetriebe"required>
                    </div>
                </div>
                <div class="Erstzulassung-Auktionsbeginn">
                    <div class="Erstzulassung">
                        <p class="Erstzulassung-text">
                            Erstzulassung
                        </p>
                        <input class="Erstzulassung-eingabe" type="date" size="40" maxlength="250" name="erstzulassung" required>
                    </div>
                    <div class="Auktionsbeginn">
                        <p class="Auktionsbeginn-text">
                            Auktionsbeginn
                        </p>
                        <input class="Auktionsbeginn-eingabe" type="date" size="40" maxlength="250" name="auktionsbeginnDatum" required>
                    </div>
                </div>
                <div class= "Uhrzeit-Auktionsende">
                    <div class="Uhrzeit">
                        <p class="Uhrzeit-text">
                            Uhrzeit
                        </p>
                        <input class="Uhrzeit-eingabe" type="time" size="40" maxlength="250" name="auktionsbeginnUhrzeit" required>
                    </div>
                    <div class="Auktionsende">
                        <p class="Auktionsende-text">
                            Auktionsende
                        </p>
                        <input class="Auktionsende-eingabe" type="date" size="40" maxlength="250" name="auktionsendeDatum" required>
                    </div>
                </div>
                <div class= "Uhrzeit-Auktionsende">
                    <div class="Uhrzeit">
                        <p class="Uhrzeit-text">
                            Bilder
                        </p>
                        <input class="Uhrzeit-eingabe" type="file" multiple="multiple" accept="image/*" name="auktionsbeginnUhrzeit" required>
                    </div>
                </div>
                <input class="Abschicken-button" type="submit" value="Abschicken">
            </div>
        </form>
    </section>
    <section class="Text-boxes">
        <div class="Text-left textBox">
            <h1 class="Text-left-überschrift">
                Sicher
            </h1>
            <p class="Text-left-text">
                Die Sicherheit unserer Kunden liegt in erster Linie, somit prüfen wir jedes Inserat sorgfältig.
            </p>
        </div>
        <div class="Text-middle textBox">
            <h1 class="Text-middle-überschrift">
                Benuzerfreundlich
            </h1>
            <p class="Text-middle-text">
                Einfach Bilder hochladen, Daten eintragen und los geht's.
            </p>
        </div>
        <div class="Text-right textBox">
            <h1 class="Text-right-überschrift">
                Kostenlos
            </h1>
            <p class="Text-right-text">
                Inseriere beliebig viele Inserate und zahle keinen Cent!
            </p>
        </div>
    </section>
    <?php
        phpFunctions::printFooter();
    ?>
</body>

</html>