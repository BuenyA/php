Dieses Projekt stellt eine automobilspezifische Auktionsseite dar, welche im Rahmen der "php-Vorlesung" programmiert wurde.
Dabei wurden folgende Richtlinien beachtet: https://elearning.dhbw-stuttgart.de/moodle/pluginfile.php/177147/mod_resource/content/1/Auktion.pdf


# Instalisierung:

1. Möglichkeit


Es gibt ein übergeordnetes Styleheet und JS-Script, welche von den untergeordneten Seiten implementiert werden.
Zudem gibt es eine übergeordnete PHP-Klasse (phpFunctions), die alle übergreifende Funktionen beinhaltet.
    Stylesheet:  »stylesheet.css«
    JS-Script:   »index.js«
    PHP-Klasse:  »phpFunctions.php«


Kurzbeschreibung der Kategorien:

# Index
Die Hauptseite (auch Homeseite) wird durch die index.php abgebildet.
Dabei wird das Stylesheet »indexSheet.css« miteingebunden.
Die index.php ist mit der »Anmeldung.php« die einzige Seite, die das übergeordnete Stylesheet (stylesheet.css) nicht einbindet.


# Account
Im Verzeichnis "Account" befinden sich alle Seite, die sich um die Thematik Konto drehen.
Dazu gehören die Anmelden-, Registrieren-, AccountVerwaltung- und PasswortVergessen-seite.
Diese implementieren sowohl das übergeordnete Stylesheet und JS-Script als auch deren einiges Stylesheet.


# Angebote
Die Kategorie Angebote mit den Seiten TopAngebote und LastMinute ähneln sich stark in ihrer Struktur.
Dabei werden lediglich andere SQL-Statements verwendet, die die Angebote anders selektieren.

Zudem befindet sich in dieser Struktur die Produkt-Seite, die eine detaillierte Anzeige der Auktion ausgibt.
Diese Seite ermöglicht das Abgeben eines Gebotes zu der Auktion:
Ist man angemeldet -> So wird die E-Mail direkt aus der Datenbank gezogen.
Ist man nicht angemeldet -> So wird die E-Mail manuell vom Nutzer angegeben.


# Inserieren
Die Kategorie Inserieren bietet die Möglichkeit eine Auktion aufzugeben.
Dabei ist die Inserierung mit einem Login-Mechanismus geschützt und kann nur von angemeldeten Kunden verwendet werden.


# Suchen
Die Suchen Kategorie wurde nach den Seiten Top-Angebote und Last-Minute entwickelt.
Der bedeutende Unterschied ist jedoch die dynamische SQL-Abfrage.
Diese wird entsprechend den gesetzten Filter generiert.



Überall muss ein trim ran

php.ini post_max_size=64M
php.ini upload_max_filesize=64M

docker-compose.yml UPLOAD_LIMIT = 64M