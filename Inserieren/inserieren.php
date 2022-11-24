<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserat aufgeben</title>
    <link rel="stylesheet" href="../allgemeines/stylesheet.css">
    <link rel="stylesheet" href="inserieren.css">
   
</head>

<body>
    <?php
        session_start();
        require '../allgemeines/db.php';
        require '../allgemeines/phpFunctions.php';

        if (empty($_SESSION['user'])) {
            header('Location: ../account/anmeldung.php');
        }


    if (isset($_POST['inserieren'])) {
        $error = false;
        $marke = htmlentities(trim($_POST['marke']));
        $modell = htmlentities(trim($_POST['modell']));
        $preis = htmlentities(trim($_POST['preis']));
        $beschreibung = htmlentities(trim($_POST['beschreibung']));
        $kilometerstand = htmlentities(trim($_POST['kilometerstand']));
        $ps = htmlentities(trim($_POST['ps']));
        $kraftstoffart = htmlentities(trim($_POST['kraftstoffart']));
        $getriebeart = htmlentities(trim($_POST['getriebeart']));
        $erstzulassung = htmlentities(trim($_POST['erstzulassung']));
        $auktionsbeginnDatum = htmlentities(trim($_POST['auktionsbeginnDatum']) . " " . trim($_POST['auktionsbeginnUhrzeit']));
        $auktionsendeDatum = htmlentities(trim($_POST['auktionsendeDatum']) . " " . trim($_POST['auktionsendeUhrzeit']));
       
        $filecount = count($_FILES['auktionbilder']['name']);

        $filename = $_FILES['auktionbilder']['name'];

        if(!empty($_SESSION['id'])) {
            $id = $_SESSION['id'];
        } else {
            $error = true;
            header('Location: ./account/anmeldung.php');
        }

        if (!$error) {
            $query = "INSERT INTO Inserat (Marke, Modell, Preis, Beschreibung, Kilometerstand, PS, Kraftstoffart, Getriebeart, Erstzulassung, Auktionsbeginn, Auktionsende, Inhaber_Nr) VALUES (:Marke, :modell, :preis, :beschreibung, :kilometerstand, :ps, :kraftstoffart, :getriebeart, :erstzulassung, :auktionsbeginnDatum, :auktionsendeDatum, :id)";
            $stmt = $db->prepare($query);
            $stmt-> bindParam('Marke',$marke, PDO::PARAM_STR);
            $stmt-> bindParam('modell',$modell, PDO::PARAM_STR);
            $stmt-> bindParam('preis',$preis, PDO::PARAM_INT);
            $stmt-> bindParam('beschreibung',$beschreibung, PDO::PARAM_STR);
            $stmt-> bindParam('kilometerstand',$kilometerstand, PDO::PARAM_INT);
            $stmt-> bindParam('ps',$ps, PDO::PARAM_INT);
            $stmt-> bindParam('kraftstoffart',$kraftstoffart, PDO::PARAM_STR);
            $stmt-> bindParam('getriebeart',$getriebeart, PDO::PARAM_STR);
            $stmt-> bindParam('erstzulassung',$erstzulassung, PDO::PARAM_INT);
            $stmt-> bindParam('auktionsbeginnDatum',$auktionsbeginnDatum, PDO::PARAM_STR);
            $stmt-> bindParam('auktionsendeDatum',$auktionsendeDatum, PDO::PARAM_STR);
            $stmt-> bindParam('id',$id, PDO::PARAM_INT);
            $stmt-> execute();
        }
        if (!$error) {
            $query = "SELECT MAX(Inserat_Nr) FROM Inserat WHERE 1";
            $stmt = $db->query($query);
            $inserat_nr = $stmt->fetch(); 
        }

        for($i=0; $i<$filecount; $i++){
            $filedata = file_get_contents($_FILES['auktionbilder']['tmp_name'][$i]);
            
            if (!$error) {
                $nr2 = 0;
                if ($i == 0 ){
                    $nr2 = 1;
                }

                $query = "INSERT INTO Inseratbilder (Inserat_Nr, Bild, Hauptbild) VALUES (:Nr ,:Bild ,:HBild )";
                $stmt = $db->prepare($query);
                $stmt-> bindParam('Nr', $inserat_nr[0], PDO::PARAM_INT);
                $stmt-> bindParam('Bild', $filedata, PDO::PARAM_STR);
                $stmt-> bindParam('HBild', $nr2, PDO::PARAM_INT);
                $stmt-> execute();
                }
        }     
        unset($db);
        header('Location: ./erfolgreichInseriert.php');
    }
    phpFunctions::printNavigationBar();
    ?>
    <div class="Überschrift">
        <h1 class="Überschrift-text">Jetzt Kostenlos Versteigern!</h1>
    </div>
    <section class="Foto-oben"></section>
    <section class="eingaben">
        <form method="post" enctype="multipart/form-data" id="inserieren">
            <div class="big-box">
                <div class="Marke-Modell">
                    <div class="Marke">
                        <p class="Marke-text">
                            Marke
                        </p>
                        <input class="Marke-eingabe" type="text" size="40" maxlength="250" name="marke" placeholder="z.B. Mercedes" required>
                    </div>
                    <div class="Modell">
                        <p class="Modell-text">
                            Modell
                        </p>
                        <input class="Modell-eingabe" type="text" size="40" maxlength="250" name="modell" placeholder="z.B. A-Klasse" required>
                    </div>
                </div>
                <div class="Preis-Beschreibung">
                    <div class="Preis">
                        <p class="Preis-text">
                            Preis
                        </p>
                        <input class="Preis-eingabe" type="number" size="40" min="1" maxlength="8" name="preis" placeholder="z.B. 10000" required>
                    </div>
                    <div class="Erstzulassung">
                        <p class="Erstzulassung-text">
                            Erstzulassung
                        </p>
                        <input class="Erstzulassung-eingabe" type="number" min="1901" max="3000" name="erstzulassung" placeholder="z.B. Jahr" required>
                    </div>
                </div>
                <div class="Kilometerstand-PS">
                    <div class="Kilometerstand">
                        <p class="Kilometerstand-text">
                            Kilometerstand
                        </p>
                        <input class="Kilometerstand-eingabe" type="number" size="40" maxlength="8" name="kilometerstand" placeholder="z.B. 150.000" required>
                    </div>
                    <div class="PS">
                        <p class="PS-text">
                            PS
                        </p>
                        <input class="PS-eingabe" type="number" size="40" maxlength="5" name="ps" placeholder="z.B. 200" required>
                    </div>
                </div>
                <div class="Kraftstoffart-Getriebeart">
                    <div class="Kraftstoffart">
                        <p class="Kraftstoffart-text">
                            Kraftstoffart
                        </p>
                        <input class= "Kraftstoffart-eingabe" type="text" size="40" maxlength="30" name="kraftstoffart" placeholder="z.B. Benzin" required>
                    </div>
                    <div class="Getriebeart">
                        <p class="Getriebeart-text">
                            Getriebeart
                        </p>
                        <input class="Getriebeart-eingabe" type="text" size="40" maxlength="30" name="getriebeart" placeholder="z.B. Automatikgetriebe" required>
                    </div>
                </div>
                <div class="Auktionsbeginn-Uhrzeit">
                    <div class="Auktionsbeginn">
                        <p class="Auktionsbeginn-text">
                            Auktionsbeginn
                        </p>
                        <input class="Auktionsbeginn-eingabe" type="date" size="40" maxlength="250" name="auktionsbeginnDatum" id="beginndatum" required>
                    </div>
                    <div class="Uhrzeit">
                        <p class="Uhrzeit-text">
                            Uhrzeit
                        </p>
                        <input class="Uhrzeit-eingabe" type="time" size="40" maxlength="250" name="auktionsbeginnUhrzeit" required>
                    </div>
                </div>
                <div class= "Auktionsende-Uhrzeit">
                    <div class="Auktionsende">
                        <p class="Auktionsende-text">
                            Auktionsende
                        </p>
                        <input class="Auktionsende-eingabe" min="auktionsbeginnDatum" type="date" size="40" maxlength="250" name="auktionsendeDatum" id="endedatum" required>
                    </div>
                    <div class="Uhrzeit">
                        <p class="Uhrzeit-text">
                            Uhrzeit
                        </p>
                        <input class="Uhrzeit-eingabe" type="time" size="40" maxlength="250" name="auktionsendeUhrzeit" required>
                    </div>
                </div>
                <div class="Erstzulassung-Bilder">
                    <div class= "Bilder">
                        <p class="Bilder-text">
                            Bilder
                        </p>
                        <input class="Bilder-eingabe" type="file" multiple accept="image/*" name="auktionbilder[]" required>
                    </div>
                </div>
                <div class="Erstzulassung-Bilder">
                    <div class="Beschreibung">
                            <p class="Beschreibung-text">
                                Beschreibung
                            </p>
                            <textarea class="Beschreibung-eingabe" type="text" name="beschreibung" required>Erzähle uns etwas über dein Auto</textarea>
                    </div>
                </div>
                <input class="Abschicken-button" type="submit" name="inserieren" value="Abschicken">
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
     <script language="javascript" type="text/javascript" src="inserieren.js"></script>
</body>

</html>