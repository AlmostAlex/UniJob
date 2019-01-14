<?php
class bewerbung_model
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

    public function insertBewerbung($vorname, $nachname, $matrikelnummer, $email, $thema_id, $vorkenntnisse, $voraussetzungen, $fachsemester, $studiengang, $credits, $seminarteilnahme, $punkte)
    {
        if ($statement = $this->dbh->prepare("INSERT INTO `bewerbung` (`vorname`, `nachname`, `matrikelnummer`, `email`, `thema_id`, `status`, `voraussetzung`, `fachsemester`, `fachsemester_punkte`, `studiengang`, `studiengang_punkte`, `credits`, `credits_punkte`, `seminarteilnahme`, `seminarteilnahme_punkte`, `gesamt_punkte`)
        VALUES (?,?,?,?,?,'offen',?,?,?,?,?,?,?,?,?,?)")) {
            $statement->bind_param('ssisisidsiidsid', $vorname, $nachname, $matrikelnummer, $email, $thema_id, $voraussetzungen, $fachsemester, $punkte['fachsemester'], $studiengang, $punkte['studiengang'], $credits, $punkte['credits'], $seminarteilnahme, $punkte['seminarteilnahme'], $punkte['gesamt']);
            $statement->execute();
            $last_id = $this->lastBewerbungID();
            $vorkenntnisse_id = $this->vorkenntnisse->vorkenntnisseByThemaID($thema_id);
            $this->bewerb_vorkennt->insertBewerbVorkennt($last_id, $vorkenntnisse_id, $vorkenntnisse);
        } else {
            $error = $this->dbh->errno . ' ' . $this->dbh->error;
            echo "Fehlercode: " . $error . "<br/> Eintragung der Bewerbung ist fehlgeschlagen.";
        }
    }

    public function updateBewerbung($vorname, $nachname, $matrikelnummer, $email, $thema_id, $vorkenntnisse, $voraussetzungen, $fachsemester, $studiengang, $credits, $seminarteilnahme, $punkte)
    {
        $status = "offen";
        if ($statement = $this->dbh->prepare("UPDATE bewerbung, thema SET bewerbung.vorname = ?, bewerbung.nachname = ?, bewerbung.email = ?, bewerbung.thema_id = ?, bewerbung.status = ?, bewerbung.voraussetzung = ?, bewerbung.fachsemester = ?, bewerbung.fachsemester_punkte = ?, bewerbung.studiengang = ?, bewerbung.studiengang_punkte =?, bewerbung.credits = ?, bewerbung.credits_punkte = ?, bewerbung.seminarteilnahme = ?, bewerbung.seminarteilnahme_punkte = ?, bewerbung.gesamt_punkte = ? WHERE bewerbung.matrikelnummer = ? AND bewerbung.thema_id = thema.thema_id AND thema.modul_id = (SELECT modul_id FROM thema WHERE thema_id = ?)"))
        {
            $statement->bind_param('sssissidsiidsidii', $vorname, $nachname, $email, $thema_id, $status, $voraussetzungen, $fachsemester, $punkte['fachsemester'], $studiengang, $punkte['studiengang'], $credits, $punkte['credits'], $seminarteilnahme, $punkte['seminarteilnahme'], $punkte['gesamt'], $matrikelnummer, $thema_id);
            $statement->execute();
            $vorkenntnisse_id = $this->vorkenntnisse->vorkenntnisseByThemaID($thema_id);
            $bewerbung_id = $this->getIdByMatrikelnummer($matrikelnummer, $thema_id);
            $this->bewerb_vorkennt->deleteBewerbVorkennt($bewerbung_id);
            $this->bewerb_vorkennt->insertBewerbVorkennt($bewerbung_id, $vorkenntnisse_id, $vorkenntnisse);
        } else {
            $error = $this->dbh->errno . ' ' . $this->dbh->error;
            echo "Fehlercode: " . $error . "<br/> Update der Bewerbung ist fehlgeschlagen.";
        }
    }

    public function duplicateBewerbungCheck($matrikelnummer, $thema_id)
    {
        
        $statement = $this->dbh->prepare("SELECT bewerbung.matrikelnummer, bewerbung.thema_id FROM modul, thema, bewerbung
                                            WHERE bewerbung.matrikelnummer = ?
                                            AND bewerbung.thema_id = thema.thema_id
                                            AND thema.modul_id = modul.modul_id
                                            AND modul.semester = (SELECT modul.semester
                                                                FROM modul, thema
                                                                WHERE thema.modul_id = modul.modul_id
                                                                AND thema.thema_id = ?)
                                            AND modul.modul_id = (SELECT modul_id
                                                                FROM thema
                                                                WHERE thema_id = ?)");
        $statement->bind_param('iii', $matrikelnummer, $thema_id, $thema_id);
        $statement->execute();
        $statement->store_result();
        if($statement->num_rows > 0) {
            $duplicate = "duplikat";
            
        } else { $duplicate = "neu";  }
        return $duplicate;
    }

    public function lastBewerbungID()
    {
        $statement = $this->dbh->prepare("SELECT max(bewerbung_id) FROM bewerbung");
        $statement->execute();
        $statement->bind_result($last_id);
        $statement->fetch();
        return $last_id;
    }

    public function getIdByMatrikelnummer($matrikelnummer, $thema_id)
    {
        $statement = $this->dbh->prepare("SELECT bewerbung_id FROM bewerbung WHERE matrikelnummer = ? AND thema_id = ?");
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

    public function bewerbung_count_all($modul_id)
    {
         $statement = $this->dbh->prepare
         ("SELECT count(bewerbung_id) as anzahl_bewerber_check
         FROM bewerbung, modul, thema
         WHERE thema.thema_id = bewerbung.thema_id 
         AND thema.modul_id = modul.modul_id
         AND modul.modul_id= ?");
        $statement->bind_param('i', $modul_id);
        $statement->execute();
        $statement->bind_result($anzahl_bewerber_check);
        $statement->fetch();
        return $anzahl_bewerber_check;        
    }
    public function info_bewerbung_all($modul_id)
    {   
             $statement = $this->dbh->prepare
             ("SELECT modul.modulbezeichnung, modul.professur, modul.kategorie,
                        (SELECT count(bewerbung.bewerbung_id) 
                        FROM thema, bewerbung, modul
                        WHERE thema.thema_id = bewerbung.thema_id 
                        AND thema.modul_id = modul.modul_id
                        AND modul.modul_id = $modul_id)
                    as anzBew,
                    (SELECT count(bewerbung.bewerbung_id) 
                        FROM thema, bewerbung, modul
                        WHERE thema.thema_id = bewerbung.thema_id 
                        AND thema.modul_id = modul.modul_id
                        AND modul.modul_id = $modul_id
                        AND bewerbung.status = 'Angenommen')
                    as anzBewANG,
                    (SELECT count(bewerbung.bewerbung_id) 
                        FROM thema, bewerbung, modul
                        WHERE thema.thema_id = bewerbung.thema_id 
                        AND thema.modul_id = modul.modul_id
                        AND modul.modul_id = $modul_id
                        AND bewerbung.status = 'Abgelehnt')
                    as anzBewABG

                FROM thema,bewerbung,modul
                WHERE thema.thema_id = bewerbung.thema_id
                AND modul.modul_id = thema.modul_id
                AND modul.modul_id  =?");
            $statement->bind_param('i', $modul_id);
            $statement->execute();
            $statement->bind_result($modulbezeichnung,$professur,$kategorie,$anzBew,$anzBewANG,$anzBewABG);
            $statement->fetch();
    if($kategorie == 'Abschlussarbeit') {$modulbezeichnung = $professur;}
            $infos = array(
                'modulbezeichnung' => $modulbezeichnung,
                'kategorie' => $kategorie,
                'anzBew' => $anzBew,
                'anzBewANG' => $anzBewANG,
                'anzBewABG' => $anzBewABG
            );
    
        return $infos;
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

        public function getBewAng($thema_id){
            $statement = $this->dbh->prepare
            ("SELECT thema.themenbezeichnung, bewerbung.vorname, bewerbung.nachname, bewerbung.matrikelnummer, bewerbung.email,
            bewerbung.fachsemester, bewerbung.credits, bewerbung.studiengang, bewerbung.gesamt_punkte, bewerbung.seminarteilnahme
            FROM bewerbung, modul, thema
            WHERE modul.modul_id = thema.modul_id
            AND bewerbung.thema_id = thema.thema_id
            AND bewerbung.status = 'Angenommen'
            AND modul.modul_id =?");
           $statement->bind_param('i', $thema_id);
           $statement->execute();
           $statement->bind_result($themenbezeichnung, $vorname, $nachname, $matrikelnummer, $email, $fachsemester, $credits, $studiengang, $gesamt_punkte, $seminarteilnahme);
          
           $rows = array();
           while ($statement->fetch()) {
               $angBew = array(
                   'themenbezeichnung' => $themenbezeichnung,
                   'vorname' => $vorname,
                   'nachname' => $nachname,
                   'matrikelnummer' => $matrikelnummer,
                   'email' => $email,
                   'fachsemester' => $fachsemester,
                   'credits' => $credits, 
                   'studiengang' => $studiengang,
                   'gesamt_punkte' => $gesamt_punkte,
                   'seminarteilnahme' => $seminarteilnahme
               );
               $rows[] = $angBew;
           }
           return $rows;

        }

        public function getBewAbg($thema_id){
            $statement = $this->dbh->prepare
            ("SELECT bewerbung.vorname, bewerbung.nachname, bewerbung.matrikelnummer, bewerbung.email,
            bewerbung.fachsemester, bewerbung.credits, bewerbung.studiengang, bewerbung.gesamt_punkte, bewerbung.seminarteilnahme
            FROM bewerbung, modul, thema
            WHERE modul.modul_id = thema.modul_id
            AND bewerbung.thema_id = thema.thema_id
            AND bewerbung.status = 'Abgelehnt'
            AND modul.modul_id =?");
           $statement->bind_param('i', $thema_id);
           $statement->execute();
           $statement->bind_result($vorname, $nachname, $matrikelnummer, $email, $fachsemester, $credits, $studiengang, $gesamt_punkte, $seminarteilnahme);
          
           $rows = array();
           while ($statement->fetch()) {
               $abgBew = array(
                   'vorname' => $vorname,
                   'nachname' => $nachname,
                   'matrikelnummer' => $matrikelnummer,
                   'email' => $email,
                   'fachsemester' => $fachsemester,
                   'credits' => $credits, 
                   'studiengang' => $studiengang,
                   'gesamt_punkte' => $gesamt_punkte,
                   'seminarteilnahme' => $seminarteilnahme
               );
               $rows[] = $abgBew;
           }
           return $rows;

        }

        public function bewerber($thema_id){
            $statement = $this->dbh->prepare
            ("SELECT bewerbung.bewerbung_id, bewerbung.vorname, bewerbung.nachname, bewerbung.matrikelnummer, bewerbung.email, bewerbung.thema_id,
            bewerbung.fachsemester, bewerbung.credits, bewerbung.studiengang, bewerbung.gesamt_punkte,
            bewerbung.status, bewerbung.seminarteilnahme
            FROM bewerbung
            WHERE bewerbung.thema_id = ?");
           $statement->bind_param('i', $thema_id);
           $statement->execute();
           $statement->bind_result($bewerbung_id, $vorname, $nachname, $matrikelnummer, $email, $thema_iddb, $fachsemester, $credits, $studiengang, $gesamt_punkte, $status, $seminarteilnahme);
          
           $rows = array();
        while ($statement->fetch()) {
            $bewerbung = array(
                'id' => $bewerbung_id,
                'vorname' => $vorname,
                'nachname' => $nachname,
                'matrikelnummer' => $matrikelnummer,
                'email' => $email,
                'thema_id' => $thema_iddb,
                'fachsemester' => $fachsemester,
                'credits' => $credits, 
                'studiengang' => $studiengang,
                'gesamt_punkte' => $gesamt_punkte,
                'status' => $status,
                'seminarteilnahme' => $seminarteilnahme
            );
            $rows[] = $bewerbung;
        }
        return $rows;
    }

    public function countAnzWHBew($modul_id)
    {
         $statement = $this->dbh->prepare
         (" SELECT count(windhund.windhund_id) as anz
         FROM windhund, thema, modul 
         WHERE thema.thema_id = windhund.thema_id 
         AND modul.modul_id = thema.modul_id
         AND modul.modul_id=?");
        $statement->bind_param('i', $modul_id);
        $statement->execute();
        $statement->bind_result($anz);
        $statement->fetch();   
        return $anz;
    }

    public function getWHThBew($modul_id){      
        $statement = $this->dbh->prepare(
        "SELECT windhund.vorname, windhund.nachname, 
                windhund.matrikelnummer, windhund.email, windhund.status, thema.themenbezeichnung
        FROM windhund, thema, modul 
        WHERE thema.thema_id = windhund.thema_id 
        AND modul.modul_id = thema.modul_id
        AND modul.modul_id=?");
        $statement->bind_param('i', $modul_id);
        $statement->bind_result($vorname, $nachname, $matrikelnummer, $email, $status, $themenbezeichnung);
        $statement->execute();
       
        while ($statement->fetch()) {
            $rows[] = array(
                'vorname' => $vorname,
                'nachname' => $nachname,
                'matrikelnummer' => $matrikelnummer,
                'email' => $email,
                'status' => $status,
                'themenbezeichnung' => $themenbezeichnung

            );
        }
        return $rows;
    }










}