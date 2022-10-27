Dieses Projekt stellt eine automobilspezifische Auktionsseite dar, welche im Rahmen der "php-Vorlesung" programmiert wurde.
Dabei wurden folgende Richtlinien beachtet: https://elearning.dhbw-stuttgart.de/moodle/pluginfile.php/177147/mod_resource/content/1/Auktion.pdf

Es gibt ein übergeordnetes Styleheet und JS-Script, welche von den untergeordneten Seiten implementiert werden.
Zudem gibt es eine übergeordnete PHP-Klasse (phpFunctions), die alle übergreifende Funktionen beinhaltet.
    Stylesheet:  "stylesheet.css"
    JS-Script:   "index.js"
    PHP-Klasse:  "phpFunctions.php"


Die Hauptseite (auch Homeseite) wird durch die index.php abgebildet.
Dabei wird das Stylesheet "indexSheet.css" miteingebunden.
Dies ist die einzige Seite, die das übergeordnete Stylesheet (stylesheet.css) nicht miteinbindet.
