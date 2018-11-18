<?php
class thema_model
{
    //Erstellen einer Variable $dbh und speichern des Datenabnkzugriffs auf dieser
    //damit alle Funktionen Zugriff auf diese über $this->dbh haben
    public $dbh;

    public function __construct()
    {
        require __DIR__ . "/../../db.php";
        $this->dbh = $dbh;
        $this->tags_model = new tags_model();
        $this->user = new Model();
    }

    public function insertThema($modul_id, $themenbezeichnung, $themenbeschreibung, $id)
    {
        if ($statement = $this->dbh->prepare("INSERT INTO `thema` (`themenbezeichnung`, `beschreibung`, `modul_id`, `thema_verfuegbarkeit`, `benutzer_id`)
        VALUES (?,?,?, 'Verfügbar',?)")) {
            $statement->bind_param('ssis', $themenbezeichnung, $themenbeschreibung, $modul_id, $id);
            $statement->execute();
        } else {
            $error = $this->dbh->errno . ' ' . $this->dbh->error;
            echo "Fehlercode: " . $error . "<br/> Eintragung vom Thema ist fehlgeschlagen.";
        }
    }

    public function getModulID($thema_id){
        $statement = $this->dbh->prepare(
        "SELECT modul_id FROM thema WHERE thema_id=?
        ");
        $statement->bind_param('i', $thema_id);
        $statement->execute();
        $statement->bind_result($modul_id);
        $statement->fetch();
        return $modul_id;
    }

    public function SwapBewThema($thID){
        $statement = $this->dbh->prepare(
        "SELECT thema.themenbezeichnung 
        FROM thema, belegwunsch
        WHERE belegwunsch.erhaltenesthema = thema.thema_id
        AND belegwunsch.erhaltenesthema =?
        ");
        $statement->bind_param('i', $thID);
        $statement->execute();
        $statement->bind_result($themenbezeichnung);
        $statement->fetch();
        return $themenbezeichnung;
    }


    public function getTHID($thID){
        $statement = $this->dbh->prepare(
        "SELECT thema.thema_id
        FROM thema, belegwunsch
        WHERE belegwunsch.erhaltenesthema = thema.thema_id
        AND belegwunsch.erhaltenesthema =?
        ");
        $statement->bind_param('i', $thID);
        $statement->execute();
        $statement->bind_result($thema_id);
        $statement->fetch();
        return $thema_id;
    }

    public function  getBewID($thID){
        $statement = $this->dbh->prepare(
            "SELECT belegwunsch_id 
            FROM belegwunsch
            WHERE erhaltenesthema =?
            ");
        $statement->bind_param('i', $thID);
        $statement->execute();
        $statement->bind_result($belegwunsch_id);
        $statement->store_result(); 
        $statement->fetch();
        return $belegwunsch_id;
    }
    
    public function swapThemen($thID){

        $statement = $this->dbh->prepare(
        "SELECT themenbezeichnung, thema_id
        FROM thema 
        WHERE thema.modul_id = (SELECT modul_id FROM thema WHERE thema_id = ?)
        AND NOT thema_id =?
        ");
        $statement->bind_param('ii', $thID,$thID);
        $statement->execute();
        $statement->bind_result($themenbezeichnung, $thema_id);
        $statement->store_result(); 

        $status ='';
        $rows = array();
        while ($statement->fetch()) {
            if($this->isNull($thema_id) == "True") 
            { $status = "Vorhanden"; 
               $bewID='NULL';
            } else {
                $status = "Vergeben";
                $bewID = $this->getBewID($thema_id);    
            } 
            $row = array(
                'thema_id' => $thema_id,
                'themenbezeichnung' => $themenbezeichnung,
                'status' => $status,
                'bewID' => $bewID       
            );
            $rows[] = $row;
        }
      return $rows;
    }

    public function swapThemenByBewID($bewID){

        $statement = $this->dbh->prepare(
        "SELECT thema.themenbezeichnung, thema.thema_id
        FROM thema, belegwunsch
        WHERE belegwunsch.wunschthema1 = thema.thema_id AND belegwunsch.belegwunsch_id = ? 
        OR belegwunsch.wunschthema2 = thema.thema_id AND belegwunsch.belegwunsch_id = ?
        OR belegwunsch.wunschthema3 = thema.thema_id AND belegwunsch.belegwunsch_id = ?
        AND thema.modul_id = (SELECT modul_id FROM thema WHERE thema_id =  belegwunsch.wunschthema1 AND belegwunsch.belegwunsch_id = ?)");
        $statement->bind_param('iiii', $bewID,$bewID,$bewID,$bewID);
        $statement->execute();
        $statement->bind_result($themenbezeichnung, $thema_id);
        $statement->store_result(); 

        $status ='';
        $rows = array();
        while ($statement->fetch()) {

            if($this->isNull($thema_id) == "True") 
            { $status = "Vorhanden"; 
               $bewID='NULL';
            } else {
                $status = "Vergeben";
                $bewID = $this->getBewID($thema_id);    
            } 

            $row = array(
                'thema_id' => $thema_id,
                'themenbezeichnung' => $themenbezeichnung,
                'status' => $status,
                'bewID' => $bewID       

            );
            $rows[] = $row;
        }
        return $rows;
    }


    public function isNull($thID){
        $statement = $this->dbh->prepare(
        "SELECT count(belegwunsch_id) as count
        FROM belegwunsch
        WHERE erhaltenesthema =?
        "); 
        $statement->bind_param('i', $thID);
        $statement->execute();
        $statement->bind_result($count);
        $statement->fetch();
        if($count == 0){
        return "True"; 
        }else{
        return "False";
        }
    }


    public function lastThemaID()
    {
        $statement = $this->dbh->prepare("SELECT max(thema_id) FROM thema");
        $statement->execute();
        $statement->bind_result($thema_id);
        $statement->fetch();
        return $thema_id;
    }

    public function getThemen($modul_id, $abfrage_th)
    {
        if ($abfrage_th != '') {
            $statement_thema = $this->dbh->prepare("SELECT thema.thema_id, 
                    thema.themenbezeichnung, thema.beschreibung, thema.thema_verfuegbarkeit, thema.benutzer_id
                    FROM tags JOIN thema on tags.thema_id = thema.thema_id
                    WHERE thema.modul_id = ?
                    GROUP BY tags.thema_id " . $abfrage_th);
            $statement_thema->bind_param('i', $modul_id);
            $statement_thema->execute();
            $statement_thema->bind_result($thema_id, $themenbezeichnung, $beschreibung, $thema_verfuegbarkeit, $benutzer_id);
            $statement_thema->store_result();
        } else {
            $statement_thema = $this->dbh->prepare("SELECT thema.thema_id, thema.themenbezeichnung, thema.beschreibung, thema.thema_verfuegbarkeit, thema.benutzer_id
                    FROM thema
                    WHERE thema.modul_id = ?
                    GROUP BY thema.thema_id");
            $statement_thema->bind_param('i', $modul_id);
            $statement_thema->execute();
            $statement_thema->bind_result($thema_id, $themenbezeichnung, $beschreibung, $thema_verfuegbarkeit, $benutzer_id);
            $statement_thema->store_result();   
        }
// es wird alles in ein Array gepackt und dann an den Controller weitergeleitet, dieser return die Ausgabe an die View
        $rows = array();
        while ($statement_thema->fetch()) {

            $benutzer = $this->user->getIDNachname($benutzer_id);

            $statement_anz = $this->dbh->prepare(
                "SELECT count(bewerbung.bewerbung_id) as anz, modul.verfahren 
                FROM  bewerbung, modul, thema
                WHERE modul.modul_id = thema.modul_id
                AND bewerbung.thema_id = thema.thema_id 
                AND thema.thema_id =?");
            $statement_anz->bind_param('i', $thema_id);
            $statement_anz->execute();
            $statement_anz->bind_result($anz, $verfahren);
            $statement_anz->store_result(); 
            $statement_anz->fetch();   
  
            if($verfahren == 'Windhundverfahren' || $verfahren == 'Belegwunschverfahren'){ $anz = "";  } 

            if($beschreibung == ''){ $beschreibung = 'Keine Beschreibung vorhanden.';}

            $row = array(
                'thema_id' => $thema_id,
                'themenbezeichnung' => $themenbezeichnung,
                'themenbeschreibung' => $beschreibung,
                'thema_verfuegbarkeit' => $thema_verfuegbarkeit,
                'benutzer' => $benutzer,
                'bewerber_anz' => $anz
            );
            $rows[] = $row;
        }
        return $rows;
    }

    public function getThemenVG($modul_id)
    {
        $vg = "Verfügbar";
        $statement = $this->dbh->prepare("SELECT thema_id, themenbezeichnung
                    FROM thema Where modul_id =? AND thema_verfuegbarkeit = ?");
        $statement->bind_param('is', $modul_id, $vg);
        $statement->execute();
        $statement->bind_result($thema_id, $themenbezeichnung);
        $statement->store_result();

// es wird alles in ein Array gepackt und dann an den Controller weitergeleitet, dieser return die Ausgabe an die View
        $rows = array();
        while ($statement->fetch()) {
            $row = array(
                'thema_id' => $thema_id,
                'themenbezeichnung' => $themenbezeichnung,
            );
            $rows[] = $row;
        }

        return $rows;
    }

    public function getThema($thema_id)
    {
        $statement_thema = $this->dbh->prepare("SELECT themenbezeichnung, beschreibung, modul_id, thema_verfuegbarkeit
                    FROM thema Where thema_id =?");
        $statement_thema->bind_param('i', $thema_id);
        $statement_thema->execute();
        $statement_thema->bind_result($themenbezeichnung, $beschreibung, $modul_id, $thema_verfuegbarkeit);
        $statement_thema->store_result();

// es wird alles in ein Array gepackt und dann an den Controller weitergeleitet, dieser return die Ausgabe an die View
        $rows = array();
        while ($statement_thema->fetch()) {
            $row = array(
                'themenbezeichnung' => $themenbezeichnung,
                'beschreibung' => $beschreibung,
                'modul_id' => $modul_id,
                'thema_verfuegbarkeit' => $thema_verfuegbarkeit,
            );
            $rows[] = $row;
        }

        return $rows;
    }


    public function getThemaEdit($thema_id)
    {
        $statement = $this->dbh->prepare("SELECT benutzer_id, themenbezeichnung, beschreibung, modul_id, thema_verfuegbarkeit
                    FROM thema Where thema_id =?");
        $statement->bind_param('i', $thema_id);
        $statement->execute();
        $statement->bind_result($benutzer_id, $themenbezeichnung, $beschreibung, $modul_id, $thema_verfuegbarkeit);
        $statement->fetch();
        $statement->store_result();

            $row = array(
                'themenbezeichnung' => $themenbezeichnung,
                'beschreibung' => $beschreibung,
                'modul_id' => $modul_id,
                'thema_verfuegbarkeit' => $thema_verfuegbarkeit,
                'benutzer_id' => $benutzer_id
            );
       
        return $row;
    }

    public function getAllModulThema($modul_id)
    {
        $statement = $this->dbh->prepare("SELECT thema_id FROM thema WHERE modul_id = ?");
        $statement->bind_param('i', $modul_id);
        $statement->execute();
        $statement->bind_result($thema_id);
        $statement->store_result();
        $rows = array();
        while ($statement->fetch()) {
            $row = array(
                'thema_id' => $thema_id,
            );
            $rows[] = $row;
        }

        return $rows;
    }

    public function deleteAllThema($modul_id)
    {
        $statement = $this->dbh->prepare("DELETE FROM thema WHERE modul_id=?");
        $statement->bind_param('i', $modul_id);
        $statement->execute();
    }

    public function getModulThemaAnzahlVerfuegbar($modul_id, $thema_verfuegbarkeit)
    {
        $statement = $this->dbh->prepare("SELECT count(thema_id) as anzahl_thema_verfuegbar FROM thema WHERE modul_id = ? AND thema_verfuegbarkeit= ? ");
        $statement->bind_param('is', $modul_id, $thema_verfuegbarkeit);
        $statement->execute();
        $statement->bind_result($anzahl_thema_verfuegbar);
        $statement->fetch();
        return $anzahl_thema_verfuegbar;
    }

    public function getThemenbezeichnung($thema_id)
    {
        $statement = $this->dbh->prepare("SELECT themenbezeichnung FROM thema WHERE thema_id = ? ");
        $statement->bind_param('i', $thema_id);
        $statement->execute();
        $statement->bind_result($themenbezeichnung);
        $statement->fetch();
        return $themenbezeichnung;
    }

    public function updateThema($benutzer_id, $themenbezeichnung, $beschreibung, $thema_id)
    {
        $statement = $this->dbh->prepare("UPDATE thema SET benutzer_id = ?,  themenbezeichnung =?, beschreibung = ?
                                        WHERE thema_id = ?");
        $statement->bind_param('issi', $benutzer_id, $themenbezeichnung, $beschreibung, $thema_id);
        $statement->execute(); 
    }

    public function getStudiengangbyThema($thema_id)
    {
        $statement = $this->dbh->prepare("SELECT modul.studiengang FROM thema, modul WHERE thema.thema_id = ? AND thema.modul_id = modul.modul_id");
        $statement->bind_param('i', $thema_id);
        $statement->execute();
        $statement->bind_result($studiengang);
        $statement->fetch();
        return $studiengang;
    }

    public function updateStatus($thema_id)
    {
        $statement = $this->dbh->prepare("UPDATE thema SET thema_verfuegbarkeit = 'Vergeben' WHERE thema_id = ?");
        $statement->bind_param('i', $thema_id);
        $statement->execute();
    }

    public function einsichtThemaModul($modul_id)
    {
        $statement = $this->dbh->prepare(
            "SELECT thema.thema_id, thema.themenbezeichnung, thema.thema_verfuegbarkeit,
            windhund.matrikelnummer, windhund.vorname, windhund.nachname, windhund.email
            FROM modul, thema, windhund
            WHERE thema.modul_id = modul.modul_id
            AND windhund.thema_id = thema.thema_id
            AND modul.modul_id = ?
            AND thema.thema_verfuegbarkeit = 'Vergeben'
            ");
        $statement->bind_param('i', $modul_id);
        $statement->execute();
        $statement->bind_result($thema_id, $themenbezeichnung, $thema_verfuegbarkeit,
            $matrikelnummer, $vorname, $nachname, $email);

        while ($statement->fetch()) {

            $row[] = array(
                'thema_id' => $thema_id,
                'themenbezeichnung' => $themenbezeichnung,
                'thema_verfuegbarkeit' => $thema_verfuegbarkeit,
                'matrikelnummer' => $matrikelnummer,
                'vorname' => $vorname,
                'nachname' => $nachname,
                'email' => $email,
            );

        }
        return $row;

    }

    public function einsichtThemaModulBeleg($modul_id)
    {
        if($statement = $this->dbh->prepare(
            "SELECT thema.themenbezeichnung, belegwunsch.wunschthema1, belegwunsch.wunschthema2, belegwunsch.wunschthema3, belegwunsch.belegwunsch_id, 
            belegwunsch.matrikelnummer, belegwunsch.vorname, belegwunsch.nachname,
            belegwunsch.email, belegwunsch.status, belegwunsch.erhaltenesthema
            FROM thema, belegwunsch, modul
            WHere thema.thema_id = belegwunsch.erhaltenesThema
            AND thema.modul_id = modul.modul_id
            AND modul.modul_id = ?
            ")) {
        $statement->bind_param('i', $modul_id);
        $statement->execute();
        $statement->bind_result($themenbezeichnung, $wunschthema1, $wunschthema2, $wunschthema3, $belegwunsch_id, $matrikelnummer, $vorname, $nachname, $email, $status, $erhaltenesthema);
        $statement->store_result();
        while ($statement->fetch()) {
            $row[] = array(
                'themenbezeichnung' => $themenbezeichnung,
                'pri1ID' => $wunschthema1,
                'pri2ID' => $wunschthema2,
                'pri3ID' => $wunschthema3,
                'pri1' => $this->getThemenbezeichnung($wunschthema1),
                'pri2' => $this->getThemenbezeichnung($wunschthema2),
                'pri3' => $this->getThemenbezeichnung($wunschthema3),
                
                'belegwunsch_id' => $belegwunsch_id,
                'matrikelnummer' => $matrikelnummer,
                'vorname' => $vorname,
                'nachname' => $nachname,
                'email' => $email,
                'status' => $status,
                'erhaltenesthema' => $erhaltenesthema
            );
            
        }
         return $row;
    }
   

 

    }

    public function keinThema($modul_id)
    {
        $statement = $this->dbh->prepare
            ("SELECT belegwunsch.belegwunsch_id, belegwunsch.matrikelnummer, belegwunsch.vorname, belegwunsch.nachname,
        belegwunsch.email, belegwunsch.status
        FROM belegwunsch, modul, thema
        WHERE belegwunsch.erhaltenesThema is Null
        AND belegwunsch.wunschthema1 = thema.thema_id
        AND thema.modul_id = modul.modul_id
        AND modul.modul_id = ?");
        $statement->bind_param('i', $modul_id);
        $statement->execute();
        $statement->bind_result($belegwunsch_id, $matrikelnummer, $vorname, $nachname, $email, $status);

        $rows = array();
        while ($statement->fetch()) {

            $row = array(
                'belegwunsch_id' => $belegwunsch_id,
                'matrikelnummer' => $matrikelnummer,
                'vorname' => $vorname,
                'nachname' => $nachname,
                'email' => $email,
                'status' => $status,
            );
            $rows[] = $row;
        }

        return $rows;
    }

    public function keinThemaCount($modul_id)
    {
        $statement = $this->dbh->prepare
            ("SELECT count(belegwunsch.belegwunsch_id) as keinThemaCount
        FROM belegwunsch, modul, thema
        WHERE belegwunsch.erhaltenesThema is Null
        AND belegwunsch.wunschthema1 = thema.thema_id
        AND thema.modul_id = modul.modul_id
        AND modul.modul_id = ?");
        $statement->bind_param('i', $modul_id);
        $statement->execute();
        $statement->bind_result($keinThemaCount);
        $statement->fetch();
        return $keinThemaCount;
    }

    public function einsichtThemaModulVerfuegbar($modul_id)
    {
        $statement = $this->dbh->prepare(
            "SELECT thema.thema_id, thema.themenbezeichnung, thema.thema_verfuegbarkeit
            FROM modul, thema
            WHERE thema.modul_id = modul.modul_id
            AND modul.modul_id = ?
            AND thema.thema_verfuegbarkeit = 'Verfügbar'
            ");
        $statement->bind_param('i', $modul_id);
        $statement->execute();
        $statement->bind_result($thema_id, $themenbezeichnung, $thema_verfuegbarkeit);
        $statement->store_result();
        while ($statement->fetch()) {

            $row[] = array(
                'thema_id' => $thema_id,
                'themenbezeichnung' => $themenbezeichnung,
            );
        }
        return $row;
    }

    public function checkThema($thema_id)
    {
        $statement = $this->dbh->prepare("SELECT thema_verfuegbarkeit FROM thema WHERE thema_id = ? ");
        $statement->bind_param('i', $thema_id);
        $statement->execute();
        $statement->bind_result($thema_verfuegbarkeit);
        $statement->fetch();

        if ($thema_verfuegbarkeit == 'Vergeben') {
            return "false_TH_Verfuegbarkeit";
        } else {
            return "true";
        }
    }

    public function getBetreuerByID($thema_id)
    {
        $statement = $this->dbh->prepare(
            "SELECT user.nachname, modul.kickoff, modul.kategorie, modul.modulbezeichnung, modul.professur
                FROM modul, thema, user
                WHERE thema.modul_id = modul.modul_id
                AND user.benutzer_id = thema.benutzer_id
                AND thema.thema_id = ?
                LIMIT 1 ");
        $statement->bind_param('i', $thema_id);
        $statement->execute();
        $statement->bind_result($nachname, $kickoff, $kategorie, $modulbezeichnung, $professur);
        $statement->fetch();

        $date = date("d.m.Y");
        $time = date("H:i:s");

        if ($kategorie == 'Seminararbeit') {
            $bez = $modulbezeichnung;
            $kat = 'Modulbezeichnung';
        } else if ($kategorie == 'Abschlussarbeit') {
            $bez = $professur;
            $kat = "Professur";
        }

        $infos = array(
            'betreuer' => $nachname,
            'kickoff' => date("d.m.Y", strtotime($kickoff)),
            'date' => $date,
            'time' => $time,
            'kategorie' => $kategorie,
            'kat' => $kat,
            'bez' => $bez,
        );

        return $infos;
    }

}
