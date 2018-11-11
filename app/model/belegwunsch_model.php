<?php
class belegwunsch_model
{
    //Erstellen einer Variable $dbh und speichern des Datenabnkzugriffs auf dieser
    //damit alle Funktionen Zugriff auf diese über $this->dbh haben
    public $dbh;

    public function __construct()
    {
        require(__DIR__."/../../db.php");
        $this->dbh = $dbh;
        $this->thema = new thema_model();
        $this->vorkenntnisse = new vorkenntnisse_model();
        $this->bewerb_vorkennt = new bewerb_vorkennt_model();
        date_default_timezone_set("Europe/Berlin");
        $this->heute_dt = new DateTime(date("Y-m-d"));
    }

    public function insertBelegwunsch($vorname, $nachname, $matrikelnummer, $email, $voraussetzungen, $seminarteilnahme, $wunschthema1, $wunschthema2, $wunschthema3)
    {
        if ($statement = $this->dbh->prepare("INSERT INTO `belegwunsch` (`vorname`, `nachname`, `matrikelnummer`, `email`, `status`, `voraussetzung`, `seminarteilnahme`, `wunschthema1`, `wunschthema2`, `wunschthema3`)
        VALUES (?,?,?,?,'offen',?,?,?,?,?)")) {
            $statement->bind_param('ssisssiii', $vorname, $nachname, $matrikelnummer, $email, $voraussetzungen, $seminarteilnahme, $wunschthema1, $wunschthema2, $wunschthema3);
            $statement->execute();
        } else {
            $error = $this->dbh->errno . ' ' . $this->dbh->error;
            echo "Fehlercode: " . $error . "<br/> Eintragung der Bewerbung ist fehlgeschlagen.";
        }
    }

    public function beleg_count($modul_id)
    {
         $statement = $this->dbh->prepare
         ("SELECT COUNT(belegwunsch_id)
         FROM belegwunsch, thema, modul
         WHERE belegwunsch.wunschthema1 = thema.thema_id AND thema.modul_id = modul.modul_id AND modul.modul_id = ?");
        $statement->bind_param('i', $modul_id);
        $statement->execute();
        $statement->bind_result($anzahl_bewerber_check);
        $statement->fetch();
        return $anzahl_bewerber_check;        
    }

    public function info_belegwunsch($modul_id)
    {
         $statement = $this->dbh->prepare
         ("SELECT modul.modulbezeichnung, modul.professur, modul.kategorie
         FROM belegwunsch, thema, modul
         WHERE belegwunsch.wunschthema1 = thema.thema_id AND thema.modul_id = modul.modul_id AND modul.modul_id = ?");
        $statement->bind_param('i', $modul_id);
        $statement->execute();
        $statement->bind_result($modulbezeichnung, $professur, $professur);
        $statement->fetch();
        $statement->store_result();

        $statement1 = $this->dbh->prepare
        ("SELECT count(thema.thema_id) as anzThema
        FROM thema, modul 
        WHERE thema.modul_id = modul.modul_id  
        AND modul.modul_id = ?
        "); 
       $statement1->bind_param('i', $modul_id);
       $statement1->execute();
       $statement1->bind_result($anzThema);
       $statement1->fetch();
       $statement1->store_result();


        $infos = array(
            'modulbezeichnung' => $modulbezeichnung,
            'professur' => $professur,
            'kategorie' => $professur,
            'anzThema' => $anzThema
        );

    return $infos;
    } 


/*  WEIL ES HIER MEHR ALS NUR EIN THEMA GIBT, AUF DASS MAN SICH BEWIRBT FRAG ICH MICH,
    WIE SINNVOLL ES IST DAS ZU MACHEN?!

    public function getIdByMatrikelnummer($matrikelnummer, $thema_id)
    {
        $statement = $this->dbh->prepare("SELECT belegwunsch_id FROM belegwunsch WHERE matrikelnummer = ? AND thema_id = ?");
        $statement->bind_param('ii', $matrikelnummer, $thema_id);
        $statement->execute();
        $statement->bind_result($bewerbung_id);
        $statement->fetch();
        return $bewerbung_id;
    }

    public function bewerbung_count($thema_id)
    {
         $statement = $this->dbh->prepare
         ("SELECT count(bewerbung_id) as anzahl_bewerber_check
         FROM bewerbung, thema, modul 
         WHERE thema.thema_id = bewerbung.thema_id 
         AND thema.thema_id= ?");
        $statement->bind_param('i', $thema_id);
        $statement->execute();
        $statement->bind_result($anzahl_bewerber_check);
        $statement->fetch();
        return $anzahl_bewerber_check;        
    }


    public function info_bewerbung($thema_id)
    {   
             $statement = $this->dbh->prepare
             ("SELECT thema.themenbezeichnung,
                        (SELECT count(bewerbung.bewerbung_id) 
                        FROM thema, bewerbung 
                        WHERE thema.thema_id = bewerbung.thema_id 
                        AND thema.thema_id = $thema_id)
                    as anzBew
                FROM thema,bewerbung
                WHERE thema.thema_id = bewerbung.thema_id
                AND thema.thema_id =?");
            $statement->bind_param('i', $thema_id);
            $statement->execute();
            $statement->bind_result($themenbezeichnung,$anzBew);
            $statement->fetch();
    
            $infos = array(
                'themenbezeichnung' => $themenbezeichnung,
                'anzBew' => $anzBew
            );
    
        return $infos;
        } 

        public function bewerber($thema_id){
            $statement = $this->dbh->prepare
            ("SELECT bewerbung.vorname, bewerbung.nachname, bewerbung.matrikelnummer, bewerbung.email,
            bewerbung.fachsemester, bewerbung.credits, bewerbung.studiengang, bewerbung.gesamt_punkte
            FROM bewerbung
            WHERE bewerbung.thema_id = ?");
           $statement->bind_param('i', $thema_id);
           $statement->execute();
           $statement->bind_result($vorname, $nachname, $matrikelnummer, $email, $fachsemester, $credits, $studiengang, $gesamt_punkte);
        
        while ($statement->fetch()) {
            $bewerbung[] = array(
                'vorname' => $vorname,
                'nachname' => $nachname,
                'matrikelnummer' => $matrikelnummer,
                'email' => $email,
                'fachsemester' => $fachsemester,
                'credits' => $credits, 
                'studiengang' => $studiengang,
                'gesamt_punkte' => $gesamt_punkte
            );
        }
        return $bewerbung;
    }
    */
}