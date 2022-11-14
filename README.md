Dieses Projekt stellt eine automobilspezifische Auktionsseite dar, welche im Rahmen der "php-Vorlesung" programmiert wurde.
Dabei wurden folgende Richtlinien beachtet: https://elearning.dhbw-stuttgart.de/moodle/pluginfile.php/177147/mod_resource/content/1/Auktion.pdf

Es gibt ein übergeordnetes Styleheet und JS-Script, welche von den untergeordneten Seiten implementiert werden.
Zudem gibt es eine übergeordnete PHP-Klasse (phpFunctions), die alle übergreifende Funktionen beinhaltet.
    Stylesheet:  »stylesheet.css«
    JS-Script:   »index.js«
    PHP-Klasse:  »phpFunctions.php«


Kurzbeschreibung der Webseiten:

Die Hauptseite (auch Homeseite) wird durch die index.php abgebildet.
Dabei wird das Stylesheet »indexSheet.css« miteingebunden.
Die index.php ist mit der »Anmeldung.php« die einzige Seite, die das übergeordnete Stylesheet (stylesheet.css) nicht einbindet.

Im Verzeichnis "Account" befinden sich alle Seite, die sich um die Thematik Konto drehen.
Dazu gehören die Anmelden-, Registrieren-, AccountVerwaltung- und PasswortVergessen-seite.
Diese implementieren sowohl das übergeordnete Stylesheet und JS-Script als auch deren einiges Stylesheet.

Die Seiten TopAngebote und LastMinute ähneln sich stark in ihrer Struktur.
Dabei werden lediglich andere SQL-Statements verwendet, die die Angebote anders selektieren.



Überall muss ein trim ran

php.ini muss konfiguriert werden