<?php

    class function_registrierung {
        public $vorname;
        public $nachname;
        public $plz;
        public $ort;
        public $adresse;
        public $telefonnummer;
        public $geburtstag;
        public $email;
        public $passwort;

        public function __construct($vorname, $nachname, $plz, $ort, $adresse, $telefonnummer, $geburtstag, $email, $passwort) {
            $this->vorname=$vorname;
            $this->nachname=$nachname;
            $this->plz=$plz;
            $this->ort=$ort;
            $this->adresse=$adresse;
            $this->telefonnummer=$telefonnummer;
            $this->geburtstag=$geburtstag;
            $this->email=$email;
            $this->passwort=$passwort;
        }

        //Überprüft ob die Benutzereingabe korrekt war
        public function input__test() {
            
            $error = false;

            //Überprüft ob ein Vorname eingegeben wurde
            if(strlen($this->vorname) == 0) {
                $error = false;
            }

            //Überprüft ob ein Nachname eingegeben wurde
            if(strlen($this->nachname) == 0) {
                $error = false;
            }
            
            //Überprüft ob eine Plz eingegeben wurde
            if($this->plz == null) {
                $error = false;
            }

            //Überprüft ob ein Ort eingegeben wurde
            if(strlen($this->ort == 0)) {
                $error = false;
            }    

            //Überprüft ob eine Adresse eingegeben wurde
            if(strlen($this->adresse) == 0) {
                $error = false;
            }

            //Überprüft ob eine Telefonnummer eingegeben wurde
            if(strlen($this->telefonnummer) == 0) {
                $error = false;
            }

            //Überprüft ob ein Geburtsdatum eingegeben wurde
            if(strlen($this->geburtstag) == 0) {
                $error = false;
            }

            //Überprüft ob eine korrekte Email eingegeben wurde
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $error = false;
            }

            //Überprüft ob ein Passwort eingegeben wurde
            if($this->passwort == null) {
                $error = false;
            }

            //Meldet zurück on die Benutzereingabe Fehlerfrei war
            //true = Fehler gefunden
            //false = kein Fehler gefunden
            return $error;

        }

/*
        //Sucht die Fehlermeldung
        public function fehler__message() {
            $fehler__message = "";

            //Überprüft ob ein Vorname eingegeben wurde
            if(strlen($this->vorname)) {
                $fehler__message = 'Bitte einen Vornamen eingeben';
            }

            //Überprüft ob ein Nachname eingegeben wurde
            if(strlen($this->nachname)) {
                $fehler__message = 'Bitte einen Nachnamen eingeben';
            }
            
            //Überprüft ob eine Plz eingegeben wurde
            if($this->plz == null) {
                $fehler__message = 'Bitte eine Postleitzahl eingeben';
            }

            //Überprüft ob ein Ort eingegeben wurde
            if(strlen($this->ort)) {
                $fehler__message = 'Bitte einen Ort eingeben';
            }    

            //Überprüft ob eine Adresse eingegeben wurde
            if(strlen($this->adresse)) {
                $fehler__message = 'Bitte eine Adresse eingeben';
            }

            //Überprüft ob eine Telefonnummer eingegeben wurde
            if(strlen($this->telefonnummer)) {
                $fehler__message = 'Bitte eine telefonnummer eingeben';
            }

            //Überprüft ob ein Geburtsdatum eingegeben wurde
            if(strlen($this->geburtstag)) {
                $fehler__message = 'Bitte ein Geburtsdatum eingeben';
            }

            //Überprüft ob eine korrekte Email eingegeben wurde
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $fehler__message ='Bitte eine gültige E-Mail-Adresse eingeben<br>';
            }

            //Überprüft ob ein Passwort eingegeben wurde
            if($this->passwort == null) {
                $fehler__message ='Bitte ein Passwort eingeben';
            }

            //Gibt die Fehlermeldung zurück
            return $fehler__message;
        }
*/

    }


?>