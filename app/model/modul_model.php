<?php

class modul_model
{
    public $dbh;

    public function __construct()
    {
        require "db.php";
        $this->dbh = $dbh;
        $this->thema = new thema_model();
        $this->tags_model = new tags_model();
    }

    public function insertModul($thema, $modulbezeichnung, $kategorie, $verfahren, $semester, $start, $ende, $studiengang, $tags)
    {
        //Erst eintragung des Moduls
        $statement = $this->dbh->prepare("INSERT INTO `modul` (`modulbezeichnung`, `kategorie`, `verfahren`, `semester`, `frist_start`, `frist_ende`, `studiengang`, `benutzer_id`, `modul_verfuegbarkeit`,`archivierung`)
        VALUES (?,?,?,?,?,?,?,?,'Offen','false')");
        $statement->bind_param('sssssssi', $modulbezeichnung, $kategorie, $verfahren, $semester, $start, $ende, $studiengang, $_SESSION['login']);
        $statement->execute();

        //dann die hierdurch entstandene modul_id holen
        $statement = $this->dbh->prepare("SELECT modul_id FROM modul WHERE modulbezeichnung = ?");
        $statement->bind_param('s', $modulbezeichnung);
        $statement->execute();
        $statement->bind_result($modul_id);
        $statement->fetch();

        // Leere Arrays entfernen
        //array_filter($_POST['themenbezeichnungbelegwunsch']);
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
                    $thema_array = $thema[$j];
                    $tag_string = $tags[$j];

                    if ($tag_string == '') {
                        $this->thema->insertThema($modul_id, $thema_array, $beschreibung_array,$_SESSION['login']);
                    } else {
                        $eintrag = $this->tags_model->getTagString($tag_string);
                        $this->thema->insertThema($modul_id, $thema_array, $beschreibung_array,$_SESSION['login']);
                        $thema_id = $this->thema->lastThemaID();
                        $this->tags_model->insertTags($tag_string, $thema_id);
                    }
                } else {
                    $tag_string = $tags[$j];

                    if ($tag_string == '') {
                        $thema_array = $thema[$j];
                        $beschreibung_array = '';
                        $this->thema->insertThema($modul_id, $thema_array, $beschreibung_array,$_SESSION['login']);
                    } else {
                        $thema_array = $thema[$j];
                        $beschreibung_array = '';
                        $this->thema->insertThema($modul_id, $thema_array, $beschreibung_array,$_SESSION['login']);
                        $thema_id = $this->thema->lastThemaID();
                        $this->tags_model->insertTags($tag_string, $thema_id);
                    }
                }
            } else {echo "thema bitte ausfüllen";}
            $j = $j + 1;
        }
    }

    public function getModule()
    {
        $statement = $this->dbh->prepare("SELECT modul_id,modulbezeichnung,kategorie,verfahren,semester,frist_start,frist_ende,studiengang,modul_verfuegbarkeit,archivierung,nachrueckverfahren
               FROM modul Where archivierung = 'false'");    
        $statement->execute();
        $statement->bind_result($modul_id, $modulbezeichnung, $kategorie, $verfahren, $semester, $frist_start, $frist_ende, $studiengang, $modul_verfuegbarkeit,$archivierung,$nachrueckverfahren);
        $statement->store_result();

        $rows = array();
        while ($statement->fetch()) {

            if (new DateTime($frist_start) > new DateTime(date("Y-m-d"))) {
                $deleteBtn = 'badge badge-danger';
            } else {  $deleteBtn = 'btn_false';}

            
            $anzahl_thema_verfuegbar = $this->getModulThemaAnzahlVerfuegbar($modul_id, "Verfügbar");
            if ((new DateTime(date("Y-m-d")) > new DateTime($frist_ende) || ($anzahl_thema_verfuegbar == "0"))) {
                $archivBtn = 'badge badge-warning';
            } else { $archivBtn = 'btn_false';}

            if ($nachrueckverfahren=='true') { $nachrueckv_status = '[Nachrückverfahren]';
            } else { $nachrueckv_status  = ''; }


            $start_dt = new DateTime($frist_start);
            $row = array(
                'modul_id' => $modul_id,
                'modulbezeichnung' => $modulbezeichnung,
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
                'nachrueckv_status'=> $nachrueckv_status
            );
            $rows[] = $row;
        }
        return $rows;
    }

    public function getModulById($modul_id)
    {
        $statement = $this->dbh->prepare("SELECT modulbezeichnung,kategorie,verfahren,semester,frist_start,frist_ende,studiengang,modul_verfuegbarkeit,nachrueckverfahren From modul Where modul_id =?");
        $statement->bind_param('i', $modul_id);
        $statement->execute();
        $statement->bind_result($modulbezeichnung, $kategorie, $verfahren, $semester, $frist_start, $frist_ende, $studiengang, $modul_verfuegbarkeit, $nachrueckverfahren);

        $modul = array();
        while ($statement->fetch()) {
            $row = array(
                'modul_id' => $modul_id,
                'modulbezeichnung' => $modulbezeichnung,
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
        echo "MODELLLLL";
    }

}
