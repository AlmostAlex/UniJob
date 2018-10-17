<?php

class modul_model
{
    public $dbh;

    public function __construct()
    {
        require(__DIR__."/../../db.php");
        $this->dbh = $dbh;
        $this->thema = new thema_model();
        $this->tags_model = new tags_model();
        $this->user = new Model();
        $this->vorkenntnisse_model = new vorkenntnisse_model();
    }

    public function insertSeminar($thema, $modulbezeichnung, $professurbezeichnung, $kategorie, $verfahren, $semester, $start, $ende, $kickoff, $studiengang, $tags, $vorkenntnisse, $betreuer)
    {
        //Erst eintragung des Moduls
        $statement = $this->dbh->prepare("INSERT INTO `modul` (`modulbezeichnung`, `professur`, `kategorie`, `verfahren`, `semester`, `frist_start`, `frist_ende`, `kickoff`, `studiengang`, `benutzer_id`, `modul_verfuegbarkeit`,`archivierung`,`nachrueckverfahren` )
        VALUES (?,?,?,?,?,?,?,?,?,?,'Offen','false', 'false')");
        $statement->bind_param('ssssssssi', $modulbezeichnung, $professurbezeichnung, $kategorie, $verfahren, $semester, $start, $ende, $kickoff, $studiengang, $_SESSION['login']);
        $statement->execute();

        //dann die hierdurch entstandene modul_id holen
        $modul_id = $this->lastModulID();

        // Leere Arrays entfernen
        array_filter($_POST['themenbezeichnungwindhund']);
        array_filter($_POST['themenbezeichnungbelegwunsch']);
        array_filter($_POST['themenbeschreibung']);

        if ($verfahren == 'Windhundverfahren' || $verfahren == 'Bewerbungsverfahren') {
            $j = 1;
            $beschreibung = $_POST['themenbeschreibung'];
        } else {
            $j = 0;
            $beschreibung = $_POST['themenbeschreibungbelegwunsch'];
        }

        //Und hier alle Themen mit den passenden Beschreibungen zu dem gerade angelegten Modul hinzufügen
        while ($j < count($thema)) {
            if (!empty($thema[$j])) {
                if (!empty($beschreibung[$j])) {
                    $beschreibung_array = $beschreibung[$j];
                    echo $beschreibung_array;
                } else{
                    $beschreibung_array = '';
                }
                    $thema_array = $thema[$j];
                    $tag_string = $tags[$j];
                    $vorkenntnisse_string = $vorkenntnisse[$j];
                    $betreuer_string = $betreuer[$j];

                    //davon ausgehend, dass der Benutzername eingegeben wird !!!!! BEI UNIDB ZUGRIFF NEU SCHREIBEN!!!!!
                    $benutzer_id = $this->user->getNachnameID($betreuer_string);
                    echo $benutzer_id;
                    if ($tag_string == '') {
                        $this->thema->insertThema($modul_id, $thema_array, $beschreibung_array,$benutzer_id);
                        $thema_id = $this->thema->lastThemaID();
                    } else {
                        $this->thema->insertThema($modul_id, $thema_array, $beschreibung_array,$benutzer_id);
                        $thema_id = $this->thema->lastThemaID();
                        $this->tags_model->insertTags($tag_string, $thema_id);
                    }
                    if($vorkenntnisse_string != ''){
                        $this->vorkenntnisse_model->insertVorkenntnisse($vorkenntnisse_string, $thema_id);
                    }

            } else {echo "thema bitte ausfüllen";}
            $j = $j + 1;
        }
    }

    public function insertAbschluss($thema, $professurbezeichnung, $kategorie, $verfahren, $semester, $start, $ende, $studiengang, $tags, $vorkenntnisse, $betreuer)
    {
        //Erst eintragung des Moduls
        $statement = $this->dbh->prepare("INSERT INTO `modul` (`professur`, `kategorie`, `verfahren`, `semester`, `frist_start`, `frist_ende`, `studiengang`, `benutzer_id`, `modul_verfuegbarkeit`,`archivierung`,`nachrueckverfahren` )
        VALUES (?,?,?,?,?,?,?,?,'Offen','false', 'false')");
        $statement->bind_param('sssssssi', $professurbezeichnung, $kategorie, $verfahren, $semester, $start, $ende, $studiengang, $_SESSION['login']);
        $statement->execute();

        //dann die hierdurch entstandene modul_id holen
        $modul_id = $this->lastModulID();

        // Leere Arrays entfernen
        array_filter($_POST['themenbezeichnungwindhund']);
        array_filter($_POST['themenbezeichnungbelegwunsch']);
        array_filter($_POST['themenbeschreibung']);
        //  array_filter($_POST['tags']);

        if ($verfahren == 'Windhundverfahren' || $verfahren == 'Bewerbungsverfahren') {
            $j = 1;
            $beschreibung = $_POST['themenbeschreibung'];
        } else {
            $j = 0;
            $beschreibung = $_POST['themenbeschreibungbelegwunsch'];
        }

        //Und hier alle Themen mit den passenden Beschreibungen zu dem gerade angelegten Modul hinzufügen
        while ($j < count($thema)) {
            if (!empty($thema[$j])) {
                if (!empty($beschreibung[$j])) {
                    $beschreibung_array = $beschreibung[$j];
                    echo $beschreibung_array;
                } else{
                    $beschreibung_array = '';
                }
                    $thema_array = $thema[$j];
                    $tag_string = $tags[$j];
                    print_r($vorkenntnisse);
                    $vorkenntnisse_string = $vorkenntnisse[$j];
                    echo $vorkenntnisse_string;

                    $betreuer_string = $betreuer[$j];

                    //davon ausgehend, dass der Benutzername eingegeben wird !!!!! BEI UNIDB ZUGRIFF NEU SCHREIBEN!!!!!
                    $benutzer_id = $this->user->getNachnameID($betreuer_string);
                    echo $benutzer_id;
                    if ($tag_string == '') {
                        $this->thema->insertThema($modul_id, $thema_array, $beschreibung_array,$benutzer_id);
                    } else {
                        $this->thema->insertThema($modul_id, $thema_array, $beschreibung_array,$benutzer_id);
                        $thema_id = $this->thema->lastThemaID();
                        $this->tags_model->insertTags($tag_string, $thema_id);
                    }
                     if($vorkenntnisse_string != ''){
                        $this->vorkenntnisse_model->insertVorkenntnisse($vorkenntnisse_string, $thema_id);
                    }
            } else {echo "thema bitte ausfüllen";}
            $j = $j + 1;
        }
    }

    public function lastModulID()
    {
        $statement = $this->dbh->prepare("SELECT max(modul_id) FROM modul");
        $statement->execute();
        $statement->bind_result($modul_id);
        $statement->fetch();
        return $modul_id;
    }

    public function getModule($filter_modul, $abfrage_th)
    {
        
        $statement = $this->dbh->prepare("SELECT modul.modul_id,modul.modulbezeichnung,modul.professur,modul.kategorie,modul.verfahren,modul.semester,modul.frist_start,modul.frist_ende,modul.studiengang,modul.modul_verfuegbarkeit,modul.archivierung,modul.nachrueckverfahren
               FROM modul Where archivierung = 'false'". $filter_modul);    
        $statement->execute();
        $statement->bind_result($modul_id, $modulbezeichnung, $professur,$kategorie, $verfahren, $semester, $frist_start, $frist_ende, $studiengang, $modul_verfuegbarkeit,$archivierung,$nachrueckverfahren);
        $statement->store_result();

        $rows = array();
        while ($statement->fetch()) {
        if($abfrage_th != '')
        {
        $statement_thema = $this->dbh->prepare("SELECT thema.thema_id
        FROM tags JOIN thema on tags.thema_id = thema.thema_id 
        WHERE thema.modul_id = ?
        GROUP BY tags.thema_id ".$abfrage_th);
        $statement_thema->bind_param('i', $modul_id);
        $statement_thema->execute();
        $statement_thema->bind_result($thema_id);
        $statement_thema->store_result();
        }else{
            $statement_thema = $this->dbh->prepare("SELECT thema.thema_id
            FROM tags JOIN thema on tags.thema_id = thema.thema_id 
            WHERE thema.modul_id = ?");
            $statement_thema->bind_param('i', $modul_id);
            $statement_thema->execute();
            $statement_thema->bind_result($thema_id);
            $statement_thema->store_result();}
        if($statement_thema->num_rows !== 0)
        {
            if (new DateTime($frist_start) > new DateTime(date("Y-m-d"))) {
                $deleteBtn = 'badge badge-danger';
            } else {  $deleteBtn = 'btn_false';}

            
            $anzahl_thema_verfuegbar = $this->getModulThemaAnzahlVerfuegbar($modul_id, "Verfügbar");
            if ((new DateTime(date("Y-m-d")) > new DateTime($frist_ende) || ($anzahl_thema_verfuegbar == "0"))) {
                $archivBtn = 'badge badge-warning';
                $btn_form  = 'btn btn-secondary disabled btn';
                $btn_msg ='Geschlossen'; 
                $state ='none';
                
            } else { $archivBtn = 'btn_false';
                  $btn_form  = 'button-two'; 
                  $btn_msg ='Anmeldung'; 
                  $state ='href="bewerbung/'.$kategorie.'/'.$modul_id.' "';
            }

            if ($nachrueckverfahren=='true') { 
                $nachrueckv_status = '[Nachrückverfahren]';
                $verfahren_anzeige = 'Windhundverfahren';
            } else { 
                $nachrueckv_status  = '';  
                $verfahren_anzeige = $verfahren;
            }

            $start_dt = new DateTime($frist_start);
            $row = array(
                'modul_id' => $modul_id,
                'modulbezeichnung' => $modulbezeichnung,
                'professur' => $professur,
                'kategorie' => $kategorie,
                'verfahren' => $verfahren,
                'semester' => $semester,
                'frist_start' => $frist_start,
                'start_anzeige' => date("d.m.Y", strtotime($frist_start)),
                'frist_ende' => $frist_ende,
                'ende_anzeige' => date("d.m.Y", strtotime($frist_ende)),
                'studiengang' => $studiengang,
                'modul_verfuegbarkeit' => $modul_verfuegbarkeit,
                'archivierung' => $archivierung,
                'checkDeleteBtn' => $deleteBtn,
                'checkArchivBtn'=> $archivBtn,
                'nachrueckv_status'=> $nachrueckv_status,
                'verfahren_anzeige'=> $verfahren_anzeige,
                'btn_form'=> $btn_form,
                'btn_msg'=> $btn_msg,
                'state'=> $state
            );
            $rows[] = $row;
        }
        }
        return $rows;
    }


    public function getModulById($modul_id)
    {
        $statement = $this->dbh->prepare("SELECT modulbezeichnung,professur,kategorie,verfahren,semester,frist_start,frist_ende,studiengang,modul_verfuegbarkeit,nachrueckverfahren From modul Where modul_id =?");
        $statement->bind_param('i', $modul_id);
        $statement->execute();
        $statement->bind_result($modulbezeichnung, $professur, $kategorie, $verfahren, $semester, $frist_start, $frist_ende, $studiengang, $modul_verfuegbarkeit, $nachrueckverfahren);

        $modul = array();
        while ($statement->fetch()) {
            $row = array(
                'modul_id' => $modul_id,
                'modulbezeichnung' => $modulbezeichnung,
                'professur' => $professur,
                'kategorie' => $kategorie,
                'verfahren' => $verfahren,
                'semester' => $semester,
                'frist_start' => $frist_start,
                'frist_ende' => $frist_ende,
                'studiengang' => $studiengang,
                'modul_verfuegbarkeit' => $modul_verfuegbarkeit,
                'nachrueckv_status' => $nachrueckverfahren
            );
            $modul = $row;
        }
        return $modul;
    }

    public function getModulbezeichnung($modul_id)
    {
        $statement = $this->dbh->prepare("SELECT modulbezeichnung From modul Where modul_id =?");
        $statement->bind_param('i', $modul_id);
        $statement->execute();
        $statement->bind_result($modulbezeichnung);
        $statement->fetch();
        return $modulbezeichnung;
    }

    public function getModulVerfahrenByID($modul_id)
    {
        $statement = $this->dbh->prepare("SELECT verfahren From modul Where modul_id =?");
        $statement->bind_param('i', $modul_id);
        $statement->execute();
        $statement->bind_result($verfahren);
        $statement->fetch();
        return $verfahren;
    }

    public function getModulNachrueckvByID($modul_id)
    {
        $statement = $this->dbh->prepare("SELECT nachrueckverfahren From modul Where modul_id =?");
        $statement->bind_param('i', $modul_id);
        $statement->execute();
        $statement->bind_result($nachrueckverfahren);
        $statement->fetch();
        return $nachrueckverfahren;
    }

    public function getVerfuegbarkeitID($modul_id)
    {
        $statement = $this->dbh->prepare("SELECT modul_verfuegbarkeit From modul Where modul_id =?");
        $statement->bind_param('i', $modul_id);
        $statement->execute();
        $statement->bind_result($modul_verfuegbarkeit);
        $statement->fetch();
        return $modul_verfuegbarkeit;
    }

    public function getFristEnde($modul_id)
    {
        $statement = $this->dbh->prepare("SELECT frist_ende From modul Where modul_id =?");
        $statement->bind_param('i', $modul_id);
        $statement->execute();
        $statement->bind_result($frist_ende);
        $statement->fetch();
        return date("d.m.Y", strtotime($frist_ende));
    }

    public function deleteModul($modul_id)
    {
        $statement = $this->dbh->prepare("DELETE FROM modul WHERE modul_id=?");
        $statement->bind_param('i', $modul_id);
        $statement->execute();      
    }

    public function getModulDateStart($modul_id)
    {
        $statement = $this->dbh->prepare("SELECT frist_start From modul Where modul_id =?");
        $statement->bind_param('i', $modul_id);
        $statement->execute();
        $statement->bind_result($frist_start);
        $statement->fetch();
        $start_dt = new DateTime($frist_start);
        return $start_dt;
    }

    public function getModulAnzahl($modul_id)
    {
        $statement = $this->dbh->prepare("SELECT count(modul_id) as anzahl_modul FROM modul WHERE modul_id = ?");
        $statement->bind_param('i', $modul_id);
        $statement->execute();
        $statement->bind_result($anzahl_modul);
        $statement->fetch();
        return $anzahl_modul;
    }

    public function updateModul($kategorie, $modulbezeichnung, $start, $ende, $semester, $studiengang, $verfahren, $modul_id)
    {
        $statement = $this->dbh->prepare("UPDATE modul SET kategorie = ?, modulbezeichnung = ?, frist_start = ?, frist_ende =?, semester =?, studiengang =?, verfahren=? WHERE modul_id = ?");
        $statement->bind_param('sssssssi', $kategorie, $modulbezeichnung, $start, $ende, $semester, $studiengang, $verfahren, $modul_id);
        $statement->execute();
    }

    public function updateArchivierung($modul_id, $true) {
        $modul_vergeben = $this->dbh->prepare("UPDATE modul SET archivierung = ? WHERE modul_id = ?");
        $modul_vergeben->bind_param('si', $true, $modul_id);
        $modul_vergeben->execute();

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

    public function updateNachrueckverfahren($modul_id, $nachrueckverfahren, $frist_ende_neu) {
        $modul_vergeben = $this->dbh->prepare("UPDATE modul SET frist_ende = ?, nachrueckverfahren = ? WHERE modul_id = ?");
        $modul_vergeben->bind_param('ssi', $frist_ende_neu, $nachrueckverfahren, $modul_id);
        $modul_vergeben->execute();
    }


    public function count_s() {
        $statement = $this->dbh->prepare("SELECT semester, count(modul_id) AS anzahl FROM modul WHERE archivierung='false' GROUP BY semester");
        $statement->execute();
        $statement->bind_result($semester, $anzahl);
    
        $s_row = array();
        while ($statement->fetch()) {
            $row = array(
                'anzahl' => $anzahl,
                'semester' => $semester
            );
            $s_row[] = $row;          
        }   
        return $s_row;
    }

    public function count_b() {
        $statement = $this->dbh->prepare("SELECT user.benutzername, user.benutzer_id, count(modul_id) AS anzahl FROM modul, user WHERE modul.benutzer_id = user.benutzer_id AND modul.archivierung='false' GROUP BY benutzername");
        $statement->execute();
        $statement->bind_result($benutzername, $benutzer_id, $anzahl);

        $b_row = array();
        while ($statement->fetch()) {
            $row = array(
                'benutzername' => $benutzername,
                'benutzer_id' => $benutzer_id,
                'anzahl' => $anzahl
            );
            $b_row[] = $row;          
        }   
        return $b_row;
    }
    public function count_k() {
        $statement = $this->dbh->prepare("SELECT kategorie, count(modul_id) AS anzahl FROM modul WHERE archivierung='false' GROUP BY kategorie");
        $statement->execute();
        $statement->bind_result($kategorie, $anzahl);

        $k_row = array();
        while ($statement->fetch()) {
            $row = array(
                'kategorie' => $kategorie,
                'anzahl' => $anzahl
            );
            $k_row[] = $row;          
        }   
        return $k_row;
    }

    public function checkModul($modul_id){

        $statement = $this->dbh->prepare("SELECT frist_ende From modul Where modul_id =?");
        $statement->bind_param('i', $modul_id);
        $statement->execute();
        $statement->bind_result($frist_ende);
        $statement->fetch();

        if(new DateTime(date("Y-m-d")) > new DateTime($frist_ende)){
            return "falseTime";     
        } else{
            return "true";
        }
    }

}
