<?php
class thema_model
{
    //Erstellen einer Variable $dbh und speichern des Datenabnkzugriffs auf dieser
    //damit alle Funktionen Zugriff auf diese über $this->dbh haben
    public $dbh;

    public function __construct()
    {
        require(__DIR__."/../../db.php");
        $this->dbh = $dbh;
        $this->tags_model = new tags_model();
        $this->user = new Model();
    }

    public function insertThema($modul_id, $themenbezeichnung, $themenbeschreibung,$id)
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

    public function lastThemaID()
    {
        $statement = $this->dbh->prepare("SELECT max(thema_id) FROM thema");
        $statement->execute();
        $statement->bind_result($thema_id);
        $statement->fetch();
        return $thema_id;
    }

    public function getThemen($modul_id,$abfrage_th)
    {
        if($abfrage_th != '')
        {
        $statement_thema = $this->dbh->prepare("SELECT thema.thema_id, thema.themenbezeichnung, thema.beschreibung, thema.thema_verfuegbarkeit, thema.benutzer_id
                    FROM tags JOIN thema on tags.thema_id = thema.thema_id 
                    WHERE thema.modul_id = ?
                    GROUP BY tags.thema_id ".$abfrage_th);
        $statement_thema->bind_param('i', $modul_id);
        $statement_thema->execute();
        $statement_thema->bind_result($thema_id, $themenbezeichnung,$beschreibung, $thema_verfuegbarkeit, $benutzer_id);
        $statement_thema->store_result();
        }
        else
        {
            $statement_thema = $this->dbh->prepare("SELECT thema.thema_id, thema.themenbezeichnung, thema.beschreibung, thema.thema_verfuegbarkeit, thema.benutzer_id
                    FROM tags JOIN thema on tags.thema_id = thema.thema_id 
                    WHERE thema.modul_id = ?
                    GROUP BY thema.thema_id");

        $statement_thema->bind_param('i', $modul_id);
        $statement_thema->execute();
        $statement_thema->bind_result($thema_id, $themenbezeichnung,$beschreibung, $thema_verfuegbarkeit, $benutzer_id);
        $statement_thema->store_result();
        }

// es wird alles in ein Array gepackt und dann an den Controller weitergeleitet, dieser return die Ausgabe an die View
        $rows = array();
        while ($statement_thema->fetch()) {

            $benutzer =  $this->user->getIDNachname($benutzer_id);

            $row = array(
                'thema_id' => $thema_id,
                'themenbezeichnung' => $themenbezeichnung,
                'themenbeschreibung' => $beschreibung,
                'thema_verfuegbarkeit' => $thema_verfuegbarkeit,
                'benutzer' => $benutzer
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
                '$modul_id' => $modul_id,
                'thema_verfuegbarkeit' => $thema_verfuegbarkeit,
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

}
