Diese Projekt stellt eine automobilspezifische Auktionsseite dar, welche im Rahmen der "php-Vorlesung" programmiert wird.
Dabei wurden folgenden Richtlinien beachtet: https://elearning.dhbw-stuttgart.de/moodle/pluginfile.php/177147/mod_resource/content/1/Auktion.pdf

Es gibt ein übergeordnetes Styleheet und ein übergeordnetes JS-Script, welche von den untergeordneten Seiten implementiert werden.
Zudem gibt es eine übergeordnete PHP-Klasse (phpFunctions), die alle verallgemeinerten Funktionen umfasst.
    Stylesheet:  "stylesheet.css"
    JS-Script:   "index.js"
    PHP-Klasse:  "phpFunctions.php"


Die Hauptseite (auch Homeseite) wird durch die index.php abgebildet.
Dabei wird das Stylesheet indexSheet.css miteingebunden.
Dies ist die einzige Seite, die das übergeordnete stylesheet (stylesheet.css) nicht miteinbindet. 
