<?php
ini_set('max_execution_time', 10);
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

    public function insertBelegwunsch($vorname, $nachname, $matrikelnummer, $email, $studiengang, $voraussetzungen, $seminarteilnahme, $wunschthema1, $wunschthema2, $wunschthema3, $punkte)
    {
        if ($statement = $this->dbh->prepare("INSERT INTO `belegwunsch` (`vorname`, `nachname`, `matrikelnummer`, `email`, `studiengang`, `status`, `voraussetzung`, `seminarteilnahme`, `wunschthema1`, `wunschthema2`, `wunschthema3`, `punkte`)
        VALUES (?,?,?,?,?,'offen',?,?,?,?,?,?)")) {
            $statement->bind_param('ssissssiiid', $vorname, $nachname, $matrikelnummer, $email, $studiengang, $voraussetzungen, $seminarteilnahme, $wunschthema1, $wunschthema2, $wunschthema3, $punkte['gesamt']);
            $statement->execute();
        } else {
            $error = $this->dbh->errno . ' ' . $this->dbh->error;
            
        }
    }

    public function updateBelegwunsch($vorname, $nachname, $matrikelnummer, $email, $studiengang, $voraussetzungen, $seminarteilnahme, $wunschthema1, $wunschthema2, $wunschthema3, $punkte)
    {
        $status = "offen";
        if ($statement = $this->dbh->prepare("UPDATE belegwunsch, thema SET belegwunsch.vorname = ?, belegwunsch.nachname = ?, belegwunsch.email = ?, belegwunsch.studiengang = ?, belegwunsch.status = ?, belegwunsch.voraussetzung = ?, belegwunsch.seminarteilnahme = ?, belegwunsch.wunschthema1 = ?, belegwunsch.wunschthema2 = ?, belegwunsch.wunschthema3 = ?, belegwunsch.punkte = ? WHERE belegwunsch.matrikelnummer = ? AND belegwunsch.wunschthema1 = thema.thema_id AND thema.modul_id = (SELECT modul_id FROM thema WHERE thema_id = ?)"))
        {
            $statement->bind_param('ssssssiiidii', $vorname, $nachname, $email, $studiengang, $status, $voraussetzungen, $seminarteilnahme, $wunschthema1, $wunschthema2, $wunschthema3, $punkte['gesamt'], $matrikelnummer, $wunschthema1);
            $statement->execute();
        } else {
            $error = $this->dbh->errno . ' ' . $this->dbh->error;
            
        }
    }

    public function deleteBewerbungModul($modul_id){
        $statement = $this->dbh->prepare("UPDATE belegwunsch
        SET erhaltenesthema = NULL 
        WHERE belegwunsch_id = (SELECT belegwunsch_id
                                            FROM thema
                                            WHERE belegwunsch.wunschthema1 = thema.thema_id
                                            AND thema.modul_id = ?) AND belegwunsch_id <> 0");
        $statement->bind_param('i', $modul_id);
        $statement->execute();   
    }

    public function duplicateBelegwunschCheck($matrikelnummer, $thema_id)
    {
        
        $statement = $this->dbh->prepare("SELECT belegwunsch.matrikelnummer FROM modul, thema, belegwunsch
                                            WHERE belegwunsch.matrikelnummer = ?
                                            AND belegwunsch.wunschthema1 = thema.thema_id
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
            
        } else { $duplicate = "neu"; }
        return $duplicate;
    }

    public function setThema($belegwunsch_id, $thema_id) 
    {
        if ($statement = $this->dbh->prepare("UPDATE belegwunsch SET erhaltenesthema = ? WHERE belegwunsch_id = ?")){
        $statement->bind_param('ii', $thema_id, $belegwunsch_id);
        $statement->execute();
        } else { //Keine Bewerbungen eingegangen.
        }
    }


    public function setModulSW($bewID_von, $bewThID_von, $bewID_zu, $bewThID_zu)
    {
        if ($statement = $this->dbh->prepare("UPDATE modul, thema SET modul.sw = 'True'
        WHERE modul.modul_id = thema.modul_id AND thema.thema_id <> 0 AND thema.thema_id =?")){
        $statement->bind_param('i', $bewThID_von);
        $statement->execute();
        } else { }
    }

    public function tauschzuKeinTH($bewID_von)
    {  // BEWERBER 
        if ($statement = $this->dbh->prepare("UPDATE belegwunsch SET erhaltenesthema =  NULL
        WHERE belegwunsch_id =?")){
        $statement->bind_param('i', $bewID_von);
        $statement->execute();
        } else { } 
    }

    public function tauschzuVTH($bewID_von,$bewThID_zu){
        if ($statement = $this->dbh->prepare("UPDATE belegwunsch SET erhaltenesthema = ?
        WHERE belegwunsch_id =?")){
        $statement->bind_param('ii', $bewThID_zu, $bewID_von);
        $statement->execute();
        } else { } 

    }

    public function tauschzuVergTH($bewID_von, $bewThID_von, $bewID_zu, $bewThID_zu)
    {  // BEWERBER 
        if ($statement = $this->dbh->prepare("UPDATE belegwunsch SET erhaltenesthema = ?
        WHERE belegwunsch_id =?")){
        $statement->bind_param('ii', $bewThID_zu, $bewID_von);
        $statement->execute();
        } else { }
        if ($statement = $this->dbh->prepare("UPDATE belegwunsch SET erhaltenesthema = NULL
        WHERE belegwunsch_id =?")){
        $statement->bind_param('i', $bewID_zu);
        $statement->execute();
        } else { }
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

    public function beleg_countStudien($modul_id, $studiengang)
    {
         $statement = $this->dbh->prepare
         ("SELECT COUNT(belegwunsch_id)
         FROM belegwunsch, thema, modul
         WHERE belegwunsch.studiengang = ? AND belegwunsch.wunschthema1 = thema.thema_id AND thema.modul_id = modul.modul_id AND modul.modul_id = ?");
        $statement->bind_param('si', $studiengang, $modul_id);
        $statement->execute();
        $statement->bind_result($anzahl_bewerber_check);
        $statement->fetch();
        return $anzahl_bewerber_check;        
    }

    public function beleg_countRest($modul_id, $studiengang)
    {
         $statement = $this->dbh->prepare
         ("SELECT COUNT(belegwunsch_id)
         FROM belegwunsch, thema, modul
         WHERE belegwunsch.studiengang != ? AND belegwunsch.wunschthema1 = thema.thema_id AND thema.modul_id = modul.modul_id AND modul.modul_id = ?");
        $statement->bind_param('si', $studiengang, $modul_id);
        $statement->execute();
        $statement->bind_result($anzahl_bewerber_check);
        $statement->fetch();
        return $anzahl_bewerber_check;        
    }

    public function countAnzWHBeleg($modul_id)
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

    public function getDataByBEWID($bewID){ 
        $statement = $this->dbh->prepare
        (" SELECT vorname, nachname, matrikelnummer,email FROM belegwunsch WHERE belegwunsch_id=?");
       $statement->bind_param('i', $bewID);
       $statement->execute();
       $statement->bind_result($vorname, $nachname, $matrikelnummer, $email);
       $statement->fetch(); 

       $teile = explode("@", $email);
       $benutzerkennung = $teile[0];

       $rows= array(
        'vorname' => $vorname,
        'nachname' => $nachname,
        'matrikelnummer' => $matrikelnummer,
        'benutzerkennung' => $benutzerkennung
    );
       return $rows;
    }  


    public function getWHThBeleg($modul_id){    
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

    public function info_belegwunsch($modul_id)
    {
         $statement = $this->dbh->prepare
         ("SELECT modul.modulbezeichnung, modul.professur, modul.kategorie
         FROM belegwunsch, thema, modul
         WHERE belegwunsch.wunschthema1 = thema.thema_id AND thema.modul_id = modul.modul_id AND modul.modul_id = ?");
        $statement->bind_param('i', $modul_id);
        $statement->execute();
        $statement->bind_result($modulbezeichnung, $professur, $kategorie);        $statement->store_result();
        $statement->fetch();

       $statement1 = $this->dbh->prepare
       ("SELECT count(thema_id) as anzThema,
                (SELECT count(thema_id) FROM thema WHERE thema_verfuegbarkeit = 'Vergeben' AND modul_id =?)
                as anzThemaVergeben
        FROM thema WHERE modul_id = ? Limit 1"); 
       $statement1->bind_param('ii', $modul_id,$modul_id);
       $statement1->execute();
       $statement1->bind_result($anz, $anzThemaVergeben);
       $statement1->fetch();
       $statement1->store_result();

        $infos = array(
            'modulbezeichnung' => $modulbezeichnung,
            'professur' => $professur,
            'kategorie' => $kategorie,
            'anzThema' => $anz,
            'anzThemaVergeben' => $anzThemaVergeben
        );

    return $infos;
    } 

    public function getBewerberInfos($studiengang, $modul_id){
        
        $statement = $this->dbh->prepare("SELECT belegwunsch_id, wunschthema1, wunschthema2, wunschthema3, studiengang, punkte
                                        FROM belegwunsch, thema 
                                        WHERE belegwunsch.wunschthema1 = thema.thema_id AND thema.modul_id = ? AND belegwunsch.studiengang != ?
                                        ORDER BY belegwunsch.punkte Desc");
        $statement->bind_param('is', $modul_id, $studiengang);
        $statement->bind_result($belegwunsch_id, $wunschthema1, $wunschthema2, $wunschthema3, $studiengang, $punkte);
        $statement->execute();
        $row = array();
        while ($statement->fetch()) {
            $rows = array(
                'belegwunsch_id' => $belegwunsch_id,
                'wunschthema1' => $wunschthema1,
                'wunschthema2' => $wunschthema2,
                'wunschthema3' => $wunschthema3,
                'studiengang' => $studiengang,
                'bewertung' => $punkte
            );
            $row[] = $rows;
        }
        return $row;
    }

    public function getBewerberInfosPlus($studiengang, $modul_id){
        
        $statement = $this->dbh->prepare("SELECT belegwunsch_id, wunschthema1, wunschthema2, wunschthema3, studiengang, punkte
                                        FROM belegwunsch, thema 
                                        WHERE belegwunsch.wunschthema1 = thema.thema_id AND thema.modul_id = ? AND belegwunsch.studiengang = ?
                                        ORDER BY belegwunsch.punkte Desc");
        $statement->bind_param('is', $modul_id, $studiengang);
        $statement->bind_result($belegwunsch_id, $wunschthema1, $wunschthema2, $wunschthema3, $studiengang, $punkte);
        $statement->execute();
        $row = array();
        while ($statement->fetch()) {
            $rows = array(
                'belegwunsch_id' => $belegwunsch_id,
                'wunschthema1' => $wunschthema1,
                'wunschthema2' => $wunschthema2,
                'wunschthema3' => $wunschthema3,
                'studiengang' => $studiengang,
                'bewertung' => $punkte
            );
            $row[] = $rows;
        }
        return $row;
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